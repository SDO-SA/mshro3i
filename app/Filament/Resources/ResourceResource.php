<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ResourceResource\Pages;
use App\Filament\Resources\ResourceResource\Pages\ListResources;
use App\Models\Department;
use App\Models\Resource as ResourceModel;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ResourceResource extends Resource
{
    protected static ?string $model = ResourceModel::class;

    protected static ?string $pluralModelLabel = 'المصادر';

    protected static ?string $modelLabel = 'مصدر';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'المعطيات';

    public static function form(Form $form): Form
    {
        $user = auth()->user();

        return $form
            ->schema([
                TextInput::make('name')->label(__('app.name'))->required(),
                Select::make('department_id')
                    ->label(__('app.department'))
                    ->default($user->department_id)
                    ->options(Department::where('id', $user->department_id)->pluck('name_ar', 'id'))
                    ->required(),
                FileUpload::make('path')->columnSpanFull()->required()->label(__('app.file')),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->query(app(ListResources::class)->departmentIdQuery())
            ->columns([
                TextColumn::make('name')->label(__('app.name')),
                TextColumn::make('created_at')->label(__('app.created_at'))->since(),
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
            'index' => Pages\ListResources::route('/'),
            'create' => Pages\CreateResource::route('/create'),
            'edit' => Pages\EditResource::route('/{record}/edit'),
        ];
    }
}
