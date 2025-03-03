<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class SalarieProfile extends Page
{
    protected static string $view = 'filament.pages.salarie-profile';

    protected static ?string $navigationIcon = 'heroicon-o-user';

    protected static ?string $navigationLabel = 'Mon profil';

    protected static ?string $navigationGroup = 'Compte';
}
