<x-app-layout>
    <section class="items-stretch rounded-lg bg-white p-6 shadow-lg shadow-zinc-400/50">
        <div class="px-3 py-3 flex items-center gap-3">
            <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-zinc-900 text-white">
                <x-phosphor-cursor-text class="h-6 w-6" />
            </div>

            <div class="min-w-0">
                <h1 class="truncate text-lg font-bold">
                    Editar Usuário
                </h1>

                <p class="truncate text-xs text-gray-500">
                    {{ $user->name }}
                </p>
            </div>
        </div>

        <div>
            <div class="mt-2 max-w-2xl sm:px-6 lg:px-8 mx-auto shadow">
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

                    <form method="POST" action="{{ route('users.update', $user->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Nome</label>
                            <input type="text" name="name" value="{{ old('name', $user->name) }}"
                                class="w-full border border-gray-300 rounded px-3 py-2">
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-1">E-mail</label>
                            <input type="email" name="email" value="{{ old('email', $user->email) }}"
                                class="w-full border border-gray-300 rounded px-3 py-2">
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                Nova Senha
                            </label>
                            <input type="password" name="password"
                                class="w-full border border-gray-300 rounded px-3 py-2">
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Confirmar Nova Senha</label>
                            <input type="password" name="password_confirmation"
                                class="w-full border border-gray-300 rounded px-3 py-2">
                        </div>

                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Perfil</label>
                            <select name="role" id="role" onchange="togglePermissions()"
                                class="w-full border border-gray-300 rounded px-3 py-2">
                                <option value="admin" {{ old('role', $userRole) === 'admin' ? 'selected' : '' }}>
                                    Administrador</option>
                                <option value="collaborator"
                                    {{ old('role', $userRole) === 'collaborator' ? 'selected' : '' }}>Colaborador
                                </option>
                            </select>
                        </div>

                        <div id="permissions-section" class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Permissões de Acesso</label>
                            <div class="border border-gray-200 rounded p-4 space-y-2">
                                @foreach ($permissions as $permission)
                                    <label class="flex items-center gap-2 cursor-pointer">
                                        <input type="checkbox" name="permissions[]" value="{{ $permission->name }}"
                                            {{ in_array($permission->name, old('permissions', $userPermissions)) ? 'checked' : '' }}
                                            class="rounded border-gray-300 text-blue-600">
                                        <span class="text-sm text-gray-700">{{ $permission->name }}</span>
                                    </label>
                                @endforeach
                            </div>
                        </div>

                        <div class="flex gap-3">
                            <button type="submit"
                                class="rounded-lg bg-[#2979FF] px-6 py-2 text-white shadow-[#2161E5]/50 shadow-lg transition-colors hover:bg-[#2161E5]">
                                Atualizar
                            </button>
                            <a href="{{ route('users.index') }}"
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
        function togglePermissions() {
            const role = document.getElementById('role').value;
            document.getElementById('permissions-section').classList.toggle('hidden', role !== 'collaborator');
        }
        togglePermissions();
    </script>
</x-app-layout>
