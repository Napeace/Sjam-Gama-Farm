<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',        // Judul notifikasi
        'message',      // Pesan/isi notifikasi (sama dengan 'body' di standar web push)
        'category',     // Kategori notifikasi (misalnya: 'hidroponik', 'peternakan', dll)
        'image_url',    // URL gambar untuk notifikasi (opsional)
        'link_url',     // URL tujuan ketika notifikasi diklik
        'is_read',      // Status dibaca (boolean)
        'visitor_id',   // ID pengunjung (untuk notifikasi personal)
    ];

    protected $casts = [
        'is_read' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Scope untuk notifikasi yang belum dibaca
     */
    public function scopeUnread($query)
    {
        return $query->where('is_read', false);
    }

    /**
     * Scope untuk notifikasi berdasarkan kategori
     */
    public function scopeByCategory($query, $category)
    {
        return $query->where('category', $category);
    }

    /**
     * Scope untuk notifikasi berdasarkan visitor ID
     */
    public function scopeForVisitor($query, $visitorId)
    {
        return $query->where(function($q) use ($visitorId) {
            $q->where('visitor_id', $visitorId)
              ->orWhereNull('visitor_id'); // Include broadcast notifications
        });
    }

    /**
     * Tandai notifikasi sebagai dibaca
     */
    public function markAsRead()
    {
        $this->update(['is_read' => true]);
        return $this;
    }

    /**
     * Tandai notifikasi sebagai belum dibaca
     */
    public function markAsUnread()
    {
        $this->update(['is_read' => false]);
        return $this;
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
