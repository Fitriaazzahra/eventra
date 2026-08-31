@extends('layouts.public')

@section('title', app()->getLocale() === 'id' ? 'Profil Saya' : 'My Profile')

@section('content')
    <main class="eventra-profile-page">
        <section class="eventra-profile-header">
            <div class="eventra-profile-cover"></div>
            <div class="eventra-profile-card">
                <div class="eventra-profile-avatar">AP</div>
                <div class="eventra-profile-summary">
                    <div>
                        <p class="eventra-profile-label">{{ app()->getLocale() === 'id' ? 'Member' : 'Member' }}</p>
                        <h1>{{ $profile['name'] }}</h1>
                    </div>
                    <a href="#" class="eventra-primary-button eventra-profile-button">{{ app()->getLocale() === 'id' ? 'Edit Profil' : 'Edit Profile' }}</a>
                </div>
            </div>
        </section>

        <section class="eventra-profile-grid">
            <aside class="eventra-profile-sidebar">
                <div class="eventra-profile-panel">
                    <h3>{{ app()->getLocale() === 'id' ? 'Tentang Saya' : 'About Me' }}</h3>
                    <p>{{ $profile['bio'] }}</p>
                </div>

                <div class="eventra-profile-panel">
                    <h3>{{ app()->getLocale() === 'id' ? 'Detail Akun' : 'Account Details' }}</h3>
                    <ul class="eventra-profile-meta">
                        <li><span>✉️</span><p>{{ $profile['email'] }}</p></li>
                        <li><span>📍</span><p>{{ $profile['location'] }}</p></li>
                        <li><span>🗓️</span><p>{{ app()->getLocale() === 'id' ? 'Bergabung' : 'Joined' }} {{ $profile['member_since'] }}</p></li>
                    </ul>
                </div>
            </aside>

            <div class="eventra-profile-main">
                <div class="eventra-profile-panel">
                    <div class="eventra-panel-header">
                        <h3>{{ app()->getLocale() === 'id' ? 'Tiket Saya' : 'My Tickets' }}</h3>
                        <a href="#">{{ app()->getLocale() === 'id' ? 'Lihat semua' : 'View all' }}</a>
                    </div>

                    <div class="eventra-ticket-list">
                        @foreach ($tickets as $ticket)
                            <div class="eventra-ticket-item">
                                <div class="eventra-ticket-badge">{{ $ticket['status'] }}</div>
                                <div>
                                    <h4>{{ $ticket['title'] }}</h4>
                                    <p>{{ $ticket['date'] }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="eventra-profile-panel">
                    <div class="eventra-panel-header">
                        <h3>{{ app()->getLocale() === 'id' ? 'Disimpan' : 'Saved' }}</h3>
                        <a href="#">{{ app()->getLocale() === 'id' ? 'Lihat semua' : 'View all' }}</a>
                    </div>

                    <div class="eventra-saved-grid">
                        @foreach ($savedEvents as $event)
                            <article class="eventra-saved-card">
                                <span class="eventra-saved-tag">{{ $event['tag'] }}</span>
                                <h4>{{ $event['title'] }}</h4>
                                <p>{{ $event['date'] }}</p>
                            </article>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
