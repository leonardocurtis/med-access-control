<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800">Usuários</h2>
            <a href="{{ route('users.create') }}"
                class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 text-sm">
                + Novo Usuário
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                    {{ session('success') }}
                </div>
            @endif
            @if (session('error'))
                <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                    {{ session('error') }}
                </div>
            @endif

            <div class="bg-white shadow-sm sm:rounded-lg overflow-hidden">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Nome</th>
                            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">E-mail</th>
                            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Perfil</th>
                            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Permissões
                            </th>
                            <th class="px-6 py-3"></th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($users as $user)
                            <tr>
                                <td class="text-center px-6 py-4 text-sm font-medium text-gray-900">{{ $user->name }}
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-500 text-center">{{ $user->email }}</td>
                                <td class="px-6 py-4 text-sm text-center">
                                    @if ($user->hasRole('admin'))
                                        <span
                                            class="bg-red-100 text-red-700 px-2 py-1 rounded-full text-xs">Admin</span>
                                    @else
                                        <span
                                            class="bg-blue-100 text-blue-700 px-2 py-1 rounded-full text-xs text-center">Colaborador</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-500 text-center">
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

                <div class="px-6 py-4">
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
