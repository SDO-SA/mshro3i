<?php

namespace App\Filament\Resources\SupervisorSubmissionResource\Pages;

use App\Filament\Resources\SupervisorSubmissionResource;
use App\Models\Submission;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class ListSupervisorSubmissions extends ListRecords
{
    protected static string $resource = SupervisorSubmissionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function supervisorIdQuery(): Builder
    {
        $supervisor_id = auth()->user()->id;

        return Submission::query()
            ->where('supervisor_id', $supervisor_id);
    }
}
