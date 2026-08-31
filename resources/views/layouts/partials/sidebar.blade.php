<div class="eventra-sidebar-header">
    <div class="eventra-brand-mark">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 9.5V5.7A1.7 1.7 0 014.7 4h14.6A1.7 1.7 0 0121 5.7v3.8m-18 0V18.3A1.7 1.7 0 004.7 20h14.6a1.7 1.7 0 001.7-1.7V9.5m-18 0h18" /></svg>
    </div>
    <div>
        <p class="eventra-brand-title">EVENTRA</p>
        <p class="eventra-brand-subtitle">admin panel</p>
    </div>
</div>

@php
    $menuItemClass = fn (bool $active) =>
        'eventra-sidebar-link ' . ($active ? 'is-active' : '');
@endphp

<nav class="eventra-sidebar-nav">
    <div class="eventra-sidebar-group">
        <div class="eventra-sidebar-label">{{ app()->getLocale() === 'id' ? 'Manajemen Acara' : 'Event Management' }}</div>
        <a href="{{ route('admin.dashboard', ['locale' => app()->getLocale()]) }}" class="{{ $menuItemClass(request()->routeIs('admin.dashboard')) }}">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" /></svg>
            {{ __('messages.dashboard') }}
        </a>
        <a href="{{ route('admin.events.index', ['locale' => app()->getLocale()]) }}" class="{{ $menuItemClass(request()->routeIs('admin.events.*')) }}">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
            {{ __('messages.events') }}
        </a>
        <a href="{{ route('admin.categories.index', ['locale' => app()->getLocale()]) }}" class="{{ $menuItemClass(request()->routeIs('admin.categories.*')) }}">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" /></svg>
            {{ app()->getLocale() === 'id' ? 'Kategori' : 'Categories' }}
        </a>
        <a href="{{ route('admin.speakers.index', ['locale' => app()->getLocale()]) }}" class="{{ $menuItemClass(request()->routeIs('admin.speakers.*')) }}">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
            {{ __('messages.speakers') }}
        </a>
        <a href="{{ route('admin.venues.index', ['locale' => app()->getLocale()]) }}" class="{{ $menuItemClass(request()->routeIs('admin.venues.*')) }}">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a2 2 0 01-2.828 0l-4.243-4.243a8 8 0 1111.314 0z" /><path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
            {{ __('messages.venues') }}
        </a>
        <a href="{{ route('admin.participants.index', ['locale' => app()->getLocale()]) }}" class="{{ $menuItemClass(request()->routeIs('admin.participants.*')) }}">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a4 4 0 00-3-3.87M9 20H4v-2a4 4 0 013-3.87m6-1.13a4 4 0 10-4-4 4 4 0 004 4zm6 0a4 4 0 10-4-4" /></svg>
            {{ __('messages.participants') }}
        </a>
    </div>

    <div class="eventra-sidebar-group">
        <div class="eventra-sidebar-label">{{ __('messages.documents') }}</div>
        <a href="{{ route('admin.documents.index', ['locale' => app()->getLocale()]) }}" class="{{ $menuItemClass(request()->routeIs('admin.documents.*')) }}">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
            {{ __('messages.documents') }}
        </a>
    </div>

    <div class="eventra-sidebar-group">
        <div class="eventra-sidebar-label">{{ app()->getLocale() === 'id' ? 'Manajemen Data' : 'Data Management' }}</div>
        <a href="{{ route('admin.import.index', ['locale' => app()->getLocale()]) }}" class="{{ $menuItemClass(request()->routeIs('admin.import.*')) }}">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v12m0 0l-4-4m4 4l4-4M4 20h16" /></svg>
            {{ __('messages.import') }}
        </a>
        <a href="{{ route('admin.export.index', ['locale' => app()->getLocale()]) }}" class="{{ $menuItemClass(request()->routeIs('admin.export.*')) }}">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 16V4m0 0L8 8m4-4l4 4M4 20h16" /></svg>
            {{ __('messages.export') }}
        </a>
    </div>

    <div class="eventra-sidebar-group">
        <div class="eventra-sidebar-label">{{ app()->getLocale() === 'id' ? 'Akses & Pengguna' : 'Access & Users' }}</div>
        <a href="{{ route('admin.users.index', ['locale' => app()->getLocale()]) }}" class="{{ $menuItemClass(request()->routeIs('admin.users.*')) }}">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M16 21v-2a4 4 0 00-4-4H7a4 4 0 00-4 4v2M9.5 11a4 4 0 100-8 4 4 0 000 8zm8.5 10v-2a4 4 0 00-3-3.87M15 3.13a4 4 0 010 7.75" /></svg>
            {{ app()->getLocale() === 'id' ? 'Pengguna' : 'Users' }}
        </a>
    </div>

</nav>

<div class="eventra-sidebar-cta">
    <div class="eventra-sidebar-card">
        <p>Need a hand organizing next month's schedule?</p>
        <a href="#">Ask the assistant →</a>
    </div>
</div>