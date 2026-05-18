<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Entretien extends Model
{
    protected $fillable = [
        'candidature_id',
        'type',
        'date_heure',
        'notes_preparation',
        'resultat',
    ];

    protected function casts(): array
    {
        return [
            'date_heure' => 'datetime',
        ];
    }

    public function candidature(): BelongsTo
    {
        return $this->belongsTo(Candidature::class);
    }

    public function getTypeLabelAttribute(): string
    {
        return match($this->type) {
            'téléphonique' => 'Téléphonique',
            'visio'        => 'Visio',
            'présentiel'   => 'Présentiel',
            'technique'    => 'Technique',
            'RH'           => 'RH',
            default        => $this->type,
        };
    }

    public function getResultatLabelAttribute(): string
    {
        return match($this->resultat) {
            'en_attente' => 'En attente',
            'positif'    => 'Positif',
            'négatif'    => 'Négatif',
            default      => $this->resultat,
        };
    }
}
