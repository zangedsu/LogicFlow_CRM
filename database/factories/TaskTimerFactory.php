<?php

namespace Database\Factories;

use App\Models\Task;
use App\Models\TaskTimer;
use App\Models\Team;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class TaskTimerFactory extends Factory
{
    protected $model = TaskTimer::class;

    public function definition(): array
    {
        return [
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'started_at' => Carbon::now(),
            'current_duration' => Carbon::now(),
            'state' => $this->faker->word(),

            'task_id' => Task::factory(),
            'user_id' => User::factory(),
            'team_id' => Team::factory(),
        ];
    }
}
