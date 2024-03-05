<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Base\RolesList;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'Saud',
            'email' => 'admin@example.com',
            'university_id' => 442003532,
            'department' => 'Computer Science',
            'type' => RolesList::ROLE_STUDENT,
            'password' => bcrypt('111'),
        ]);
        $this->call(DepartmentSeeder::class);
    }
}
