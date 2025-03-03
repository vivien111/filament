<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use Illuminate\Support\Facades\File;
class ViewLogs extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static string $view = 'filament.pages.view-logs';

    public $logContent;

    public function mount()
    {
        // Lire le fichier de log
        $logFile = storage_path('logs/laravel.log');
        if (File::exists($logFile)) {
            $this->logContent = File::get($logFile);
        } else {
            $this->logContent = 'Aucun fichier de log trouvé.';
        }
    }
}
