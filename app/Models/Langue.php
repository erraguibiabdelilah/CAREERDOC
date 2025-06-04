<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class langue extends Model
{
    use HasFactory;

    protected $fillable = [
        'libelle',
        'level',
        'id_cv',
    ];

    // Constantes pour les niveaux
    const LEVELS = [
        'Débutant' => 'A1-A2',
        'Intermédiaire' => 'B1-B2',
        'Avancé' => 'C1-C2',
        'Natif' => 'Natif',
    ];

    const LEVEL_COLORS = [
        'Débutant' => '#dc3545',
        'Intermédiaire' => '#ffc107',
        'Avancé' => '#17a2b8',
        'Natif' => '#28a745',
    ];

    const LEVEL_PERCENTAGES = [
        'Débutant' => 25,
        'Intermédiaire' => 50,
        'Avancé' => 75,
        'Natif' => 100,
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

    public function scopeByLevel($query, $level)
    {
        return $query->where('level', $level);
    }

    public function scopeOrderByLevel($query, $direction = 'desc')
    {
        $levels = array_keys(self::LEVELS);
        $orderCase = '';

        foreach ($levels as $index => $level) {
            $orderCase .= "WHEN level = '{$level}' THEN {$index} ";
        }

        return $query->orderByRaw("CASE {$orderCase} END {$direction}");
    }

    // Accesseurs
    public function getLevelDescriptionAttribute(): string
    {
        return self::LEVELS[$this->level] ?? $this->level;
    }

    public function getLevelColorAttribute(): string
    {
        return self::LEVEL_COLORS[$this->level] ?? '#6c757d';
    }

    public function getLevelPercentageAttribute(): int
    {
        return self::LEVEL_PERCENTAGES[$this->level] ?? 0;
    }

    public function getIsNativeAttribute(): bool
    {
        return $this->level === 'Natif';
    }

    public function getIsAdvancedAttribute(): bool
    {
        return in_array($this->level, ['Avancé', 'Natif']);
    }

    // Méthodes statiques utilitaires
    public static function getLevels(): array
    {
        return array_keys(self::LEVELS);
    }

    public static function getLevelsWithDescriptions(): array
    {
        return self::LEVELS;
    }

    // Validation
    public static function boot()
    {
        parent::boot();

        static::saving(function ($langue) {
            if (!in_array($langue->level, array_keys(self::LEVELS))) {
                $langue->level = 'Débutant';
            }
        });
    }
}
