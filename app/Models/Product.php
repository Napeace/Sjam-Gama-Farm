<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'tipe_produk',
        'deskripsi',
        'harga',
        'status_booking',
        'status_stok',
        'stok',
        'tanggal_tanam',
        'prediksi_panen',
        'gambar',
    ];

    protected $casts = [
        'tanggal_tanam' => 'date',
        'prediksi_panen' => 'date',
    ];

    // Scope untuk filter berdasarkan tipe produk
    public function scopeSayur($query)
    {
        return $query->where('tipe_produk', 'SAYUR');
    }

    public function scopeAlat($query)
    {
        return $query->where('tipe_produk', 'ALAT');
    }

    // Accessor untuk menentukan apakah produk tersedia
    public function getIsAvailableAttribute()
    {
        if ($this->tipe_produk === 'SAYUR') {
            return $this->status_stok === 'TERSEDIA';
        } else {
            return $this->stok > 0;
        }
    }

    // Accessor untuk status stok yang dinamis
    public function getStockStatusAttribute()
    {
        if ($this->tipe_produk === 'SAYUR') {
            return $this->status_stok;
        } else {
            return $this->stok > 0 ? 'TERSEDIA' : 'TIDAK TERSEDIA';
        }
    }
}
