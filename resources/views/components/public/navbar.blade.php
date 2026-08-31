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

<header class="public-navbar">
    <nav class="public-nav">
        <div class="public-nav-brand">
            <div class="public-brand-mark">E</div>
            <div class="public-brand-name">EVENTRA</div>
        </div>

        <div class="public-nav-menu">
            @php
                $menuItems = \App\Models\SiteMenu::where('is_active', true)->orderBy('sort_order')->get();
            @endphp

            @foreach ($menuItems as $menu)
                @php
                    $target = $menu->target_url ?? '';

                    if (str_contains($target, 'http')) {
                        $menuLink = $target;
                    } else {
                        $cleanTarget = trim($target, '/');
                        $cleanTarget = preg_replace('#^(id|en)(/|$)#', '', $cleanTarget);
                        $cleanTarget = trim($cleanTarget, '/');

                        $menuLink = '/' . app()->getLocale() . ($cleanTarget !== '' ? '/' . $cleanTarget : '');
                    }
                @endphp

                <a href="{{ $menuLink }}" class="public-nav-link {{ request()->fullUrlIs($menuLink) || request()->path() === trim($menuLink, '/') ? 'active' : '' }}">{{ app()->getLocale() === 'id' ? $menu->label_id : $menu->label_en }}</a>
            @endforeach
        </div>

        <div class="public-nav-actions">
            <div class="public-locale-switch">
                <a href="{{ $switchLocaleUrl('id') }}" class="public-locale-btn {{ app()->getLocale() === 'id' ? 'is-active' : '' }}">ID</a>
                <a href="{{ $switchLocaleUrl('en') }}" class="public-locale-btn {{ app()->getLocale() === 'en' ? 'is-active' : '' }}">EN</a>
            </div>
            <a href="{{ route('public.events.index', ['locale' => app()->getLocale()]) }}" class="public-cta-btn">{{ app()->getLocale() === 'id' ? 'Jelajahi Acara' : 'Explore Events' }}</a>
        </div>

        <button type="button" class="public-menu-toggle" aria-label="Open menu">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M4 7h16M4 12h16M4 17h16" /></svg>
        </button>
    </nav>
</header>
