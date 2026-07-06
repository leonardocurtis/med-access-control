@php
    $menu = [
        [
            'permission' => 'access-hospital-sectors',
            'route' => 'modules.hospital-sectors',
            'label' => 'Setores Hospitalares',
            'icon' => 'phosphor-buildings',
        ],
        [
            'permission' => 'access-medical-specialties',
            'route' => 'modules.medical-specialties',
            'label' => 'Especialidades Médicas',
            'icon' => 'phosphor-stethoscope',
        ],
        [
            'permission' => 'access-equipment',
            'route' => 'modules.equipment',
            'label' => 'Equipamentos',
            'icon' => 'phosphor-monitor',
        ],
        [
            'permission' => 'access-care-units',
            'route' => 'modules.care-units',
            'label' => 'Unidades Assistenciais',
            'icon' => 'phosphor-first-aid-kit',
        ],
    ];
@endphp

<aside class="fixed top-0 left-0 z-50 h-full w-64 transform bg-white p-6 shadow-lg transition-transform duration-300">
    {{-- HEADER --}}
    <div class="mb-8 flex items-center gap-3">
        <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-blue-600 text-white">
            <x-phosphor-heartbeat class="h-6 w-6" />
        </div>

        <div class="min-w-0">
            <h1 class="truncate text-lg font-bold">
                Med Access
            </h1>

            <p class="truncate text-xs text-gray-500">Sistema de Gestão</p>
        </div>
    </div>

    {{-- MENU --}}
    <nav class="flex-1">

        @auth

            {{-- ADMIN --}}
            @if (auth()->user()->hasRole('admin'))
                <x-nav-link :href="route('users.index')" :active="request()->routeIs('users.*')">
                    <x-phosphor-users class="h-5 w-5" />
                    Usuários
                </x-nav-link>

                <x-nav-link :href="route('permissions.index')" :active="request()->routeIs('permissions.*')">
                    <x-phosphor-shield-check class="h-5 w-5" />
                    Permissões
                </x-nav-link>
            @endif

            {{-- COLLABORATOR --}}
            @if (auth()->user()->hasRole('collaborator'))
                <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                    <x-phosphor-house class="h-5 w-5" />
                    Dashboard
                </x-nav-link>

                @foreach ($menu as $item)
                    @can($item['permission'])
                        <x-nav-link :href="route($item['route'])" :active="request()->routeIs($item['route'] . '*')">
                            <x-dynamic-component :component="$item['icon']" class="h-5 w-5" />
                            {{ $item['label'] }}
                        </x-nav-link>
                    @endcan
                @endforeach
            @endif

        @endauth

    </nav>

</aside>
