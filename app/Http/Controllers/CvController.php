<?php

namespace App\Http\Controllers;

use App\Models\CV;
use App\Models\Experience;
use App\Models\Formation;
use App\Models\Competence;
use App\Models\Langue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CVController extends Controller
{
    public function index()
    {
        $cvs = CV::where('id_user', Auth::id())->with(['experiences', 'formations', 'competences', 'langues'])->get();
        return view('cv.index', compact('cvs'));
    }

    public function create()
    {
        return view('cv.create');
    }

    // Nouvelle méthode pour créer un CV temporaire
    public function createTemp(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'age' => 'required|integer|min:16|max:100',
            'adresse' => 'required|string|max:255',
            'tel' => 'required|string|max:20',
            'gmail' => 'required|email|max:255',
        ]);

        try {
            // Créer le CV principal temporaire
            $cv = CV::create([
                'nom' => $request->nom,
                'prenom' => $request->prenom,
                'age' => $request->age,
                'adresse' => $request->adresse,
                'tel' => $request->tel,
                'profile' => $request->profile,
                'gmail' => $request->gmail,
                'lienGithub' => $request->lienGithub,
                'lienLinkedin' => $request->lienLinkedin,
                'id_user' => Auth::id(),
                'id_template' => 1, // Valeur par défaut
                'is_draft' => true, // Nouveau champ pour marquer comme brouillon
            ]);

            return response()->json([
                'success' => true,
                'cv_id' => $cv->id,
                'message' => 'CV temporaire créé avec succès'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la création du CV: ' . $e->getMessage()
            ], 500);
        }
    }

    // Ajouter une expérience
    public function addExperience(Request $request)
    {
        $request->validate([
            'cv_id' => 'required|exists:cvs,id',
            'period' => 'required|string|max:255',
            'entreprise' => 'required|string|max:255',
            'poste' => 'required|string|max:255',
        ]);

        try {
            $cv = CV::where('id', $request->cv_id)
                   ->where('id_user', Auth::id())
                   ->firstOrFail();

            $experience = Experience::create([
                'period' => $request->period,
                'entreprise' => $request->entreprise,
                'poste' => $request->poste,
                'id_cv' => $cv->id,
            ]);

            return response()->json([
                'success' => true,
                'experience' => $experience,
                'message' => 'Expérience ajoutée avec succès'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de l\'ajout de l\'expérience: ' . $e->getMessage()
            ], 500);
        }
    }

    // Ajouter une formation
    public function addFormation(Request $request)
    {
        $request->validate([
            'cv_id' => 'required|exists:cvs,id',
            'dateDebut' => 'required|date',
            'dateFin' => 'required|date|after_or_equal:dateDebut',
            'etablissement' => 'required|string|max:255',
            'libelle' => 'required|string|max:255',
        ]);

        try {
            $cv = CV::where('id', $request->cv_id)
                   ->where('id_user', Auth::id())
                   ->firstOrFail();

            $formation = Formation::create([
                'dateDebut' => $request->dateDebut,
                'dateFin' => $request->dateFin,
                'etablissement' => $request->etablissement,
                'libelle' => $request->libelle,
                'id_cv' => $cv->id,
            ]);

            return response()->json([
                'success' => true,
                'formation' => $formation,
                'message' => 'Formation ajoutée avec succès'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de l\'ajout de la formation: ' . $e->getMessage()
            ], 500);
        }
    }

    // Ajouter une compétence
    public function addCompetence(Request $request)
    {
        $request->validate([
            'cv_id' => 'required|exists:cvs,id',
            'libelle' => 'required|string|max:255',
            'level' => 'required|integer|min:0|max:100',
        ]);

        try {
            $cv = CV::where('id', $request->cv_id)
                   ->where('id_user', Auth::id())
                   ->firstOrFail();

            $competence = Competence::create([
                'libelle' => $request->libelle,
                'level' => $request->level,
                'id_cv' => $cv->id,
            ]);

            return response()->json([
                'success' => true,
                'competence' => $competence,
                'message' => 'Compétence ajoutée avec succès'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de l\'ajout de la compétence: ' . $e->getMessage()
            ], 500);
        }
    }

    // Ajouter une langue
    public function addLangue(Request $request)
    {
        $request->validate([
            'cv_id' => 'required|exists:cvs,id',
            'libelle' => 'required|string|max:255',
            'level' => 'required|string|in:Débutant,Intermédiaire,Avancé,Natif',
        ]);

        try {
            $cv = CV::where('id', $request->cv_id)
                   ->where('id_user', Auth::id())
                   ->firstOrFail();

            $langue = Langue::create([
                'libelle' => $request->libelle,
                'level' => $request->level,
                'id_cv' => $cv->id,
            ]);

            return response()->json([
                'success' => true,
                'langue' => $langue,
                'message' => 'Langue ajoutée avec succès'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de l\'ajout de la langue: ' . $e->getMessage()
            ], 500);
        }
    }

    // Finaliser le CV
    public function finalize(Request $request)
    {
        $request->validate([
            'cv_id' => 'required|exists:cvs,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'id_template' => 'required|exists:templates,id',
        ]);

        try {
            $cv = CV::where('id', $request->cv_id)
                   ->where('id_user', Auth::id())
                   ->firstOrFail();

            // Upload image si présente
            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('cv_images', 'public');
                $cv->image = $imagePath;
            }

            // Finaliser le CV
            $cv->update([
                'id_template' => $request->id_template,
                'is_draft' => false, // Marquer comme finalisé
            ]);

            return response()->json([
                'success' => true,
                'message' => 'CV finalisé avec succès',
                'redirect_url' => route('cv.show', $cv->id)
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la finalisation du CV: ' . $e->getMessage()
            ], 500);
        }
    }

    // Supprimer un élément
    public function deleteItem(Request $request)
    {
        $request->validate([
            'type' => 'required|in:experience,formation,competence,langue',
            'id' => 'required|integer',
        ]);

        try {
            switch ($request->type) {
                case 'experience':
                    $item = Experience::where('id', $request->id)
                                    ->whereHas('cv', function($query) {
                                        $query->where('id_user', Auth::id());
                                    })->firstOrFail();
                    break;
                case 'formation':
                    $item = Formation::where('id', $request->id)
                                   ->whereHas('cv', function($query) {
                                       $query->where('id_user', Auth::id());
                                   })->firstOrFail();
                    break;
                case 'competence':
                    $item = Competence::where('id', $request->id)
                                    ->whereHas('cv', function($query) {
                                        $query->where('id_user', Auth::id());
                                    })->firstOrFail();
                    break;
                case 'langue':
                    $item = Langue::where('id', $request->id)
                                ->whereHas('cv', function($query) {
                                    $query->where('id_user', Auth::id());
                                })->firstOrFail();
                    break;
            }

            $item->delete();

            return response()->json([
                'success' => true,
                'message' => ucfirst($request->type) . ' supprimé(e) avec succès'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la suppression: ' . $e->getMessage()
            ], 500);
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'age' => 'required|integer|min:16|max:100',
            'adresse' => 'required|string|max:255',
            'tel' => 'required|string|max:20',
            'profile' => 'nullable|string',
            'gmail' => 'required|email|max:255',
            'lienGithub' => 'nullable|url',
            'lienLinkedin' => 'nullable|url',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'id_template' => 'required|exists:templates,id',
        ]);

        DB::beginTransaction();
        try {
            // Upload image si présente
            $imagePath = null;
            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('cv_images', 'public');
            }

            // Créer le CV principal
            $cv = CV::create([
                'nom' => $request->nom,
                'prenom' => $request->prenom,
                'age' => $request->age,
                'adresse' => $request->adresse,
                'tel' => $request->tel,
                'profile' => $request->profile,
                'gmail' => $request->gmail,
                'lienGithub' => $request->lienGithub,
                'lienLinkedin' => $request->lienLinkedin,
                'image' => $imagePath,
                'id_user' => Auth::id(),
                'id_template' => $request->id_template,
            ]);

            // Ajouter les expériences
            if ($request->has('experiences')) {
                foreach ($request->experiences as $experience) {
                    if (!empty($experience['period']) || !empty($experience['entreprise']) || !empty($experience['poste'])) {
                        Experience::create([
                            'period' => $experience['period'],
                            'entreprise' => $experience['entreprise'],
                            'poste' => $experience['poste'],
                            'id_cv' => $cv->id,
                        ]);
                    }
                }
            }

            // Ajouter les formations
            if ($request->has('formations')) {
                foreach ($request->formations as $formation) {
                    if (!empty($formation['dateDebut']) || !empty($formation['dateFin']) ||
                        !empty($formation['etablissement']) || !empty($formation['libelle'])) {
                        Formation::create([
                            'dateDebut' => $formation['dateDebut'],
                            'dateFin' => $formation['dateFin'],
                            'etablissement' => $formation['etablissement'],
                            'libelle' => $formation['libelle'],
                            'id_cv' => $cv->id,
                        ]);
                    }
                }
            }

            // Ajouter les compétences
            if ($request->has('competences')) {
                foreach ($request->competences as $competence) {
                    if (!empty($competence['libelle'])) {
                        Competence::create([
                            'libelle' => $competence['libelle'],
                            'level' => $competence['level'] ?? 50,
                            'id_cv' => $cv->id,
                        ]);
                    }
                }
            }

            // Ajouter les langues
            if ($request->has('langues')) {
                foreach ($request->langues as $langue) {
                    if (!empty($langue['libelle'])) {
                        Langue::create([
                            'libelle' => $langue['libelle'],
                            'level' => $langue['level'] ?? 'Débutant',
                            'id_cv' => $cv->id,
                        ]);
                    }
                }
            }

            DB::commit();
            return redirect()->route('cv.show', $cv->id)->with('success', 'CV créé avec succès!');

        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Erreur lors de la création du CV: ' . $e->getMessage());
        }
    }

    public function show($id)
    {
        $cv = CV::with(['experiences', 'formations', 'competences', 'langues'])
                ->where('id', $id)
                ->where('id_user', Auth::id())
                ->firstOrFail();

        return view('cv.show', compact('cv'));
    }

    public function edit($id)
    {
        $cv = CV::with(['experiences', 'formations', 'competences', 'langues'])
                ->where('id', $id)
                ->where('id_user', Auth::id())
                ->firstOrFail();

        return view('cv.edit', compact('cv'));
    }

    public function update(Request $request, $id)
    {
        $cv = CV::where('id', $id)->where('id_user', Auth::id())->firstOrFail();

        $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'age' => 'required|integer|min:16|max:100',
            'adresse' => 'required|string|max:255',
            'tel' => 'required|string|max:20',
            'profile' => 'nullable|string',
            'gmail' => 'required|email|max:255',
            'lienGithub' => 'nullable|url',
            'lienLinkedin' => 'nullable|url',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        DB::beginTransaction();
        try {
            // Upload nouvelle image si présente
            if ($request->hasFile('image')) {
                // Supprimer l'ancienne image
                if ($cv->image) {
                    Storage::disk('public')->delete($cv->image);
                }
                $imagePath = $request->file('image')->store('cv_images', 'public');
                $cv->image = $imagePath;
            }

            // Mettre à jour les informations principales
            $cv->update([
                'nom' => $request->nom,
                'prenom' => $request->prenom,
                'age' => $request->age,
                'adresse' => $request->adresse,
                'tel' => $request->tel,
                'profile' => $request->profile,
                'gmail' => $request->gmail,
                'lienGithub' => $request->lienGithub,
                'lienLinkedin' => $request->lienLinkedin,
                'image' => $cv->image,
            ]);

            // Supprimer et recréer les relations (méthode simple)
            $cv->experiences()->delete();
            $cv->formations()->delete();
            $cv->competences()->delete();
            $cv->langues()->delete();

            // Recréer les expériences
            if ($request->has('experiences')) {
                foreach ($request->experiences as $experience) {
                    if (!empty($experience['period']) || !empty($experience['entreprise']) || !empty($experience['poste'])) {
                        Experience::create([
                            'period' => $experience['period'],
                            'entreprise' => $experience['entreprise'],
                            'poste' => $experience['poste'],
                            'id_cv' => $cv->id,
                        ]);
                    }
                }
            }

            // Recréer les formations
            if ($request->has('formations')) {
                foreach ($request->formations as $formation) {
                    if (!empty($formation['dateDebut']) || !empty($formation['dateFin']) ||
                        !empty($formation['etablissement']) || !empty($formation['libelle'])) {
                        Formation::create([
                            'dateDebut' => $formation['dateDebut'],
                            'dateFin' => $formation['dateFin'],
                            'etablissement' => $formation['etablissement'],
                            'libelle' => $formation['libelle'],
                            'id_cv' => $cv->id,
                        ]);
                    }
                }
            }

            // Recréer les compétences
            if ($request->has('competences')) {
                foreach ($request->competences as $competence) {
                    if (!empty($competence['libelle'])) {
                        Competence::create([
                            'libelle' => $competence['libelle'],
                            'level' => $competence['level'] ?? 50,
                            'id_cv' => $cv->id,
                        ]);
                    }
                }
            }

            // Recréer les langues
            if ($request->has('langues')) {
                foreach ($request->langues as $langue) {
                    if (!empty($langue['libelle'])) {
                        Langue::create([
                            'libelle' => $langue['libelle'],
                            'level' => $langue['level'] ?? 'Débutant',
                            'id_cv' => $cv->id,
                        ]);
                    }
                }
            }

            DB::commit();
            return redirect()->route('cv.show', $cv->id)->with('success', 'CV mis à jour avec succès!');

        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Erreur lors de la mise à jour du CV: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        $cv = CV::where('id', $id)->where('id_user', Auth::id())->firstOrFail();

        // Supprimer l'image si elle existe
        if ($cv->image) {
            Storage::disk('public')->delete($cv->image);
        }

        $cv->delete();
        return redirect()->route('cv.index')->with('success', 'CV supprimé avec succès!');
    }
}
