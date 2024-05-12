<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SupervisorsResource\Pages;
use App\Filament\Resources\SupervisorsResource\Pages\ListSupervisors;
use App\Models\Supervisor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class SupervisorsResource extends Resource
{
    protected static ?string $model = Supervisor::class;

    protected static ?string $pluralModelLabel = 'المشرفين';

    protected static ?string $modelLabel = 'مشرف';

    protected static ?string $navigationIcon = 'heroicon-o-users';

    protected static ?string $navigationGroup = 'إدارة';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')->label(__('app.name')),
                TextInput::make('university_id')->numeric()->unique(ignoreRecord: true)->label(__('app.uni_id')),
                TextInput::make('email')->unique(ignoreRecord: true)->label(__('app.email')),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->query(app(ListSupervisors::class)->departmentIdQuery())
            ->columns([
                TextColumn::make('name')->sortable()->label(__('app.name')),
                TextColumn::make('email')->sortable()->label(__('app.email')),
                TextColumn::make('university_id')->sortable()->label(__('app.uni_id')),
                TextColumn::make('created_at')->label(__('app.created_at'))->since(),
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
            'index' => Pages\ListSupervisors::route('/'),
            'create' => Pages\CreateSupervisors::route('/create'),
            'edit' => Pages\EditSupervisors::route('/{record}/edit'),
        ];
    }
}
