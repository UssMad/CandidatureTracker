<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Candidature extends Model
{
    use SoftDeletes;

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

    protected function casts(): array
    {
        return [
            'date_candidature' => 'date',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function entretiens()
    {
        return $this->hasMany(Entretien::class);
    }

    public function fichiers()
    {
        return $this->hasMany(Fichier::class);
    }

    public function getStatutLabelAttribute(): string
    {
        return match($this->statut) {
            'envoyée'    => 'Envoyée',
            'en_cours'   => 'En cours',
            'entretien'  => 'Entretien',
            'offre'      => 'Offre reçue',
            'refusée'    => 'Refusée',
            'abandonnée' => 'Abandonnée',
            default      => $this->statut,
        };
    }

    public function getPrioriteLabelAttribute(): string
    {
        return match($this->priorite) {
            'faible'  => 'Faible',
            'moyenne' => 'Moyenne',
            'haute'   => 'Haute',
            default   => $this->priorite,
        };
    }
}
