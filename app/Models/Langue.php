<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Langue extends Model
{
    protected $primaryKey = 'id_langue';
    protected $fillable = ['libelle_langue', 'niveau', 'id_cv'];

    public function cv()
    {
        return $this->belongsTo(Cv::class, 'id_cv');
    }
}