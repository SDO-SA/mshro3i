<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AnnouncementResource\Pages;
use App\Filament\Resources\AnnouncementResource\Pages\ListAnnouncements;
use App\Models\Announcement;
use App\Models\Department;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class AnnouncementResource extends Resource
{
    protected static ?string $model = Announcement::class;

    protected static ?string $pluralModelLabel = 'الإعلانات';

    protected static ?string $modelLabel = 'إعلان';

    protected static ?string $navigationIcon = 'heroicon-o-newspaper';

    protected static ?string $navigationGroup = 'المعطيات';

    public static function form(Form $form): Form
    {
        $user = auth()->user();

        return $form
            ->schema([
                TextInput::make('header')->required()->label(__('app.header')),
                TextInput::make('brief')->required()->label(__('app.brief')),
                RichEditor::make('message')->columnSpanFull()->required()->label(__('app.message')),
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
            ->query(app(ListAnnouncements::class)->departmentIdQuery())
            ->columns([
                TextColumn::make('header')->label(__('app.header')),
                TextColumn::make('brief')->limit(15)->label(__('app.brief')),
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
            'index' => Pages\ListAnnouncements::route('/'),
            'create' => Pages\CreateAnnouncement::route('/create'),
            'edit' => Pages\EditAnnouncement::route('/{record}/edit'),
        ];
    }
}
