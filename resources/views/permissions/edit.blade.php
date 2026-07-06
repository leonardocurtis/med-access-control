<x-app-layout>
    <section class="items-stretch rounded-lg bg-white p-6 shadow-lg shadow-zinc-400/50">
        <div class="px-3 py-3 flex items-center gap-3">
            <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-zinc-900 text-white">
                <x-phosphor-cursor-text class="h-6 w-6" />
            </div>

            <div class="min-w-0">
                <h1 class="truncate text-lg font-bold">
                    Editar Permissão
                </h1>

                <p class="truncate text-xs text-gray-500">
                    {{ $permission->name }}
                </p>
            </div>
        </div>

        <div>
            <div class="mt-2 max-w-2xl mx-auto sm:px-6 lg:px-8 shadow">
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
                            <button type="submit" class="rounded-lg bg-[#2979FF] px-6 py-2 text-white shadow-[#2161E5]/50 shadow-lg transition-colors hover:bg-[#2161E5]">
                                Salvar
                            </button>
                            <a href="{{ route('permissions.index') }}"
                                class="bg-red-500 text-white px-6 py-2 rounded-lg hover:bg-red-600 shadow-red-600/50 shadow-lg">
                                Cancelar
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
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
