@extends('layouts.admin')

@section('title', __('messages.dashboard'))
@section('breadcrumb', __('messages.dashboard'))

@section('content')
    @php
        $cards = [
            ['label' => app()->getLocale() === 'id' ? 'Total Event' : 'Total Events', 'value' => $stats['total_events'], 'tone' => 'violet', 'icon' => 'calendar'],
            ['label' => app()->getLocale() === 'id' ? 'Upcoming Events' : 'Upcoming Events', 'value' => $stats['upcoming_events'], 'tone' => 'green', 'icon' => 'clock'],
            ['label' => app()->getLocale() === 'id' ? 'Participants' : 'Participants', 'value' => $stats['participants'], 'tone' => 'amber', 'icon' => 'users'],
            ['label' => app()->getLocale() === 'id' ? 'Speakers' : 'Speakers', 'value' => $stats['speakers'], 'tone' => 'violet', 'icon' => 'user'],
            ['label' => app()->getLocale() === 'id' ? 'Venues' : 'Venues', 'value' => $stats['venues'], 'tone' => 'slate', 'icon' => 'pin'],
            ['label' => app()->getLocale() === 'id' ? 'Documents' : 'Documents', 'value' => $stats['documents'], 'tone' => 'green', 'icon' => 'file'],
        ];
    @endphp

    <div class="eventra-dashboard-shell">
        <div class="eventra-dashboard-header">
            <div>
                <p class="eventra-dashboard-date">{{ now()->translatedFormat('l, d F Y') }}</p>
                <h1>{{ __('messages.welcome', ['name' => auth()->user()->name]) }}</h1>
            </div>
        </div>

        <div class="eventra-dashboard-grid">
            @foreach ($cards as $card)
                <div class="eventra-dashboard-card eventra-dashboard-card-{{ $card['tone'] }}">
                    <div class="eventra-dashboard-icon">
                        @switch($card['icon'])
                            @case('calendar')
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                                @break
                            @case('clock')
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                @break
                            @case('users')
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a4 4 0 00-3-3.87M9 20H4v-2a4 4 0 013-3.87m6-1.13a4 4 0 10-4-4 4 4 0 004 4zm6 0a4 4 0 10-4-4" /></svg>
                                @break
                            @case('user')
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M20 21a8 8 0 10-16 0M12 11a4 4 0 100-8 4 4 0 000 8z" /></svg>
                                @break
                            @case('pin')
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 21s6-5.686 6-11a6 6 0 10-12 0c0 5.314 6 11 6 11zm0-8a2 2 0 110-4 2 2 0 010 4z" /></svg>
                                @break
                            @default
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                        @endswitch
                    </div>
                    <div class="eventra-dashboard-card-content">
                        <div class="eventra-dashboard-number-wrap">
                            <div class="eventra-dashboard-number">{{ number_format($card['value']) }}</div>
                        </div>
                        <div class="eventra-dashboard-label">{{ $card['label'] }}</div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="eventra-chart-panel">
            <div class="eventra-chart-card">
                <div class="eventra-chart-header">
                    <div>
                        <p>{{ app()->getLocale() === 'id' ? 'Aktivitas acara' : 'Event activity' }}</p>
                        <h3>{{ app()->getLocale() === 'id' ? '6 bulan terakhir' : 'Last 6 months' }}</h3>
                    </div>
                    <span>{{ app()->getLocale() === 'id' ? '+12,4%' : '+12.4%' }}</span>
                </div>

                <div class="eventra-chart-bars">
                    @foreach ($monthlyEvents as $month)
                        @php
                            $height = $maxMonthlyValue > 0 ? max(18, ($month['value'] / $maxMonthlyValue) * 100) : 18;
                        @endphp
                        <div class="eventra-chart-column">
                            <div class="eventra-chart-bar-wrap">
                                <span class="eventra-chart-bar" style="height: {{ $height }}%"></span>
                            </div>
                            <small>{{ $month['label'] }}</small>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection