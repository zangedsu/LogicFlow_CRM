<?php

namespace Database\Factories;

use App\Models\TaskState;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class TaskStateFactory extends Factory
{
    protected $model = TaskState::class;

    public function definition(): array
    {
        return [
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'name' => $this->faker->name(),
            'team_id' => User::first()->personalTeam()->id,
        ];
    }
}
