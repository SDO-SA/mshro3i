<?php

namespace App\Filament\Widgets;

use App\Models\Group;
use Filament\Widgets\ChartWidget;

class StudentGroupStateChart extends ChartWidget
{
    protected static ?string $heading = 'حالة المجموعات';

    protected function getData(): array
    {
        $notjoined = Group::where('status','new')->count();
        $groupmember = Group::where('status','pending')->count();
        $groupleader = Group::where('status','confirmed')->count();
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
                'جديد',
                'معلق',
                'مؤكد'
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
