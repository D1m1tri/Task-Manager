<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Task;
use App\Models\User;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Task::factory()->count(50)->create()->each(function ($task) {
            for( $i = 0; $i < 3; $i++ ) {
                $user = User::inRandomOrder()->first();
                $task->assignees()->attach($user->id);
            }
            $task->save();
        });
    }
}
