<?php
namespace App\Http\Controllers;

use App\Models\lettre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LettreController extends Controller
{
    public function store(Request $request)
    {
        // Validation des données reçues
        $validated = $request->validate([
            'lieuEtDate' => 'required|string|max:255',
            'nomEmetteur' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'tel' => 'required|string|max:50',
            'adresseEmetteur' => 'required|string|max:255',
            'entrepriseName' => 'required|string|max:255',
            'adresseEntreprise' => 'required|string|max:255',
            'objet' => 'required|string|max:255',
            'contenu' => 'required|string',
            'signature' => 'required|string|max:255',
        ]);

        // Création de la nouvelle lettre avec l'id de l'utilisateur connecté
        $lettre = new lettre();
        $lettre->lieuEtDate = $validated['lieuEtDate'];
        $lettre->nomEmetteur = $validated['nomEmetteur'];
        $lettre->email = $validated['email'];
        $lettre->tel = $validated['tel'];
        $lettre->adresseEmetteur = $validated['adresseEmetteur'];
        $lettre->entrepriseName = $validated['entrepriseName'];
        $lettre->adresseEntreprise = $validated['adresseEntreprise'];
        $lettre->objet = $validated['objet'];
        $lettre->contenu = $validated['contenu'];
        $lettre->signature = $validated['signature'];
        $lettre->id_user = Auth::id();  // récupère l'utilisateur connecté

        $lettre->save();

        // Rediriger avec un message de succès
        return redirect()->back()->with('success', 'Lettre enregistrée avec succès !');
    }
}
