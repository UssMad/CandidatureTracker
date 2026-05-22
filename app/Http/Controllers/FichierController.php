<?php

namespace App\Http\Controllers;

use App\Models\Candidature;
use Illuminate\Http\Request;

class FichierController extends Controller
{
    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request, Candidature $candidature)
    {
        $this->authorize('update', $candidature);

        $request->validate([
            'fichier' => ['required', 'file', 'mimes:pdf,doc,docx', 'max:5120'],
        ]);

        $path = $request->file('fichier')->store('fichiers', 'public');

        $candidature->fichiers()->create([
            'nom_fichier' => $request->file('fichier')->getClientOriginalName(),
            'chemin' => $path,
        ]);

        return redirect()->back()->with('success', 'Fichier ajouté avec succès.');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}
