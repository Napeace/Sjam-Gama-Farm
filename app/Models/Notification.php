<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',        // Judul notifikasi
        'message',      // Pesan/isi notifikasi
        'category',     // Kategori notifikasi
        'image_url',    // URL gambar untuk notifikasi
        'link_url',     // URL tujuan ketika notifikasi diklik
        'visitor_id',   // ID pengunjung untuk notifikasi personal (null = broadcast)
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function visitorStates()
    {
        return $this->hasMany(NotificationVisitorState::class);
    }

    /**
     * Get notification state for specific visitor
     */
    public function getStateForVisitor($visitorId)
    {
        return $this->visitorStates()->where('visitor_id', $visitorId)->first();
    }

    /**
     * Scope untuk notifikasi berdasarkan kategori
     */
    public function scopeByCategory($query, $category)
    {
        return $query->where('category', $category);
    }

    /**
     * Scope untuk notifikasi yang bisa dilihat visitor (broadcast + personal untuk visitor ini)
     */
    public function scopeForVisitor($query, $visitorId)
    {
        return $query->where(function($q) use ($visitorId) {
            $q->whereNull('visitor_id') // Broadcast notifications
              ->orWhere('visitor_id', $visitorId); // Personal notifications
        })
        ->whereDoesntHave('visitorStates', function($q) use ($visitorId) {
            $q->where('visitor_id', $visitorId)->where('is_deleted', true);
        });
    }

    /**
     * Get notifications with read status for specific visitor
     */
    public static function getForVisitorWithStates($visitorId, $limit = 10)
    {
        $notifications = self::forVisitor($visitorId)
            ->with(['visitorStates' => function($query) use ($visitorId) {
                $query->where('visitor_id', $visitorId);
            }])
            ->orderBy('created_at', 'desc')
            ->limit($limit)
            ->get();

        // Transform to include read status
        return $notifications->map(function($notification) use ($visitorId) {
            $state = $notification->visitorStates->first();

            return [
                'id' => $notification->id,
                'title' => $notification->title,
                'message' => $notification->message,
                'category' => $notification->category,
                'image_url' => $notification->image_url,
                'link_url' => $notification->link_url,
                'is_read' => $state ? $state->is_read : false,
                'created_at' => $notification->created_at->toISOString(),
            ];
        });
    }

    /**
     * Mark as read for specific visitor
     */
    public function markAsReadForVisitor($visitorId)
    {
        NotificationVisitorState::updateOrCreate(
            [
                'notification_id' => $this->id,
                'visitor_id' => $visitorId
            ],
            [
                'is_read' => true,
                'is_deleted' => false
            ]
        );
    }

    /**
     * Mark as deleted for specific visitor
     */
    public function markAsDeletedForVisitor($visitorId)
    {
        NotificationVisitorState::updateOrCreate(
            [
                'notification_id' => $this->id,
                'visitor_id' => $visitorId
            ],
            [
                'is_deleted' => true
            ]
        );
    }

    /**
     * Konversi ke format Web Push
     */
    public function toWebPushFormat()
    {
        return [
            'title' => $this->title,
            'body' => $this->message,
            'icon' => $this->image_url,
            'action_url' => $this->link_url,
            'timestamp' => $this->created_at->timestamp,
        ];
    }
}
