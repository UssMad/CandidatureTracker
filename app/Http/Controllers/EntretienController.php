<?php

namespace App\Http\Controllers;

use App\Models\Candidature;
use App\Models\Entretien;
use App\Http\Requests\EntretienRequest;

class EntretienController extends Controller
{
    public function store(EntretienRequest $request, Candidature $candidature)
    {
        $this->authorize('view', $candidature);

        $entretien = $candidature->entretiens()->create($request->validated());

        return redirect()->route('candidatures.show', $candidature)
            ->with('success', 'Entretien ajouté avec succès.');
    }

    public function update(EntretienRequest $request, Candidature $candidature, Entretien $entretien)
    {
        $this->authorize('update', $entretien);

        $entretien->update($request->validated());

        return redirect()->route('candidatures.show', $candidature)
            ->with('success', 'Entretien mis à jour avec succès.');
    }

    public function destroy(Candidature $candidature, Entretien $entretien)
    {
        $this->authorize('delete', $entretien);

        $entretien->delete();

        return redirect()->route('candidatures.show', $candidature)
            ->with('success', 'Entretien supprimé avec succès.');
    }
}
