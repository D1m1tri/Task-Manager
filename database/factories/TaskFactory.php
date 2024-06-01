<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Task;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $status = fake()->randomElement([0, 1, 2, 3]);
        $completed_at = $status == 2 ? fake()->dateTime() : null;
        $user = User::inRandomOrder()->first();
        return [
            'task' => fake()->sentence(),
            'description' => fake()->paragraph(),
            'status' => $status,
            'completed_at' => $completed_at,
            'owner_id' => $user->id,
        ];
    }
}
