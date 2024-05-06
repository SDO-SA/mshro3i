<?php

namespace App\Filament\Resources\SupervisorSubmissionResource\Pages;

use App\Filament\Resources\SupervisorSubmissionResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSupervisorSubmission extends EditRecord
{
    protected static string $resource = SupervisorSubmissionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
