<?php

namespace Database\Factories;

use App\Models\Department;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Supervisor>
 */
class SupervisorFactory extends Factory
{
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'university_id' => fake()->unique()->randomNumber(5),
            'email' => fake()->unique()->safeEmail(),
            'department_id' => Department::query()->get()->random()->id,
            'password' => static::$password ??= Hash::make('password'),
        ];
    }
}
