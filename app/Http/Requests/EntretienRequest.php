<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EntretienRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'type' => ['required', 'in:téléphonique,visio,présentiel,technique,RH'],
            'date_heure' => ['required', 'date_format:Y-m-d H:i'],
            'statut' => ['required', 'in:En attente,Refusé,accepté'],
            'notes_preparation' => ['nullable', 'string'],
            'resultat' => ['required', 'in:en_attente,positif,négatif'],
        ];
    }
}
