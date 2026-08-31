<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', __('messages.dashboard')) — Eventra Admin</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body x-data="{ sidebarOpen: false }">
    <div class="eventra-app">
        <aside class="eventra-sidebar">
            @include('layouts.partials.sidebar')
        </aside>

        <div x-show="sidebarOpen" x-cloak class="eventra-dialog-backdrop" style="display:none;">
            <div class="eventra-dialog-backdrop" @click="sidebarOpen = false" style="background: rgba(15,23,42,0.35);"></div>
            <aside class="eventra-sidebar" style="position: fixed; left: 0; top: 0; bottom: 0; z-index: 60; width: 256px;">
                @include('layouts.partials.sidebar')
            </aside>
        </div>

        <div class="eventra-main">
            @php
                $switchAdminLocaleUrl = function (string $locale) {
                    $currentUrl = url()->full();
                    $path = parse_url($currentUrl, PHP_URL_PATH) ?? '/';
                    $query = parse_url($currentUrl, PHP_URL_QUERY);
                    $fragment = parse_url($currentUrl, PHP_URL_FRAGMENT);

                    $segments = array_values(array_filter(explode('/', trim($path, '/')), fn ($segment) => $segment !== ''));

                    if (! empty($segments) && in_array($segments[0], ['id', 'en'], true)) {
                        $segments[0] = $locale;
                    } else {
                        array_unshift($segments, $locale);
                    }

                    $newPath = '/' . implode('/', $segments);

                    return $newPath . ($query ? '?' . $query : '') . ($fragment ? '#' . $fragment : '');
                };
            @endphp

            <header class="eventra-header">
                <div class="eventra-header-title-wrap">
                    <p class="eventra-kicker">EVENTRA</p>
                    <h1 class="eventra-header-title">@yield('breadcrumb', __('messages.dashboard'))</h1>
                </div>

                <div class="eventra-header-actions">
                    <div class="eventra-locale-switcher">
                        <a href="{{ $switchAdminLocaleUrl('id') }}" class="{{ app()->getLocale() === 'id' ? 'is-active' : '' }}">ID</a>
                        <a href="{{ $switchAdminLocaleUrl('en') }}" class="{{ app()->getLocale() === 'en' ? 'is-active' : '' }}">EN</a>
                    </div>

                    <button type="button" class="eventra-icon-btn" aria-label="Notifications">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0a3 3 0 11-6 0m6 0H9" /></svg>
                        <span class="dot"></span>
                    </button>

                    <div class="eventra-user">
                        <div class="eventra-user-avatar">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</div>
                        <div class="eventra-user-meta">
                            <span class="eventra-user-name">{{ auth()->user()->name }}</span>
                            <span class="eventra-user-role">Admin</span>
                        </div>
                    </div>

                    <form method="POST" action="{{ route('admin.logout', ['locale' => app()->getLocale()]) }}">
                        @csrf
                        <button type="submit" class="eventra-logout">{{ __('messages.logout') }}</button>
                    </form>
                </div>
            </header>

            <main class="eventra-page">
                @if (session('success'))
                    <div class="eventra-alert" id="eventra-flash-alert" role="alert">
                        {{ session('success') }}
                    </div>
                @endif
                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>