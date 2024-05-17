<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SupervisorProjectResource\Pages;
use App\Filament\Resources\SupervisorProjectResource\Pages\ListSupervisorProjects;
use App\Models\Project;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
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

    protected static ?string $navigationGroup = 'الإدارة';

    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')->disabled()->label(__('app.name')),
                TextInput::make('group_name')->label(__('app.group_name'))->disabled()->placeholder(fn (Project $project) => $project->group->name),
                Textarea::make('abstract')->columnSpanFull()->disabled()->label(__('app.abstract')),
                TextInput::make('projectfield')->disabled()->label(__('app.project_field')),
                TextInput::make('projecttech')->disabled()->label(__('app.project_tech')),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->query(app(ListSupervisorProjects::class)->supervisorIdQuery())
            ->columns([
                TextColumn::make('name')->sortable()->label(__('app.name')),
                TextColumn::make('group_name')->label(__('app.group_name'))->getStateUsing(fn (Project $project) => $project->group->name),
                TextColumn::make('status')
                    ->badge()
                    ->label(__('app.state'))
                    ->color(fn (string $state): string => match ($state) {
                        'pending' => 'warning',
                        'approved' => 'success',
                        'declined' => 'danger',

                    })->sortable()
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'pending' => __('app.pending'),
                        'approved' => __('app.confirmed'),
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
            'index' => Pages\ListSupervisorProjects::route('/'),
            'create' => Pages\CreateSupervisorProject::route('/create'),
            'edit' => Pages\EditSupervisorProject::route('/{record}/edit'),
        ];
    }
}
