<?php

namespace App\Http\Controllers;

use App\Models\Langues;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LanguesController extends Controller
{
    /**
     * Affiche la liste des langues (READ)
     */
    public function index()
    {
        $langues = Langues::all();
        return view('langues.index', compact('langues'));
    }

    /**
     * Affiche le formulaire de création (CREATE - UI)
     */
    public function create()
    {
        return view('langues.create');
    }

    /**
     * Enregistre une nouvelle langue (CREATE - Logique)
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'libelle' => 'required|string|max:255',
            'level' => 'required|string|max:50',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        Langues::create($request->all());

        return redirect()->route('langues.index')
            ->with('success', 'Langue créée avec succès.');
    }

    /**
     * Affiche une langue spécifique (READ - Détail)
     */
    public function show(Langues $langue)
    {
        return view('langues.show', compact('langue'));
    }

    /**
     * Affiche le formulaire d'édition (UPDATE - UI)
     */
    public function edit(Langues $langue)
    {
        return view('langues.edit', compact('langue'));
    }

    /**
     * Met à jour une langue (UPDATE - Logique)
     */
    public function update(Request $request, Langues $langue)
    {
        $validator = Validator::make($request->all(), [
            'libelle' => 'required|string|max:255',
            'level' => 'required|string|max:50',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $langue->update($request->all());

        return redirect()->route('langues.index')
            ->with('success', 'Langue mise à jour avec succès.');
    }

    /**
     * Supprime une langue (DELETE)
     */
    public function destroy(Langues $langue)
    {
        $langue->delete();

        return redirect()->route('langues.index')
            ->with('success', 'Langue supprimée avec succès.');
    }
}
