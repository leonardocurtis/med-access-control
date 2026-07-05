<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800">Permissões</h2>
            <a href="{{ route('permissions.create') }}"
               class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 text-sm">
                + Nova Permissão
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">{{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">{{ session('error') }}</div>
            @endif

            <div class="bg-white shadow-sm sm:rounded-lg overflow-hidden">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nome (slug)</th>
                            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Usuários</th>
                            <th class="px-6 py-3"></th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse($permissions as $permission)
                            <tr>
                                <td class="px-6 py-4 text-sm font-mono text-gray-700">{{ $permission->name }}</td>
                                <td class="px-6 py-4 text-sm text-gray-500 text-la text-center">{{ $permission->users_count }}</td>
                                <td class="px-6 py-4 text-right space-x-2">
                                    <a href="{{ route('permissions.edit', $permission) }}" class="text-blue-600 hover:underline text-sm">Editar</a>
                                    <form action="{{ route('permissions.destroy', $permission) }}" method="POST" class="inline"
                                          onsubmit="return confirm('Remover esta permissão?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:underline text-sm">Excluir</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="3" class="px-6 py-4 text-center text-gray-400">Nenhuma permissão cadastrada.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>