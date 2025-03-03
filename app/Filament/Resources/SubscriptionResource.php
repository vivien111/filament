<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SubscriptionResource\Pages;
use App\Filament\Resources\SubscriptionResource\RelationManagers;
use App\Models\Subscription;
use Filament\Forms;
use App\Models\User;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Resources\Pages\ListRecords;
use Filament\Tables\Actions\Action;
use Illuminate\Support\Facades\Log;
use Filament\Notifications\Notification;

class SubscriptionResource extends Resource
{
    protected static ?string $model = Subscription::class;

    protected static ?string $navigationIcon = 'heroicon-o-credit-card'; // ou 'heroicon-s-credit-card'

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('stripe_subscription_id')
                    ->label('Stripe Subscription ID')
                    ->required(),
                Forms\Components\TextInput::make('stripe_status')
                    ->label('Status')
                    ->required(),
                Forms\Components\Select::make('user_id')
                    ->label('User')
                    ->options(User::all()->pluck('name', 'id'))
                    ->searchable()
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->label('User')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('stripe_subscription_id')
                    ->label('Subscription ID')
                    ->sortable(),
                Tables\Columns\TextColumn::make('stripe_status')
                    ->label('Status')
                    ->sortable(),
            ])
            ->filters([
                // Define filters if necessary
            ])
            ->headerActions([
                Action::make('cancel')
                    ->label('Cancel Subscription')
                    ->action(function ($record) {
                        // Vérifier si le $record est valide (pas null)
                        if ($record) {
                            // Annuler l'abonnement via Stripe ou autre logique
                            $record->cancelSubscription();
            
                            // Afficher une notification de succès
                            Notification::make()
                                ->title('Abonnement annulé')
                                ->success() // Vous pouvez également utiliser ->error() pour des erreurs
                                ->body('L\'abonnement a été annulé avec succès.')
                                ->send();
            
                        } else {
                            // Si $record est null, retourner un message d'erreur
                            Log::error('Le record de l\'abonnement est introuvable.');
            
                            // Afficher une notification d'erreur
                            Notification::make()
                                ->title('Erreur')
                                ->danger()
                                ->body('Impossible de trouver l\'abonnement.')
                                ->send();
            
                            return response()->json(['error' => 'Record de l\'abonnement non trouvé'], 404);
                        }
                    })
                    ->requiresConfirmation() // Demander une confirmation avant d'exécuter l'action
            ])
            ->actions([
                // Définir d'autres actions pour chaque ligne (par exemple, voir, éditer, etc.)
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSubscriptions::route('/'),
            'create' => Pages\CreateSubscription::route('/create'),
            'edit' => Pages\EditSubscription::route('/{record}/edit'),
        ];
    }
}
