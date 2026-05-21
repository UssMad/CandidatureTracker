<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EntretienRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        if ($this->has('date_heure')) {
            $this->merge([
                'date_heure' => str_replace('T', ' ', $this->date_heure),
            ]);
        }
    }

    public function rules(): array
    {
        return [
            'type' => ['required', 'in:téléphonique,visio,présentiel,technique,RH'],
            'date_heure' => ['required', 'date'],
            'statut' => ['required', 'in:En attente,Refusé,accepté'],
            'notes_preparation' => ['nullable', 'string'],
            'resultat' => ['required', 'in:en_attente,positif,négatif'],
        ];
    }
}
