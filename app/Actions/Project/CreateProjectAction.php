<?php

namespace App\Actions\Project;

use App\Models\Project;

class CreateProjectAction
{
    /**
     * Create a new class instance.
     */
    public function create(Project $project): bool
    {
        $project->save();

        return true;
    }
}
