@extends('layouts.admin')

@section('title', app()->getLocale() === 'id' ? 'Edit Pembicara' : 'Edit Speaker')
@section('breadcrumb', app()->getLocale() === 'id' ? 'Pembicara / Edit' : 'Speakers / Edit')

@section('content')
    <div class="eventra-heading-row">
        <div>
            <h1>{{ app()->getLocale() === 'id' ? 'Edit Pembicara' : 'Edit Speaker' }}</h1>
            <p>{{ app()->getLocale() === 'id' ? 'Perbarui profil pembicara yang akan tampil pada event.' : 'Update the speaker profile that appears on your events.' }}</p>
        </div>
        <a href="{{ route('admin.speakers.index', ['locale' => app()->getLocale()]) }}" class="eventra-btn-secondary">
            {{ app()->getLocale() === 'id' ? 'Kembali' : 'Back' }}
        </a>
    </div>

    <form method="POST" action="{{ route('admin.speakers.update', ['locale' => app()->getLocale(), 'speaker' => $speaker->id]) }}" class="eventra-form-shell">
        @csrf
        @method('PUT')

        <div class="eventra-form-layout">
            <div class="eventra-form-main-column">
                <div class="eventra-form-card">
                    <h3>{{ app()->getLocale() === 'id' ? 'Profil Pembicara' : 'Speaker Profile' }}</h3>

                    <div class="eventra-form-field">
                        <label>{{ app()->getLocale() === 'id' ? 'Nama Lengkap' : 'Full Name' }} *</label>
                        <input type="text" name="name" value="{{ old('name', $speaker->name) }}" class="eventra-form-input" required>
                        @error('name') <p class="eventra-form-error">{{ $message }}</p> @enderror
                    </div>

                    <div class="eventra-form-grid">
                        <div class="eventra-form-field">
                            <label>{{ app()->getLocale() === 'id' ? 'Jabatan' : 'Job Title' }}</label>
                            <input type="text" name="job_title" value="{{ old('job_title', $speaker->job_title) }}" class="eventra-form-input">
                        </div>
                        <div class="eventra-form-field">
                            <label>{{ app()->getLocale() === 'id' ? 'Perusahaan' : 'Company' }}</label>
                            <input type="text" name="company" value="{{ old('company', $speaker->company) }}" class="eventra-form-input">
                        </div>
                    </div>

                    <div class="eventra-form-field">
                        <label>{{ app()->getLocale() === 'id' ? 'Biografi' : 'Biography' }}</label>
                        <textarea name="biography" class="eventra-form-textarea" rows="5">{{ old('biography', $speaker->biography) }}</textarea>
                    </div>
                </div>
            </div>

            <div class="eventra-form-side-column">
                <div class="eventra-form-card">
                    <h3>{{ app()->getLocale() === 'id' ? 'Kontak' : 'Contact' }}</h3>
                    <div class="eventra-form-field">
                        <label>{{ app()->getLocale() === 'id' ? 'Email' : 'Email' }}</label>
                        <input type="email" name="email" value="{{ old('email', $speaker->email) }}" class="eventra-form-input">
                    </div>
                    <div class="eventra-form-field">
                        <label>LinkedIn</label>
                        <input type="url" name="linkedin" value="{{ old('linkedin', $speaker->linkedin) }}" class="eventra-form-input">
                    </div>
                    <div class="eventra-form-field">
                        <label>{{ app()->getLocale() === 'id' ? 'Website' : 'Website' }}</label>
                        <input type="url" name="website" value="{{ old('website', $speaker->website) }}" class="eventra-form-input">
                    </div>
                </div>

                <div class="eventra-form-card">
                    <h3>{{ app()->getLocale() === 'id' ? 'Status' : 'Status' }}</h3>
                    <div class="eventra-form-field">
                        <label>{{ app()->getLocale() === 'id' ? 'Status' : 'Status' }}</label>
                        <select name="status" class="eventra-form-select">
                            <option value="active" @selected(old('status', $speaker->status) === 'active')>{{ app()->getLocale() === 'id' ? 'Aktif' : 'Active' }}</option>
                            <option value="inactive" @selected(old('status', $speaker->status) === 'inactive')>{{ app()->getLocale() === 'id' ? 'Tidak Aktif' : 'Inactive' }}</option>
                        </select>
                    </div>
                </div>

                <div class="eventra-form-actions">
                    <button type="submit" class="eventra-btn-primary">{{ __('messages.save') }}</button>
                    <a href="{{ route('admin.speakers.index', ['locale' => app()->getLocale()]) }}" class="eventra-btn-secondary">{{ __('messages.cancel') }}</a>
                </div>
            </div>
        </div>
    </form>
@endsection
