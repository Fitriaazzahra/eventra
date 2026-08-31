@extends('layouts.admin')

@section('title', app()->getLocale() === 'id' ? 'Tambah Pengguna' : 'Create User')
@section('breadcrumb', app()->getLocale() === 'id' ? 'Tambah Pengguna' : 'Create User')

@section('content')
    <div class="eventra-heading-row">
        <div>
            <h1>{{ app()->getLocale() === 'id' ? 'Tambah Pengguna' : 'Create User' }}</h1>
            <p>{{ app()->getLocale() === 'id' ? 'Buat akun pengguna baru untuk admin atau staff.' : 'Create a new user account for admin or staff.' }}</p>
        </div>
        <a href="{{ route('admin.users.index', ['locale' => app()->getLocale()]) }}" class="eventra-btn-secondary">{{ app()->getLocale() === 'id' ? 'Kembali' : 'Back' }}</a>
    </div>

    <form method="POST" action="{{ route('admin.users.store', ['locale' => app()->getLocale()]) }}" class="eventra-form-shell">
        @csrf

        <div class="eventra-form-layout">
            <div class="eventra-form-main-column">
                <div class="eventra-form-card">
                    <h3>{{ app()->getLocale() === 'id' ? 'Informasi Akun' : 'Account Details' }}</h3>

                    <div class="eventra-form-grid">
                        <div class="eventra-form-field">
                            <label for="name">{{ app()->getLocale() === 'id' ? 'Nama Lengkap' : 'Full Name' }}</label>
                            <input id="name" type="text" name="name" value="{{ old('name') }}" class="eventra-form-input @error('name') has-error @enderror" required>
                            @error('name')
                                <p class="eventra-form-error">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="eventra-form-field">
                            <label for="email">Email</label>
                            <input id="email" type="email" name="email" value="{{ old('email') }}" class="eventra-form-input @error('email') has-error @enderror" required>
                            @error('email')
                                <p class="eventra-form-error">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="eventra-form-field">
                            <label for="password">{{ app()->getLocale() === 'id' ? 'Kata Sandi' : 'Password' }}</label>
                            <input id="password" type="password" name="password" class="eventra-form-input @error('password') has-error @enderror" required>
                            @error('password')
                                <p class="eventra-form-error">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="eventra-form-field">
                            <label for="password_confirmation">{{ app()->getLocale() === 'id' ? 'Konfirmasi Kata Sandi' : 'Confirm Password' }}</label>
                            <input id="password_confirmation" type="password" name="password_confirmation" class="eventra-form-input" required>
                        </div>
                    </div>
                </div>
            </div>

            <div class="eventra-form-side-column">
                <div class="eventra-form-card">
                    <h3>{{ app()->getLocale() === 'id' ? 'Catatan' : 'Notes' }}</h3>
                    <p class="eventra-form-hint">{{ app()->getLocale() === 'id' ? 'Password minimal 8 karakter dan harus dikonfirmasi untuk mencegah kesalahan input.' : 'Passwords must be at least 8 characters and confirmed to prevent input mistakes.' }}</p>
                </div>
            </div>
        </div>

        <div class="eventra-form-actions">
            <a href="{{ route('admin.users.index', ['locale' => app()->getLocale()]) }}" class="eventra-btn-secondary">{{ __('messages.cancel') }}</a>
            <button type="submit" class="eventra-btn-primary">{{ app()->getLocale() === 'id' ? 'Simpan Pengguna' : 'Save User' }}</button>
        </div>
    </form>
@endsection
