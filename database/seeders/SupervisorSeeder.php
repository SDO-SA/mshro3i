<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\Supervisor;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class SupervisorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Supervisor::factory(70)->create();

        /** @var Supervisor $supervisor */
        Supervisor::create([
            'name' => 'مشعل القرني',
            'email' => 'supervisor@example.com',
            'university_id' => 442003532,
            'department_id' => Department::query()->get()->random()->id,
            'password' => Hash::make(111),
        ]);

        /** @var Supervisor $supervisor */
        Supervisor::create([
            'name' => 'ماجد العتيبي',
            'email' => 'supervisor2@example.com',
            'university_id' => 443003532,
            'department_id' => Department::query()->get()->random()->id,
            'password' => Hash::make(111),
        ]);

        /** @var Supervisor $supervisor */
        Supervisor::create([
            'name' => 'سعود الزهراني',
            'email' => 'supervisor3@example.com',
            'university_id' => 444003532,
            'department_id' => Department::query()->get()->random()->id,
            'password' => Hash::make(111),
        ]);

        /** @var Supervisor $supervisor */
        Supervisor::create([
            'name' => 'سعود المحمدي',
            'email' => 'supervisor4@example.com',
            'university_id' => 445003532,
            'department_id' => Department::query()->get()->random()->id,
            'password' => Hash::make(111),
        ]);
    }
}
