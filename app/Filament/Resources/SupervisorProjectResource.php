<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SupervisorProjectResource\Pages;
use App\Filament\Resources\SupervisorProjectResource\Pages\ListSupervisorProjects;
use App\Models\Project;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class SupervisorProjectResource extends Resource
{
    protected static ?string $model = Project::class;

    protected static ?string $pluralModelLabel = 'المشاريع';

    protected static ?string $modelLabel = 'مشروع';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->query(app(ListSupervisorProjects::class)->supervisorIdQuery())
            ->columns([
                TextColumn::make('name')->sortable(),
                TextColumn::make('group_name')->label('Group')->getStateUsing(fn (Project $project) => $project->group->name),
                TextColumn::make('status')->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'pending' => 'primary',
                        'approved' => 'success',
                        'declined' => 'danger',

                    })->sortable()
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'pending' => __('app.pending'),
                        'approved' => __('app.confirmed'),
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

    public static function canCreate(): bool
    {
        return false;
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSupervisorProjects::route('/'),
            'create' => Pages\CreateSupervisorProject::route('/create'),
            'edit' => Pages\EditSupervisorProject::route('/{record}/edit'),
        ];
    }
}
