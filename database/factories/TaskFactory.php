<?php

namespace Database\Factories;

use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class TaskFactory extends Factory
{
    protected $model = Task::class;

    public function definition(): array
    {
        return [
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'name' => $this->faker->randomElement(['Создать', 'Добавить', 'Отредактировать', 'Оптимизировать']).' '.
                $this->faker->randomElement(['страницу', 'сайт', 'приложение', 'базу данных']),
            'description' => $this->faker->text(),
            'deadline' => $this->faker->dateTimeBetween(now(), '+30 days'),

            'project_id' => Project::factory(),

            'author_id' => User::factory(),
        ];
    }
}
