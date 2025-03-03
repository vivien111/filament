<x-filament-panels::page>
    <x-filament::card>
        <div class="max-h-96 overflow-y-auto">
            <h3 class="text-xl font-semibold mb-2">Log Content</h3>
            <pre class="bg-gray-800 p-4 rounded-lg whitespace-pre-wrap break-words text-sm text-white">
                {{ $logContent }}
            </pre>
        </div>
    </x-filament::card>
</x-filament-panels::page>
