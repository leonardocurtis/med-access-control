<header x-data="{ open: false }"
    class="sticky top-0 z-50 flex h-14 items-center justify-between border-zinc-200 border-b bg-white px-4 md:px-8">
    <div class="flex items-center justify-between w-full">

        <div>

            <h1 class="text-2xl font-bold text-zinc-900">

                Painel de Controle

            </h1>

        </div>

    </div>

    <div class="relative">

        <button @click="open=!open" class="flex items-center gap-3 rounded-xl px-2 py-1 transition hover:bg-gray-100">

            <x-avatar :name="Auth::user()->name" size="h-8 w-8 text-sm" />
            <div class="hidden text-left md:block">

                <div class="font-semibold text-sm">

                    {{ Auth::user()->name }}

                </div>

                <div class="text-xs text-gray-500">

                    {{ Auth::user()->email }}

                </div>

            </div>

            <x-phosphor-caret-down class="h-4 w-4 text-gray-500" />

        </button>

        <div x-show="open" @click.outside="open=false" x-transition
            class="absolute right-0 mt-2 w-56 overflow-hidden rounded-xl border bg-white shadow-lg">

            <form method="POST" action="{{ route('logout') }}">

                @csrf

                <button class="flex w-full items-center gap-3 px-4 py-3 text-red-600 hover:bg-red-50">

                    <x-phosphor-sign-out class="h-5 w-5" />

                    Sair

                </button>

            </form>

        </div>

    </div>

</header>
