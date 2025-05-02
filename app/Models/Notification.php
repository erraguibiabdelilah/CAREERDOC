<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $primaryKey = 'id_notification';
    protected $fillable = ['contenu', 'id_personne'];

    public function personne()
    {
        return $this->belongsTo(Personne::class, 'id_personne');
    }
}