@extends('layouts.public')

@section('title', $event->name)

@section('content')
    <main class="eventra-event-detail-page">
        <nav class="eventra-event-breadcrumbs" aria-label="Breadcrumb">
            <a href="{{ route('public.home', ['locale' => app()->getLocale()]) }}">{{ app()->getLocale() === 'id' ? 'Beranda' : 'Home' }}</a>
            <span>/</span>
            <a href="{{ route('public.events.index', ['locale' => app()->getLocale()]) }}">{{ app()->getLocale() === 'id' ? 'Acara' : 'Events' }}</a>
            <span>/</span>
            <span>{{ $event->name }}</span>
        </nav>

        <div class="eventra-event-detail-layout">
            <article class="eventra-event-main">
                <div class="eventra-event-category-badge">
                    {{ $event->category?->name ?? 'Event' }}
                </div>

                <h1>{{ $event->name }}</h1>
                <p class="eventra-event-lead">{{ $event->description ?: 'A unique experience for people who love innovation, community, and meaningful connection.' }}</p>

                <div class="eventra-event-hero-image">
                    <img src="{{ $event->cover_image ?: 'https://images.unsplash.com/photo-1511578314322-379afb476865?auto=format&fit=crop&w=1200&q=80' }}" alt="{{ $event->name }}" />
                </div>

                <div class="eventra-event-content">
                    <section class="eventra-event-section">
                        <h2>{{ app()->getLocale() === 'id' ? 'Tentang Event' : 'About This Event' }}</h2>
                        <p>{{ $event->description ?: 'This event brings together leaders, creators, and curious minds for a high-impact event experience focused on learning, networking, and inspiration.' }}</p>
                    </section>

                    <section class="eventra-event-section">
                        <h2>{{ app()->getLocale() === 'id' ? 'Yang Akan Anda Rasakan' : 'What You’ll Experience' }}</h2>
                        <ul class="eventra-event-feature-list">
                            <li>Insightful sessions from industry leaders and practitioners.</li>
                            <li>Hands-on workshops and practical takeaways.</li>
                            <li>Meaningful networking with like-minded attendees.</li>
                        </ul>
                    </section>

                    <section class="eventra-event-section">
                        <h2>{{ app()->getLocale() === 'id' ? 'Jadwal' : 'Event Schedule' }}</h2>
                        <div class="eventra-event-schedule">
                            <div class="eventra-event-schedule-row">
                                <span>09:00</span>
                                <span>Registration & welcome coffee</span>
                            </div>
                            <div class="eventra-event-schedule-row">
                                <span>10:00</span>
                                <span>Opening remarks</span>
                            </div>
                            <div class="eventra-event-schedule-row">
                                <span>13:00</span>
                                <span>Networking session</span>
                            </div>
                        </div>
                    </section>

                    <section class="eventra-event-section">
                        <h2>{{ app()->getLocale() === 'id' ? 'Pembicara' : 'Speakers' }}</h2>
                        <div class="eventra-event-speakers">
                            @foreach ($event->speakers as $speaker)
                                <div class="eventra-event-speaker-card">
                                    <div class="eventra-event-speaker-photo">
                                        <img src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?auto=format&fit=crop&w=400&q=80" alt="{{ $speaker->name }}" />
                                    </div>
                                    <div>
                                        <strong>{{ $speaker->name }}</strong>
                                        <span>{{ $speaker->job_title }}</span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </section>

                    <section class="eventra-event-section">
                        <h2>{{ app()->getLocale() === 'id' ? 'Lokasi' : 'Venue' }}</h2>
                        <div class="eventra-event-venue-card">
                            <h3>{{ $event->venue?->name ?? 'Event venue' }}</h3>
                            <p>{{ $event->venue?->address ?? 'Main hall' }}, {{ $event->venue?->city ?? 'Jakarta' }}</p>
                            <div class="eventra-event-map-placeholder">
                                Map placeholder
                            </div>
                        </div>
                    </section>
                </div>
            </article>

            <aside class="eventra-event-sidebar">
                <div class="eventra-event-register-card">
                    <div class="eventra-event-price-row">
                        <span>{{ app()->getLocale() === 'id' ? 'Harga' : 'Price' }}</span>
                        <strong>{{ $event->ticket_price > 0 ? 'Rp' . number_format($event->ticket_price, 0, ',', '.') : (app()->getLocale() === 'id' ? 'Gratis' : 'Free') }}</strong>
                    </div>

                    <div class="eventra-event-meta-list">
                        <div><span>📅</span><p>{{ $event->start_date?->translatedFormat('d M Y') ?? 'TBD' }}</p></div>
                        <div><span>🕒</span><p>{{ $event->start_time ?? '09:00' }}</p></div>
                        <div><span>📍</span><p>{{ $event->venue?->name ?? 'Event venue' }}</p></div>
                        <div><span>👥</span><p>{{ $event->capacity ?? '200' }} {{ app()->getLocale() === 'id' ? 'kursi' : 'seats' }}</p></div>
                    </div>

                    <button type="button" class="eventra-primary-button" onclick="eventraOpenRegisterModal()">
                        {{ app()->getLocale() === 'id' ? 'Daftar Sekarang' : 'Register Now' }}
                    </button>
                </div>
            </aside>
        </div>

        @if ($relatedEvents->isNotEmpty())
            <section class="eventra-event-related">
                <div class="eventra-event-related-header">
                    <h2>{{ app()->getLocale() === 'id' ? 'Acara Lainnya' : 'More Events' }}</h2>
                </div>
                <div class="eventra-events-grid">
                    @foreach ($relatedEvents as $relatedEvent)
                        <x-public.event-card :event="$relatedEvent" />
                    @endforeach
                </div>
            </section>
        @endif

        {{-- ===================== MODAL PENDAFTARAN ===================== --}}
        <div
            id="eventra-register-modal"
            class="eventra-modal-overlay {{ $errors->any() ? 'is-open' : '' }}"
            onclick="if (event.target === this) eventraCloseRegisterModal()"
        >
            <div class="eventra-modal-box">
                <button
                    type="button"
                    class="eventra-modal-close"
                    onclick="eventraCloseRegisterModal()"
                    aria-label="{{ app()->getLocale() === 'id' ? 'Tutup' : 'Close' }}"
                >&times;</button>

                <h3 class="eventra-modal-title">
                    {{ app()->getLocale() === 'id' ? 'Daftar ke ' . $event->name : 'Register for ' . $event->name }}
                </h3>

                @if (session('success'))
                    <div class="eventra-modal-success">{{ session('success') }}</div>
                @endif

                <form
                    method="POST"
                    action="{{ route('public.events.register', ['locale' => app()->getLocale(), 'slug' => $event->slug]) }}"
                >
                    @csrf

                    <label for="eventra-register-name">
                        {{ app()->getLocale() === 'id' ? 'Nama Lengkap' : 'Full Name' }}
                    </label>
                    <input
                        type="text"
                        id="eventra-register-name"
                        name="name"
                        required
                        value="{{ old('name') }}"
                    >
                    @error('name')
                        <span class="eventra-modal-error">{{ $message }}</span>
                    @enderror

                    <label for="eventra-register-email">Email</label>
                    <input
                        type="email"
                        id="eventra-register-email"
                        name="email"
                        required
                        value="{{ old('email') }}"
                    >
                    @error('email')
                        <span class="eventra-modal-error">{{ $message }}</span>
                    @enderror

                    <label for="eventra-register-phone">
                        {{ app()->getLocale() === 'id' ? 'No. Telepon' : 'Phone' }}
                    </label>
                    <input
                        type="text"
                        id="eventra-register-phone"
                        name="phone"
                        required
                        value="{{ old('phone') }}"
                    >
                    @error('phone')
                        <span class="eventra-modal-error">{{ $message }}</span>
                    @enderror

                    <button type="submit" class="eventra-primary-button eventra-modal-submit">
                        {{ app()->getLocale() === 'id' ? 'Kirim Pendaftaran' : 'Submit Registration' }}
                    </button>
                </form>
            </div>
        </div>
        {{-- =================== /MODAL PENDAFTARAN ===================== --}}
    </main>

    <script>
        function eventraOpenRegisterModal() {
            document.getElementById('eventra-register-modal').classList.add('is-open');
            document.body.style.overflow = 'hidden';
        }

        function eventraCloseRegisterModal() {
            document.getElementById('eventra-register-modal').classList.remove('is-open');
            document.body.style.overflow = '';
        }

        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape') {
                eventraCloseRegisterModal();
            }
        });

        @if (session('success'))
            document.body.style.overflow = 'hidden';
        @endif
    </script>
@endsection