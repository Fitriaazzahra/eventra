@extends('layouts.admin')

@section('title', app()->getLocale() === 'id' ? 'Edit Pengguna' : 'Edit User')
@section('breadcrumb', app()->getLocale() === 'id' ? 'Edit Pengguna' : 'Edit User')

@section('content')
    <div class="eventra-heading-row">
        <div>
            <h1>{{ app()->getLocale() === 'id' ? 'Edit Pengguna' : 'Edit User' }}</h1>
            <p>{{ app()->getLocale() === 'id' ? 'Perbarui profil dan kredensial akun pengguna.' : 'Update user profile and account credentials.' }}</p>
        </div>
        <a href="{{ route('admin.users.index', ['locale' => app()->getLocale()]) }}" class="eventra-btn-secondary">{{ app()->getLocale() === 'id' ? 'Kembali' : 'Back' }}</a>
    </div>

    <form method="POST" action="{{ route('admin.users.update', ['locale' => app()->getLocale(), 'user' => $user->id]) }}" class="eventra-form-shell">
        @csrf
        @method('PUT')

        <div class="eventra-form-layout">
            <div class="eventra-form-main-column">
                <div class="eventra-form-card">
                    <h3>{{ app()->getLocale() === 'id' ? 'Informasi Akun' : 'Account Details' }}</h3>

                    <div class="eventra-form-grid">
                        <div class="eventra-form-field">
                            <label for="name">{{ app()->getLocale() === 'id' ? 'Nama Lengkap' : 'Full Name' }}</label>
                            <input id="name" type="text" name="name" value="{{ old('name', $user->name) }}" class="eventra-form-input @error('name') has-error @enderror" required>
                            @error('name')
                                <p class="eventra-form-error">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="eventra-form-field">
                            <label for="email">Email</label>
                            <input id="email" type="email" name="email" value="{{ old('email', $user->email) }}" class="eventra-form-input @error('email') has-error @enderror" required>
                            @error('email')
                                <p class="eventra-form-error">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="eventra-form-field">
                            <label for="password">{{ app()->getLocale() === 'id' ? 'Kata Sandi Baru' : 'New Password' }}</label>
                            <input id="password" type="password" name="password" class="eventra-form-input @error('password') has-error @enderror" placeholder="{{ app()->getLocale() === 'id' ? 'Biarkan kosong jika tidak ingin mengganti' : 'Leave empty to keep current password' }}">
                            @error('password')
                                <p class="eventra-form-error">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="eventra-form-field">
                            <label for="password_confirmation">{{ app()->getLocale() === 'id' ? 'Konfirmasi Kata Sandi Baru' : 'Confirm New Password' }}</label>
                            <input id="password_confirmation" type="password" name="password_confirmation" class="eventra-form-input" placeholder="{{ app()->getLocale() === 'id' ? 'Konfirmasi kata sandi baru' : 'Confirm new password' }}">
                        </div>
                    </div>
                </div>
            </div>

            <div class="eventra-form-side-column">
                <div class="eventra-form-card">
                    <h3>{{ app()->getLocale() === 'id' ? 'Catatan' : 'Notes' }}</h3>
                    <p class="eventra-form-hint">{{ app()->getLocale() === 'id' ? 'Kosongkan password jika tidak ingin mengubah kata sandi pengguna.' : 'Leave the password empty if you do not want to change the user password.' }}</p>
                </div>
            </div>
        </div>

        <div class="eventra-form-actions">
            <a href="{{ route('admin.users.index', ['locale' => app()->getLocale()]) }}" class="eventra-btn-secondary">{{ __('messages.cancel') }}</a>
            <button type="submit" class="eventra-btn-primary">{{ app()->getLocale() === 'id' ? 'Perbarui Pengguna' : 'Update User' }}</button>
        </div>
    </form>
@endsection
