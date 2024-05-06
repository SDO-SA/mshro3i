<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SupervisorAssignmentResource\Pages;
use App\Filament\Resources\SupervisorAssignmentResource\Pages\ListSupervisorAssignments;
use App\Models\Assignment;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class SupervisorAssignmentResource extends Resource
{
    protected static ?string $model = Assignment::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')->disabled(),
                TextInput::make('points')->disabled(),
                RichEditor::make('deliverables')->columnSpanFull()->disabled(),
                DateTimePicker::make('due_date')
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
                TextColumn::make('name')->sortable(),
                TextColumn::make('points')->sortable(),
                TextColumn::make('due_date')->sortable(),
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

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSupervisorAssignments::route('/'),
            'create' => Pages\CreateSupervisorAssignment::route('/create'),
            'edit' => Pages\EditSupervisorAssignment::route('/{record}/edit'),
        ];
    }
}
