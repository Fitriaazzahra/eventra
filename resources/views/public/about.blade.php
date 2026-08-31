@extends('layouts.public')

@section('title', app()->getLocale() === 'id' ? 'Tentang' : 'About')

@section('content')
    <main class="eventra-about-page">
        <section class="eventra-page-hero">
            <div class="eventra-page-hero-inner">
                <p class="eventra-kicker">{{ app()->getLocale() === 'id' ? 'Tentang kami' : 'About us' }}</p>
                <h1>{{ app()->getLocale() === 'id' ? ($settings['hero_title']->value_id ?? 'Membangun pengalaman event yang berkesan.') : ($settings['hero_title']->value_en ?? 'Building memorable event experiences.') }}</h1>
                <p>{{ app()->getLocale() === 'id' ? ($settings['hero_description']->value_id ?? 'Eventra membantu komunitas, brand, dan organisasi menyusun event yang terstruktur, relevan, dan berdampak.') : ($settings['hero_description']->value_en ?? 'Eventra helps communities, brands, and organizations host events that are well structured, relevant, and impactful.') }}</p>
            </div>
        </section>

        <section class="eventra-about-showcase">
            <div class="eventra-about-grid">
                <div class="eventra-about-copy">
                    <h2>{{ app()->getLocale() === 'id' ? ($settings['story_title']->value_id ?? 'Eventra untuk momen yang lebih besar') : ($settings['story_title']->value_en ?? 'Eventra for bigger moments') }}</h2>
                    <p>{{ app()->getLocale() === 'id' ? ($settings['story_description']->value_id ?? 'Dari seminar hingga komunitas digital, kami hadir untuk menghubungkan audience, pembicara, dan penyelenggara dalam satu ekosistem event yang rapi dan mudah diakses.') : ($settings['story_description']->value_en ?? 'From seminars to digital communities, we connect audiences, speakers, and organizers in one streamlined event ecosystem that is easy to access and manage.') }}</p>
                </div>

                <div class="eventra-about-visual">
                    <div class="eventra-about-card eventra-about-card-primary">
                        <span>{{ app()->getLocale() === 'id' ? ($settings['vision_title']->value_id ?? 'Visi') : ($settings['vision_title']->value_en ?? 'Vision') }}</span>
                        <strong>{{ app()->getLocale() === 'id' ? ($settings['vision_text']->value_id ?? 'Menjadi platform event paling mudah dijangkau.') : ($settings['vision_text']->value_en ?? 'To become the most accessible event platform.') }}</strong>
                    </div>
                    <div class="eventra-about-card">
                        <span>{{ app()->getLocale() === 'id' ? ($settings['mission_title']->value_id ?? 'Misi') : ($settings['mission_title']->value_en ?? 'Mission') }}</span>
                        <strong>{{ app()->getLocale() === 'id' ? ($settings['mission_text']->value_id ?? 'Menyediakan ruang bertumbuh bagi komunitas dan bisnis.') : ($settings['mission_text']->value_en ?? 'Create spaces for growth across communities and business.') }}</strong>
                    </div>
                </div>
            </div>
        </section>

        <section class="eventra-about-stats">
            <div class="eventra-about-stats-grid">
                @foreach ($stats as $stat)
                    <div class="eventra-about-stat-card">
                        <strong>{{ $stat['value'] }}</strong>
                        <span>{{ $stat['label'] }}</span>
                    </div>
                @endforeach
            </div>
        </section>
    </main>
@endsection
