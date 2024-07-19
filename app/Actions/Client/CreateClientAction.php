<?php

namespace App\Actions\Client;
use http\Env\Request;

class CreateClientAction
{
    /**
     * Create a new class instance.
     */

    public function create(Request $request)
    {
        $validated = $request->validated();

    }
}
