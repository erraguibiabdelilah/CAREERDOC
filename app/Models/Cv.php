<?php

// ==== Models/CV.php ====
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CV extends Model
{
    use HasFactory;

    protected $table = 'cvs';

    protected $fillable = [
        'nom',
        'prenom',
        'age',
        'adresse',
        'tel',
        'profile',
        'gmail',
        'lienGithub',
        'lienLinkedin',
        'image',
        'id_user',
        'id_template',
    ];

    protected $casts = [
        'age' => 'integer',
    ];

    // Relations
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function template(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_template');
    }

    public function experiences(): HasMany
    {
        return $this->hasMany(Experience::class, 'id_cv')->orderBy('created_at', 'desc');
    }

    public function formations(): HasMany
    {
        return $this->hasMany(Formation::class, 'id_cv')->orderBy('dateDebut', 'desc');
    }

    public function competences(): HasMany
    {
        return $this->hasMany(Competence::class, 'id_cv');
    }

    public function langues(): HasMany
    {
        return $this->hasMany(Langue::class, 'id_cv');
    }

    // Accesseurs
    public function getFullNameAttribute(): string
    {
        return "{$this->prenom} {$this->nom}";
    }

    public function getImageUrlAttribute(): ?string
    {
        return $this->image ? asset('storage/' . $this->image) : null;
    }

    // Méthodes utilitaires
    public function hasExperiences(): bool
    {
        return $this->experiences()->count() > 0;
    }

    public function hasFormations(): bool
    {
        return $this->formations()->count() > 0;
    }

    public function hasCompetences(): bool
    {
        return $this->competences()->count() > 0;
    }

    public function hasLangues(): bool
    {
        return $this->langues()->count() > 0;
    }
}

// ==== Models/Experience.php ====


// ==== Models/Competence.php ====
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Competence extends Model
{
    use HasFactory;

    protected $fillable = [
        'libelle',
        'level',
        'id_cv',
    ];

    protected $casts = [
        'level' => 'integer',
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

    public function scopeOrderByLevel($query, $direction = 'desc')
    {
        return $query->orderBy('level', $direction);
    }

    // Accesseurs
    public function getLevelPercentageAttribute(): string
    {
        return $this->level . '%';
    }

    public function getLevelTextAttribute(): string
    {
        $level = $this->level;

        if ($level >= 90) {
            return 'Expert';
        } elseif ($level >= 75) {
            return 'Avancé';
        } elseif ($level >= 50) {
            return 'Intermédiaire';
        } elseif ($level >= 25) {
            return 'Débutant';
        } else {
            return 'Novice';
        }
    }

    public function getLevelColorAttribute(): string
    {
        $level = $this->level;

        if ($level >= 90) {
            return '#28a745'; // Vert
        } elseif ($level >= 75) {
            return '#17a2b8'; // Bleu
        } elseif ($level >= 50) {
            return '#ffc107'; // Jaune
        } elseif ($level >= 25) {
            return '#fd7e14'; // Orange
        } else {
            return '#dc3545'; // Rouge
        }
    }

    // Validation personnalisée
    public static function boot()
    {
        parent::boot();

        static::saving(function ($competence) {
            $competence->level = max(0, min(100, $competence->level));
        });
    }
}

