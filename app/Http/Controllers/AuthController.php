<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLoginForm(){
        return view('Auth.login');
    }



    public function login(Request $request){
        $credentials=$request->validate([
            'email'=>'required|email',
            'password'=>'required'
        ]);


        if(Auth::attempt($credentials)){
            $request->session()->regenerate();;

            if(Auth::user()->role=="admin"){
                return redirect()->intended('/admin/dashboard');
            }

            return redirect()->intended('/page/myDocument');
        }
        return back()->withErrors([
            'email' => 'Identifiants incorrects.',]);
    }


    public function register(Request $request){
        $data=$request->validate([
            'name'=>'required',
            'email'=>'required |email',
            'password'=>'required|min:8',
        ]);

        $user=User::create([
            'name'=>$data['name'],
            'email'=>$data['email'],
            'password'=>$data['password'],
            'role'=>'user',
        ]);
        return redirect()->intended('/login');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }


        public function adminDashboard()
        {
            if (!auth()->check() || auth()->user()->role !== 'admin') {
                abort(403, 'Accès non autorisé');
            }

            return view('layouts.adminDashboard');
        }
}



