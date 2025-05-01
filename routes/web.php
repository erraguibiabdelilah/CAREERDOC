<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('chat');
});

Route::post('/openai/chat', [\App\Http\Controllers\OpenAiController::class, 'processChat'])
    ->name('openai.chat');


