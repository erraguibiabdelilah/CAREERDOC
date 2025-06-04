<?php

namespace App\Http\Controllers;

use App\Models\Langues;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LanguesController extends Controller
{
       public function store(Request $request)
    {
        $request->validate([
            'libelle' => 'required|string|max:255',
            'level' => 'required|string|in:Débutant,Intermédiaire,Avancé,Natif',
            'id_cv' => 'required|exists:cvs,id',
        ]);

        // Vérifier que le CV appartient à l'utilisateur connecté
        $cv = CV::where('id', $request->id_cv)->where('id_user', Auth::id())->firstOrFail();

        $langue = Langue::create([
            'libelle' => $request->libelle,
            'level' => $request->level,
            'id_cv' => $request->id_cv,
        ]);

        return response()->json([
            'success' => true,
            'langue' => $langue,
            'message' => 'Langue ajoutée avec succès!'
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'libelle' => 'required|string|max:255',
            'level' => 'required|string|in:Débutant,Intermédiaire,Avancé,Natif',
        ]);

        $langue = Langue::whereHas('cv', function($query) {
            $query->where('id_user', Auth::id());
        })->findOrFail($id);

        $langue->update([
            'libelle' => $request->libelle,
            'level' => $request->level,
        ]);

        return response()->json([
            'success' => true,
            'langue' => $langue,
            'message' => 'Langue mise à jour avec succès!'
        ]);
    }

    public function destroy($id)
    {
        $langue = Langue::whereHas('cv', function($query) {
            $query->where('id_user', Auth::id());
        })->findOrFail($id);

        $langue->delete();

        return response()->json([
            'success' => true,
            'message' => 'Langue supprimée avec succès!'
        ]);
    }
}


