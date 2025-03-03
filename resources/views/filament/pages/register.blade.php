<x-filament-panels::page>
    <x-filament::card>
        <form wire:submit.prevent="register">
            <div class="space-y-4">
                <x-filament::input
                    type="text"
                    wire:model="name"
                    label="Nom"
                    required
                />
                <x-filament::input
                    type="email"
                    wire:model="email"
                    label="Adresse e-mail"
                    required
                />
                <x-filament::input
                    type="password"
                    wire:model="password"
                    label="Mot de passe"
                    required
                />
                <x-filament::input
                    type="password"
                    wire:model="password_confirmation"
                    label="Confirmer le mot de passe"
                    required
                />
            </div>

            <div class="flex justify-end mt-4">
                <button
                    type="submit"
                    class="bg-primary-500 text-white px-4 py-2 rounded-lg hover:bg-primary-600 transition-colors"
                >
                    S'inscrire
                </button>
            </div>
        </form>
    </x-filament::card>
</x-filament-panels::page>