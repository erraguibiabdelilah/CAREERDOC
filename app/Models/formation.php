<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class formation extends Model
{
     use HasFactory;

    protected $fillable = [
        'dateDebut',
        'dateFin',
        'etablissement',
        'libelle',
        'id_cv',
    ];

    protected $casts = [
        'dateDebut' => 'date',
        'dateFin' => 'date',
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

    public function scopeOrderByDate($query, $direction = 'desc')
    {
        return $query->orderBy('dateDebut', $direction);
    }

    // Accesseurs
    public function getFormattedDateDebutAttribute(): string
    {
        return $this->dateDebut ? $this->dateDebut->format('m/Y') : '';
    }

    public function getFormattedDateFinAttribute(): string
    {
        return $this->dateFin ? $this->dateFin->format('m/Y') : '';
    }

    public function getFormattedPeriodAttribute(): string
    {
        $debut = $this->formatted_date_debut;
        $fin = $this->formatted_date_fin;

        if ($debut && $fin) {
            return "{$debut} - {$fin}";
        } elseif ($debut) {
            return "Depuis {$debut}";
        } elseif ($fin) {
            return "Jusqu'à {$fin}";
        }

        return 'Période non spécifiée';
    }

    public function getDurationAttribute(): ?int
    {
        if (!$this->dateDebut || !$this->dateFin) {
            return null;
        }

        return $this->dateDebut->diffInMonths($this->dateFin);
    }

    public function getDurationTextAttribute(): string
    {
        $duration = $this->duration;

        if (!$duration) {
            return '';
        }

        if ($duration < 12) {
            return "{$duration} mois";
        }

        $years = floor($duration / 12);
        $months = $duration % 12;

        $text = "{$years} an" . ($years > 1 ? 's' : '');

        if ($months > 0) {
            $text .= " et {$months} mois";
        }

        return $text;
    }
}
