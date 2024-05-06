<?php

namespace App\Filament\Resources\SupervisorProjectResource\Pages;

use App\Filament\Resources\SupervisorProjectResource;
use App\Models\Project;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class ListSupervisorProjects extends ListRecords
{
    protected static string $resource = SupervisorProjectResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function supervisorIdQuery(): Builder
    {
        $supervisor_id = auth()->user()->id;

        return Project::query()
            ->where('supervisor_id', $supervisor_id);
    }
}
