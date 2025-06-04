<?php

namespace App\Http\Controllers;

use App\Models\experience;
use Illuminate\Http\Request;

class ExperienceController extends Controller
{ public function store(Request $request)
    {
        $request->validate([
            'period' => 'required|string|max:255',
            'entreprise' => 'required|string|max:255',
            'poste' => 'required|string|max:255',
            'id_cv' => 'required|exists:cvs,id',
        ]);

        // Vérifier que le CV appartient à l'utilisateur connecté
        $cv = CV::where('id', $request->id_cv)->where('id_user', Auth::id())->firstOrFail();

        $experience = Experience::create([
            'period' => $request->period,
            'entreprise' => $request->entreprise,
            'poste' => $request->poste,
            'id_cv' => $request->id_cv,
        ]);

        return response()->json([
            'success' => true,
            'experience' => $experience,
            'message' => 'Expérience ajoutée avec succès!'
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'period' => 'required|string|max:255',
            'entreprise' => 'required|string|max:255',
            'poste' => 'required|string|max:255',
        ]);

        $experience = Experience::whereHas('cv', function($query) {
            $query->where('id_user', Auth::id());
        })->findOrFail($id);

        $experience->update([
            'period' => $request->period,
            'entreprise' => $request->entreprise,
            'poste' => $request->poste,
        ]);

        return response()->json([
            'success' => true,
            'experience' => $experience,
            'message' => 'Expérience mise à jour avec succès!'
        ]);
    }

    public function destroy($id)
    {
        $experience = Experience::whereHas('cv', function($query) {
            $query->where('id_user', Auth::id());
        })->findOrFail($id);

        $experience->delete();

        return response()->json([
            'success' => true,
            'message' => 'Expérience supprimée avec succès!'
        ]);
    }
}
