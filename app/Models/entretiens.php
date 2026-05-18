<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class entretiens extends Model
{
    protected $table = 'entretiens';
    protected $fillable = [
        'candidature_id',
        'type',
        'date_heure',
        'notes_preparation',
        'resultat',
    ];

    public function candidature()
    {
        return $this->belongsTo(candidatures::class);
    }
}
