<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Parcours extends Model
{
    protected $primaryKey = 'id_parcours';
    protected $fillable = [
        'date_debut', 'date_fin', 'etablissement', 'libelle_diplome', 'id_cv'
    ];

    public function cv()
    {
        return $this->belongsTo(Cv::class, 'id_cv');
    }
}