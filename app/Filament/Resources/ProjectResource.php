<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProjectResource\Pages;
use App\Filament\Resources\ProjectResource\Pages\ListProjects;
use App\Filament\Resources\ProjectResource\RelationManagers;
use App\Models\Group;
use App\Models\Project;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProjectResource extends Resource
{
    protected static ?string $model = Project::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        $group = $form->getModelInstance();
        $groupName = optional(Group::find($group->group_id))->name ?? '';
        return $form
            ->schema([
                TextInput::make('name')->disabled(),
                TextInput::make('group_name')->label('Group')->disabled()->placeholder($groupName),
                TextInput::make('projectfield')->disabled(),
                RichEditor::make('abstract')->columnSpanFull(),
                // FileUpload::make('attachment')
                //     ->disk('public')
                //     ->columnSpanFull(),
                Radio::make('status')
                    ->label('Status')
                    ->options([
                        'approved' => 'Approve',
                        'declined' => 'Decline'
                    ])->inline()
                    ->inlineLabel(false)
                    ->required(),
                TextColumn::make('created_at')->label('Created At')->since(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->query(app(ListProjects::class)->departmentIdQuery())
            ->columns([
                TextColumn::make('name')->sortable(),
                TextColumn::make('group_name')->label('Group')->getStateUsing(fn(Project $project) => $project->group->name),
                TextColumn::make('status')->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'pending' => 'primary',
                        'approved' => 'success',
                        'declined' => 'danger',

                    })->sortable(),
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
            'index' => Pages\ListProjects::route('/'),
            'create' => Pages\CreateProject::route('/create'),
            'edit' => Pages\EditProject::route('/{record}/edit'),
        ];
    }
}
