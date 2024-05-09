<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SupervisorSubmissionResource\Pages;
use App\Filament\Resources\SupervisorSubmissionResource\Pages\ListSupervisorSubmissions;
use App\Models\Submission;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class SupervisorSubmissionResource extends Resource
{
    protected static ?string $model = Submission::class;

    protected static ?string $pluralModelLabel = 'التسليمات';

    protected static ?string $modelLabel = 'تسليم';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')->disabled(),
                TextInput::make('group_name')->label('Group')->disabled()->placeholder(fn (Submission $submission) => $submission->group->name),
                TextInput::make('submitter')->disabled(),
                TextInput::make('notes')->disabled(),
                Textarea::make('feedback')->columnSpanFull(),
                TextInput::make('points')->required(),
                Radio::make('status')
                    ->label('Status')
                    ->options([
                        'approved' => 'Approve',
                        'declined' => 'Decline',
                    ])->inline()
                    ->inlineLabel(false)
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->query(app(ListSupervisorSubmissions::class)->supervisorIdQuery())
            ->columns([
                TextColumn::make('name')->sortable(),
                TextColumn::make('group_name')->label('Group')->getStateUsing(fn (Submission $submission) => $submission->group->name),
                TextColumn::make('submitter')->sortable(),
                TextColumn::make('supervisor')->label('Supervisor')->getStateUsing(fn (Submission $submission) => $submission->group->supervisor->name),
                TextColumn::make('status')->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'pending' => 'warning',
                        'approved' => 'success',
                        'declined' => 'danger',

                    })->sortable()
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'pending' => __('app.pending'),
                        'approved' => __('app.confirmed'),
                        default => $state,
                    }),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function canCreate(): bool
    {
        return false;
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSupervisorSubmissions::route('/'),
            'create' => Pages\CreateSupervisorSubmission::route('/create'),
            'edit' => Pages\EditSupervisorSubmission::route('/{record}/edit'),
        ];
    }
}
