<?php

namespace Database\Factories;

use App\Models\TeamEvent;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class TeamEventFactory extends Factory
{
    protected $model = TeamEvent::class;

    public function definition(): array
    {
        return [
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'name' => $this->faker->name(),
            'description' => $this->faker->text(),
            'date_time' => Carbon::now(),
            'link' => $this->faker->word(),

            'author_id' => User::factory(),
        ];
    }
}
