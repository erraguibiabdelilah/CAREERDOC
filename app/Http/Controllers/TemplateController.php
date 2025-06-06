<?php

namespace App\Http\Controllers;

use App\Models\Template;  // Modèle Template avec majuscule
use Illuminate\Http\Request;

class TemplateController extends Controller
{
    public function index()
    {
       $templates = Template::all();
    return view('admin.gestiontemplates', compact('templates'));
    }

    public function create()
    {
        return view('admin.template_create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:free,premium',
            'description' => 'nullable|string',
        ]);

        Template::create($request->all());

        return redirect()->route('admin.templates.index')
            ->with('success', 'Template créé avec succès.');
    }

    public function show(Template $template)
    {
        return view('admin.template_show', compact('template'));
    }

    public function edit(Template $template)
    {
        return view('admin.template_edit', compact('template'));
    }

    public function update(Request $request, Template $template)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:free,premium',
            'description' => 'nullable|string',
        ]);

        $template->update($request->all());

        return redirect()->route('admin.templates.index')
            ->with('success', 'Template mis à jour.');
    }

    public function destroy(Template $template)
    {
        $template->delete();

        return redirect()->route('admin.templates.index')
            ->with('success', 'Template supprimé.');
    }
}
