<?php

namespace App\Filament\Resources\SalarieResource\Pages;

use App\Filament\Resources\SalarieResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSalarie extends EditRecord
{
    protected static string $resource = SalarieResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
