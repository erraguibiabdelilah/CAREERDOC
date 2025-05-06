<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AutoGenerate;
use App\Http\Controllers\GenrateCoverLetter;
use App\Models\User;
//landign page
Route::get('/', function () {return view('layouts.landignPage');});

// Routes d'authentification
Route::get('/login', [AuthController::class, 'showLoginForm']);
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::match(['get', 'post'], '/logout',[AuthController::class, 'logout'])->name('logout');



Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {return view('layouts.dashboard');});

    // Routes admin

    Route::get('/admin/dashboard',[AuthController::class , 'adminDashboard'])->name('adminDashboard');

});
Route::get('/chat', function () {return view('chat');});
Route::post('/openai/chat', [\App\Http\Controllers\OpenAiController::class, 'processChat'])->name('openai.chat');
Route::get('/auto', [AutoGenerate::class, 'showForm'])->name('home');
Route::post('/generate-cv', [AutoGenerate::class, 'processChat'])->name('openai.autoCV');

Route::get('/form', [GenrateCoverLetter::class, 'showForm'])->name('cover.form');

// Route pour traiter la soumission du formulaire
Route::post('/CoverGenerate', [GenrateCoverLetter::class, 'processChat'])->name('CoverGenerate');





