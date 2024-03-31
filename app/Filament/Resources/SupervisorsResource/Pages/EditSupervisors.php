<?php

namespace App\Filament\Resources\SupervisorsResource\Pages;

use App\Filament\Resources\SupervisorsResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSupervisors extends EditRecord
{
    protected static string $resource = SupervisorsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
