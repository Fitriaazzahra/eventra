@extends('layouts.public')

@section('title', 'Eventra')

@section('content')
    <main class="eventra-home">
        <section class="eventra-home-hero">
            <div class="eventra-home-hero-row">
                <div class="eventra-home-hero-copy">
                    <div class="eventra-home-badge">
                        EVENTRA
                    </div>
                    <h1>
                        {{ app()->getLocale() === 'id' ? 'Temukan Event Selanjutnya' : 'Discover Your Next Event' }}
                    </h1>
                    <p>
                        {{ app()->getLocale() === 'id' ? 'Temukan event yang bermakna, bertemu orang inspiratif, dan ciptakan pengalaman tak terlupakan.' : 'Find meaningful events, meet inspiring people, and create unforgettable experiences.' }}
                    </p>

                    <div class="eventra-home-hero-actions">
                        <a href="{{ route('public.events.index', ['locale' => app()->getLocale()]) }}" class="primary">
                            {{ app()->getLocale() === 'id' ? 'Jelajahi Acara' : 'Explore Events' }}
                        </a>
                        <a href="#categories" class="secondary">
                            {{ app()->getLocale() === 'id' ? 'Lihat Kategori' : 'Browse Categories' }}
                        </a>
                    </div>

                    <div class="eventra-home-stats">
                        <div class="eventra-home-stat">
                            <strong>1200+</strong>
                            <span>{{ app()->getLocale() === 'id' ? 'Acara' : 'Events' }}</span>
                        </div>
                        <div class="eventra-home-stat">
                            <strong>35k+</strong>
                            <span>{{ app()->getLocale() === 'id' ? 'Peserta' : 'Attendees' }}</span>
                        </div>
                        <div class="eventra-home-stat">
                            <strong>250+</strong>
                            <span>{{ app()->getLocale() === 'id' ? 'Pembicara' : 'Speakers' }}</span>
                        </div>
                    </div>
                </div>

                <div class="eventra-home-visual">
                    <div class="eventra-home-frame">
                        <img src="https://images.unsplash.com/photo-1511578314322-379afb476865?auto=format&fit=crop&w=1200&q=80" alt="Event crowd" />
                    </div>
                    <div class="eventra-home-pill">
                        <div>
                            <small>{{ app()->getLocale() === 'id' ? 'Acara Populer' : 'Featured Event' }}</small>
                            <strong>Tech Summit 2026</strong>
                        </div>
                        <div class="status">{{ app()->getLocale() === 'id' ? 'Tersedia' : 'Open' }}</div>
                    </div>
                </div>
            </div>
        </section>

        <section class="eventra-home-search">
            <div class="eventra-home-search-card">
                <div class="eventra-home-search-inner">
                    <div class="eventra-home-search-field">
                        <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35m1.85-5.15a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                        <input type="text" placeholder="{{ app()->getLocale() === 'id' ? 'Cari acara, topik, atau lokasi' : 'Search events, topics, or locations' }}" />
                    </div>
                    <button type="button">
                        {{ app()->getLocale() === 'id' ? 'Cari' : 'Search' }}
                    </button>
                </div>
            </div>
        </section>

        <section id="categories" class="eventra-home-categories">
            <div class="mb-8 flex items-end justify-between gap-3">
                <div>
                    <p class="text-sm font-semibold uppercase tracking-[0.2em] text-primary-dark">{{ app()->getLocale() === 'id' ? 'Kategori' : 'Categories' }}</p>
                    <h2 class="mt-2 text-3xl font-bold text-text">{{ app()->getLocale() === 'id' ? 'Jelajahi berdasarkan kategori' : 'Explore by Category' }}</h2>
                </div>
            </div>

            <div class="eventra-home-category-list">
                @foreach ($categories as $category)
                    <button type="button" class="eventra-home-category">
                        <span class="eventra-home-category-mark">✦</span>
                        {{ $category->name }}
                    </button>
                @endforeach
            </div>
        </section>

        <section class="eventra-home-section">
            <div class="eventra-home-section-header">
                <div>
                    <p>{{ app()->getLocale() === 'id' ? 'Unggulan' : 'Featured' }}</p>
                    <h2>{{ app()->getLocale() === 'id' ? 'Acara Unggulan' : 'Featured Events' }}</h2>
                </div>
                <a href="{{ route('public.events.index', ['locale' => app()->getLocale()]) }}">
                    {{ app()->getLocale() === 'id' ? 'Lihat semua' : 'View all' }} →
                </a>
            </div>

            <div class="eventra-home-grid eventra-home-grid-featured">
                @foreach ($featuredEvents as $event)
                    <x-public.event-card :event="$event" />
                @endforeach
            </div>
        </section>

        <section class="eventra-home-section eventra-home-section-upcoming">
            <div class="eventra-home-section-header">
                <div>
                    <p>{{ app()->getLocale() === 'id' ? 'Akan Datang' : 'Upcoming' }}</p>
                    <h2>{{ app()->getLocale() === 'id' ? 'Acara Mendatang' : 'Upcoming Events' }}</h2>
                </div>
                <a href="{{ route('public.events.index', ['locale' => app()->getLocale()]) }}">
                    {{ app()->getLocale() === 'id' ? 'Lihat semua' : 'View All Events' }} →
                </a>
            </div>

            <div class="eventra-home-upcoming-list">
                @foreach ($upcomingEvents as $event)
                    <div class="eventra-home-upcoming-item">
                        <div class="eventra-home-upcoming-main">
                            <div class="eventra-home-date-badge">
                                <span>{{ $event->start_date?->translatedFormat('M') ?? 'NOV' }}</span>
                                <strong>{{ $event->start_date?->day ?? '20' }}</strong>
                            </div>
                            <div>
                                <div class="eventra-home-upcoming-tag">{{ $event->category?->name ?? 'Event' }}</div>
                                <h3>{{ $event->name }}</h3>
                                <div class="eventra-home-upcoming-meta">
                                    <span>{{ $event->venue?->city ?? 'Jakarta' }}</span>
                                    <span>•</span>
                                    <span>{{ $event->start_date?->translatedFormat('d M Y') ?? 'TBD' }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="eventra-home-upcoming-side">
                            <div class="eventra-home-price-box">
                                <div>{{ app()->getLocale() === 'id' ? 'Harga' : 'Price' }}</div>
                                <strong>{{ $event->ticket_price > 0 ? 'Rp' . number_format($event->ticket_price, 0, ',', '.') : (app()->getLocale() === 'id' ? 'Gratis' : 'Free') }}</strong>
                            </div>
                            <a href="{{ route('public.events.show', ['locale' => app()->getLocale(), 'slug' => $event->slug]) }}">
                                {{ app()->getLocale() === 'id' ? 'Lihat Detail' : 'View Details' }}
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>

        <section class="eventra-home-section eventra-home-section-speakers">
            <div class="eventra-home-section-header eventra-home-section-header-inline">
                <div>
                    <p>{{ app()->getLocale() === 'id' ? 'Pembicara' : 'Speakers' }}</p>
                    <h2>{{ app()->getLocale() === 'id' ? 'Temui Pembicara' : 'Meet the Speakers' }}</h2>
                </div>
            </div>
            <div class="eventra-home-speaker-grid">
                @foreach ($speakers as $speaker)
                    <div class="eventra-home-speaker-card">
                        <div class="eventra-home-speaker-avatar">
                            <img src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?auto=format&fit=crop&w=400&q=80" alt="{{ $speaker->name }}" />
                        </div>
                        <div class="eventra-home-speaker-body">
                            <h3>{{ $speaker->name }}</h3>
                            <p class="role">{{ $speaker->job_title }}</p>
                            <p>{{ $speaker->company }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>

        <section class="eventra-home-section eventra-home-section-cta">
            <div class="eventra-home-cta-card">
                <p>{{ app()->getLocale() === 'id' ? 'Bersiaplah' : 'Ready to begin' }}</p>
                <h2>{{ app()->getLocale() === 'id' ? 'Ciptakan momen yang patut diingat.' : 'Create a moment worth remembering.' }}</h2>
                <p class="subtitle">
                    {{ app()->getLocale() === 'id' ? 'Temukan event berikutnya dan terhubung dengan orang-orang yang memiliki minat yang sama.' : 'Find your next event and connect with people who share your interests.' }}
                </p>
                <div>
                    <a href="{{ route('public.events.index', ['locale' => app()->getLocale()]) }}">
                        {{ app()->getLocale() === 'id' ? 'Jelajahi Acara' : 'Explore Events' }}
                    </a>
                </div>
            </div>
        </section>
    </main>
@endsection
