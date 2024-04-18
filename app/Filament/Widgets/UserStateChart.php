<?php

namespace App\Filament\Widgets;

use App\Models\User;
use Filament\Widgets\ChartWidget;

class UserStateChart extends ChartWidget
{
    protected static ?string $heading = 'حالة الطلاب';

    protected function getData(): array
    {
        $notjoined = User::where('state','not_joined')->count();
        $groupmember = User::where('state','group_member')->count();
        $groupleader = User::where('state','group_leader')->count();
        return [
            'datasets' => [
                [
                    'label' => 'User State',
                    'data' => [$notjoined,$groupmember,$groupleader],
                    'backgroundColor' => [
                        'rgb(255, 99, 132)',
                        'rgb(54, 162, 235)',
                        'rgb(255, 205, 86)'
                    ],
                ],
            ],
            'labels' => [
                'لم ينضم',
                'عضو مجموعة',
                'قائد مجموعة'
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
                'x' =>[
                    'display' => false,
                ],
                'y' =>[
                    'display' => false,
                ]
            ]
        ];
    }
}
