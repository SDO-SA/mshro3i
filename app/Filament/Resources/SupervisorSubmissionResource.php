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

    protected static ?string $navigationGroup = 'المعطيات';

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-check';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')->disabled()->label(__('app.name')),
                TextInput::make('group_name')->label(__('app.group_name'))->disabled()->placeholder(fn (Submission $submission) => $submission->group->name),
                TextInput::make('submitter')->disabled()->label(__('app.submitter')),
                TextInput::make('notes')->disabled()->label(__('app.notes')),
                Textarea::make('feedback')->columnSpanFull()->label(__('app.feedback')),
                TextInput::make('points')->required()->label(__('app.points')),
                Radio::make('status')
                    ->label(__('app.state'))
                    ->options([
                        'approved' => __('app.confirmed'),
                        'declined' => __('app.declined'),
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
                TextColumn::make('name')->sortable()->label(__('app.name')),
                TextColumn::make('group_name')->label(__('app.group_name'))->getStateUsing(fn (Submission $submission) => $submission->group->name),
                TextColumn::make('submitter')->sortable()->label(__('app.submitter')),
                TextColumn::make('supervisor')->label(__('app.supervisor'))->getStateUsing(fn (Submission $submission) => $submission->group->supervisor->name),
                TextColumn::make('status')
                    ->label(__('app.state'))
                    ->badge()
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
