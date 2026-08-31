<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Eventra - Discover. Connect. Experience.">
    <title>@yield('title', 'Eventra') | Eventra</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
@php
    $switchLocaleUrl = function (string $locale) {
        $currentUrl = url()->current();
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

<body class="bg-background text-text antialiased">
    <x-public.navbar />
    @yield('content')

    <footer class="public-footer">
        <div class="public-footer-inner">
            <div class="public-footer-brand">
                <div class="public-footer-logo">EVENTRA</div>
                <p>{{ app()->getLocale() === 'id' ? 'Discover. Connect. Experience.' : 'Discover. Connect. Experience.' }}</p>
            </div>

            <div class="public-footer-column">
                <div class="public-footer-title">{{ app()->getLocale() === 'id' ? 'Navigasi' : 'Explore' }}</div>
                @php
                    $menuItems = \App\Models\SiteMenu::where('is_active', true)->orderBy('sort_order')->get();
                @endphp
                <ul>
                    @foreach ($menuItems as $menu)
                        @php
                            $menuUrl = trim($menu->target_url, '/');
                            $menuLink = '/' . app()->getLocale() . '/' . ltrim($menuUrl, '/');
                            if (str_contains($menu->target_url, 'http')) {
                                $menuLink = $menu->target_url;
                            }
                        @endphp
                        <li><a href="{{ $menuLink }}">{{ app()->getLocale() === 'id' ? $menu->label_id : $menu->label_en }}</a></li>
                    @endforeach
                </ul>
            </div>

            <div class="public-footer-column">
                <div class="public-footer-title">{{ app()->getLocale() === 'id' ? 'Komunitas' : 'Community' }}</div>
                <ul>
                    <li><a href="#">Instagram</a></li>
                    <li><a href="#">LinkedIn</a></li>
                    <li><a href="#">X</a></li>
                </ul>
            </div>

            <div class="public-footer-column">
                <div class="public-footer-title">{{ app()->getLocale() === 'id' ? 'Bahasa' : 'Language' }}</div>
                <ul>
                    <li><a href="{{ $switchLocaleUrl('id') }}">🇮🇩 Indonesia</a></li>
                    <li><a href="{{ $switchLocaleUrl('en') }}">🇬🇧 English</a></li>
                </ul>
            </div>
        </div>

        <div class="public-footer-bottom">
            <p>© 2026 Eventra. {{ app()->getLocale() === 'id' ? 'Semua hak dilindungi.' : 'All rights reserved.' }}</p>
            <div class="public-footer-links">
                <a href="#">{{ app()->getLocale() === 'id' ? 'Kebijakan Privasi' : 'Privacy Policy' }}</a>
                <a href="#">{{ app()->getLocale() === 'id' ? 'Syarat' : 'Terms' }}</a>
            </div>
        </div>
    </footer>
</body>
</html>
