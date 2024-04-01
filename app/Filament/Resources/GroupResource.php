<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GroupResource\Pages;
use App\Filament\Resources\GroupResource\Pages\ListGroups;
use App\Filament\Resources\GroupResource\RelationManagers;
use App\Models\Group;
use App\Models\Supervisor;
use Filament\Forms;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class GroupResource extends Resource
{
    protected static ?string $model = Group::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    public static function form(Form $form): Form
    {
        $user = auth()->user();
        $group = $form->getModelInstance();
        $supervisorname = optional(Supervisor::find($group->supervisor_id))->name ?? '';
        return $form
            ->schema([
                TextInput::make('name')->disabled(),
                TextInput::make('supervisors')->disabled(),
                TextInput::make('total_members')->disabled(),
                TextInput::make('supervisor_name')->label('Supervisor')->disabled()->placeholder($supervisorname),
                Radio::make('status')
                    ->label('Status')
                    ->options([
                        'pending' => 'Pending',
                        'confirmed' => 'Confirmed'
                    ])->inline()
                    ->inlineLabel(false)
                    ->required(),
                Select::make('supervisor_id')
                    ->label('Assign Supervisor')
                    ->options(Supervisor::where('department_id', $user->department_id)->pluck('name', 'id'))
                    ->searchable(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->query(app(ListGroups::class)->departmentIdQuery())
            ->columns([
                TextColumn::make('name')->sortable(),
                TextColumn::make('total_members')->sortable(),
                TextColumn::make('status')->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'new' => 'info',
                        'pending' => 'primary',
                        'confirmed' => 'success',

                    })->sortable(),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->options([
                        'new' => 'New',
                        'pending' => 'Pending',
                        'confirmed' => 'Confirmed'
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
            'index' => Pages\ListGroups::route('/'),
            'create' => Pages\CreateGroup::route('/create'),
            'edit' => Pages\EditGroup::route('/{record}/edit'),
        ];
    }
}
