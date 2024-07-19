<?php

namespace Database\Seeders;

use App\Models\Client;
use App\Models\Project;
use App\Models\Task;
use App\Models\TaskNote;
use App\Models\TaskState;
use App\Models\TaskTag;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->withPersonalTeam()->create();

//        User::factory()->withPersonalTeam()->create([
//            'name' => 'User',
//            'email' => 't@t.t',
//            'password' => '123456789'
//        ]);

//        Client::factory(10)->create();
        Project::factory(25)->create();
        TaskState::factory(3)->create();
        Task::factory(25)->create();
        TaskNote::factory(50)->create();
        TaskTag::factory(10)->create();

    }
}
