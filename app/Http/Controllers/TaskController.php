<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function show($id)
    {
        $task = Auth::user()->currentTeam()->first()->tasks()->get()->find($id);
        if($task){
            return view('tasks.show', ['task' =>$task]);
        }else{
            abort(404);
        }
    }

    public function edit($id){
        $task = Auth::user()->currentTeam()->first()->tasks()->get()->find($id);
        if ($task){
            return view('tasks.edit', ['task' => $task]);
        }
        abort(404);
    }
}
