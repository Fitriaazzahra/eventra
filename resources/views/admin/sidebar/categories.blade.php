@extends('layouts.admin')

@section('title', app()->getLocale() === 'id' ? 'Kategori' : 'Categories')
@section('breadcrumb', app()->getLocale() === 'id' ? 'Kategori' : 'Categories')

@section('content')
    <div class="eventra-heading-row">
        <div>
            <h1>{{ app()->getLocale() === 'id' ? 'Kategori' : 'Categories' }}</h1>
            <p>{{ app()->getLocale() === 'id' ? 'Kelola kategori acara yang digunakan untuk pengelompokan event.' : 'Manage event categories used to organize your events.' }}</p>
        </div>
        <a href="{{ route('admin.categories.create', ['locale' => app()->getLocale()]) }}" class="eventra-add-btn">{{ app()->getLocale() === 'id' ? 'Tambah Kategori' : 'New Category' }}</a>
    </div>

    <div class="eventra-toolbar">
        <form method="GET" class="eventra-toolbar-form">
            <div class="eventra-search-wrap">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35m1.85-5.15a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="{{ app()->getLocale() === 'id' ? 'Cari kategori' : 'Search category' }}...">
            </div>
            <button type="submit" class="eventra-search-btn">{{ __('messages.search') }}</button>
        </form>
    </div>

    <div class="eventra-form-card">
        <div class="eventra-table-wrap">
            @if ($categories->isEmpty())
                <div class="eventra-empty-state">
                    <p>{{ app()->getLocale() === 'id' ? 'Belum ada data kategori.' : 'No categories available yet.' }}</p>
                    <a href="{{ route('admin.categories.create', ['locale' => app()->getLocale()]) }}" class="eventra-add-btn eventra-add-btn-inline">{{ app()->getLocale() === 'id' ? 'Tambah Kategori' : 'New Category' }}</a>
                </div>
            @else
                <div class="eventra-table-scroll">
                    <table class="eventra-table">
                        <thead>
                            <tr>
                                <th>{{ app()->getLocale() === 'id' ? 'Nama' : 'Name' }}</th>
                                <th>{{ app()->getLocale() === 'id' ? 'Deskripsi' : 'Description' }}</th>
                                <th>{{ app()->getLocale() === 'id' ? 'Status' : 'Status' }}</th>
                                <th class="align-right">{{ app()->getLocale() === 'id' ? 'Aksi' : 'Actions' }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $category)
                                <tr>
                                    <td>
                                        <div class="eventra-event-name">{{ $category->name }}</div>
                                    </td>
                                    <td class="eventra-table-venue">{{ $category->description ?: '—' }}</td>
                                    <td>
                                        <span class="eventra-status {{ $category->status === 'active' ? 'published' : 'draft' }}">
                                            <span class="dot"></span>
                                            {{ ucfirst($category->status) }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="eventra-row-actions">
                                            <a href="{{ route('admin.categories.edit', ['locale' => app()->getLocale(), 'category' => $category->id]) }}" class="eventra-row-action eventra-row-action-edit" title="{{ __('messages.edit') }}">
                                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5h2.5A1.5 1.5 0 0115 6.5V7m-6 0h-2A2 2 0 005 9v9a2 2 0 002 2h9a2 2 0 002-2v-2m-8 0l8-8m0 0v3.5M15 7l-8 8" /></svg>
                                            </a>

                                            <!-- Form disesuaikan dengan SweetAlert global di layouts.admin -->
                                            <form method="POST" action="{{ route('admin.categories.destroy', ['locale' => app()->getLocale(), 'category' => $category->id]) }}" class="delete-form" data-name="Kategori {{ $category->name }}">
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