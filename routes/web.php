<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AutoGenerate;
use App\Http\Controllers\GenrateCoverLetter;
use App\Http\Controllers\GenerateJobRequest;
use App\Http\Controllers\LettreController;
use App\Http\Controllers\JobRequestController;
use App\Models\Admin;
use App\Models\User;

use App\Http\Controllers\TemplateController;


Route::resource('templates', TemplateController::class)->names('admin.templates');

Route::middleware('auth:admin')->prefix('admin')->name('admin.')->group(function () {
    Route::get('dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::resource('admins', AdminController::class)->except(['show']);
});


Route::middleware('auth:admin')->group(function () {
    Route::get('gestionadmins', function () {
        $admins = Admin::all();
        return view('admin.gestionadmins', compact('admins'));
    })->name('adminManagement');
});

Route::get('/admin/gestiontemplates', [TemplateController::class, 'index'])->middleware('auth:admin')->name('admin.gestiontemplates');




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



// Routes protégées pour utilisateur connecté
Route::middleware('auth')->group(function () {

    Route::prefix('page')->group(function () {
    Route::get('/myDocument', function(){ return view('page.dashboard');})->name('dashboard');
    Route::get('/newCoverLetter',function(){ return view('page.newCover');})->name('coverLetter');
    Route::get('/newResume',function(){ return view('page.newResume');})->name('resume');
    Route::get('/page/NewJobLetter', function () {return view('page.newJobLetter');})->name('newJobLetter');
    Route::get('/page/newResumeWithModel', function () { return view('page.cvWithModel');})->name('resumeWithModel');
});

});
Route::get('/chat', function () {return view('chat');});

Route::post('/openai/chat', [\App\Http\Controllers\OpenAiController::class, 'processChat'])->name('openai.chat');
Route::get('/auto', [AutoGenerate::class, 'showForm'])->name('home');


Route::post('/generate-cv', [AutoGenerate::class, 'generate'])->name('autoCV');

Route::prefix('template')->group(function(){
    Route::get('/tempalte1', function() {return view('page.templateCV.template1');})->name('template1');
    Route::get('/tempalte2', function() {return view('page.templateCV.template2');})->name('template2');
    Route::get('/tempalte3', function() {return view('page.templateCV.template3');})->name('template3');
    Route::get('/tempalte4', function() {return view('page.templateCV.template4');})->name('template4');
    Route::get('/tempalte5', function() {return view('page.templateCV.template4');})->name('template5');
});

// Routes pour la génération de lettre de motivation

// Route pour traiter la soumission du formulaire

Route::get('/Generate/CV', function(){
    return view('page.cv');
})->name('generateCV');



Route::get('/checkout', function(){return view('page.protemplate.paiment');})->name('checkout');



Route::get('/cvWithModel', function(){

})->name('cvWithModel');

Route::post('/savePaiment',[NotificationController::class ,'create'])->name('notifications.create');







