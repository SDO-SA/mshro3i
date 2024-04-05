<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StudentsResource\Pages;
use App\Filament\Resources\StudentsResource\Pages\ListStudents;
use App\Filament\Resources\StudentsResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class StudentsResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name'),
                TextInput::make('university_id')->numeric()->unique(ignoreRecord: true),
                TextInput::make('email')->unique(ignoreRecord: true),
                Radio::make('state')
                    ->options([
                        'not_joined' => 'Not Joined',
                        'group_member' => 'Group Member',
                        'group_leader' => 'Group Leader'
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        $currentUser = auth()->user();
        return $table
            ->query(app(ListStudents::class)->departmentIdQuery())
            ->columns([
                TextColumn::make('name')->sortable(),
                TextColumn::make('email')->sortable(),
                TextColumn::make('university_id')->sortable(),
                TextColumn::make('state')->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'not_joined' => 'info',
                        'group_member' => 'success',
                        'group_leader' => 'primary',

                    })->sortable()
                    ->label('State') // Add a custom label for clarity
                    ->formatStateUsing(fn(string $state): string => match ($state) {
                        'not_joined' => 'Not Joined',
                        'group_member' => 'Group Member',
                        'group_leader' => 'Group Leader',
                        default => $state,
                    }),
                TextColumn::make('created_at')->label('Created At')->since(),
            ])
            ->filters([
                SelectFilter::make('state')
                    ->options([
                        'not_joined' => 'Not Joined',
                        'group_member' => 'Group Member',
                        'group_leader' => 'Group Leader',
                    ])
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
            'index' => Pages\ListStudents::route('/'),
            'create' => Pages\CreateStudents::route('/create'),
            'edit' => Pages\EditStudents::route('/{record}/edit'),
        ];
    }
}
