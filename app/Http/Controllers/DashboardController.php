<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Admin;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if (!$user) {
            return redirect('/login');
        }

        // Vérifie si l'utilisateur est dans la table admins
        $admin = Admin::where('email', $user->email)->first();

        if ($admin) {
            // C'est un admin
            return view('admin.dashboard', ['admin' => $admin, 'user' => $user]);
        } else {
            // C'est un user normal
            return view('page.dashboard', ['user' => $user]);
        }
    }
    
}
