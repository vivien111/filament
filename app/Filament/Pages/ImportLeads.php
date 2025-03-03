<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class ImportLeads extends Page
{
    protected static string $view = 'filament.pages.import-leads';

    protected static ?string $navigationIcon = 'heroicon-o-document-arrow-up';

    protected static ?string $navigationLabel = 'Importer des leads';

    protected static ?string $navigationGroup = 'Gestion des leads';
}
