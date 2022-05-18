<?php

namespace Database\Seeders;

use App\Models\Task;
use App\Models\TaskStatus;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
    {
        User::factory(5)->create();
        TaskStatus::factory(4)->create();
        Task::factory(5)->create();

//        'status_id' => TaskStatus::factory()->create()->id,
//        'created_by_id' => User::factory()->create()->id,
//        'assigned_to_id' => User::factory()->create()->id,
    }
}
