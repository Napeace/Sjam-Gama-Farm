<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Models\NotificationVisitorState;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class NotificationController extends Controller
{
    /**
     * Display notifications for the current visitor
     */
    public function index(Request $request)
    {
        // Get visitor_id from cookie or header
        $visitorId = $request->cookie('visitor_id') ?: $request->header('X-Visitor-ID');

        // If no visitor_id, return empty response
        if (!$visitorId) {
            return response()->json(['notifications' => [], 'unread_count' => 0]);
        }

        // Get notifications with states for this visitor
        $notifications = Notification::getForVisitorWithStates($visitorId, 10);
        $unreadCount = $notifications->where('is_read', false)->count();

        return response()->json([
            'notifications' => $notifications,
            'unread_count' => $unreadCount
        ]);
    }

    /**
     * Mark a notification as read for current visitor
     */
    public function markAsRead(Request $request, $id)
    {
        try {
            // Get visitor_id from cookie or header
            $visitorId = $request->cookie('visitor_id') ?: $request->header('X-Visitor-ID');

            if (!$visitorId) {
                return response()->json(['success' => false, 'message' => 'Visitor ID not found'], 400);
            }

            $notification = Notification::findOrFail($id);
            $notification->markAsReadForVisitor($visitorId);

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            Log::error('Error marking notification as read: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Notification not found'], 404);
        }
    }

    /**
     * Mark all notifications as read for current visitor
     */
    public function markAllAsRead(Request $request)
    {
        try {
            // Get visitor_id from cookie or header
            $visitorId = $request->cookie('visitor_id') ?: $request->header('X-Visitor-ID');

            if (!$visitorId) {
                return response()->json(['success' => false, 'message' => 'Visitor ID not found'], 400);
            }

            // Get all notifications for this visitor
            $notifications = Notification::forVisitor($visitorId)->get();

            // Mark each as read
            foreach ($notifications as $notification) {
                $notification->markAsReadForVisitor($visitorId);
            }

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            Log::error('Error marking all notifications as read: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Error occurred'], 500);
        }
    }

    /**
     * Send notification to visitor(s)
     */
    public function send(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:100',
            'message' => 'required|string|max:200',
            'category' => 'nullable|string',
            'image_url' => 'nullable|url',
            'link_url' => 'nullable|url',
            'visitor_id' => 'nullable|string',
        ]);

        // Create notification in database
        $notification = Notification::create([
            'title' => $request->title,
            'message' => $request->message,
            'category' => $request->category,
            'image_url' => $request->image_url,
            'link_url' => $request->link_url,
            'visitor_id' => $request->visitor_id, // If null, it's a broadcast
        ]);

        return response()->json([
            'success' => true,
            'notification_id' => $notification->id,
            'message' => 'Notifikasi berhasil dibuat'
        ]);
    }

    /**
     * Delete a specific notification for current visitor
     */
    public function delete(Request $request, $id)
    {
        try {
            Log::info('Delete notification request received', [
                'notification_id' => $id,
                'visitor_id_header' => $request->header('X-Visitor-ID'),
                'visitor_id_cookie' => $request->cookie('visitor_id'),
                'headers' => $request->headers->all()
            ]);

            // Get visitor_id from cookie or header
            $visitorId = $request->cookie('visitor_id') ?: $request->header('X-Visitor-ID');

            if (!$visitorId) {
                Log::error('Delete notification failed: Visitor ID not found');
                return response()->json(['success' => false, 'message' => 'Visitor ID not found'], 400);
            }

            // Check if notification exists
            $notification = Notification::find($id);
            if (!$notification) {
                Log::error('Delete notification failed: Notification not found', ['id' => $id]);
                return response()->json(['success' => false, 'message' => 'Notification not found'], 404);
            }

            // Check if notification is accessible by this visitor
            $isAccessible = Notification::forVisitor($visitorId)->where('id', $id)->exists();
            if (!$isAccessible) {
                Log::error('Delete notification failed: Not accessible by visitor', [
                    'notification_id' => $id,
                    'visitor_id' => $visitorId
                ]);
                return response()->json(['success' => false, 'message' => 'Notification not accessible'], 403);
            }

            // Mark as deleted for this visitor
            $notification->markAsDeletedForVisitor($visitorId);

            Log::info('Notification deleted successfully', [
                'notification_id' => $id,
                'visitor_id' => $visitorId
            ]);

            return response()->json(['success' => true, 'message' => 'Notification deleted successfully']);

        } catch (\Exception $e) {
            Log::error('Error deleting notification: ' . $e->getMessage(), [
                'notification_id' => $id,
                'trace' => $e->getTraceAsString()
            ]);
            return response()->json(['success' => false, 'message' => 'Server error occurred'], 500);
        }
    }

    /**
     * Delete all notifications for current visitor
     */
    public function deleteAll(Request $request)
    {
        try {
            // Get visitor_id from cookie or header
            $visitorId = $request->cookie('visitor_id') ?: $request->header('X-Visitor-ID');

            if (!$visitorId) {
                return response()->json(['success' => false, 'message' => 'Visitor ID not found'], 400);
            }

            // Get all notifications for this visitor
            $notifications = Notification::forVisitor($visitorId)->get();

            // Mark each as deleted for this visitor
            foreach ($notifications as $notification) {
                $notification->markAsDeletedForVisitor($visitorId);
            }

            Log::info('All notifications deleted for visitor', ['visitor_id' => $visitorId]);

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            Log::error('Error deleting all notifications: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Error occurred'], 500);
        }
    }
}
