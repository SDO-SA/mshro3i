<?php

namespace App\Filament\Resources\SupervisorAssignmentResource\Pages;

use App\Filament\Resources\SupervisorAssignmentResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSupervisorAssignment extends EditRecord
{
    protected static string $resource = SupervisorAssignmentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
