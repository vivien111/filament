<?php

namespace App\Filament\Resources\SalarieResource\Pages;

use App\Filament\Resources\SalarieResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSalaries extends ListRecords
{
    protected static string $resource = SalarieResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
