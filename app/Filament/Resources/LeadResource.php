<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LeadResource\Pages;
use App\Models\Lead;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Storage;
use Filament\Tables\Actions\Action;

class LeadResource extends Resource
{
    protected static ?string $model = Lead::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Nom')
                    ->required(),
                Forms\Components\TextInput::make('email')
                    ->label('Email')
                    ->email()
                    ->required(),
                Forms\Components\TextInput::make('phone')
                    ->label('Téléphone'),
                Forms\Components\TextInput::make('company')
                    ->label('Entreprise'),
                Forms\Components\Textarea::make('notes')
                    ->label('Notes'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Nom')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('email')
                    ->label('Email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('phone')
                    ->label('Téléphone'),
                Tables\Columns\TextColumn::make('company')
                    ->label('Entreprise'),
            ])
            ->headerActions([
                Action::make('import')
                    ->label('Importer des leads')
                    ->action(function (array $data) {
                        $file = $data['file'];

                        // Vérifie si le fichier est bien un fichier CSV
                        if ($file instanceof \Illuminate\Http\UploadedFile) {
                            $path = $file->store('temp');

                            // Lire le fichier CSV et importer les leads
                            $rows = array_map('str_getcsv', file(storage_path("app/{$path}")));
                            $header = array_shift($rows);

                            // Vérifie que les colonnes du CSV correspondent à celles attendues
                            $expectedColumns = ['name', 'email', 'phone', 'company', 'notes'];

                            if ($header !== $expectedColumns) {
                                Storage::delete($path);
                                throw new \Exception('Le fichier CSV doit contenir les colonnes suivantes : ' . implode(', ', $expectedColumns));
                            }

                            foreach ($rows as $row) {
                                // Vérifie que chaque ligne a le bon nombre de colonnes
                                if (count($row) === count($header)) {
                                    Lead::create(array_combine($header, $row));
                                } else {
                                    throw new \Exception('Une ou plusieurs lignes ont un nombre incorrect de colonnes.');
                                }
                            }

                            Storage::delete($path);
                        } else {
                            throw new \Exception('Le fichier téléchargé est invalide. Assurez-vous que le fichier est au format CSV.');
                        }
                    })
                    ->form([
                        Forms\Components\FileUpload::make('file')
                            ->label('Fichier CSV')
                            ->required()
                            ->acceptedFileTypes(['text/csv']),
                    ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListLeads::route('/'),
            'create' => Pages\CreateLead::route('/create'),
            'edit' => Pages\EditLead::route('/{record}/edit'),
        ];
    }
}
