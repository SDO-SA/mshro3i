<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SupervisorGroupResource\Pages;
use App\Filament\Resources\SupervisorGroupResource\Pages\ListSupervisorGroups;
use App\Models\Group;
use App\Models\Supervisor;
use App\Models\User;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class SupervisorGroupResource extends Resource
{
    protected static ?string $model = Group::class;

    protected static ?string $pluralModelLabel = 'المجموعات';

    protected static ?string $modelLabel = 'مجموعة';

    protected static ?string $navigationGroup = 'الإدارة';

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    public static function form(Form $form): Form
    {
        $group = $form->getModelInstance();
        $supervisorname = optional(Supervisor::find($group->supervisor_id))->name ?? '';
        $groupUsers = User::where('group_id', $group->id)->get();
        $groupLeader = $groupUsers->where('state', 'group_leader')->first();
        $groupMembers = $groupUsers->where('state', 'group_member')->pluck('name')->toArray();

        return $form
            ->schema([
                TextInput::make('name')->disabled()->label(__('app.group_name')),
                TextInput::make('group_leader')->label(__('app.group_leader'))->disabled()->placeholder($groupLeader->name),
                TextInput::make('supervisor_name')->label(__('app.supervisor'))->disabled()->placeholder($supervisorname),
                TextInput::make('group_members')->label(__('app.group_members'))->disabled()->placeholder(implode(' - ', $groupMembers)),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->query(app(ListSupervisorGroups::class)->supervisorIdQuery())
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
            'index' => Pages\ListSupervisorGroups::route('/'),
            'create' => Pages\CreateSupervisorGroup::route('/create'),
            'edit' => Pages\EditSupervisorGroup::route('/{record}/edit'),
        ];
    }
}
