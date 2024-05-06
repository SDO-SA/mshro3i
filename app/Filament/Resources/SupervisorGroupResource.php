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

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

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
                TextInput::make('name')->disabled(),
                TextInput::make('supervisors')->disabled(),
                TextInput::make('total_members')->disabled(),
                TextInput::make('supervisor_name')->label('Supervisor')->disabled()->placeholder($supervisorname),
                TextInput::make('group_leader')->label('Leader')->disabled()->placeholder($groupLeader->name),
                TextInput::make('group_members')->label('Members')->disabled()->placeholder(implode(', ', $groupMembers)),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->query(app(ListSupervisorGroups::class)->supervisorIdQuery())
            ->columns([
                TextColumn::make('name')->sortable(),
                TextColumn::make('total_members')->sortable(),
                TextColumn::make('status')->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'new' => 'info',
                        'pending' => 'primary',
                        'confirmed' => 'success',

                    })->sortable()
                    ->label('Status') // Add a custom label for clarity
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'new' => __('app.new'),
                        'pending' => __('app.pending'),
                        'confirmed' => __('app.confirmed'),
                        default => $state,
                    }),
                TextColumn::make('created_at')->label('Created At')->since(),
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
            'index' => Pages\ListSupervisorGroups::route('/'),
            'create' => Pages\CreateSupervisorGroup::route('/create'),
            'edit' => Pages\EditSupervisorGroup::route('/{record}/edit'),
        ];
    }
}
