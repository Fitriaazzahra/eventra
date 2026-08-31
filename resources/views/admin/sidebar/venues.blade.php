@extends('layouts.admin')

@section('title', __('messages.venues'))
@section('breadcrumb', __('messages.venues'))

@section('content')
    <div class="eventra-heading-row">
        <div>
            <h1>{{ __('messages.venues') }}</h1>
            <p>{{ app()->getLocale() === 'id' ? 'Pantau lokasi dan kapasitas venue untuk setiap event.' : 'Track venue locations and capacities for each event.' }}</p>
        </div>
        <a href="{{ route('admin.venues.create', ['locale' => app()->getLocale()]) }}" class="eventra-add-btn">{{ app()->getLocale() === 'id' ? 'Tambah Lokasi' : 'Add Venue' }}</a>
    </div>

    <div class="eventra-toolbar">
        <form method="GET" class="eventra-toolbar-form">
            <div class="eventra-search-wrap">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35m1.85-5.15a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="{{ app()->getLocale() === 'id' ? 'Cari venue' : 'Search venue' }}...">
            </div>
            <button type="submit" class="eventra-search-btn">{{ __('messages.search') }}</button>
        </form>
    </div>

    <div class="eventra-form-card">
        <div class="eventra-table-wrap">
            @if ($venues->isEmpty())
                <div class="eventra-empty-state">
                    <p>{{ app()->getLocale() === 'id' ? 'Belum ada data lokasi.' : 'No venues available yet.' }}</p>
                    <a href="{{ route('admin.venues.create', ['locale' => app()->getLocale()]) }}" class="eventra-add-btn eventra-add-btn-inline">{{ app()->getLocale() === 'id' ? 'Tambah Lokasi' : 'Add Venue' }}</a>
                </div>
            @else
                <div class="eventra-table-scroll">
                    <table class="eventra-table">
                        <thead>
                            <tr>
                                <th>{{ app()->getLocale() === 'id' ? 'Nama' : 'Name' }}</th>
                                <th>{{ app()->getLocale() === 'id' ? 'Kota' : 'City' }}</th>
                                <th>{{ app()->getLocale() === 'id' ? 'Kapasitas' : 'Capacity' }}</th>
                                <th>{{ app()->getLocale() === 'id' ? 'Status' : 'Status' }}</th>
                                <th class="align-right">{{ app()->getLocale() === 'id' ? 'Aksi' : 'Actions' }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($venues as $venue)
                                <tr>
                                    <td>
                                        <div class="eventra-event-name">{{ $venue->name }}</div>
                                    </td>
                                    <td class="eventra-table-venue">{{ $venue->city }}</td>
                                    <td class="eventra-table-venue">{{ $venue->capacity ?: '—' }}</td>
                                    <td>
                                        <span class="eventra-status {{ $venue->status === 'active' ? 'published' : 'draft' }}">
                                            <span class="dot"></span>
                                            {{ ucfirst($venue->status) }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="eventra-row-actions">
                                            <a href="{{ route('admin.venues.edit', ['locale' => app()->getLocale(), 'venue' => $venue->id]) }}" class="eventra-row-action eventra-row-action-edit" title="{{ __('messages.edit') }}">
                                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5h2.5A1.5 1.5 0 0115 6.5V7m-6 0h-2A2 2 0 005 9v9a2 2 0 002 2h9a2 2 0 002-2v-2m-8 0l8-8m0 0v3.5M15 7l-8 8" /></svg>
                                            </a>

                                            <form id="delete-form-{{ $venue->id }}" method="POST" action="{{ route('admin.venues.destroy', ['locale' => app()->getLocale(), 'venue' => $venue->id]) }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="eventra-row-action eventra-row-action-delete" title="{{ __('messages.delete') }}" onclick="confirmDelete({{ $venue->id }})">
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

    <!-- SweetAlert2 CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function confirmDelete(id) {
            const isIndonesian = '{{ app()->getLocale() }}' === 'id';

            Swal.fire({
                title: isIndonesian ? 'Apakah Anda yakin?' : 'Are you sure?',
                text: isIndonesian ? 'Yakin ingin menghapus venue ini?' : 'Are you sure you want to delete this venue?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc3545',
                cancelButtonColor: '#6c757d',
                confirmButtonText: isIndonesian ? 'Ya, Hapus!' : 'Yes, Delete!',
                cancelButtonText: isIndonesian ? 'Batal' : 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + id).submit();
                }
            });
        }
    </script>
@endsection