<?php

namespace Database\Factories;

use App\Models\Task;
use App\Models\TaskNote;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class TaskNoteFactory extends Factory
{
    protected $model = TaskNote::class;

    public function definition(): array
    {
        return [
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'text' => $this->faker->text(),
            'task_id' => Task::factory(),

            'user_id' => User::factory(),
        ];
    }
}
