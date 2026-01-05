<?php

namespace App\Http\Controllers;

use App\Models\PageView;
use App\Models\PopularContent;
use App\Models\VisitorSession;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class AnalyticsDashboardController extends Controller
{
    /**
     * Show analytics dashboard
     */
    public function index(Request $request)
    {
        $dateRange = $request->get('range', '7'); // Default 7 days
        $startDate = Carbon::now()->subDays((int)$dateRange)->startOfDay();
        $endDate = Carbon::now()->endOfDay();

        // Overview Stats
        $stats = $this->getOverviewStats($startDate, $endDate);

        // Traffic chart data
        $trafficData = $this->getTrafficChartData($startDate, $endDate);

        // Top pages
        $topPages = $this->getTopPages($startDate, $endDate, 10);

        // Recent visitors
        $recentVisitors = $this->getRecentVisitors(20);

        // Device breakdown
        $deviceBreakdown = $this->getDeviceBreakdown($startDate, $endDate);

        // Browser breakdown
        $browserBreakdown = $this->getBrowserBreakdown($startDate, $endDate);

        // Top countries
        $topCountries = $this->getTopCountries($startDate, $endDate, 10);

        // Popular content
        $popularLawyers = $this->getPopularContent('lawyer', $startDate, $endDate, 5);
        $popularExpertise = $this->getPopularContent('expertise', $startDate, $endDate, 5);
        $popularArticles = $this->getPopularContent('article', $startDate, $endDate, 5);

        return view('admin.analytics.index', compact(
            'stats',
            'trafficData',
            'topPages',
            'recentVisitors',
            'deviceBreakdown',
            'browserBreakdown',
            'topCountries',
            'popularLawyers',
            'popularExpertise',
            'popularArticles',
            'dateRange'
        ));
    }

    /**
     * Get overview statistics
     */
    private function getOverviewStats($startDate, $endDate)
    {
        $totalVisitors = VisitorSession::whereBetween('started_at', [$startDate, $endDate])->count();
        
        $totalPageViews = PageView::whereBetween('viewed_at', [$startDate, $endDate])->count();
        
        $avgSessionDuration = VisitorSession::whereBetween('started_at', [$startDate, $endDate])
            ->avg('total_time_spent');
        
        $bounceRate = $this->calculateBounceRate($startDate, $endDate);
        
        $avgPagesPerSession = $totalVisitors > 0 ? round($totalPageViews / $totalVisitors, 2) : 0;

        // Compare with previous period
        $previousStart = $startDate->copy()->subDays($startDate->diffInDays($endDate));
        $previousEnd = $startDate->copy()->subDay();

        $previousVisitors = VisitorSession::whereBetween('started_at', [$previousStart, $previousEnd])->count();
        $visitorsChange = $previousVisitors > 0 
            ? round((($totalVisitors - $previousVisitors) / $previousVisitors) * 100, 1)
            : 0;

        return [
            'total_visitors' => $totalVisitors,
            'total_page_views' => $totalPageViews,
            'avg_session_duration' => round($avgSessionDuration ?? 0),
            'bounce_rate' => $bounceRate,
            'avg_pages_per_session' => $avgPagesPerSession,
            'visitors_change' => $visitorsChange,
        ];
    }

    /**
     * Calculate bounce rate (sessions with only 1 page view)
     */
    private function calculateBounceRate($startDate, $endDate)
    {
        $totalSessions = VisitorSession::whereBetween('started_at', [$startDate, $endDate])->count();
        
        if ($totalSessions == 0) return 0;

        $bouncedSessions = VisitorSession::whereBetween('started_at', [$startDate, $endDate])
            ->where('total_pages_viewed', 1)
            ->count();

        return round(($bouncedSessions / $totalSessions) * 100, 1);
    }

    /**
     * Get traffic chart data
     */
    private function getTrafficChartData($startDate, $endDate)
    {
        $data = PageView::whereBetween('viewed_at', [$startDate, $endDate])
            ->select(
                DB::raw('DATE(viewed_at) as date'),
                DB::raw('COUNT(*) as views'),
                DB::raw('COUNT(DISTINCT session_id) as visitors')
            )
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        return [
            'labels' => $data->pluck('date')->map(fn($d) => Carbon::parse($d)->format('M d'))->toArray(),
            'views' => $data->pluck('views')->toArray(),
            'visitors' => $data->pluck('visitors')->toArray(),
        ];
    }

    /**
     * Get top pages
     */
    private function getTopPages($startDate, $endDate, $limit = 10)
    {
        return PageView::whereBetween('viewed_at', [$startDate, $endDate])
            ->select(
                'url',
                'page_title',
                DB::raw('COUNT(*) as views'),
                DB::raw('AVG(time_on_page) as avg_time'),
                DB::raw('COUNT(DISTINCT session_id) as unique_visitors')
            )
            ->groupBy('url', 'page_title')
            ->orderByDesc('views')
            ->limit($limit)
            ->get();
    }

    /**
     * Get recent visitors
     */
    private function getRecentVisitors($limit = 20)
    {
        return VisitorSession::with('pageViews')
            ->orderByDesc('started_at')
            ->limit($limit)
            ->get();
    }

    /**
     * Get device breakdown
     */
    private function getDeviceBreakdown($startDate, $endDate)
    {
        return VisitorSession::whereBetween('started_at', [$startDate, $endDate])
            ->select('device_type', DB::raw('COUNT(*) as count'))
            ->groupBy('device_type')
            ->get();
    }

    /**
     * Get browser breakdown
     */
    private function getBrowserBreakdown($startDate, $endDate)
    {
        return VisitorSession::whereBetween('started_at', [$startDate, $endDate])
            ->select('browser', DB::raw('COUNT(*) as count'))
            ->whereNotNull('browser')
            ->groupBy('browser')
            ->orderByDesc('count')
            ->limit(5)
            ->get();
    }

    /**
     * Get top countries
     */
    private function getTopCountries($startDate, $endDate, $limit = 10)
    {
        return VisitorSession::whereBetween('started_at', [$startDate, $endDate])
            ->select('country', DB::raw('COUNT(*) as count'))
            ->whereNotNull('country')
            ->groupBy('country')
            ->orderByDesc('count')
            ->limit($limit)
            ->get();
    }

    /**
     * Get popular content
     */
    private function getPopularContent($type, $startDate, $endDate, $limit = 5)
    {
        return PopularContent::where('content_type', $type)
            ->whereBetween('date', [$startDate->toDateString(), $endDate->toDateString()])
            ->select('content_title', DB::raw('SUM(view_count) as total_views'))
            ->groupBy('content_title')
            ->orderByDesc('total_views')
            ->limit($limit)
            ->get();
    }

    /**
     * Export analytics data
     */
    public function export(Request $request)
    {
        // Add export logic (Excel/PDF)
        // We can create this next if needed
    }
}
