<?php

namespace Database\Factories;

use App\Models\Department;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Group>
 */
class GroupFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $names = [
            'Money',
            'Power',
            'Food',
            'Serenity',
            'Velocity',
            'Aurora',
            'Phoenix',
            'Maverick',
            'Luna',
            'Nova',
            'Raven',
            'Sapphire',
            'Blaze',
            'Jupiter',
            'Echo',
            'Orion',
            'Stella',
            'Zenith',
            'Titan',
            'Harmony',
        ];

        return [
            'name' => fake()->randomElement($names),
            'department_id' => Department::query()->get()->random()->id,
            'total_members' => random_int(1, 4),
            'status' => 'new',
        ];
    }
}
