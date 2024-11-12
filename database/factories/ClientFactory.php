<?php

namespace Database\Factories;

use App\Models\Client;
use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class ClientFactory extends Factory
{
    protected $model = Client::class;

    public function definition(): array
    {
        return [
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'name' => $this->faker->name(),
            'phone' => $this->faker->phoneNumber(),
            'site' => $this->faker->url(),
            'email' => $this->faker->email(),
            'team_id' => User::first()->personalTeam()->id,
            //'projects' => Project::factory(10)->create(),
        ];
    }
}
