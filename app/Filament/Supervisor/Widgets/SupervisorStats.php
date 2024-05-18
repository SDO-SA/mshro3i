<?php

namespace App\Filament\Supervisor\Widgets;

use App\Models\Group;
use App\Models\Project;
use App\Models\Submission;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class SupervisorStats extends BaseWidget
{
    protected function getStats(): array
    {
        $user = auth()->user();
        $groups = Group::where('supervisor_id', $user->id)->count();
        $projects = Project::where('supervisor_id', $user->id)->count();
        $submissions = Submission::where('supervisor_id', $user->id)->count();

        return [
            Stat::make('المجموعات', $groups),
            Stat::make('المشاريع', $projects),
            Stat::make('التسليمات', $submissions),
        ];
    }
}
