<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Nova Permissão</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">

                @if ($errors->any())
                    <div class="mb-4 bg-red-50 border border-red-300 text-red-700 px-4 py-3 rounded">
                        <ul class="list-disc list-inside text-sm">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('permissions.update', $permission->id) }}">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nome</label>
                        <input type="text" name="name" value="{{ old('name', $permission->name) }}"
                            class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Descrição
                        </label>

                        <textarea name="description" id="description" rows="4" placeholder="Ex.: Permite acessar o módulo de radiologia."
                            class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 placeholder:text-gray-400">{{ old('description', $permission->description) }}</textarea>
                        <div class="flex justify-end mt-1 text-xs italic text-gray-400">
                            <span id="remaining">100</span>
                        </div>
                    </div>

                    <div class="flex gap-3">
                        <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">
                            Salvar
                        </button>
                        <a href="{{ route('permissions.index') }}"
                            class="bg-red-500 text-white px-6 py-2 rounded hover:bg-red-600">
                            Cancelar
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        const textarea = document.getElementById('description');
        const remaining = document.getElementById('remaining');
        const max = 100;

        function updateCounter() {
            const length = textarea.value.length;
            const left = max - length;

            if (left < 50) {
                remaining.classList.add('text-red-400');
            } else {
                remaining.classList.remove('text-red-400');
            }

            remaining.textContent = `${left} / ${max}`;
        }

        textarea.addEventListener('input', updateCounter);

        updateCounter();
    </script>
</x-app-layout>
