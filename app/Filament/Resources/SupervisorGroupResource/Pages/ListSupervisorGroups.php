<?php

namespace App\Filament\Resources\SupervisorGroupResource\Pages;

use App\Filament\Resources\SupervisorGroupResource;
use App\Models\Group;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class ListSupervisorGroups extends ListRecords
{
    protected static string $resource = SupervisorGroupResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function supervisorIdQuery(): Builder
    {
        $supervisor_id = auth()->user()->id;

        return Group::query()
            ->where('supervisor_id', $supervisor_id);
    }
}
