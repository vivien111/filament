<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TicketResource\Pages;
use App\Filament\Resources\TicketResource\RelationManagers;
use App\Models\Ticket;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Filters\SelectFilter;
class TicketResource extends Resource
{
    protected static ?string $model = Ticket::class;

    protected static ?string $navigationIcon = 'heroicon-o-ticket';
    protected static ?string $navigationGroup = 'Support et Aide';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('title')
                    ->label('Titre')
                    ->required()
                    ->maxLength(255),
                Textarea::make('description')
                    ->label('Description')
                    ->required(),
                Select::make('status')
                    ->label('Statut')
                    ->options([
                        'open' => 'Ouvert',
                        'in_progress' => 'En cours',
                        'resolved' => 'Résolu',
                        'closed' => 'Fermé',
                    ])
                    ->default('open')
                    ->required(),
                Select::make('user_id')
                    ->label('Utilisateur')
                    ->relationship('user', 'name') // Relation avec l'utilisateur
                    ->required(),
                Select::make('assigned_to')
                    ->label('Assigné à')
                    ->relationship('assignedTo', 'name') // Relation avec l'administrateur ou l'entreprise
                    ->nullable(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')->label('Titre')->searchable(),
                TextColumn::make('description')->label('Description')->limit(50),
                TextColumn::make('status')->label('Statut'),
                TextColumn::make('user.name')->label('Utilisateur'),
                TextColumn::make('assignedTo.name')->label('Assigné à'),
                TextColumn::make('created_at')->label('Créé le')->dateTime(),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->label('Statut')
                    ->options([
                        'open' => 'Ouvert',
                        'in_progress' => 'En cours',
                        'resolved' => 'Résolu',
                        'closed' => 'Fermé',
                    ]),
            ])
            ->actions([
                EditAction::make(), // Modifier un ticket
                DeleteAction::make(), // Supprimer un ticket
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(), // Supprimer plusieurs tickets
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTickets::route('/'),
            'create' => Pages\CreateTicket::route('/create'),
            'edit' => Pages\EditTicket::route('/{record}/edit'),
        ];
    }
}
