<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TicketMessageResource\Pages;
use App\Models\TicketMessage;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;

class TicketMessageResource extends Resource
{
    protected static ?string $model = TicketMessage::class;

    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-left-ellipsis';
    protected static ?string $navigationGroup = 'Support et Aide';
    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('ticket_id')
                    ->label('Ticket')
                    ->relationship('ticket', 'title') // Relation avec le ticket
                    ->required(),
                Select::make('user_id')
                    ->label('Utilisateur')
                    ->relationship('user', 'name') // Relation avec l'utilisateur
                    ->required(),
                Textarea::make('message')
                    ->label('Message')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('ticket.title')->label('Ticket'),
                TextColumn::make('user.name')->label('Utilisateur'),
                TextColumn::make('message')->label('Message')->limit(50),
                TextColumn::make('created_at')->label('Créé le')->dateTime(),
            ])
            ->filters([
                // Ajoutez des filtres si nécessaire
            ])
            ->actions([
                Tables\Actions\EditAction::make(), // Modifier un message
                Tables\Actions\DeleteAction::make(), // Supprimer un message
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(), // Supprimer plusieurs messages
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTicketMessages::route('/'),
            'create' => Pages\CreateTicketMessage::route('/create'),
            'edit' => Pages\EditTicketMessage::route('/{record}/edit'),
        ];
    }
}