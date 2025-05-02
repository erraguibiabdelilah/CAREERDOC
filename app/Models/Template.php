<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Template extends Model
{
    protected $primaryKey = 'id_template';
    protected $fillable = ['contenu', 'id_personne'];

    public function personne()
    {
        return $this->belongsTo(Personne::class, 'id_personne');
    }
}