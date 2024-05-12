<?php

namespace App\Filament\Widgets;

use App\Models\Group;
use Filament\Widgets\ChartWidget;

class StudentGroupStateChart extends ChartWidget
{
    protected static ?string $heading = 'حالة المجموعات';

    protected function getData(): array
    {
        $user = auth()->user();
        $departmentId = $user->department_id;

        $newgroup = Group::where('status', 'new')
            ->where('department_id', $departmentId)
            ->count();

        $pendinggroup = Group::where('status', 'pending')
            ->where('department_id', $departmentId)
            ->count();

        $conifirmedgroup = Group::where('status', 'confirmed')
            ->where('department_id', $departmentId)
            ->count();

        return [
            'datasets' => [
                [
                    'label' => 'Group State',
                    'data' => [$newgroup, $pendinggroup, $conifirmedgroup],
                    'backgroundColor' => [
                        'rgb(162, 195, 219)',
                        'rgb(220, 177, 45)',
                        'rgb(138, 175, 34)',
                    ],
                ],
            ],
            'labels' => [
                'جديد',
                'معلق',
                'مؤكد',
            ],
        ];
    }

    protected function getType(): string
    {
        return 'pie';
    }

    protected function getOptions(): array
    {
        return [
            'scales' => [
                'x' => [
                    'display' => false,
                ],
                'y' => [
                    'display' => false,
                ],
            ],
        ];
    }
}
