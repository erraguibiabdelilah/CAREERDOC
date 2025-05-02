<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lettre extends Model
{
    protected $primaryKey = 'id_lettre';
    
    public function personne()
    {
        return $this->belongsTo(Personne::class, 'id_personne');
    }
}
