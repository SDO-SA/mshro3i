<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StudentsResource\Pages;
use App\Filament\Resources\StudentsResource\Pages\ListStudents;
use App\Models\Group;
use App\Models\User;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class StudentsResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $pluralModelLabel = 'الطلاب';

    protected static ?string $modelLabel = 'طالب';

    protected static ?string $navigationIcon = 'heroicon-o-users';

    protected static ?string $navigationGroup = 'إدارة';

    public static function form(Form $form): Form
    {
        $user = auth()->user();

        return $form
            ->schema([
                TextInput::make('name')->disabled()->label(__('app.name')),
                TextInput::make('university_id')->disabled()->label(__('app.uni_id')),
                TextInput::make('group_name')->label(__('app.group_name'))->disabled()->placeholder(fn (User $user) => $user->group->name ?? ''),
                TextInput::make('email')->disabled()->label(__('app.email')),
                Select::make('group_id')
                    ->label(__('app.assign_group'))
                    ->options(Group::where('department_id', $user->department_id)->pluck('name', 'id'))
                    ->searchable()
                    ->required(),
                Radio::make('state')
                    ->label(__('app.state'))
                    ->options([
                        'group_member' => __('app.filament_groupmember'),
                        'group_leader' => __('app.filament_groupleader'),
                    ])->inline()
                    ->inlineLabel(false)
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        $currentUser = auth()->user();

        return $table
            ->query(app(ListStudents::class)->departmentIdQuery())
            ->columns([
                TextColumn::make('name')->sortable()->label(__('app.name')),
                TextColumn::make('email')->sortable()->label(__('app.email')),
                TextColumn::make('university_id')->sortable()->label(__('app.uni_id')),
                TextColumn::make('state')->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'not_joined' => 'info',
                        'group_member' => 'success',
                        'group_leader' => 'warning',

                    })->sortable()
                    ->label(__('app.state'))
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'not_joined' => __('app.filament_notjoined'),
                        'group_member' => __('app.filament_groupmember'),
                        'group_leader' => __('app.filament_groupleader'),
                        default => $state,
                    }),
                TextColumn::make('created_at')->label(__('app.created_at'))->since(),
            ])
            ->filters([
                SelectFilter::make('state')
                    ->options([
                        'not_joined' => 'Not Joined',
                        'group_member' => 'Group Member',
                        'group_leader' => 'Group Leader',
                    ]),
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
            'index' => Pages\ListStudents::route('/'),
            'create' => Pages\CreateStudents::route('/create'),
            'edit' => Pages\EditStudents::route('/{record}/edit'),
        ];
    }
}
