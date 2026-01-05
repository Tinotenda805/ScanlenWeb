<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\PageView;
use App\Models\VisitorSession;
use Illuminate\Support\Str;

class TrackPageViews
{
    /**
     * List of excluded routes/paths
     */
    private $excludedPaths = [
        'admin/*',
        'api/*',
        'login',
        'login/*',
        'logout',
        'logout/*',
        'auth/*',
        'sanctum/*',
    ];

    /**
     * List of excluded route names (if using named routes)
     */
    private $excludedRouteNames = [
        'login',
        'login.store',
        'logout',
        'admin.*', // Exclude all admin routes
    ];

    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        // Skip tracking for excluded routes
        if ($this->shouldSkipTracking($request)) {
            return $next($request);
        }

        // Generate or retrieve session ID
        $sessionId = session()->getId();
        if (!$sessionId) {
            session()->start();
            $sessionId = session()->getId();
        }

        // Parse user agent
        $userAgent = $request->userAgent() ?? '';
        $deviceType = $this->getDeviceType($userAgent);
        $browser = $this->getBrowser($userAgent);
        $platform = $this->getPlatform($userAgent);

        // Get location data
        $ipAddress = $request->ip();
        $country = $this->getCountryFromIP($ipAddress);
        $city = null;

        // Check if this is a fresh session (first request)
        $isFreshSession = !VisitorSession::where('session_id', $sessionId)->exists();

        // Create or update visitor session
        $session = VisitorSession::firstOrCreate(
            ['session_id' => $sessionId],
            [
                'ip_address' => $ipAddress,
                'country' => $country,
                'city' => $city,
                'user_agent' => $userAgent,
                'device_type' => $deviceType,
                'browser' => $browser,
                'platform' => $platform,
                'landing_page' => $request->fullUrl(),
                'started_at' => now(),
            ]
        );

        // Update session stats (only if not an admin page)
        $session->increment('total_pages_viewed');
        $session->update([
            'exit_page' => $request->fullUrl(),
            'ended_at' => now(),
        ]);

        // Track page view
        PageView::create([
            'session_id' => $sessionId,
            'ip_address' => $ipAddress,
            'country' => $country,
            'city' => $city,
            'user_agent' => $userAgent,
            'device_type' => $deviceType,
            'browser' => $browser,
            'platform' => $platform,
            'url' => $request->fullUrl(),
            'page_title' => $this->getPageTitle($request),
            'referrer' => $request->header('referer'),
            'viewed_at' => now(),
            'is_admin_page' => $this->isAdminRoute($request), // Add flag
        ]);

        return $next($request);
    }

    /**
     * Check if request should be excluded from tracking
     */
    private function shouldSkipTracking(Request $request): bool
    {
        // Skip AJAX/JSON requests
        if ($request->ajax() || $request->wantsJson()) {
            return true;
        }

        // Skip excluded paths
        foreach ($this->excludedPaths as $path) {
            if ($request->is($path)) {
                return true;
            }
        }

        // Skip excluded route names
        $route = $request->route();
        if ($route && $route->getName()) {
            foreach ($this->excludedRouteNames as $routePattern) {
                if (Str::is($routePattern, $route->getName())) {
                    return true;
                }
            }
        }

        // Skip based on URL segments (more comprehensive)
        $url = $request->fullUrl();
        if (str_contains($url, '/admin') || 
            str_contains($url, '/login') || 
            str_contains($url, '/logout') ||
            str_contains($url, '/auth')) {
            return true;
        }

        return false;
    }

    /**
     * Check if this is an admin route
     */
    private function isAdminRoute(Request $request): bool
    {
        $route = $request->route();
        $path = $request->path();
        
        return $request->is('admin/*') || 
               ($route && Str::startsWith($route->getName(), 'admin.')) ||
               Str::startsWith($path, 'admin/');
    }

    /**
     * Get page title from route or URL
     */
    private function getPageTitle(Request $request): string
    {
        $route = $request->route();
        if ($route && $route->getName()) {
            return $route->getName();
        }
        
        $path = $request->path();
        return ucwords(str_replace(['-', '_', '/'], ' ', $path));
    }

    /**
     * Detect device type from user agent
     */
    private function getDeviceType(string $userAgent): string
    {
        if (preg_match('/(tablet|ipad|playbook)|(android(?!.*(mobi|opera mini)))/i', $userAgent)) {
            return 'tablet';
        }
        
        if (preg_match('/(up.browser|up.link|mmp|symbian|smartphone|midp|wap|phone|android|iemobile)/i', $userAgent)) {
            return 'mobile';
        }
        
        return 'desktop';
    }

    /**
     * Detect browser from user agent
     */
    private function getBrowser(string $userAgent): string
    {
        $browsers = [
            'Edge' => '/Edge\/([0-9\.]+)/i',
            'Chrome' => '/Chrome\/([0-9\.]+)/i',
            'Safari' => '/Safari\/([0-9\.]+)/i',
            'Firefox' => '/Firefox\/([0-9\.]+)/i',
            'Opera' => '/Opera\/([0-9\.]+)/i',
            'MSIE' => '/MSIE ([0-9\.]+)/i',
        ];

        foreach ($browsers as $browser => $pattern) {
            if (preg_match($pattern, $userAgent)) {
                return $browser;
            }
        }

        return 'Unknown';
    }

    /**
     * Detect platform/OS from user agent
     */
    private function getPlatform(string $userAgent): string
    {
        $platforms = [
            'Windows' => '/Windows/i',
            'Mac' => '/Macintosh|Mac OS X/i',
            'Linux' => '/Linux/i',
            'Ubuntu' => '/Ubuntu/i',
            'iPhone' => '/iPhone/i',
            'iPad' => '/iPad/i',
            'Android' => '/Android/i',
        ];

        foreach ($platforms as $platform => $pattern) {
            if (preg_match($pattern, $userAgent)) {
                return $platform;
            }
        }

        return 'Unknown';
    }

    /**
     * Basic country detection from IP
     */
    private function getCountryFromIP(string $ip): ?string
    {
        // For localhost/development
        if ($ip === '127.0.0.1' || $ip === '::1' || str_starts_with($ip, '192.168.')) {
            return 'Local';
        }

        // Basic implementation using ip-api.com
        try {
            $response = @file_get_contents("http://ip-api.com/json/{$ip}?fields=country", false, stream_context_create([
                'http' => [
                    'timeout' => 2,
                    'ignore_errors' => true,
                ]
            ]));
            
            if ($response) {
                $data = json_decode($response, true);
                return $data['country'] ?? null;
            }
        } catch (\Exception $e) {
            // Silent fail
        }

        return null;
    }
}