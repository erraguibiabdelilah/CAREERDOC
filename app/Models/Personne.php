<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Personne extends Authenticatable
{
    use Notifiable;

    protected $primaryKey = 'id_personne';
    protected $fillable = ['nom', 'prenom', 'email', 'password', 'role'];
    protected $hidden = ['password', 'remember_token'];

    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    // Méthode factory pour créer le bon type d'objet
    public function newFromBuilder($attributes = [], $connection = null)
    {
        if (isset($attributes->role) && $attributes->role === 'admin') {
            $model = new Admin();
        } else {
            $model = new User();
        }

        $model->exists = true;
        $model->setRawAttributes((array) $attributes, true);
        $model->setConnection($connection ?: $this->getConnectionName());

        return $model;
    }
}