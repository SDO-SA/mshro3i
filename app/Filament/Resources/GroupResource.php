<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GroupResource\Pages;
use App\Filament\Resources\GroupResource\Pages\ListGroups;
use App\Models\Group;
use App\Models\Supervisor;
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

class GroupResource extends Resource
{
    protected static ?string $model = Group::class;

    protected static ?string $pluralModelLabel = 'المجموعات';

    protected static ?string $modelLabel = 'مجموعة';

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    protected static ?string $navigationGroup = 'إدارة';

    public static function form(Form $form): Form
    {
        $user = auth()->user();
        $group = $form->getModelInstance();
        $supervisorname = optional(Supervisor::find($group->supervisor_id))->name ?? '';
        $groupUsers = User::where('group_id', $group->id)->get();
        $groupLeader = $groupUsers->where('state', 'group_leader')->first();
        $groupMembers = $groupUsers->where('state', 'group_member')->pluck('name')->toArray();

        return $form
            ->schema([
                TextInput::make('name')->disabled()->label(__('app.group_name')),
                TextInput::make('supervisors')->disabled()->label(__('app.suggested_supervisors')),
                TextInput::make('group_leader')->label(__('app.group_leader'))->disabled()->placeholder($groupLeader->name),
                TextInput::make('supervisor_name')->label(__('app.supervisor'))->disabled()->placeholder($supervisorname),
                TextInput::make('group_members')->label(__('app.group_members'))->disabled()->placeholder(implode(' - ', $groupMembers)),
                Select::make('supervisor_id')
                    ->label(__('app.assign_supervisor'))
                    ->options(Supervisor::where('department_id', $user->department_id)->pluck('name', 'id'))
                    ->searchable()
                    ->required(),
                Radio::make('status')
                    ->label(__('app.state'))
                    ->options([
                        'pending' => __('app.pending'),
                        'confirmed' => __('app.confirmed'),
                    ])->inline()
                    ->inlineLabel(false)
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->query(app(ListGroups::class)->departmentIdQuery())
            ->columns([
                TextColumn::make('name')->sortable()->label(__('app.group_name')),
                TextColumn::make('total_members')->sortable()->label(__('app.total_members')),
                TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'new' => 'info',
                        'pending' => 'warning',
                        'confirmed' => 'success',

                    })->sortable()
                    ->label(__('app.state'))
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'new' => __('app.new'),
                        'pending' => __('app.pending'),
                        'confirmed' => __('app.confirmed'),
                        default => $state,
                    }),
                TextColumn::make('created_at')->label(__('app.created_at'))->since(),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->options([
                        'new' => 'New',
                        'pending' => 'Pending',
                        'confirmed' => 'Confirmed',
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
            'index' => Pages\ListGroups::route('/'),
            'create' => Pages\CreateGroup::route('/create'),
            'edit' => Pages\EditGroup::route('/{record}/edit'),
        ];
    }
}
