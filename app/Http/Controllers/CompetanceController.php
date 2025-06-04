<?php

namespace App\Http\Controllers;

use App\Models\competance;
use Illuminate\Http\Request;

class CompetanceController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'libelle' => 'required|string|max:255',
            'level' => 'required|integer|min:0|max:100',
            'id_cv' => 'required|exists:cvs,id',
        ]);

        // Vérifier que le CV appartient à l'utilisateur connecté
        $cv = CV::where('id', $request->id_cv)->where('id_user', Auth::id())->firstOrFail();

        $competence = Competence::create([
            'libelle' => $request->libelle,
            'level' => $request->level,
            'id_cv' => $request->id_cv,
        ]);

        return response()->json([
            'success' => true,
            'competence' => $competence,
            'message' => 'Compétence ajoutée avec succès!'
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'libelle' => 'required|string|max:255',
            'level' => 'required|integer|min:0|max:100',
        ]);

        $competence = Competence::whereHas('cv', function($query) {
            $query->where('id_user', Auth::id());
        })->findOrFail($id);

        $competence->update([
            'libelle' => $request->libelle,
            'level' => $request->level,
        ]);

        return response()->json([
            'success' => true,
            'competence' => $competence,
            'message' => 'Compétence mise à jour avec succès!'
        ]);
    }

    public function destroy($id)
    {
        $competence = Competence::whereHas('cv', function($query) {
            $query->where('id_user', Auth::id());
        })->findOrFail($id);

        $competence->delete();

        return response()->json([
            'success' => true,
            'message' => 'Compétence supprimée avec succès!'
        ]);
    }
}
