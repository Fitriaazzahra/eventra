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
                <input type="text" placeholder="{{ app()->getLocale() === 'id' ? 'Cari acara, topik, atau lokasi' : 'Search events, topics, or locations' }}" />
            </div>
            <button type="button">
                {{ app()->getLocale() === 'id' ? 'Cari' : 'Search' }}
            </button>
        </div>

        <div class="eventra-events-layout">
            <aside class="eventra-events-sidebar">
                <div class="eventra-events-sidebar-head">
                    <h2>{{ app()->getLocale() === 'id' ? 'Filter' : 'Filters' }}</h2>
                    <button type="button">{{ app()->getLocale() === 'id' ? 'Reset' : 'Reset' }}</button>
                </div>

                <div class="eventra-events-filter-group">
                    <label>{{ app()->getLocale() === 'id' ? 'Kategori' : 'Category' }}</label>
                    <div class="eventra-events-radio-list">
                        @foreach ($categories as $category)
                            <label class="eventra-events-radio-item">
                                <input type="radio" name="category" />
                                <span>{{ $category->name }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>

                <div class="eventra-events-filter-group">
                    <label>{{ app()->getLocale() === 'id' ? 'Lokasi' : 'Location' }}</label>
                    <select>
                        <option>{{ app()->getLocale() === 'id' ? 'Pilih lokasi' : 'Select location' }}</option>
                    </select>
                </div>

                <div class="eventra-events-filter-group">
                    <label>{{ app()->getLocale() === 'id' ? 'Tanggal' : 'Date' }}</label>
                    <select>
                        <option>{{ app()->getLocale() === 'id' ? 'Semua tanggal' : 'Any date' }}</option>
                    </select>
                </div>
            </aside>

            <div class="eventra-events-results">
                <div class="eventra-events-results-head">
                    <p>{{ app()->getLocale() === 'id' ? 'Menampilkan 9 acara' : 'Showing 9 events' }}</p>
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
        </div>
    </main>
@endsection
