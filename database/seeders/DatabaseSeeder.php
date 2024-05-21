<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Task;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
        ]);

        Task::create([
            'task' => 'Test Task',
            'description' => 'This is a test task.',
            'completed' => false,
            'completed_at' => null,
            'owner_id' => 1,
        ]);

        // Attach the task to the user
        $user = User::find(1);
        $task = Task::find(1);

        $user->assignedTasks()->attach($task->id);
    }
}
