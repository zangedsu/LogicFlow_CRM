<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    public function show($id)
    {
        $project = Auth::user()->currentTeam()->first()->projects()->get()->find($id);
        if($project){
            return view('projects.show', ['project' =>$project]);
        }else{
            abort(404);
        }
    }

    public function edit($id){
        $project = Auth::user()->currentTeam()->first()->projects()->get()->find($id);
        if ($project){
            return view('projects.edit', ['project' => $project]);
        }
        abort(404);
    }
}
