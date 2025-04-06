<?php

namespace App\Http\Controllers;

use App\Models\Sprint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SprintController extends Controller
{

    public function index()
    {
        return view('sprints.index');
    }
    public function show($id)
    {
        return view('sprints.show', ['sprint' => Sprint::findOrFail($id)]);
    }
}
