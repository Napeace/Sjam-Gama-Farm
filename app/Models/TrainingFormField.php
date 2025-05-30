<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrainingFormField extends Model
{
    use HasFactory;

    protected $fillable = [
        'training_form_id',
        'field_name',
        'field_type',
        'field_description',
        'is_required',
        'field_order'
    ];

    protected $casts = [
        'is_required' => 'boolean'
    ];

    // Field types yang tersedia
    const FIELD_TYPES = [
        'text' => 'Text',
        'textarea' => 'Textarea',
        'email' => 'Email',
        'phone' => 'Phone',
        'file' => 'File Upload'
    ];

    // Relasi ke training form
    public function trainingForm()
    {
        return $this->belongsTo(TrainingForm::class);
    }

    // Get field type label
    public function getFieldTypeLabelAttribute()
    {
        return self::FIELD_TYPES[$this->field_type] ?? $this->field_type;
    }
}
