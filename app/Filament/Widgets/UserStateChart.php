<?php

namespace App\Filament\Widgets;

use App\Models\User;
use Filament\Widgets\ChartWidget;

class UserStateChart extends ChartWidget
{
    protected static ?string $heading = 'حالة الطلاب';

    protected function getData(): array
    {
        $user = auth()->user();
        $departmentId = $user->department_id;

        $notjoined = User::where('state', 'not_joined')
            ->where('department_id', $departmentId)
            ->count();

        $groupmember = User::where('state', 'group_member')
            ->where('department_id', $departmentId)
            ->count();

        $groupleader = User::where('state', 'group_leader')
            ->where('department_id', $departmentId)
            ->count();

        return [
            'datasets' => [
                [
                    'label' => 'User State',
                    'data' => [$notjoined, $groupmember, $groupleader],
                    'backgroundColor' => [
                        'rgb(162, 195, 219)',
                        'rgb(220, 177, 45)',
                        'rgb(138, 175, 34)',
                    ],
                ],
            ],
            'labels' => [
                'لم ينضم',
                'عضو مجموعة',
                'قائد مجموعة',
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
