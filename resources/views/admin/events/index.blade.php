
@extends('layouts.admin')

@section('title', __('messages.events'))
@section('breadcrumb', __('messages.events'))

@section('content')
    @php
        $stats = [
            ['label' => app()->getLocale() === 'id' ? 'Total acara' : 'Total events', 'value' => $events->total(), 'accent' => 'violet'],
            ['label' => app()->getLocale() === 'id' ? 'Published' : 'Published', 'value' => $events->where('status', 'published')->count(), 'accent' => 'green'],
            ['label' => app()->getLocale() === 'id' ? 'Draft' : 'Draft', 'value' => $events->where('status', 'draft')->count(), 'accent' => 'amber'],
            ['label' => app()->getLocale() === 'id' ? 'Completed' : 'Completed', 'value' => $events->where('status', 'completed')->count(), 'accent' => 'slate'],
        ];
    @endphp

    <div class="eventra-heading-row">
        <div>
            <h1>{{ app()->getLocale() === 'id' ? 'Semua acara' : 'All events' }}</h1>
            <p>{{ app()->getLocale() === 'id' ? 'Kelola jadwal, venue, dan status publikasi dalam satu tempat.' : 'Manage schedules, venues, and publishing status in one place.' }}</p>
        </div>
        <a href="{{ route('admin.events.create', ['locale' => app()->getLocale()]) }}" class="eventra-add-btn">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" /></svg>
            {{ __('messages.add_event') }}
        </a>
    </div>

    <div class="eventra-stats-grid">
        @foreach ($stats as $stat)
            <div class="eventra-stat-card">
                <p class="eventra-stat-label">{{ strtoupper($stat['label']) }}</p>
                <p class="eventra-stat-value {{ $stat['accent'] }}">{{ $stat['value'] }}</p>
            </div>
        @endforeach
    </div>

    <div class="eventra-toolbar">
        <form method="GET" class="eventra-toolbar-form">
            <div class="eventra-search-wrap">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35m1.85-5.15a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="{{ __('messages.search') }}...">
            </div>

            <select name="status" class="eventra-filter-select" onchange="this.form.submit()">
                <option value="">{{ app()->getLocale() === 'id' ? 'Semua Status' : 'All Status' }}</option>
                @foreach (['draft' => 'Draft', 'published' => 'Published', 'completed' => 'Completed', 'cancelled' => 'Cancelled'] as $value => $label)
                    <option value="{{ $value }}" @selected(request('status') === $value)>{{ $label }}</option>
                @endforeach
            </select>

            <select name="category" class="eventra-filter-select" onchange="this.form.submit()">
                <option value="">{{ app()->getLocale() === 'id' ? 'Semua Kategori' : 'All Categories' }}</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" @selected((string) request('category') === (string) $category->id)>{{ $category->name }}</option>
                @endforeach
            </select>

            <button type="submit" class="eventra-search-btn">{{ __('messages.search') }}</button>
        </form>

        @if (request()->hasAny(['search', 'status', 'category']))
            <a href="{{ route('admin.events.index', ['locale' => app()->getLocale()]) }}" class="eventra-clear-link">{{ __('messages.cancel') }}</a>
        @endif
    </div>

    <div class="eventra-table-wrap">
        @if ($events->isEmpty())
            <div class="eventra-empty-state">
                <p>{{ app()->getLocale() === 'id' ? 'Tidak ada acara ditemukan.' : 'No events found.' }}</p>
                <a href="{{ route('admin.events.create', ['locale' => app()->getLocale()]) }}" class="eventra-add-btn eventra-add-btn-inline">
                    {{ __('messages.add_event') }}
                </a>
            </div>
        @else
            <div class="eventra-table-scroll">
                <table class="eventra-table">
                    <thead>
                        <tr>
                            <th>EVENT</th>
                            <th>CATEGORY</th>
                            <th>DATE</th>
                            <th>VENUE</th>
                            <th>CAPACITY</th>
                            <th>STATUS</th>
                            <th class="align-right">ACTIONS</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($events as $event)
                            @php
                                $categoryName = $event->category->name ?? 'General';
                                $categoryBadge = match($categoryName) {
                                    'Community' => 'community',
                                    'Entertainment' => 'entertainment',
                                    'Education' => 'education',
                                    'Conference' => 'conference',
                                    default => 'default',
                                };
                                $statusClass = $event->status ?? 'draft';
                            @endphp
                            <tr>
                                <td>
                                    <div class="eventra-event-name">{{ $event->name }}</div>
                                    <span class="eventra-event-code">{{ $event->event_code }}</span>
                                </td>
                                <td>
                                    <span class="eventra-badge {{ $categoryBadge }}">{{ $categoryName }}</span>
                                </td>
                                <td class="eventra-table-date">{{ $event->start_date ? $event->start_date->translatedFormat('d M Y') : '—' }}</td>
                                <td class="eventra-table-venue">{{ $event->venue->name ?? '—' }}</td>
                                <td class="eventra-table-capacity">
                                    <span class="eventra-capacity">
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14c-4.418 0-8 2.239-8 5v1h16v-1c0-2.761-3.582-5-8-5z" /></svg>
                                        {{ $event->capacity ?? 0 }}
                                    </span>
                                </td>
                                <td>
                                    <span class="eventra-status {{ $statusClass }}">
                                        <span class="dot"></span>
                                        {{ ucfirst($event->status) }}
                                    </span>
                                </td>
                                <td>
                                    <div class="eventra-row-actions">
                                        <a href="{{ route('admin.events.edit', ['locale' => app()->getLocale(), 'event' => $event->id]) }}" class="eventra-row-action eventra-row-action-edit" title="{{ __('messages.edit') }}">
                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.5-9.5a2.121 2.121 0 113 3L12 15l-4 1 1-4 6.5-6.5z" /></svg>
                                        </a>
                                        
                                        <!-- Form Hapus Langsung Memicu SweetAlert2 -->
                                        <form action="{{ route('admin.events.destroy', ['locale' => app()->getLocale(), 'event' => $event->id]) }}" 
                                              method="POST" 
                                              class="delete-form inline-block" 
                                              data-name="{{ $event->name }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="eventra-row-action eventra-row-action-delete" title="{{ __('messages.delete') }}">
                                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M3 7h18m-10 0V4a1 1 0 011-1h4a1 1 0 011 1v3" /></svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="eventra-table-footer">
                <span>{{ app()->getLocale() === 'id' ? 'Menampilkan' : 'Showing' }} {{ $events->count() }} {{ app()->getLocale() === 'id' ? 'dari' : 'of' }} {{ $events->total() }} {{ app()->getLocale() === 'id' ? 'acara' : 'events' }}</span>
                <div class="eventra-pagination">
                    {{ $events->links('pagination::simple-tailwind') }}
                </div>
            </div>
        @endif
    </div>
@endsection
