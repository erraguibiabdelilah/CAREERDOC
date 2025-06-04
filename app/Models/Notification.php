<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model // Majuscule pour respecter les conventions
{
    protected $fillable = [
        'contenu',
        'estLu',
        'id_user',
    ];
}
