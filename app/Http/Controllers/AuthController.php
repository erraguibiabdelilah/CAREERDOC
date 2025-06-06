<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    public function showLoginForm()
    {
        return view('auth.login'); // Vue partagée pour tous
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        if (Admin::where('email', $credentials['email'])->exists()) {
            if (Auth::guard('admin')->attempt($credentials)) {
                return redirect()->intended('/admin/dashboard');
            } else {
                return back()->withErrors(['email' => 'Mot de passe incorrect pour admin']);
            }
        }

        // Sinon, on tente avec le guard user (web)
        if (User::where('email', $credentials['email'])->exists()) {
            if (Auth::guard('web')->attempt($credentials)) {
                return redirect()->intended('/page/myDocument');
            } else {
                return back()->withErrors(['email' => 'Mot de passe incorrect pour utilisateur']);
            }
        }

        // Aucun utilisateur trouvé
        return back()->withErrors(['email' => 'Aucun compte trouvé avec cet email']);
    }

    public function logout(Request $request)
    {
        if (Auth::guard('admin')->check()) {
            Auth::guard('admin')->logout();
            return redirect('/login');
        }

        if (Auth::guard('web')->check()) {
            Auth::guard('web')->logout();
            return redirect('/login');
        }

        return redirect('/login');
    }
    // Dans app/Http/Controllers/AuthController.php
public function register(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:8|confirmed',
    ]);

    $user = User::create([
        'name' => $validated['name'],
        'email' => $validated['email'],
        'password' => Hash::make($validated['password']),
    ]);

    Auth::login($user);

    return redirect('/dashboard')->with('success', 'Inscription réussie!');
}
}


