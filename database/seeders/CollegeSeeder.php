<?php

namespace Database\Seeders;

use App\Models\College;
use Illuminate\Database\Seeder;

class CollegeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        College::query()->upsert($this->getData(), 'id');
    }

    private function getData(): array
    {
        return [
            [
                'id' => 1,
                'name_en' => 'College Of Computing',
                'name_ar' => 'كلية الحاسبات',
            ],
            [
                'id' => 2,
                'name_en' => 'College Of Engineering ',
                'name_ar' => 'كلية الهندسة',
            ],
            [
                'id' => 3,
                'name_en' => 'College Of Applied Sciences',
                'name_ar' => 'كلية العلوم التطبيقية',
            ],
        ];
    }
}
