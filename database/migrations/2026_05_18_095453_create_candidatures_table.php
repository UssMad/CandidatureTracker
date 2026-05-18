<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
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

    // Relations
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function entretiens(): HasMany
    {
        return $this->hasMany(entretiens::class);
    }

    public function fichiers(): HasMany // bonus
    {
        return $this->hasMany(fichiers::class);
    }

    // Accessors — affichage en français dans les vues
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