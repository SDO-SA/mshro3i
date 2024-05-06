<?php

namespace App\Filament\Resources\SupervisorProjectResource\Pages;

use App\Filament\Resources\SupervisorProjectResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSupervisorProject extends EditRecord
{
    protected static string $resource = SupervisorProjectResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
