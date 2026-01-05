/**
 * Scanlen & Holderness Analytics Tracker
 * Tracks time on page and click events
 */

(function() {
    'use strict';

    // Configuration
    const TRACKER = {
        startTime: Date.now(),
        lastActivityTime: Date.now(),
        isActive: true,
        heartbeatInterval: 30000, // 30 seconds
        inactivityThreshold: 30000, // 30 seconds
    };

    /**
     * Send analytics data to server
     */
    function sendAnalytics(endpoint, data) {
        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content;
        
        fetch(endpoint, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
                'X-Requested-With': 'XMLHttpRequest',
            },
            body: JSON.stringify(data),
            keepalive: true, // Ensures request completes even if page is closing
        }).catch(err => {
            // Silent fail - don't disrupt user experience
            console.debug('Analytics tracking error:', err);
        });
    }

    /**
     * Calculate time spent on page
     */
    function getTimeOnPage() {
        return Math.floor((Date.now() - TRACKER.startTime) / 1000); // in seconds
    }

    /**
     * Send time tracking update
     */
    function sendTimeUpdate() {
        if (!TRACKER.isActive) return;

        const timeSpent = getTimeOnPage();
        
        sendAnalytics('/api/analytics/time', {
            url: window.location.href,
            time_spent: timeSpent,
            page_title: document.title,
        });
    }

    /**
     * Track click events
     */
    function trackClick(event) {
        const target = event.target.closest('a, button');
        if (!target) return;

        const data = {
            url: window.location.href,
            element_type: target.tagName.toLowerCase(),
            element_id: target.id || null,
            element_class: target.className || null,
            element_text: target.textContent?.trim().substring(0, 100) || null,
            target_url: target.href || null,
        };

        sendAnalytics('/api/analytics/click', data);
    }

    /**
     * Track activity (user is active on page)
     */
    function trackActivity() {
        TRACKER.lastActivityTime = Date.now();
        TRACKER.isActive = true;
    }

    /**
     * Check if user is inactive
     */
    function checkInactivity() {
        const timeSinceLastActivity = Date.now() - TRACKER.lastActivityTime;
        if (timeSinceLastActivity > TRACKER.inactivityThreshold) {
            TRACKER.isActive = false;
        }
    }

    /**
     * Send final time update before page unload
     */
    function handlePageUnload() {
        // Use sendBeacon for reliable delivery
        const timeSpent = getTimeOnPage();
        const data = JSON.stringify({
            url: window.location.href,
            time_spent: timeSpent,
            page_title: document.title,
        });

        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content;
        const blob = new Blob([data], { type: 'application/json' });
        
        // Try sendBeacon first (more reliable)
        if (navigator.sendBeacon) {
            const formData = new FormData();
            formData.append('data', blob);
            formData.append('_token', csrfToken);
            navigator.sendBeacon('/api/analytics/time', formData);
        } else {
            // Fallback to synchronous XHR
            sendTimeUpdate();
        }
    }

    /**
     * Initialize tracker
     */
    function init() {
        // Don't track in admin areas
        if (window.location.pathname.startsWith('/admin')) {
            return;
        }

        // Track activity events
        ['mousedown', 'mousemove', 'keypress', 'scroll', 'touchstart'].forEach(event => {
            document.addEventListener(event, trackActivity, { passive: true });
        });

        // Track clicks
        document.addEventListener('click', trackClick, true);

        // Send heartbeat updates
        setInterval(() => {
            checkInactivity();
            if (TRACKER.isActive) {
                sendTimeUpdate();
            }
        }, TRACKER.heartbeatInterval);

        // Track page unload
        window.addEventListener('beforeunload', handlePageUnload);
        window.addEventListener('pagehide', handlePageUnload); // For mobile browsers

        // Track visibility changes (tab switching)
        document.addEventListener('visibilitychange', () => {
            if (document.hidden) {
                TRACKER.isActive = false;
                sendTimeUpdate();
            } else {
                TRACKER.isActive = true;
                trackActivity();
            }
        });

        console.debug('📊 Analytics tracker initialized');
    }

    // Initialize when DOM is ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }
})();