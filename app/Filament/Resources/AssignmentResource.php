<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AssignmentResource\Pages;
use App\Filament\Resources\AssignmentResource\Pages\ListAssignments;
use App\Models\Assignment;
use App\Models\Department;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class AssignmentResource extends Resource
{
    protected static ?string $model = Assignment::class;

    protected static ?string $pluralModelLabel = 'الواجبات';

    protected static ?string $modelLabel = 'واجب';

    protected static ?string $navigationIcon = 'heroicon-o-document-magnifying-glass';

    protected static ?string $navigationGroup = 'المعطيات';

    public static function form(Form $form): Form
    {
        $user = auth()->user();

        return $form
            ->schema([
                TextInput::make('name')->label(__('app.name')),
                TextInput::make('points')->label(__('app.points')),
                RichEditor::make('deliverables')->columnSpanFull()->required()->label(__('app.deliverables')),
                DateTimePicker::make('due_date')
                    ->label(__('app.due_date'))
                    ->suffix('End Date')
                    ->seconds(false)
                    ->required(),
                Select::make('department_id')
                    ->label(__('app.department'))
                    ->default($user->department_id)
                    ->options(Department::where('id', $user->department_id)->pluck('name_ar', 'id'))
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->query(app(ListAssignments::class)->departmentIdQuery())
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
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListAssignments::route('/'),
            'create' => Pages\CreateAssignment::route('/create'),
            'edit' => Pages\EditAssignment::route('/{record}/edit'),
        ];
    }
}
