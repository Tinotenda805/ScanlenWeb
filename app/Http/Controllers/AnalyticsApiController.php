<?php

namespace App\Http\Controllers;

use App\Models\ClickEvent;
use App\Models\PageView;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AnalyticsApiController extends Controller
{
    /**
     * Track time spent on page
     */
    public function trackTime(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'url' => 'required|string',
            'time_spent' => 'required|integer|min:0',
            'page_title' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false], 400);
        }

        $sessionId = session()->getId();
        
        // Find the most recent page view for this session and URL
        $pageView = PageView::where('session_id', $sessionId)
            ->where('url', $request->url)
            ->latest('viewed_at')
            ->first();

        if ($pageView) {
            $pageView->update([
                'time_on_page' => $request->time_spent,
            ]);

            // Update session total time
            $pageView->session()->increment('total_time_spent', $request->time_spent);
        }

        return response()->json(['success' => true]);
    }

    /**
     * Track click events
     */
    public function trackClick(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'url' => 'required|string',
            'element_type' => 'required|string',
            'element_id' => 'nullable|string',
            'element_class' => 'nullable|string',
            'element_text' => 'nullable|string',
            'target_url' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false], 400);
        }

        $sessionId = session()->getId();

        ClickEvent::create([
            'session_id' => $sessionId,
            'url' => $request->url,
            'element_type' => $request->element_type,
            'element_id' => $request->element_id,
            'element_class' => $request->element_class,
            'element_text' => $request->element_text,
            'target_url' => $request->target_url,
            'clicked_at' => now(),
        ]);

        return response()->json(['success' => true]);
    }
}
