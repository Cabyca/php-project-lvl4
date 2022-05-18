<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

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
    public function definition()
    {
        return [
            'name' => $this->faker->text('15'),
            'description' => $this->faker->text('100'),
            'status_id' => $this->faker->numberBetween(1, 4),
            'created_by_id' => $this->faker->numberBetween(1, 4),
            'assigned_to_id' => $this->faker->numberBetween(1, 4)
        ];
    }
}
