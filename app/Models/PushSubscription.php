<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class PushSubscription extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'endpoint',         // Endpoint URL dari browser
        'public_key',       // Public key (p256dh) dari subscription
        'auth_token',       // Auth token dari subscription
        'content_encoding', // Content encoding (biasanya 'aesgcm')
        'visitor_id',       // ID pengunjung untuk identifikasi tanpa login
        'subscribed_at',    // Waktu pertama kali subscribe
    ];

    protected $casts = [
        'subscribed_at' => 'datetime',
    ];

    /**
     * Mendapatkan route untuk pengiriman notifikasi via WebPush.
     * Ini dibutuhkan oleh package WebPush Laravel.
     */
    public function routeNotificationForWebPush()
    {
        return [
            'endpoint' => $this->endpoint,
            'keys' => [
                'p256dh' => $this->public_key,
                'auth' => $this->auth_token,
            ],
            'contentEncoding' => $this->content_encoding,
        ];
    }

    /**
     * Scope untuk mencari subscription berdasarkan visitor ID
     */
    public function scopeForVisitor($query, $visitorId)
    {
        return $query->where('visitor_id', $visitorId);
    }

    /**
     * Update waktu terakhir subscription digunakan
     */
    public function updateLastActivity()
    {
        $this->update(['updated_at' => now()]);
        return $this;
    }
}
