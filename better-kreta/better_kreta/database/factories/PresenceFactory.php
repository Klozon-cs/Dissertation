<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Presence>
 */
class PresenceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'state' => fake()->numberBetween(1,3),
            'schoolday_id' => fake()->numberBetween(1,4),
            'student_id'=> fake()->numberBetween(1,32),
            'created_by' => '1',
        ];
    }
}
