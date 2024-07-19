<?php

namespace Database\Factories;

use App\Models\TaskTag;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class TaskTagFactory extends Factory
{
    protected $model = TaskTag::class;

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
