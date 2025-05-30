<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrainingRegistration extends Model
{
    use HasFactory;

    protected $fillable = [
        'training_form_id',
        'email',
        'answers',
        'status',
        'registered_at'
    ];

    protected $casts = [
        'answers' => 'array',
        'registered_at' => 'datetime'
    ];

    // Status options
    const STATUS_PENDING = 'pending';
    const STATUS_APPROVED = 'approved';
    const STATUS_REJECTED = 'rejected';

    const STATUSES = [
        self::STATUS_PENDING => 'Pending',
        self::STATUS_APPROVED => 'Approved',
        self::STATUS_REJECTED => 'Rejected'
    ];

    // Relasi ke training form
    public function trainingForm()
    {
        return $this->belongsTo(TrainingForm::class);
    }

    // Get status label
    public function getStatusLabelAttribute()
    {
        return self::STATUSES[$this->status] ?? $this->status;
    }

    // Accessor untuk mendapatkan data dari backup (jika ada)
    public function getBackupNameAttribute()
    {
        return $this->answers['backup_name'] ?? null;
    }

    public function getBackupPhoneAttribute()
    {
        return $this->answers['backup_phone'] ?? null;
    }

    public function getBackupPaymentProofAttribute()
    {
        return $this->answers['backup_payment_proof'] ?? null;
    }

    // Helper method untuk mendapatkan jawaban form (tanpa backup data)
    public function getFormAnswersAttribute()
    {
        $answers = $this->answers ?? [];

        // Remove backup data from answers
        unset($answers['backup_name']);
        unset($answers['backup_phone']);
        unset($answers['backup_payment_proof']);

        return $answers;
    }

    // Scope untuk status tertentu
    public function scopePending($query)
    {
        return $query->where('status', self::STATUS_PENDING);
    }

    public function scopeApproved($query)
    {
        return $query->where('status', self::STATUS_APPROVED);
    }

    public function scopeRejected($query)
    {
        return $query->where('status', self::STATUS_REJECTED);
    }
}
