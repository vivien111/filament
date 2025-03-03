<?php

namespace App\Filament\Resources;

use App\Filament\Resources\IntegrationResource\Pages;
use App\Models\Integration;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;

class IntegrationResource extends Resource
{
    protected static ?string $model = Integration::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('service_name')
                    ->label('Service Name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('api_key')
                    ->label('API Key')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make('status')
                    ->label('Status')
                    ->options([
                        'active' => 'Active',
                        'inactive' => 'Inactive',
                    ])
                    ->default('inactive')
                    ->required(),
                Forms\Components\FileUpload::make('logo')
                    ->label('Logo')
                    ->image()
                    ->nullable()
                    ->disk('public')
                    ->directory('integrations/logos')
                    ->maxSize(1024), // Limiter la taille du fichier en Ko
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('service_name')->label('Service Name'),
                ImageColumn::make('logo')
                ->label('Logo')
                ->disk('public')
                ->width(100)
                ->height(100)
                ->view('columns.custom-image-column'),
                TextColumn::make('status')->label('Status'),
                TextColumn::make('api_key')->label('API Key')->limit(50),
                TextColumn::make('created_at')->label('Created At')->date(),
            ])
            ->filters([
                // Add filters here if needed
            ])
            ->actions([
                EditAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            // Si vous avez des relations, définissez-les ici
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListIntegrations::route('/'),
            'create' => Pages\CreateIntegration::route('/create'),
            'edit' => Pages\EditIntegration::route('/{record}/edit'),
        ];
    }
}
