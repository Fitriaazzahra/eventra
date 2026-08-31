@extends('layouts.admin')

@section('title', __('messages.participants'))
@section('breadcrumb', __('messages.participants'))

@section('content')
    <div class="eventra-heading-row">
        <div>
            <h1>{{ __('messages.participants') }}</h1>
            <p>{{ app()->getLocale() === 'id' ? 'Lihat daftar peserta, status pendaftaran, dan tipe tiket.' : 'View participant registrations, status, and ticket types.' }}</p>
        </div>
        <a href="{{ route('admin.participants.create', ['locale' => app()->getLocale()]) }}" class="eventra-add-btn">{{ app()->getLocale() === 'id' ? 'Tambah Peserta' : 'Add Participant' }}</a>
    </div>

    <div class="eventra-toolbar">
        <form method="GET" class="eventra-toolbar-form">
            <div class="eventra-search-wrap">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35m1.85-5.15a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="{{ app()->getLocale() === 'id' ? 'Cari peserta' : 'Search participants' }}...">
            </div>
            <button type="submit" class="eventra-search-btn">{{ __('messages.search') }}</button>
        </form>
    </div>

    <div class="eventra-form-card">
        <div class="eventra-table-wrap">
            @if ($participants->isEmpty())
                <div class="eventra-empty-state">
                    <p>{{ app()->getLocale() === 'id' ? 'Belum ada data peserta.' : 'No participants available yet.' }}</p>
                    <a href="{{ route('admin.participants.create', ['locale' => app()->getLocale()]) }}" class="eventra-add-btn eventra-add-btn-inline">{{ app()->getLocale() === 'id' ? 'Tambah Peserta' : 'Add Participant' }}</a>
                </div>
            @else
                <div class="eventra-table-scroll">
                    <table class="eventra-table">
                        <thead>
                            <tr>
                                <th>{{ app()->getLocale() === 'id' ? 'Nama' : 'Name' }}</th>
                                <th>{{ app()->getLocale() === 'id' ? 'Acara' : 'Event' }}</th>
                                <th>{{ app()->getLocale() === 'id' ? 'Tanggal Daftar' : 'Registration Date' }}</th>
                                <th>{{ app()->getLocale() === 'id' ? 'Status' : 'Status' }}</th>
                                <th class="align-right">{{ app()->getLocale() === 'id' ? 'Aksi' : 'Actions' }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($participants as $participant)
                                <tr>
                                    <td>
                                        <div class="eventra-event-name">{{ $participant->name }}</div>
                                    </td>
                                    <td class="eventra-table-venue">{{ $participant->event?->name ?? '—' }}</td>
                                    <td class="eventra-table-date">{{ $participant->registration_date?->translatedFormat('d M Y') ?? '—' }}</td>
                                    <td>
                                        <span class="eventra-status {{ $participant->status === 'Confirmed' || $participant->status === 'Attended' ? 'published' : 'draft' }}">
                                            <span class="dot"></span>
                                            {{ $participant->status }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="eventra-row-actions">
                                            <a href="{{ route('admin.participants.edit', ['locale' => app()->getLocale(), 'participant' => $participant->id]) }}" class="eventra-row-action eventra-row-action-edit" title="{{ __('messages.edit') }}">
                                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5h2.5A1.5 1.5 0 0115 6.5V7m-6 0h-2A2 2 0 005 9v9a2 2 0 002 2h9a2 2 0 002-2v-2m-8 0l8-8m0 0v3.5M15 7l-8 8" /></svg>
                                            </a>

                                            <form method="POST" action="{{ route('admin.participants.destroy', ['locale' => app()->getLocale(), 'participant' => $participant->id]) }}" onsubmit="return confirm('{{ app()->getLocale() === 'id' ? 'Yakin ingin menghapus peserta ini?' : 'Are you sure you want to delete this participant?' }}');">
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
            @endif
        </div>
    </div>
@endsection
