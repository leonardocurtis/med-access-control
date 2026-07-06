<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>403: Acesso Negado</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body
    class="min-h-screen bg-gradient-to-br from-slate-100 via-zinc-100 to-slate-200 flex items-center justify-center px-6">

    <div class="w-full max-w-lg">

        <div class="rounded-3xl bg-white shadow-2xl border border-zinc-200 p-10 text-center">
            <div class="mx-auto flex h-24 w-24 items-center justify-center rounded-full bg-red-100 shadow-xl">
                <x-phosphor-warning-octagon class="h-12 w-12 text-red-600" />
            </div>

            <h1 class="mt-4 text-6xl font-extrabold tracking-tight text-red-600">
                403
            </h1>

            <h2 class="mt-4 text-2xl font-bold text-zinc-800">
                Acesso Negado
            </h2>

            <p class="mt-4 text-zinc-600 leading-relaxed">
                Você não possui permissão para acessar esta página.
                Caso acredite que isso seja um erro, entre em contato com o administrador do sistema.
            </p>

            <div class="mt-6 flex flex-col sm:flex-row justify-center gap-4">

                <a href="{{ route('dashboard') }}"
                    class="rounded-xl bg-zinc-900 px-6 py-3 font-medium text-white transition hover:bg-zinc-800">
                    Voltar
                </a>

            </div>

        </div>
    </div>

</body>

</html>
