<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function show($id)
    {

        $task = Auth::user()
            ->currentTeam()
            ->first()
            ->tasks()
            ->with(['stateLogs.statusChangedBy']) // подгружаем логи и автора изменения
            ->find($id); // find сразу ищет по id

        if (auth()->user()->cannot('view', $task)) {
            abort(403);
        }
        if ($task) {
            return view('tasks.show', ['task' => $task]);
        }

        abort(404);
    }

    public function edit($id)
    {
        $task = Auth::user()->currentTeam()->first()->tasks()->get()->find($id);
        if (auth()->user()->cannot('update', $task)) {
            abort(403);
        }
        if ($task) {
            return view('tasks.edit', ['task' => $task]);
        }
        abort(404);
    }
}
