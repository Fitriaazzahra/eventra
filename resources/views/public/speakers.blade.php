@extends('layouts.public')

@section('title', app()->getLocale() === 'id' ? 'Pembicara' : 'Speakers')

@section('content')
    <main class="eventra-speakers-page">
        <section class="eventra-page-hero eventra-page-hero-soft">
            <div class="eventra-page-hero-inner">
                <p class="eventra-kicker">{{ app()->getLocale() === 'id' ? 'Komunitas' : 'Community' }}</p>
                <h1>{{ app()->getLocale() === 'id' ? 'Pembicara kami' : 'Meet our speakers' }}</h1>
                <p>{{ app()->getLocale() === 'id' ? 'Para pemimpin, mentor, serta creator yang membawa insight, pengalaman, dan inspirasi nyata ke setiap event kami.' : 'Leaders, mentors, and creators who bring real insight, experience, and inspiration to every event we host.' }}</p>
            </div>
        </section>

        <section class="eventra-speakers-section">
            <div class="eventra-speakers-grid">
                @php
                    $speakers = \App\Models\Speaker::orderBy('name')->get();
                @endphp

                @forelse ($speakers as $speaker)
                    <article class="eventra-speaker-card">
                        <div class="eventra-speaker-avatar">
                            @if ($speaker->photo)
                                <img src="{{ asset('storage/' . $speaker->photo) }}" alt="{{ $speaker->name }}">
                            @else
                                <span>{{ strtoupper(substr($speaker->name, 0, 2)) }}</span>
                            @endif
                        </div>

                        <div class="eventra-speaker-body">
                            <div class="eventra-speaker-role">{{ $speaker->job_title ?? 'Speaker' }}</div>
                            <h3>{{ $speaker->name }}</h3>
                            <p class="eventra-speaker-company">{{ $speaker->company ?? 'Independent' }}</p>
                            <p class="eventra-speaker-bio">{{ \Illuminate\Support\Str::limit($speaker->biography ?? 'Event speaker and community advocate.', 150) }}</p>

                            <div class="eventra-speaker-meta">
                                @if ($speaker->linkedin)
                                    <a href="{{ $speaker->linkedin }}" target="_blank" rel="noopener">LinkedIn</a>
                                @endif
                                @if ($speaker->website)
                                    <a href="{{ $speaker->website }}" target="_blank" rel="noopener">Website</a>
                                @endif
                            </div>
                        </div>
                    </article>
                @empty
                    <div class="eventra-empty-state">
                        <h3>{{ app()->getLocale() === 'id' ? 'Belum ada pembicara' : 'No speakers available yet' }}</h3>
                    </div>
                @endforelse
            </div>
        </section>
    </main>
@endsection
