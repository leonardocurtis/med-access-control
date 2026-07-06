<x-app-layout>
    <section class="items-stretch rounded-lg bg-white p-6 shadow-lg shadow-zinc-400/50">

        <div>
            <div class="mb-4 flex justify-end items-center">
                <a href="{{ route('permissions.create') }}"
                    class="inline-flex items-center space-x-2 rounded-lg bg-[#2979FF] px-4 py-2 text-white shadow-[#2161E5]/50 shadow-lg transition-colors hover:bg-[#2161E5]">
                    <x-phosphor-plus-circle class="w-6 h-6" />
                    <span>Nova Permissão</span>
                </a>
            </div>
        </div>

        <div>
            <div class="max-w-7xl">
                <x-flash-message />
                <div class="bg-white shadow sm:rounded-lg overflow-hidden">
                    <table class="min-w-full divide-y divide-gray-300">
                        <thead class="bg-gray-200">
                            <tr>
                                <th class="px-6 py-3 text-left font-bold text-gray-600 text-xs uppercase tracking-wider">
                                    Nome
                                </th>
                                <th
                                    class="px-6 py-3 text-left font-bold text-gray-600 text-xs uppercase tracking-wider">
                                    Descrição
                                </th>
                                <th
                                    class="px-6 py-3 text-left font-bold text-gray-600 text-xs uppercase tracking-wider">
                                    Usuários
                                </th>
                                <th class="px-6 py-3"></th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($permissions as $permission)
                                <tr>
                                    <td class="px-6 py-4 text-gray-900 text-sm">{{ $permission->name }}</td>
                                    <td class="px-6 py-4 text-gray-900 text-sm">
                                        {{ $permission->description ?? '—' }}
                                    </td>
                                    <td class="px-6 py-4 text-gray-900 text-sm">
                                        {{ $permission->users_count }}</td>
                                    <td class="px-6 py-4 text-center text-sm space-x-2 tex">
                                        <div class="flex justify-center items-center gap-3">

                                            <button type="button"
                                                onclick="window.location='{{ route('permissions.edit', $permission) }}'"
                                                class="text-blue-600 hover:underline">
                                                Editar
                                            </button>

                                            <form action="{{ route('permissions.destroy', $permission) }}"
                                                method="POST" onsubmit="return confirm('Confirmar exclusão?')">
                                                @csrf
                                                @method('DELETE')

                                                <button type="submit" class="text-red-600 hover:underline">
                                                    Excluir
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="px-6 py-4 text-center text-gray-400">Nenhuma permissão
                                        cadastrada.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
