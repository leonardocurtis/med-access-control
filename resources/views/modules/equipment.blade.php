<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Equipamentos</h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <p class="text-gray-600">Módulo: <strong>Equipamentos</strong></p>
                <p class="text-gray-400 text-sm mt-2">Acesso autorizado para {{ auth()->user()->name }}.</p>
            </div>
        </div>
    </div>
</x-app-layout>