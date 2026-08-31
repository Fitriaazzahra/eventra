<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login — Eventra Admin</title>
    @vite(['resources/css/app.css'])
</head>
<body class="bg-background min-h-screen flex items-center justify-center">
    <form method="POST" action="{{ route('admin.login.submit') }}" class="bg-surface p-8 rounded shadow w-full max-w-sm">
        @csrf
        <h1 class="text-xl font-semibold mb-4 text-text">Eventra Admin</h1>

        @if ($errors->any())
            <div class="mb-4 text-danger text-sm">
                {{ $errors->first() }}
            </div>
        @endif

        <label class="block mb-2 text-sm text-text-muted">Email</label>
        <input type="email" name="email" value="{{ old('email') }}" class="w-full border border-border rounded px-3 py-2 mb-4" required autofocus>

        <label class="block mb-2 text-sm text-text-muted">Password</label>
        <input type="password" name="password" class="w-full border border-border rounded px-3 py-2 mb-4" required>

        <label class="flex items-center mb-4 text-sm text-text-muted">
            <input type="checkbox" name="remember" class="mr-2"> Ingat saya
        </label>

        <button type="submit" class="w-full bg-primary hover:bg-primary-dark text-white py-2 rounded">
            Login
        </button>
    </form>
</body>
</html>