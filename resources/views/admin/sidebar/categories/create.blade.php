@extends('layouts.admin')

@section('title', app()->getLocale() === 'id' ? 'Tambah Kategori' : 'Add Category')
@section('breadcrumb', app()->getLocale() === 'id' ? 'Kategori / Tambah' : 'Categories / Add')

@section('content')
    <div class="eventra-heading-row">
        <div>
            <h1>{{ app()->getLocale() === 'id' ? 'Tambah Kategori' : 'Add Category' }}</h1>
            <p>{{ app()->getLocale() === 'id' ? 'Buat kategori baru untuk pengelompokan acara.' : 'Create a new category for organizing events.' }}</p>
        </div>
        <a href="{{ route('admin.categories.index', ['locale' => app()->getLocale()]) }}" class="eventra-btn-secondary">
            {{ app()->getLocale() === 'id' ? 'Kembali' : 'Back' }}
        </a>
    </div>

    <form method="POST" action="{{ route('admin.categories.store', ['locale' => app()->getLocale()]) }}" class="eventra-form-shell">
        @csrf

        <div class="eventra-form-layout">
            <div class="eventra-form-main-column">
                <div class="eventra-form-card">
                    <h3>{{ app()->getLocale() === 'id' ? 'Informasi Kategori' : 'Category Information' }}</h3>

                    <div class="eventra-form-field">
                        <label>{{ app()->getLocale() === 'id' ? 'Nama Kategori' : 'Category Name' }} *</label>
                        <input type="text" name="name" value="{{ old('name') }}" class="eventra-form-input" required>
                        @error('name') <p class="eventra-form-error">{{ $message }}</p> @enderror
                    </div>

                    <div class="eventra-form-field">
                        <label>{{ app()->getLocale() === 'id' ? 'Deskripsi' : 'Description' }}</label>
                        <textarea name="description" class="eventra-form-textarea" rows="4">{{ old('description') }}</textarea>
                        @error('description') <p class="eventra-form-error">{{ $message }}</p> @enderror
                    </div>
                </div>
            </div>

            <div class="eventra-form-side-column">
                <div class="eventra-form-card">
                    <h3>{{ app()->getLocale() === 'id' ? 'Status' : 'Status' }}</h3>
                    <div class="eventra-form-field">
                        <label>{{ app()->getLocale() === 'id' ? 'Status' : 'Status' }}</label>
                        <select name="status" class="eventra-form-select">
                            <option value="active" @selected(old('status', 'active') === 'active')>{{ app()->getLocale() === 'id' ? 'Aktif' : 'Active' }}</option>
                            <option value="inactive" @selected(old('status') === 'inactive')>{{ app()->getLocale() === 'id' ? 'Tidak Aktif' : 'Inactive' }}</option>
                        </select>
                    </div>
                </div>

                <div class="eventra-form-actions">
                    <button type="submit" class="eventra-btn-primary">{{ __('messages.save') }}</button>
                    <a href="{{ route('admin.categories.index', ['locale' => app()->getLocale()]) }}" class="eventra-btn-secondary">{{ __('messages.cancel') }}</a>
                </div>
            </div>
        </div>
    </form>
@endsection
