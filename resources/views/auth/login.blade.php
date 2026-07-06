<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }} | Sign In</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-slate-950 flex items-center justify-center p-4 antialiased">

    {{-- Background --}}
    <div class="fixed inset-0 overflow-hidden pointer-events-none" aria-hidden="true">
        <div class="absolute inset-0"
            style="background-image: radial-gradient(circle at 1px 1px, rgb(148 163 184 / 0.12) 1px, transparent 0); background-size: 28px 28px;">
        </div>
        <div class="absolute -top-24 left-1/3 w-80 h-80 bg-cyan-500/5 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 right-1/4 w-80 h-80 bg-blue-600/5 rounded-full blur-3xl"></div>
    </div>

    <div class="relative w-full max-w-sm">

        {{-- Card --}}
        <div class="bg-white rounded-2xl shadow-2xl overflow-hidden">

            {{-- Top accent stripe --}}
            <div class="h-1 bg-gradient-to-r from-cyan-500 to-blue-600"></div>

            <div class="px-8 pt-8 pb-9">

                {{-- Header --}}
                <div class="text-center mb-8">
                    <div class="inline-flex items-center justify-center w-14 h-14 bg-cyan-50 rounded-2xl mb-3.5">
                        <x-phosphor-shield-check-duotone class="w-7 h-7 text-cyan-600" />
                    </div>
                    <h1 class="text-lg font-semibold text-slate-900 tracking-tight">
                        Med Access System

                    </h1>
                    <p class="text-xs text-slate-400 mt-0.5 tracking-wide uppercase">
                        Sistema de Controle de Acesso
                    </p>
                </div>

                {{-- Session Status --}}
                <x-auth-session-status class="mb-5" :status="session('status')" />

                <form method="POST" action="{{ route('login') }}" class="space-y-5" novalidate>
                    @csrf

                    {{-- Email --}}
                    <div class="space-y-1.5">
                        <label for="email" class="block text-sm font-medium text-slate-700">
                            Email
                        </label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <x-phosphor-envelope class="w-4 h-4 text-slate-400" />
                            </span>
                            <input id="email" type="email" name="email" value="{{ old('email') }}" required
                                autofocus autocomplete="username" placeholder="email@hospital.com"
                                class="w-full pl-10 pr-4 py-2.5 text-sm bg-slate-50 border rounded-lg text-slate-900 placeholder-slate-400
                                       transition-colors duration-150
                                       @error('email') border-red-400 focus:ring-red-500/20 focus:border-red-400
                                       @else border-slate-200 focus:ring-cyan-500/20 focus:border-cyan-500 @enderror
                                       focus:outline-none focus:ring-2 focus:bg-white" />
                        </div>
                        <x-input-error :messages="$errors->get('email')" class="text-xs text-red-500 flex items-center gap-1 mt-1" />
                    </div>

                    {{-- Password --}}
                    <div class="space-y-1.5">
                        <div class="flex items-center justify-between">
                            <label for="password" class="block text-sm font-medium text-slate-700">
                                Senha
                            </label>
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}"
                                    class="text-xs font-medium text-cyan-600 hover:text-cyan-700 transition-colors duration-150">
                                    Esqueceu a senha?
                                </a>
                            @endif
                        </div>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <x-phosphor-lock-simple class="w-4 h-4 text-slate-400" />
                            </span>
                            <input id="password" type="password" name="password" required
                                autocomplete="current-password" placeholder="••••••••"
                                class="w-full pl-10 pr-11 py-2.5 text-sm bg-slate-50 border rounded-lg text-slate-900 placeholder-slate-400
                                       transition-colors duration-150
                                       @error('password') border-red-400 focus:ring-red-500/20 focus:border-red-400
                                       @else border-slate-200 focus:ring-cyan-500/20 focus:border-cyan-500 @enderror
                                       focus:outline-none focus:ring-2 focus:bg-white" />
                            <button type="button" id="toggle-password"
                                class="absolute inset-y-0 right-0 pr-3 flex items-center text-slate-400 hover:text-slate-600 transition-colors duration-150"
                                aria-label="Show password">
                                <x-phosphor-eye id="icon-show" class="w-4 h-4" />
                                <x-phosphor-eye-slash id="icon-hide" class="w-4 h-4 hidden" />
                            </button>
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="text-xs text-red-500 flex items-center gap-1 mt-1" />
                    </div>

                    {{-- Remember Me --}}
                    <label for="remember_me" class="flex items-center gap-2.5 cursor-pointer select-none">
                        <input id="remember_me" type="checkbox" name="remember"
                            class="w-4 h-4 rounded border-slate-300 text-cyan-600 focus:ring-cyan-500 focus:ring-offset-0 transition-colors" />
                        <span class="text-sm text-slate-600">Lembrar de mim</span>
                    </label>

                    {{-- Submit --}}
                    <button type="submit"
                        class="w-full flex items-center justify-center gap-2 py-2.5 px-4
                               bg-cyan-600 hover:bg-cyan-700 active:bg-cyan-800
                               text-white text-sm font-semibold rounded-lg
                               focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:ring-offset-2
                               transition-colors duration-150">
                        <x-phosphor-sign-in class="w-4 h-4" />
                        Sign in
                    </button>
                </form>
            </div>
        </div>

        {{-- Footer note --}}
        <p class="text-center text-xs text-white mt-5">
            Med Access System &mdash; Sistema restrito. Apenas usuários autorizados.
        </p>
    </div>

    <script>
        (() => {
            const toggle = document.getElementById('toggle-password');
            const field = document.getElementById('password');
            const iconShow = document.getElementById('icon-show');
            const iconHide = document.getElementById('icon-hide');

            if (!toggle || !field) return;

            toggle.addEventListener('click', () => {
                const isHidden = field.type === 'password';
                field.type = isHidden ? 'text' : 'password';
                toggle.setAttribute('aria-label', isHidden ? 'Hide password' : 'Show password');
                iconShow.classList.toggle('hidden', isHidden);
                iconHide.classList.toggle('hidden', !isHidden);
            });
        })();
    </script>

</body>

</html>
