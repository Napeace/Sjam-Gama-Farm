<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotificationVisitorState extends Model
{
    use HasFactory;

    protected $fillable = [
        'notification_id',
        'visitor_id',
        'is_read',
        'is_deleted',
    ];

    protected $casts = [
        'is_read' => 'boolean',
        'is_deleted' => 'boolean',
    ];

    public function notification()
    {
        return $this->belongsTo(Notification::class);
    }
}
