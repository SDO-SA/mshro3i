<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\States\StudentStates;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(RolesAndPermissionsSeeder::class);
        $this->call(DepartmentSeeder::class);
        \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Saud',
        //     'email' => 'admin@example.com',
        //     'university_id' => 442003532,
        //     'department' => 'Computer Science',
        //     'state' => StudentStates::NotJoined,
        //     'password' => bcrypt('111'),
        // ]);
    }
}
