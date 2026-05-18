<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class candidatures extends Model
{
    use SoftDeletes;
    protected $table = 'candidatures';
    protected $fillable = [
        'user_id',
        'entreprise',
        'poste',
        'url_offre',
        'statut',
        'priorite',
        'notes',
        'date_candidature',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function entretiens()
    {
        return $this->hasMany(entretiens::class);
    }

    public function fichiers()
    {
        return $this->hasMany(fichiers::class);
    }
}
