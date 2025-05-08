<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'deskripsi',
        'harga',
        'status_booking',
        'status_stok',
        'tanggal_tanam',
        'prediksi_panen',
        'gambar',
    ];

    protected $casts = [
        'tanggal_tanam' => 'date',
        'prediksi_panen' => 'date',
    ];
}
