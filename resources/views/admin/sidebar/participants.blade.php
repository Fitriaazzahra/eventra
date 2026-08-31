@extends('layouts.admin')

@section('title', 'Peserta')
@section('breadcrumb', 'Peserta')

@section('content')
    <div class="eventra-heading-row">
        <div>
            <h1>Peserta</h1>
            <p>Lihat daftar peserta, status pendaftaran, dan tipe tiket.</p>
        </div>
        <a href="{{ route('admin.participants.create', ['locale' => app()->getLocale()]) }}" class="eventra-add-btn">Tambah Peserta</a>
    </div>

    <div class="eventra-toolbar">
        <form method="GET" class="eventra-toolbar-form">
            <div class="eventra-search-wrap">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35m1.85-5.15a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari peserta...">
            </div>
            <button type="submit" class="eventra-search-btn">Cari</button>
        </form>
    </div>

    <div class="eventra-form-card">
        <div class="eventra-table-wrap">
            @if ($participants->isEmpty())
                <div class="eventra-empty-state">
                    <p>Belum ada data peserta.</p>
                    <a href="{{ route('admin.participants.create', ['locale' => app()->getLocale()]) }}" class="eventra-add-btn eventra-add-btn-inline">Tambah Peserta</a>
                </div>
            @else
                <div class="eventra-table-scroll">
                    <table class="eventra-table">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Acara</th>
                                <th>Tanggal Daftar</th>
                                <th>Status</th>
                                <th class="align-right">Aksi</th>
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
                                            <a href="{{ route('admin.participants.edit', ['locale' => app()->getLocale(), 'participant' => $participant->id]) }}" class="eventra-row-action eventra-row-action-edit" title="Edit">
                                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5h2.5A1.5 1.5 0 0115 6.5V7m-6 0h-2A2 2 0 005 9v9a2 2 0 002 2h9a2 2 0 002-2v-2m-8 0l8-8m0 0v3.5M15 7l-8 8" /></svg>
                                            </a>

                                            <form id="delete-form-{{ $participant->id }}" method="POST" action="{{ route('admin.participants.destroy', ['locale' => app()->getLocale(), 'participant' => $participant->id]) }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="eventra-row-action eventra-row-action-delete btn-delete" data-id="{{ $participant->id }}" title="Hapus">
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

    {{-- Script SweetAlert2 untuk menangani konfirmasi hapus --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('.btn-delete').forEach(button => {
                button.addEventListener('click', function () {
                    const participantId = this.getAttribute('data-id');
                    const form = document.getElementById('delete-form-' + participantId);

                    Swal.fire({
                        title: 'Apakah Anda yakin?',
                        text: "Data peserta ini akan dihapus permanen!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#6c757d',
                        confirmButtonText: 'Ya, Hapus!',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                });
            });
        });
    </script>
@endsection