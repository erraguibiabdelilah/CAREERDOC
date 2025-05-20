<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AutoGenerate;
use App\Http\Controllers\GenrateCoverLetter;
use App\Http\Controllers\GenerateJobRequest;
use App\Models\User;
//landign page

Route::post('/lettre/store', [LettreController::class, 'store'])->name('lettre.store')->middleware('auth');
Route::post('/jobRequest/store', [JobRequestController::class, 'store'])->name('JobRequest.store')->middleware('auth');
//landign page
Route::get('/', function () {return view('layouts.landignPage');});


Route::get('/GenerateCover', function () {return view('page.generateCover');})->name('cover');
Route::get('/CreateCover', function () {return view('page.coverWithModel');})->name('coverWithModel');
Route::match(['get', 'post'],'/cover/generate', [GenrateCoverLetter::class, 'generate'])->name('coverGenerate');


Route::get('/GenerateJobLetter', function () { return view('page.generateJobRequest');})->name('JobRequest');
Route::get('/CreateJobRequest', function () { return view('page.jobRequestWithModel');})->name('jobLetterWithModel');
Route::match(['get', 'post'],'/jobLetter/generate', [GenerateJobRequest::class, 'generate'])->name('jobLetterGenerate');


// Routes d'authentification
Route::get('/login', [AuthController::class, 'showLoginForm']);
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::match(['get', 'post'], '/logout',[AuthController::class, 'logout'])->name('logout');



Route::middleware('auth')->group(function () {

    Route::get('/admin/dashboard',[AuthController::class , 'adminDashboard'])->name('adminDashboard');
    Route::prefix('page')->group(function () {
    Route::get('/myDocument', function(){ return view('page.dashboard');})->name('dashboard');
    Route::get('/newCoverLetter',function(){ return view('page.newCover');})->name('coverLetter');
    Route::get('/newResume',function(){ return view('page.newResume');})->name('resume');
    Route::get('/page/NewJobLetter', function () {return view('page.newJobLetter');})->name('newJobLetter');
});

});
Route::get('/chat', function () {return view('chat');});

Route::post('/openai/chat', [\App\Http\Controllers\OpenAiController::class, 'processChat'])->name('openai.chat');
Route::get('/auto', [AutoGenerate::class, 'showForm'])->name('home');
Route::post('/generate-cv', [AutoGenerate::class, 'generate'])->name('autoCV');

// Routes pour la génération de lettre de motivation

// Route pour traiter la soumission du formulaire

Route::get('/Generate/CV', function(){
    return view('page.cv');
})->name('generateCV');






Route::get('/cvWithModel', function(){
    return view('cv.personalInfo');
})->name('cvWithModel');








