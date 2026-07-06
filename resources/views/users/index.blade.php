<x-app-layout>
    <section class="items-stretch rounded-lg bg-white p-6 shadow-lg shadow-zinc-400/50">
        <div>
            <div class="mb-4 flex justify-end items-center">
                <a href="{{ route('users.create') }}"
                    class="inline-flex items-center space-x-2 rounded-lg bg-[#2979FF] px-4 py-2 text-white shadow-[#2161E5]/50 shadow-lg transition-colors hover:bg-[#2161E5]">
                    <x-phosphor-plus-circle class="w-6 h-6" />
                    <span>Novo Usuário</span>
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
                                <th
                                    class="px-6 py-3 text-left font-bold text-gray-600 text-xs uppercase tracking-wider">
                                    Nome</th>
                                <th
                                    class="px-6 py-3 text-left font-bold text-gray-600 text-xs uppercase tracking-wider">
                                    E-mail
                                </th>
                                <th
                                    class="px-6 py-3 text-left font-bold text-gray-600 text-xs uppercase tracking-wider">
                                    Perfil
                                </th>
                                <th
                                    class="px-6 py-3 text-left font-bold text-gray-600 text-xs uppercase tracking-wider">
                                    Permissões
                                </th>
                                <th class="px-6 py-3"></th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($users as $user)
                                <tr>
                                    <td class="px-6 py-4 text-gray-900 text-sm">
                                        {{ $user->name }}
                                    </td>
                                    <td class="px-6 py-4 text-gray-900 text-sm">{{ $user->masked_email }}</td>
                                    <td class="px-6 py-4 text-gray-900 text-sm">
                                        @if ($user->hasRole('admin'))
                                            <span
                                                class="bg-yellow-100 text-amber-700 px-2 py-1 rounded-full text-xs">Admin</span>
                                        @else
                                            <span
                                                class="bg-emerald-100 text-emerald-700 px-2 py-1 rounded-full text-xs text-center">Colaborador</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 text-gray-900 text-sm">
                                        {{ $user->permissions->count() > 0 ? $user->permissions->pluck('name')->implode(', ') : '—' }}
                                    </td>
                                    <td class="px-6 py-4 text-center text-sm space-x-2 tex">
                                        <div class="flex justify-center items-center gap-3">

                                            <button type="button"
                                                onclick="window.location='{{ route('users.edit', $user) }}'"
                                                class="text-blue-600 hover:underline">
                                                Editar
                                            </button>

                                            @if ($user->id !== auth()->id())
                                                <form action="{{ route('users.destroy', $user) }}" method="POST"
                                                    onsubmit="return confirm('Confirmar exclusão?')">
                                                    @csrf
                                                    @method('DELETE')

                                                    <button type="submit" class="text-red-600 hover:underline">
                                                        Excluir
                                                    </button>
                                                </form>
                                            @endif

                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-4 text-center text-gray-400">Nenhum usuário
                                        encontrado.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        @if ($users->hasPages())
            <div class="px-6 py-2">
                {{ $users->links() }}
            </div>
        @endif
    </section>
</x-app-layout>
