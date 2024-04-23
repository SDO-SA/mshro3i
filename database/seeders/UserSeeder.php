<?php

namespace Database\Seeders;

use App\Base\RolesList;
use App\Models\Department;
use App\Models\User;
use App\States\StudentStates;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        User::factory(80)->create();

        /** @var User $student */
        $student1 = User::create([
            'name' => 'سعود العتيبي',
            'email' => 'student@example.com',
            'university_id' => 442003532,
            'college_id' => 1,
            'department_id' => 1,
            'state' => StudentStates::NotJoined,
            'password' => Hash::make(111),
        ]);
        $student1->assignRole(RolesList::ROLE_STUDENT);

        /** @var User $student */
        $student2 = User::create([
            'name' => 'محمد الشريف',
            'email' => 'student2@example.com',
            'university_id' => 443003532,
            'college_id' => 1,
            'department_id' => 2,
            'state' => StudentStates::NotJoined,
            'password' => Hash::make(111),
        ]);
        $student2->assignRole(RolesList::ROLE_STUDENT);

        /** @var User $student */
        $student3 = User::create([
            'name' => 'معيض الزهراني',
            'email' => 'student3@example.com',
            'university_id' => 444003532,
            'college_id' => 1,
            'department_id' => Department::query()->get()->random()->id,
            'state' => StudentStates::NotJoined,
            'password' => Hash::make(111),
        ]);
        $student3->assignRole(RolesList::ROLE_STUDENT);

        /** @var User $student */
        $student4 = User::create([
            'name' => 'محمد احمد',
            'email' => 'student4@example.com',
            'university_id' => 445303532,
            'college_id' => 1,
            'department_id' => Department::query()->get()->random()->id,
            'state' => StudentStates::NotJoined,
            'password' => Hash::make(111),
        ]);
        $student4->assignRole(RolesList::ROLE_STUDENT);
    }
}
