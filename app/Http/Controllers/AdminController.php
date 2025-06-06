<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function dashboard()
    {
        $admin = Auth::guard('admin')->user();

        if (!$admin) {
            abort(403, 'Accès non autorisé');
        }

        return view('admin.dashboard', ['user' => $admin]);
    }

    public function index()
    {
        $admins = Admin::all();
        return view('admin.gestionadmins', compact('admins'));
    }

    public function create()
    {
        return view('admin.admins.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:admins,email',
            'password' => 'required|string|min:6|confirmed',
        ]);

        Admin::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']), // hash du mot de passe
        ]);

        return redirect()->route('admin.admins.index')->with('success', 'Administrateur ajouté avec succès');
    }

  public function edit($id)
{
    $admin = Admin::findOrFail($id);
    
    // Empêcher la modification du super admin
    if ($admin->email === 'admin@admin.com') {
        return redirect()->route('admin.admins.index')
                        ->with('error', 'Le super administrateur ne peut pas être modifié.');
    }
    
    return view('admin.admins.edit', compact('admin'));
}

// Méthode pour mettre à jour un administrateur
public function update(Request $request, $id)
{
    $admin = Admin::findOrFail($id);
    
    // Empêcher la modification du super admin
    if ($admin->email === 'admin@admin.com') {
        return redirect()->route('admin.admins.index')
                        ->with('error', 'Le super administrateur ne peut pas être modifié.');
    }
    
    // Validation des données
   $rules = [
    'name' => 'required|string|max:255',
    'email' => 'required|email|unique:admins,email,' . $id,
];
    
    // Ajouter les règles de mot de passe seulement si un mot de passe est fourni
    if ($request->filled('password')) {
        $rules['password'] = 'required|string|min:6|confirmed';
    }
    
    $validatedData = $request->validate($rules, [
        'name.required' => 'Le nom est obligatoire.',
        'name.max' => 'Le nom ne peut pas dépasser 255 caractères.',
        'email.required' => 'L\'adresse email est obligatoire.',
        'email.email' => 'L\'adresse email doit être valide.',
        'email.unique' => 'Cette adresse email est déjà utilisée.',
        'password.required' => 'Le mot de passe est obligatoire.',
        'password.min' => 'Le mot de passe doit contenir au moins 6 caractères.',
        'password.confirmed' => 'La confirmation du mot de passe ne correspond pas.',
    ]);
    
    try {
        // Mettre à jour les données de base
        $admin->name = $validatedData['name'];
        $admin->email = $validatedData['email'];
        
        // Mettre à jour le mot de passe seulement s'il est fourni
        if ($request->filled('password')) {
            $admin->password = Hash::make($validatedData['password']);
        }
        
        $admin->save();
        
        return redirect()->route('admin.admins.index')
                        ->with('success', 'Administrateur modifié avec succès.');
                        
    } catch (\Exception $e) {
        return redirect()->back()
                        ->with('error', 'Erreur lors de la modification : ' . $e->getMessage())
                        ->withInput();
    }
}

public function destroy($id)
{
    try {
        $admin = Admin::findOrFail($id); // <-- ici

        if ($admin->email === 'admin@admin.com') {
            return redirect()->route('admin.admins.index')
                            ->with('error', 'Le super administrateur ne peut pas être supprimé.');
        }

        if ($admin->id === auth()->guard('admin')->id()) {
            return redirect()->route('admin.admins.index')
                            ->with('error', 'Vous ne pouvez pas supprimer votre propre compte.');
        }

        $adminName = $admin->name;
        $admin->delete();

        return redirect()->route('admin.admins.index')
                        ->with('success', "L'administrateur '{$adminName}' a été supprimé avec succès.");

    } catch (\Exception $e) {
        return redirect()->route('admin.admins.index')
                        ->with('error', 'Erreur lors de la suppression : ' . $e->getMessage());
    }
}

// Méthode pour afficher un administrateur spécifique (optionnelle)
public function show($id)
{
    $admin = Admin::findOrFail($id);
    return view('admin.admins.show', compact('admin'));
}
}