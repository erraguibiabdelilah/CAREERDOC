<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cv extends Model
{
    protected $primaryKey = 'id_cv';
    protected $fillable = [
        'nom', 'prenom', 'age', 'adresse', 'tele', 'gmail',
        'lien_github', 'lien_linkedin', 'competences', 'image', 'id_personne'
    ];

    public function personne()
    {
        return $this->belongsTo(Personne::class, 'id_personne');
    }

    public function parcours()
    {
        return $this->hasMany(Parcours::class, 'id_cv');
    }

    public function experiences()
    {
        return $this->hasMany(Experience::class, 'id_cv');
    }

    public function langues()
    {
        return $this->hasMany(Langue::class, 'id_cv');
    }
}