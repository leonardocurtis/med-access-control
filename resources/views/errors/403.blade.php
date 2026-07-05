<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Acesso Negado</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex items-center justify-center min-h-screen bg-gray-50">
    <div class="text-center">
        <h1 class="text-6xl font-bold text-red-600">403</h1>
        <p class="text-xl text-gray-700 mt-4">Acesso Negado</p>
        <p class="text-gray-500 mt-2">Você não tem permissão para acessar este recurso.</p>
        <a href="{{ url()->previous() }}" class="mt-6 inline-block bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">
            Voltar
        </a>
    </div>
</body>
</html>