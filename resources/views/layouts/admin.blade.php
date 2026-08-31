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

                    <!-- User Link ke Halaman Profil Khusus -->
                    <a href="{{ route('admin.profile.index', ['locale' => app()->getLocale()]) }}" class="eventra-user" style="text-decoration: none; color: inherit; display: flex; align-items: center; gap: 10px;">
                        @if (auth()->user()->avatar && \Illuminate\Support\Facades\Storage::disk('nas')->exists(auth()->user()->avatar))
                            <img src="{{ route('admin.profile.avatar.show', ['locale' => app()->getLocale()]) }}" 
                                 alt="{{ auth()->user()->name }}" 
                                 class="eventra-user-avatar" 
                                 style="object-fit: cover; border-radius: 50%; width: 36px; height: 36px;">
                        @else
                            <div class="eventra-user-avatar" style="width: 36px; height: 36px; border-radius: 50%; background: #6366f1; color: white; display: flex; align-items: center; justify-content: center; font-weight: 700;">
                                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                            </div>
                        @endif

                        <div class="eventra-user-meta">
                            <span class="eventra-user-name">{{ auth()->user()->name }}</span>
                            <span class="eventra-user-role">Admin</span>
                        </div>
                    </a>

                    <form method="POST" action="{{ route('admin.logout', ['locale' => app()->getLocale()]) }}">
                        @csrf
                        <button type="submit" class="eventra-logout">{{ __('messages.logout') }}</button>
                    </form>
                </div>
            </header>

            <main class="eventra-page">
                @if (session('success'))
                    <div class="eventra-alert" id="eventra-flash-alert" role="alert" style="margin-bottom: 20px; padding: 12px 16px; background: #dcfce7; color: #15803d; border-radius: 8px;">
                        {{ session('success') }}
                    </div>
                @endif
                @yield('content')
            </main>
        </div>
    </div>

    <!-- SweetAlert2 CDN & Handler Hapus Modern -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Intersept penekanan submit pada form hapus
            document.addEventListener('submit', function (e) {
                const form = e.target;
                
                // Periksa apakah form merupakan form DELETE (punya _method DELETE atau class delete-form)
                const isDeleteForm = form.classList.contains('delete-form') || 
                                     form.querySelector('input[name="_method"][value="DELETE"]');

                if (isDeleteForm && !form.dataset.confirmed) {
                    e.preventDefault();
                    
                    const itemName = form.dataset.name || 'data ini';

                    Swal.fire({
                        title: 'Konfirmasi Hapus',
                        html: `Apakah Anda yakin ingin menghapus <b>"${itemName}"</b>?<br><span style="font-size: 0.85em; color: #6b7280; margin-top: 4px; display: inline-block;">Data yang dihapus tidak dapat dikembalikan.</span>`,
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#ef4444',
                        cancelButtonColor: '#9ca3af',
                        confirmButtonText: 'Ya, Hapus Data',
                        cancelButtonText: 'Batal',
                        reverseButtons: true,
                        customClass: {
                            popup: 'eventra-sweet-popup',
                            confirmButton: 'eventra-sweet-confirm',
                            cancelButton: 'eventra-sweet-cancel'
                        }
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.dataset.confirmed = "true";
                            form.submit();
                        }
                    });
                }
            });
        });
    </script>

    <!-- Custom Styling untuk Popup SweetAlert2 agar Serasi dengan Theme Eventra -->
    <style>
        .eventra-sweet-popup {
            border-radius: 20px !important;
            padding: 24px !important;
            font-family: 'Inter', sans-serif !important;
        }
        .eventra-sweet-confirm {
            border-radius: 10px !important;
            padding: 10px 20px !important;
            font-weight: 600 !important;
            box-shadow: 0 4px 12px rgba(239, 68, 68, 0.25) !important;
        }
        .eventra-sweet-cancel {
            border-radius: 10px !important;
            padding: 10px 20px !important;
            font-weight: 600 !important;
        }
    </style>
</body>
</html>