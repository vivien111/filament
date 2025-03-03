<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SalarieResource\Pages;
use App\Filament\Resources\SalarieResource\RelationManagers;
use App\Models\Salarie;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Columns\BooleanColumn;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\DeleteAction;
class SalarieResource extends Resource
{
    protected static ?string $model = Salarie::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    public static function form(Form $form): Form
{
    return $form
        ->schema([
            Forms\Components\TextInput::make('nom')->required(),
            Forms\Components\TextInput::make('prenom')->required(),
            Forms\Components\TextInput::make('email')->email()->required(),
            Forms\Components\Select::make('entreprise_id')
                ->relationship('entreprise', 'nom')
                ->required(),
        ]);
}

public static function table(Table $table): Table
{
    return $table
        ->columns([
            Tables\Columns\TextColumn::make('nom'),
            Tables\Columns\TextColumn::make('prenom'),
            Tables\Columns\TextColumn::make('email'),
            Tables\Columns\TextColumn::make('entreprise.nom'),
            BooleanColumn::make('is_active')->label('Actif'),

        ])
        ->actions([
            // Action pour désactiver/réactiver un salarié
            Action::make('toggleActive')
                ->label(fn (Salarie $record) => $record->is_active ? 'Désactiver' : 'Activer')
                ->color(fn (Salarie $record) => $record->is_active ? 'danger' : 'success')
                ->action(function (Salarie $record) {
                    $record->update(['is_active' => !$record->is_active]);
                }),

            // Action pour supprimer un salarié
            DeleteAction::make(),
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
            'index' => Pages\ListSalaries::route('/'),
            'create' => Pages\CreateSalarie::route('/create'),
            'edit' => Pages\EditSalarie::route('/{record}/edit'),
        ];
    }
}
