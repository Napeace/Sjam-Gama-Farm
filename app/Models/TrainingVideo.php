<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrainingVideo extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'youtube_url',
        'youtube_video_id',
        'is_active',
        'thumbnail_url',
        'view_count'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'view_count' => 'integer',
    ];

    /**
     * Extract YouTube video ID from URL
     */
    public function extractYouTubeId($url)
    {
        preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/', $url, $matches);
        return isset($matches[1]) ? $matches[1] : null;
    }

    /**
     * Get YouTube thumbnail URL
     */
    public function getYouTubeThumbnail($videoId)
    {
        return "https://img.youtube.com/vi/{$videoId}/maxresdefault.jpg";
    }

    /**
     * Boot method to automatically extract video ID and thumbnail
     */
    protected static function boot()
    {
        parent::boot();

        static::saving(function ($video) {
            if ($video->youtube_url) {
                $videoId = $video->extractYouTubeId($video->youtube_url);
                if ($videoId) {
                    $video->youtube_video_id = $videoId;
                    $video->thumbnail_url = $video->getYouTubeThumbnail($videoId);
                }
            }
        });
    }


    /**
     * Scope for active videos
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Increment view count
     */
    public function incrementViewCount()
    {
        $this->increment('view_count');
    }
}
