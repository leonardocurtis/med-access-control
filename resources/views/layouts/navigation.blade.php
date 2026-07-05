<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <div class="flex-shrink-0 flex items-center">
                    <span class="font-bold text-lg text-red-700">Med Acesss System</span>
                </div>

                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">

                    @auth

                        @if(auth()->user()->hasRole('admin'))
                            <x-nav-link :href="route('users.index')" :active="request()->routeIs('users.*')">
                                Usuários
                            </x-nav-link>
                            <x-nav-link :href="route('permissions.index')" :active="request()->routeIs('permissions.*')">
                                Permissões
                            </x-nav-link>
                        @endif

                        @if(auth()->user()->hasRole('collaborator'))
                            @can('access-hospital-sectors')
                                <x-nav-link :href="route('modules.hospital-sectors')" :active="request()->routeIs('modules.hospital-sectors')">
                                    Setores Hospitalares
                                </x-nav-link>
                            @endcan

                            @can('access-medical-specialties')
                                <x-nav-link :href="route('modules.medical-specialties')" :active="request()->routeIs('modules.medical-specialties')">
                                    Especialidades Médicas
                                </x-nav-link>
                            @endcan

                            @can('access-equipment')
                                <x-nav-link :href="route('modules.equipment')" :active="request()->routeIs('modules.equipment')">
                                    Equipamentos
                                </x-nav-link>
                            @endcan

                            @can('access-care-units')
                                <x-nav-link :href="route('modules.care-units')" :active="request()->routeIs('modules.care-units')">
                                    Unidades Assistenciais
                                </x-nav-link>
                            @endcan
                        @endif

                    @endauth
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                            {{ Auth::user()->name }}
                            @if(Auth::user()->hasRole('admin'))
                                <span class="ml-2 text-xs bg-red-100 text-red-700 px-2 py-0.5 rounded-full">Admin</span>
                            @endif
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault(); this.closest('form').submit();">
                                Sair
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>
        </div>
    </div>
</nav>