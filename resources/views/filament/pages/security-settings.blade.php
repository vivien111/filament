<x-filament-panels::page>
    <x-filament::card>
        <div class="p-6">
            <h3 class="text-xl font-semibold mb-4">Paramètres de Sécurité</h3>

            <form wire:submit.prevent="save">
                <!-- Activer la 2FA -->
                <div class="mb-6">
                    <label class="flex items-center space-x-3">
                        <input
                            type="checkbox"
                            wire:model="enable2FA"
                            class="form-checkbox h-5 w-5 text-primary-600 rounded"
                        />
                        <span class="text-gray-700">Activer l'authentification à deux facteurs (2FA)</span>
                    </label>
                </div>
<br>
                <!-- Appliquer une politique de mot de passe stricte -->
                <div class="mb-6">
                    <label class="flex items-center space-x-3">
                        <input
                            type="checkbox"
                            wire:model="passwordPolicy"
                            class="form-checkbox h-5 w-5 text-primary-600 rounded"
                        />
                        <span class="text-gray-700">Appliquer une politique de mot de passe stricte</span>
                    </label>
                </div>

                <!-- Bouton de soumission -->
                <div class="flex justify-end">
                    <button
                        type="submit"
                        class="bg-primary-500 text-white px-4 py-2 rounded-lg hover:bg-primary-600 transition-colors"
                    >
                        Enregistrer les paramètres
                    </button>
                </div>
            </form>
        </div>
    </x-filament::card>
</x-filament-panels::page>