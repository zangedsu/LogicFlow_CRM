<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{
    public function show($id)
    {
     $client = Auth::user()->currentTeam()->first()->clients()->get()->find($id);
     if($client){
         return view('clients.show', ['client' =>$client]);
     }else{
         abort(404);
     }
    }

    public function edit($id){
        $client = Auth::user()->currentTeam()->first()->clients()->get()->find($id);
        if ($client){
            return view('clients.edit', ['client' => $client]);
        }
        abort(404);
    }
}
