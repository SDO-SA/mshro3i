<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SupervisorAssignmentResource\Pages;
use App\Filament\Resources\SupervisorAssignmentResource\Pages\ListSupervisorAssignments;
use App\Models\Assignment;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class SupervisorAssignmentResource extends Resource
{
    protected static ?string $model = Assignment::class;

    protected static ?string $pluralModelLabel = 'الواجبات';

    protected static ?string $modelLabel = 'واجب';

    protected static ?string $navigationGroup = 'المعطيات';

    protected static ?string $navigationIcon = 'heroicon-o-document-magnifying-glass';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')->disabled()->label(__('app.name')),
                TextInput::make('points')->disabled()->label(__('app.points')),
                Textarea::make('deliverables')->disabled()->columnSpanFull()->label(__('app.deliverables')),
                DateTimePicker::make('due_date')
                    ->label(__('app.due_date'))
                    ->suffix('End Date')
                    ->seconds(false)
                    ->disabled(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->query(app(ListSupervisorAssignments::class)->departmentIdQuery())
            ->columns([
                TextColumn::make('name')->sortable()->label(__('app.name')),
                TextColumn::make('points')->sortable()->label(__('app.points')),
                TextColumn::make('due_date')->sortable()->label(__('app.due_date')),
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
            'index' => Pages\ListSupervisorAssignments::route('/'),
            'create' => Pages\CreateSupervisorAssignment::route('/create'),
            'edit' => Pages\EditSupervisorAssignment::route('/{record}/edit'),
        ];
    }
}
