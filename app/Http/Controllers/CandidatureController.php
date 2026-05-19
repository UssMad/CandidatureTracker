<?php

namespace App\Http\Controllers;

use App\Models\Candidature;
use App\Http\Requests\CandidatureRequest;
use Illuminate\Http\Request;

class CandidatureController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->user()->candidatures()->with('entretiens');

        if ($request->filled('statut')) {
            $query->where('statut', $request->statut);
        }

        if ($request->filled('priorite')) {
            $query->where('priorite', $request->priorite);
        }

        $candidatures = $query->orderBy('date_candidature', 'desc')->get();

        return view('candidatures.index', compact('candidatures'));
    }

    public function create()
    {
        return view('candidatures.create');
    }

    public function store(CandidatureRequest $request)
    {
        $candidature = $request->user()->candidatures()->create(
            $request->validated()
        );

        return redirect()->route('candidatures.show', $candidature)
            ->with('success', 'Candidature créée avec succès.');
    }

    public function show(Candidature $candidature)
    {
        $this->authorize('view', $candidature);

        $candidature->load('entretiens');

        return view('candidatures.show', compact('candidature'));
    }

    public function edit(Candidature $candidature)
    {
        $this->authorize('update', $candidature);

        return view('candidatures.edit', compact('candidature'));
    }

    public function update(CandidatureRequest $request, Candidature $candidature)
    {
        $this->authorize('update', $candidature);

        $candidature->update($request->validated());

        return redirect()->route('candidatures.show', $candidature)
            ->with('success', 'Candidature mise à jour avec succès.');
    }

    public function destroy(Candidature $candidature)
    {
        $this->authorize('delete', $candidature);

        $candidature->delete();

        return redirect()->route('candidatures.index')
            ->with('success', 'Candidature archivée avec succès.');
    }
}
