<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Models\PushSubscription;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cookie;
use NotificationChannels\WebPush\WebPushMessage;
use Illuminate\Support\Facades\Notification as NotificationFacade;

class NotificationController extends Controller
{
    /**
     * Menampilkan notifikasi untuk pengunjung saat ini
     */
    public function index(Request $request)
    {
        $visitorId = $request->cookie('visitor_id');

        if (!$visitorId) {
            return response()->json(['notifications' => [], 'unread_count' => 0]);
        }

        $notifications = Notification::forVisitor($visitorId)
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();

        return response()->json([
            'notifications' => $notifications,
            'unread_count' => $notifications->where('is_read', false)->count()
        ]);
    }

    /**
     * Menyimpan subscription push notification dari browser
     */
    public function subscribe(Request $request)
    {
        // Fix for the validation
        $request->validate([
            'endpoint' => 'required|string',
            'keys.auth' => 'required|string',
            'keys.p256dh' => 'required|string',
        ]);

        // Generate atau dapatkan visitor_id dari cookie
        $visitorId = $request->cookie('visitor_id');

        if (!$visitorId) {
            $visitorId = Str::uuid()->toString();
        }

        // Simpan subscription
        $subscription = PushSubscription::updateOrCreate(
            ['endpoint' => $request->endpoint],
            [
                'public_key' => $request->keys['p256dh'],
                'auth_token' => $request->keys['auth'],
                'content_encoding' => $request->contentEncoding ?? 'aesgcm',
                'visitor_id' => $visitorId,
                'subscribed_at' => now(),
            ]
        );

        // Set cookie untuk mengingat visitor (30 hari)
        return response()->json(['success' => true, 'subscribed' => true])
            ->cookie('visitor_id', $visitorId, 60 * 24 * 30);
    }

    /**
     * Memeriksa status subscription
     */
    public function checkSubscription(Request $request)
    {
        $visitorId = $request->cookie('visitor_id');

        if (!$visitorId) {
            return response()->json(['subscribed' => false]);
        }

        $hasSubscription = PushSubscription::where('visitor_id', $visitorId)->exists();

        return response()->json(['subscribed' => $hasSubscription]);
    }

    /**
     * Menghapus subscription
     */
    public function unsubscribe(Request $request)
    {
        $request->validate([
            'endpoint' => 'required|string',
        ]);

        PushSubscription::where('endpoint', $request->endpoint)->delete();

        return response()->json(['success' => true]);
    }

    /**
     * Menandai notifikasi sebagai dibaca
     */
    public function markAsRead(Request $request, $id)
    {
        $notification = Notification::findOrFail($id);
        $notification->markAsRead();

        return response()->json(['success' => true]);
    }

    /**
     * Menandai semua notifikasi sebagai dibaca
     */
    public function markAllAsRead(Request $request)
    {
        $visitorId = $request->cookie('visitor_id');

        if ($visitorId) {
            Notification::where('visitor_id', $visitorId)
                ->where('is_read', false)
                ->update(['is_read' => true]);
        }

        return response()->json(['success' => true]);
    }

    /**
     * Kirim notifikasi ke pengunjung tertentu atau semua pengunjung
     * Biasanya dipanggil dari admin panel
     */
    public function send(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:100',
            'message' => 'required|string|max:200',
            'category' => 'nullable|string',
            'image_url' => 'nullable|url',
            'link_url' => 'nullable|url',
            'visitor_id' => 'nullable|string', // Changed to string as uuid is a string
        ]);

        // Buat notifikasi di database
        $notification = Notification::create([
            'title' => $request->title,
            'message' => $request->message,
            'category' => $request->category,
            'image_url' => $request->image_url,
            'link_url' => $request->link_url,
            'visitor_id' => $request->visitor_id,
            'is_read' => false,
        ]);

        // Ambil subscription untuk kirim push notification
        $query = PushSubscription::query();

        if ($request->visitor_id) {
            $query->where('visitor_id', $request->visitor_id);
        }

        if ($request->category) {
            // Jika ingin filter berdasarkan kategori, tambahkan logika di sini
        }

        $subscriptions = $query->get();

        if ($subscriptions->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'Tidak ada subscription yang ditemukan'
            ]);
        }

        // Kirim push notification ke semua subscription
        foreach ($subscriptions as $subscription) {
            $this->sendWebPushNotification($subscription, $notification);
        }

        return response()->json([
            'success' => true,
            'message' => 'Notifikasi berhasil dikirim ke ' . $subscriptions->count() . ' pengunjung'
        ]);
    }

    /**
     * Kirim notifikasi Web Push ke subscription tertentu
     */
    protected function sendWebPushNotification($subscription, $notification)
    {
        // Gunakan Laravel WebPush Package untuk mengirim notifikasi
        $message = (new WebPushMessage)
            ->title($notification->title)
            ->body($notification->message)
            ->action('View', $notification->link_url ?? url('/'))
            ->options(['TTL' => 1000]);

        if ($notification->image_url) {
            $message->icon($notification->image_url);
        }

        NotificationFacade::send(
            $subscription,
            new \App\Notifications\WebPushNotification($message)
        );
    }
}
