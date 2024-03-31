<?php

namespace App\Filament\Resources\SupervisorsResource\Pages;

use App\Filament\Resources\SupervisorsResource;
use App\Models\Supervisor;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Contracts\Database\Eloquent\Builder;

class ListSupervisors extends ListRecords
{
    protected static string $resource = SupervisorsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
    public function departmentIdQuery(): Builder
    {
        $departmentId = auth()->user()->department_id;

        return Supervisor::query()
            ->where('department_id', $departmentId);
    }
}
