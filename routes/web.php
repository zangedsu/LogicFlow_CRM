<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\ProjectController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');



    Route::get('/clients/create', function () {
        return view('clients.create');
    })->name('clients.create');

    Route::get('/clients/{id}', [ClientController::class, 'show'])->name('clients.show');
    Route::get('/clients/{id}/edit', [ClientController::class, 'edit'])->name('clients.edit');

    Route::get('/clients', function () {
        return view('clients.index');
    })->name('clients');



    Route::get('/projects', function () {
        return view('projects.index');
    })->name('projects.index');

    Route::get('/projects/create', function () {
        return view('projects.create');
    })->name('projects.create');

    Route::get('/projects/{id}', [ProjectController::class, 'show'])->name('projects.show');
    Route::get('/projects/{id}/edit', [ProjectController::class, 'edit'])->name('projects.edit');

});
