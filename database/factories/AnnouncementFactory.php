<?php

namespace Database\Factories;

use App\Models\Department;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Group>
 */
class AnnouncementFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {


        return [
            'uuid' => fake()->uuid(),
            'header' => fake()->name(),
            'message' => fake()->text(),
            'department_id' => Department::query()->get()->random()->id,
        ];
    }
}
