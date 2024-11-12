<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    public function show($id)
    {
        //request tab
        $tab = request('tab') ?? null;

        $project = Auth::user()->currentTeam()->first()->projects()->get()->find($id);

        if ($project) {
            $route_name = '';

            switch ($tab) {
                case null: $route_name = 'projects.show.overview';
                    break;
                case 'sprints': $route_name = 'projects.show.sprints';
                    break;
                default: abort(404);
            }

            return view($route_name, ['project' => $project]);
        } else {
            abort(404);
        }
    }

    public function edit($id)
    {
        $project = Auth::user()->currentTeam()->first()->projects()->get()->find($id);
        if ($project) {
            return view('projects.edit', ['project' => $project]);
        }
        abort(404);
    }
}
