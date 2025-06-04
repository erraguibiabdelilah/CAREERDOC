<?php

namespace App\Http\Controllers;

use App\Models\formation;
use Illuminate\Http\Request;

class FormationController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'dateDebut' => 'required|date',
            'dateFin' => 'required|date|after_or_equal:dateDebut',
            'etablissement' => 'required|string|max:255',
            'libelle' => 'required|string|max:255',
            'id_cv' => 'required|exists:cvs,id',
        ]);

        // Vérifier que le CV appartient à l'utilisateur connecté
        $cv = CV::where('id', $request->id_cv)->where('id_user', Auth::id())->firstOrFail();

        $formation = Formation::create([
            'dateDebut' => $request->dateDebut,
            'dateFin' => $request->dateFin,
            'etablissement' => $request->etablissement,
            'libelle' => $request->libelle,
            'id_cv' => $request->id_cv,
        ]);

        return response()->json([
            'success' => true,
            'formation' => $formation,
            'message' => 'Formation ajoutée avec succès!'
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'dateDebut' => 'required|date',
            'dateFin' => 'required|date|after_or_equal:dateDebut',
            'etablissement' => 'required|string|max:255',
            'libelle' => 'required|string|max:255',
        ]);

        $formation = Formation::whereHas('cv', function($query) {
            $query->where('id_user', Auth::id());
        })->findOrFail($id);

        $formation->update([
            'dateDebut' => $request->dateDebut,
            'dateFin' => $request->dateFin,
            'etablissement' => $request->etablissement,
            'libelle' => $request->libelle,
        ]);

        return response()->json([
            'success' => true,
            'formation' => $formation,
            'message' => 'Formation mise à jour avec succès!'
        ]);
    }

    public function destroy($id)
    {
        $formation = Formation::whereHas('cv', function($query) {
            $query->where('id_user', Auth::id());
        })->findOrFail($id);

        $formation->delete();

        return response()->json([
            'success' => true,
            'message' => 'Formation supprimée avec succès!'
        ]);
    }
}
