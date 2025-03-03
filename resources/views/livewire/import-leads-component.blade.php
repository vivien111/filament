<div>
    @if (session()->has('success'))
        <div class="bg-green-500 text-white p-2 mb-4">
            {{ session('success') }}
        </div>
    @endif

    <form wire:submit.prevent="submit" class="space-y-4">
        <input type="file" wire:model="file" class="border p-2 w-full">
        
        @error('file')
            <span class="text-red-500">{{ $message }}</span>
        @enderror

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">
            Importer
        </button>
    </form>
</div>
