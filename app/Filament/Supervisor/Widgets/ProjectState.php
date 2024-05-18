<?php

namespace App\Filament\Supervisor\Widgets;

use App\Models\Project;
use Filament\Widgets\ChartWidget;

class ProjectState extends ChartWidget
{
    protected static ?string $heading = 'حالة المشاريع';

    protected function getData(): array
    {

        $user = auth()->user()->id;

        $pending = Project::where('status', 'pending')
            ->where('supervisor_id', $user)
            ->count();
        $approved = Project::where('status', 'approved')
            ->where('supervisor_id', $user)
            ->count();
        $declined = Project::where('status', 'declined')
            ->where('supervisor_id', $user)
            ->count();

        return [
            'datasets' => [
                [
                    'label' => 'Project State',
                    'data' => [$pending, $approved, $declined],
                    'backgroundColor' => [
                        'rgb(220, 177, 45)',
                        'rgb(138, 175, 34)',
                        'rgb(255, 55, 55)',
                    ],
                ],
            ],
            'labels' => [
                'معلق',
                'معتمد',
                'مرفوض',
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
