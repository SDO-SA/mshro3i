<?php

namespace App\Filament\Resources\GroupResource\Pages;

use App\Filament\Resources\GroupResource;
use App\Models\Group;
use Filament\Actions;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Filament\Resources\Pages\ListRecords;

class ListGroups extends ListRecords
{
    protected static string $resource = GroupResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function departmentIdQuery(): Builder
    {
        $departmentId = auth()->user()->department_id;

        return Group::query()
            ->where('department_id', $departmentId);
    }
}
