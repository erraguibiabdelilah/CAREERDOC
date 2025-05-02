<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    protected $primaryKey = 'id_experience';
    protected $fillable = [
        'date_debut', 'date_fin', 'entreprise', 'poste', 'id_cv'
    ];

    public function cv()
    {
        return $this->belongsTo(Cv::class, 'id_cv');
    }
}