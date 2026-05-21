<?php

namespace App\Http\Controllers;

use App\Models\Candidature;
use Illuminate\Http\Request;

class ArchiveController extends Controller
{
    public function index(Request $request)
    {
        $candidatures = $request->user()->candidatures()
            ->onlyTrashed()
            ->with('entretiens')
            ->orderBy('deleted_at', 'desc')
            ->get();

        return view('archives.index', compact('candidatures'));
    }

    public function show($id)
    {
        $candidature = Candidature::withTrashed()->with('entretiens', 'fichiers')->findOrFail($id);

        $this->authorize('view', $candidature);

        return view('candidatures.show', compact('candidature'));
    }

    public function restore($id)
    {
        $candidature = Candidature::withTrashed()->findOrFail($id);

        $this->authorize('restore', $candidature);

        $candidature->restore();

        return redirect()->route('candidatures.show', $candidature)
            ->with('success', 'Candidature restaurée avec succès.');
    }
}
