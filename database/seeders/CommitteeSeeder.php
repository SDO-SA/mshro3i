<?php

namespace Database\Seeders;

use App\Models\Committee;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class CommitteeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /** @var Committee $committee */
        Committee::create([
            'name' => 'لجنة المشاريع',
            'email' => 'gpc@example.com',
            'department_id' => 1,
            'password' => Hash::make(111),
        ]);

        /** @var Committee $committee */
        Committee::create([
            'name' => 'لجنة المشاريع',
            'email' => 'gpc2@example.com',
            'department_id' => 2,
            'password' => Hash::make(111),
        ]);

        /** @var Committee $committee */
        Committee::create([
            'name' => 'لجنة المشاريع',
            'email' => 'gpc3@example.com',
            'department_id' => 3,
            'password' => Hash::make(111),
        ]);

        /** @var Committee $committee */
        Committee::create([
            'name' => 'لجنة المشاريع',
            'email' => 'gpc4@example.com',
            'department_id' => 4,
            'password' => Hash::make(111),
        ]);
    }
}
