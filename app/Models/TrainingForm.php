<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrainingForm extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'max_quota',
        'current_quota',
        'training_date',
        'training_time',
        'location',
        'location_url',
        'price',
        'is_active'
    ];

    protected $casts = [
        'training_date' => 'date',
        'training_time' => 'datetime',
        'price' => 'decimal:2',
        'is_active' => 'boolean'
    ];

    // Relasi ke training form fields
    public function fields()
    {
        return $this->hasMany(TrainingFormField::class)->orderBy('field_order');
    }

    // Relasi ke training registrations
    public function registrations()
    {
        return $this->hasMany(TrainingRegistration::class);
    }

    // Relasi ke registrasi yang approved saja
    public function approvedRegistrations()
    {
        return $this->hasMany(TrainingRegistration::class)
            ->where('status', TrainingRegistration::STATUS_APPROVED);
    }

    // Scope untuk form yang aktif
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    // PERBAIKAN: Hitung kuota berdasarkan registrasi yang approved
    public function getActualCurrentQuotaAttribute()
    {
        return $this->approvedRegistrations()->count();
    }

    // Cek apakah kuota masih tersedia berdasarkan approved registrations
    public function hasAvailableQuota()
    {
        return $this->getActualCurrentQuotaAttribute() < $this->max_quota;
    }

    // Get sisa kuota berdasarkan approved registrations
    public function getAvailableQuotaAttribute()
    {
        return $this->max_quota - $this->getActualCurrentQuotaAttribute();
    }

    // Get persentase kuota yang terisi
    public function getQuotaPercentageAttribute()
    {
        if ($this->max_quota <= 0) {
            return 0;
        }
        return ($this->getActualCurrentQuotaAttribute() / $this->max_quota) * 100;
    }

    // Format harga
    public function getFormattedPriceAttribute()
    {
        return $this->price == 0 ? 'Gratis' : 'Rp ' . number_format($this->price, 0, ',', '.');
    }

    // Method untuk sinkronisasi current_quota dengan data aktual
    public function syncCurrentQuota()
    {
        $actualQuota = $this->getActualCurrentQuotaAttribute();
        if ($this->current_quota != $actualQuota) {
            $this->update(['current_quota' => $actualQuota]);
        }
        return $actualQuota;
    }
}
