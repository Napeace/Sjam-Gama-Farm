<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Artikel extends Model
{
    use HasFactory;

    protected $table = 'artikels';

    protected $fillable = [
        'judul',
        'slug',
        'isi',
        'gambar',
        'kategori',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
