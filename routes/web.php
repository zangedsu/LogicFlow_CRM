<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\SprintController;
use App\Http\Controllers\TaskController;
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

    Route::get('/tasks', function () {
        return view('tasks.index');
    })->name('tasks');

    Route::get('/tasks/kanban', function () {
        return view('tasks.kanban');
    })->name('tasks.kanban');

    Route::get('/tasks/create', function () {
        return view('tasks.create');
    })->name('tasks.create');

    Route::get('/tasks/{id}', [TaskController::class, 'show'])->name('tasks.show');

    Route::get('/tasks/{id}/edit', [TaskController::class, 'edit'])->name('tasks.edit');

    Route::get('/sprints/create', function () {
        return view('sprints.create');
    })->name('sprints.create');

    Route::get('/calendar', function () {
        return view('app.calendar');
    })->name('calendar');
    Route::get('/reports', function () {
        return view('app.reports');
    })->name('reports');

    Route::get('/coming-soon', function () {
        return view('coming-soon');
    })->name('coming-soon');

    Route::get('/chat', function () {
        return view('app.chat');
    })->name('chat');

    Route::get('/event/create', function () {
        return view('events.create');
    })->name('event.create');

    Route::get('/sprints/{id}', [SprintController::class, 'show'])->name('sprints.show');

    Route::get('sprints', [SprintController::class, 'index'])->name('sprints.index');

});
