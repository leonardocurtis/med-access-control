<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Novo Usuário</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">

                @if($errors->any())
                    <div class="mb-4 bg-red-50 border border-red-300 text-red-700 px-4 py-3 rounded">
                        <ul class="list-disc list-inside text-sm">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('users.store') }}">
                    @csrf

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nome</label>
                        <input type="text" name="name" value="{{ old('name') }}"
                               class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">E-mail</label>
                        <input type="email" name="email" value="{{ old('email') }}"
                               class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Senha</label>
                        <input type="password" name="password"
                               class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Confirmar Senha</label>
                        <input type="password" name="password_confirmation"
                               class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Perfil</label>
                        <select name="role" id="role"
                                class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                onchange="togglePermissions()">
                            <option value="">Selecione...</option>
                            <option value="admin" {{ old('role') === 'admin' ? 'selected' : '' }}>Administrador</option>
                            <option value="collaborator" {{ old('role') === 'collaborator' ? 'selected' : '' }}>Colaborador</option>
                        </select>
                    </div>

                    <div id="permissions-section" class="mb-6 hidden">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Permissões de Acesso</label>
                        <div class="border border-gray-200 rounded p-4 space-y-2">
                            @foreach($permissions as $permission)
                                <label class="flex items-center gap-2 cursor-pointer">
                                    <input type="checkbox" name="permissions[]" value="{{ $permission->name }}"
                                           {{ in_array($permission->name, old('permissions', [])) ? 'checked' : '' }}
                                           class="rounded border-gray-300 text-blue-600">
                                    <span class="text-sm text-gray-700">{{ $permission->name }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    <div class="flex gap-3">
                        <button type="submit"
                                class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">
                            Salvar
                        </button>
                        <a href="{{ route('users.index') }}"
                           class="bg-gray-100 text-gray-700 px-6 py-2 rounded hover:bg-gray-200">
                            Cancelar
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function togglePermissions() {
            const role = document.getElementById('role').value;
            const section = document.getElementById('permissions-section');
            section.classList.toggle('hidden', role !== 'collaborator');
        }
        togglePermissions();
    </script>
</x-app-layout>