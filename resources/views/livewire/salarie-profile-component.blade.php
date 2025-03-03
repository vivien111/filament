<div class="p-4 bg-gray-900 text-white rounded-md">
    @if (session()->has('success'))
        <div class="bg-green-500 text-white p-2 mb-4 rounded">
            {{ session('success') }}
        </div>
    @endif

    <form wire:submit.prevent="updateProfile" class="space-y-4">
        <div>
            <label for="nom" class="block text-sm font-medium">Nom</label>
            <input type="text" id="nom" wire:model="nom" class="border p-2 w-full bg-black text-white rounded">
            @error('nom') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="prenom" class="block text-sm font-medium">Prénom</label>
            <input type="text" id="prenom" wire:model="prenom" class="border p-2 w-full bg-black text-white rounded">
            @error('prenom') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="email" class="block text-sm font-medium">Email</label>
            <input type="email" id="email" wire:model="email" class="border p-2 w-full bg-black text-white rounded">
            @error('email') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="password" class="block text-sm font-medium">Nouveau mot de passe</label>
            <input type="password" id="password" wire:model="password" class="border p-2 w-full bg-black text-white rounded">
            @error('password') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded w-full">
            Mettre à jour
        </button>
    </form>
</div>
