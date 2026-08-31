<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ __('messages.login') }} — Eventra Admin</title>
    @vite(['resources/css/app.css'])
</head>
<body>
    <div class="eventra-login-page">
        <div class="eventra-login-card">
            <div class="eventra-login-brand">
                <div class="eventra-login-brand-mark">
                    <svg viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 2v4M18 2v4M3 9h18M4 6h16a1 1 0 011 1v13a1 1 0 01-1 1H4a1 1 0 01-1-1V7a1 1 0 011-1z"/></svg>
                </div>
                <div>
                    <p class="eventra-login-headline">
                        {{ app()->getLocale() === 'id' ? 'Kelola setiap acara' : 'Manage every event' }}<br>
                        {{ app()->getLocale() === 'id' ? 'dari satu tempat.' : 'from one place.' }}
                    </p>
                    <p class="eventra-login-subtext">
                        {{ app()->getLocale() === 'id' ? 'Jadwal, venue, kategori, dan peserta — semuanya rapi dalam satu panel admin.' : 'Schedules, venues, categories, and participants — all organized in one admin panel.' }}
                    </p>
                </div>
                <p class="eventra-login-footer-label">EVENTRA ADMIN PANEL</p>
            </div>

            <div class="eventra-login-form-side">
                <p class="eventra-login-kicker">{{ app()->getLocale() === 'id' ? 'SELAMAT DATANG KEMBALI' : 'WELCOME BACK' }}</p>
                <h1 class="eventra-login-title">{{ app()->getLocale() === 'id' ? 'Masuk ke Eventra' : 'Sign in to Eventra' }}</h1>

                @if ($errors->any())
                    <div class="eventra-login-alert">
                        {{ $errors->first() }}
                    </div>
                @endif

                <form method="POST" action="{{ route('admin.login.submit', ['locale' => app()->getLocale()]) }}">
                    @csrf

                    <div class="eventra-form-group">
                        <label for="email" class="eventra-label">Email</label>
                        <input
                            type="email"
                            id="email"
                            name="email"
                            value="{{ old('email') }}"
                            class="eventra-input @error('email') has-error @enderror"
                            required
                            autofocus
                        >
                        @error('email')
                            <p class="eventra-error-text">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="eventra-form-group">
                        <label for="password" class="eventra-label">{{ app()->getLocale() === 'id' ? 'Kata Sandi' : 'Password' }}</label>
                        <input
                            type="password"
                            id="password"
                            name="password"
                            class="eventra-input @error('password') has-error @enderror"
                            required
                        >
                        @error('password')
                            <p class="eventra-error-text">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="eventra-login-remember">
                        <label>
                            <input type="checkbox" name="remember">
                            {{ app()->getLocale() === 'id' ? 'Ingat saya' : 'Remember me' }}
                        </label>
                    </div>

                    <button type="submit" class="eventra-login-submit">
                        {{ __('messages.login') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>