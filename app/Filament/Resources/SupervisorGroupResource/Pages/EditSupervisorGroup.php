<?php

namespace App\Filament\Resources\SupervisorGroupResource\Pages;

use App\Filament\Resources\SupervisorGroupResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSupervisorGroup extends EditRecord
{
    protected static string $resource = SupervisorGroupResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
