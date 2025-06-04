<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class experience extends Model
{
use HasFactory;

    protected $fillable = [
        'period',
        'entreprise',
        'poste',
        'id_cv',
    ];

    // Relations
    public function cv(): BelongsTo
    {
        return $this->belongsTo(CV::class, 'id_cv');
    }

    // Scopes
    public function scopeForUser($query, $userId)
    {
        return $query->whereHas('cv', function ($q) use ($userId) {
            $q->where('id_user', $userId);
        });
    }

    // Accesseurs
    public function getFormattedPeriodAttribute(): string
    {
        return $this->period ?: 'Période non spécifiée';
    }
}

