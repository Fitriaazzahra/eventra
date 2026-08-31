@extends('layouts.public')

@section('title', app()->getLocale() === 'id' ? 'Jelajahi Acara' : 'Explore Events')

@section('content')
    <main class="eventra-events-page">
        <div class="eventra-events-header">
            <p>{{ app()->getLocale() === 'id' ? 'Acara' : 'Events' }}</p>
            <h1>{{ app()->getLocale() === 'id' ? 'Jelajahi Acara' : 'Explore Events' }}</h1>
            <p class="eventra-events-subtitle">{{ app()->getLocale() === 'id' ? 'Temukan event yang paling cocok dengan minat, kebutuhan, dan pengalaman yang Anda cari.' : 'Find the events that best match your interests, needs, and the experience you want.' }}</p>
        </div>

        <div class="eventra-events-search">
            <div class="eventra-events-search-field">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35m1.85-5.15a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                <input type="text" placeholder="{{ app()->getLocale() === 'id' ? 'Cari acara atau topik' : 'Search events or topics' }}" />
            </div>
            <button type="button">
                {{ app()->getLocale() === 'id' ? 'Cari' : 'Search' }}
            </button>
        </div>

        <div class="eventra-events-results">
            <div class="eventra-events-results-head">
                <p>{{ app()->getLocale() === 'id' ? 'Menampilkan ' . $events->count() . ' acara' : 'Showing ' . $events->count() . ' events' }}</p>
            </div>

            <div class="eventra-events-grid">
                @foreach ($events as $event)
                    <x-public.event-card :event="$event" />
                @endforeach
            </div>

            @if ($events->hasPages())
                <div class="eventra-events-pagination">
                    {{ $events->links() }}
                </div>
            @endif
        </div>
    </main>
@endsection