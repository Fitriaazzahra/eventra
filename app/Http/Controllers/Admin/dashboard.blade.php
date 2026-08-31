<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard — Eventra Admin</title>
    @vite(['resources/css/app.css'])
</head>
<body class="bg-background min-h-screen p-8">
    <h1 class="text-2xl font-semibold text-text">Selamat datang, {{ auth()->user()->name }}</h1>
    <form method="POST" action="{{ route('admin.logout') }}" class="mt-4">
        @csrf
        <button type="submit" class="text-danger underline">Logout</button>
    </form>
</body>
</html>