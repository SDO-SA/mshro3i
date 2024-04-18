<?php

namespace App\Filament\Widgets;

use App\Models\Group;
use App\Models\Supervisor;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        $user = auth()->user();
        $students = User::where('department_id',$user->department_id)->count();
        $supervisors = Supervisor::where('department_id',$user->department_id)->count();
        $groups = Group::where('department_id',$user->department_id)->count();
        return [
            Stat::make('الطلاب', $students),
            Stat::make('المشرفين', $supervisors),
            Stat::make('المجموعات', $groups),
        ];
    }
}
