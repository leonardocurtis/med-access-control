<x-app-layout>

    <div>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Bem-vindo, {{ auth()->user()->name }}
        </h2>
    </div>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                <p class="text-gray-600 mb-4">
                    Você tem acesso aos seguintes módulos:
                </p>

                @if ($userPermissions->isEmpty())
                    <p class="text-gray-400 italic">
                        Nenhum módulo disponível para o seu perfil.
                    </p>
                @else

                    @php
                        $modules = [
                            'access-hospital-sectors' => [
                                'route' => 'modules.hospital-sectors',
                                'label' => 'Setores Hospitalares',
                            ],
                            'access-medical-specialties' => [
                                'route' => 'modules.medical-specialties',
                                'label' => 'Especialidades Médicas',
                            ],
                            'access-equipment' => [
                                'route' => 'modules.equipment',
                                'label' => 'Equipamentos',
                            ],
                            'access-care-units' => [
                                'route' => 'modules.care-units',
                                'label' => 'Unidades Assistenciais',
                            ],
                        ];
                    @endphp

                    <div class="grid grid-cols-2 gap-4 mt-4">

                        @foreach ($userPermissions as $permission)

                            @php
                                $module = $modules[$permission->name] ?? null;
                            @endphp

                            @if ($module)
                                <a href="{{ route($module['route']) }}"
                                   class="block p-4 bg-blue-50 border border-blue-200 rounded-lg hover:bg-blue-100 transition text-blue-700 font-medium">
                                    {{ $module['label'] }}
                                </a>
                            @endif

                        @endforeach

                    </div>

                @endif

            </div>
        </div>
    </div>

</x-app-layout>