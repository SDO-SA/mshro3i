<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProjectResource\Pages;
use App\Filament\Resources\ProjectResource\Pages\ListProjects;
use App\Models\Project;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Support\Colors\Color;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Storage;

class ProjectResource extends Resource
{
    protected static ?string $model = Project::class;

    protected static ?string $pluralModelLabel = 'المشاريع';

    protected static ?string $modelLabel = 'مشروع';

    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';

    protected static ?string $navigationGroup = 'إدارة';

    public static function form(Form $form): Form
    {

        return $form
            ->schema([
                TextInput::make('name')->disabled()->label(__('app.name')),
                TextInput::make('group_name')->label(__('app.group_name'))->disabled()->placeholder(fn (Project $project) => $project->group->name),
                RichEditor::make('abstract')->columnSpanFull()->label(__('app.abstract')),
                // FileUpload::make('attachment')
                //     ->disk('public')
                //     ->columnSpanFull(),
                TextInput::make('projectfield')->disabled()->label(__('app.project_field')),
                TextInput::make('projecttech')->disabled()->label(__('app.project_tech')),

                Radio::make('status')
                    ->label(__('app.state'))
                    ->options([
                        'approved' => __('app.confirmed'),
                        'declined' => __('app.declined'),
                    ])->inline()
                    ->inlineLabel(false)
                    ->required()->columnSpanFull(),
                Textarea::make('feedback')->label(__('app.project_feedback')),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->query(app(ListProjects::class)->departmentIdQuery())
            ->columns([
                TextColumn::make('name')->sortable()->label(__('app.name')),
                TextColumn::make('group_name')->label(__('app.group_name'))->getStateUsing(fn (Project $project) => $project->group->name),
                TextColumn::make('supervisor')->label(__('app.supervisor'))->getStateUsing(fn (Project $project) => $project->supervisor->name),
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
                        'declined' => __('app.declined'),
                        default => $state,
                    }),
                TextColumn::make('created_at')->label(__('app.created_at'))->since(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\Action::make('View File')->url(function (Project $record) {
                    return Storage::url($record->attachment);
                }, true)->icon('heroicon-o-magnifying-glass')->label('عرض الملف')
                    ->color(Color::Green),
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

    public static function canCreate(): bool
    {
        return false;
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProjects::route('/'),
            'create' => Pages\CreateProject::route('/create'),
            'edit' => Pages\EditProject::route('/{record}/edit'),
        ];
    }
}
