<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Department::query()->upsert($this->getData(), 'id');
    }

    private function getData(): array
    {
        return [
            [
                'id' => 1,
                'department' => 'Computer Science',
            ],
            [
                'id' => 2,
                'department' => 'Computer Eng',
            ],
            [
                'id' => 3,
                'department' => 'Cyber Security',
            ],
            [
                'id' => 4,
                'department' => 'Software Eng',
            ],
        ];
    }
}
