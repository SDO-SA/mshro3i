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
                'name_en' => 'Computer Science',
                'name_ar' => 'علوم الحاسب',
                'college_id' => 1,
            ],
            [
                'id' => 2,
                'name_en' => 'Computer Engineering',
                'name_ar' => 'هندسة الحاسب',
                'college_id' => 1,
            ],
            [
                'id' => 3,
                'name_en' => 'Cyber Security',
                'name_ar' => 'الأمن السيبراني',
                'college_id' => 1,
            ],
            [
                'id' => 4,
                'name_en' => 'Software Engineering',
                'name_ar' => 'هندسة البرمجيات',
                'college_id' => 1,
            ],
            [
                'id' => 5,
                'name_en' => 'Data Science',
                'name_ar' => 'علم البيانات',
                'college_id' => 1,
            ],
            [
                'id' => 6,
                'name_en' => 'Islamic Architecture',
                'name_ar' => 'العمارة الإسلامية',
                'college_id' => 2,
            ],
            [
                'id' => 7,
                'name_en' => 'Electrical Engineering',
                'name_ar' => 'الهندسة الكهربائية',
                'college_id' => 2,
            ],
            [
                'id' => 8,
                'name_en' => 'Civil Engineering',
                'name_ar' => 'الهندسة المدنية',
                'college_id' => 2,
            ],
            [
                'id' => 9,
                'name_en' => 'Mechanical Engineering',
                'name_ar' => 'الهندسة الميكانيكية',
                'college_id' => 2,
            ],
            [
                'id' => 10,
                'name_en' => 'Industrial Engineering',
                'name_ar' => 'الهندسة الصناعية',
                'college_id' => 2,
            ],
            [
                'id' => 11,
                'name_en' => 'Biology',
                'name_ar' => 'الأحياء',
                'college_id' => 3,
            ],
            [
                'id' => 12,
                'name_en' => 'Mathematical Sciences',
                'name_ar' => 'الرياضيات',
                'college_id' => 3,
            ],
            [
                'id' => 13,
                'name_en' => 'Chemistry',
                'name_ar' => 'الكيمياء',
                'college_id' => 3,
            ],
            [
                'id' => 14,
                'name_en' => 'Physics',
                'name_ar' => 'الفيزياء',
                'college_id' => 3,
            ],
        ];
    }
}
