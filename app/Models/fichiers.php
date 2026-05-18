<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class fichiers extends Model
{
    protected $table = 'fichiers';
    protected $fillable = [
        'candidature_id',
        'nom_fichier',
        'chemin',
    ];

    public function candidature()
    {
        return $this->belongsTo(candidatures::class);
    }
}
