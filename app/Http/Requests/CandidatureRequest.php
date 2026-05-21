<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CandidatureRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'entreprise' => ['required', 'string'],
            'poste' => ['required', 'string'],
            'url_offre' => ['nullable', 'url'],
            'statut' => ['required', 'in:envoyée,en_cours,entretien,offre,refusée,abandonnée'],
            'priorite' => ['required', 'in:faible,moyenne,haute'],
            'notes' => ['nullable', 'string'],
            'date_candidature' => ['required', 'date'],
            'fichier' => ['nullable', 'file', 'mimes:pdf,doc,docx', 'max:5120'],
        ];
    }
}
