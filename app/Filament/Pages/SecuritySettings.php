<?php

namespace App\Filament\Pages;

use Filament\Forms\Components\Toggle;
use Filament\Pages\Page;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Concerns\InteractsWithForms;

class SecuritySettings extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-shield-check';
    protected static string $view = 'filament.pages.security-settings';
    protected static ?string $navigationGroup = 'Sécurité';
    protected static ?int $navigationSort = 3;

    public $enable2FA;
    public $passwordPolicy;

    public function mount()
    {
        $this->form->fill([
            'enable2FA' => config('security.enable_2fa', false),
            'passwordPolicy' => config('security.password_policy', false),
        ]);
    }

    protected function getFormSchema(): array
    {
        return [
            Toggle::make('enable2FA')
                ->label('Activer l\'authentification à deux facteurs (2FA)'),
            Toggle::make('passwordPolicy')
                ->label('Appliquer une politique de mot de passe stricte'),
        ];
    }

    public function save()
    {
        $data = $this->form->getState();

        // Enregistrer les paramètres dans un fichier de configuration ou la base de données
        config(['security.enable_2fa' => $data['enable2FA']]);
        config(['security.password_policy' => $data['passwordPolicy']]);

        $this->notify('success', 'Paramètres de sécurité mis à jour avec succès.');
    }
}
