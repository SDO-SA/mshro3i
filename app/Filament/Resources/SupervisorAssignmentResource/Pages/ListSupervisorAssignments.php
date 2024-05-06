<?php

namespace App\Filament\Resources\SupervisorAssignmentResource\Pages;

use App\Filament\Resources\SupervisorAssignmentResource;
use App\Models\Assignment;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class ListSupervisorAssignments extends ListRecords
{
    protected static string $resource = SupervisorAssignmentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function departmentIdQuery(): Builder
    {
        $departmentId = auth()->user()->department_id;

        return Assignment::query()
            ->where('department_id', $departmentId);
    }
}
