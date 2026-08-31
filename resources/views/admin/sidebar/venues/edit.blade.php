@extends('layouts.admin')

@section('title', app()->getLocale() === 'id' ? 'Edit Venue' : 'Edit Venue')
@section('breadcrumb', app()->getLocale() === 'id' ? 'Venue / Edit' : 'Venues / Edit')

@section('content')
    <div class="eventra-heading-row">
        <div>
            <h1>{{ app()->getLocale() === 'id' ? 'Edit Venue' : 'Edit Venue' }}</h1>
            <p>{{ app()->getLocale() === 'id' ? 'Perbarui informasi venue untuk event yang akan datang.' : 'Update venue information for upcoming events.' }}</p>
        </div>
        <a href="{{ route('admin.venues.index', ['locale' => app()->getLocale()]) }}" class="eventra-btn-secondary">
            {{ app()->getLocale() === 'id' ? 'Kembali' : 'Back' }}
        </a>
    </div>

    <form method="POST" action="{{ route('admin.venues.update', ['locale' => app()->getLocale(), 'venue' => $venue->id]) }}" class="eventra-form-shell">
        @csrf
        @method('PUT')

        <div class="eventra-form-layout">
            <div class="eventra-form-main-column">
                <div class="eventra-form-card">
                    <h3>{{ app()->getLocale() === 'id' ? 'Detail Lokasi' : 'Venue Details' }}</h3>

                    <div class="eventra-form-field">
                        <label>{{ app()->getLocale() === 'id' ? 'Nama Venue' : 'Venue Name' }} *</label>
                        <input type="text" name="name" value="{{ old('name', $venue->name) }}" class="eventra-form-input" required>
                        @error('name') <p class="eventra-form-error">{{ $message }}</p> @enderror
                    </div>

                    <div class="eventra-form-field">
                        <label>{{ app()->getLocale() === 'id' ? 'Alamat' : 'Address' }} *</label>
                        <textarea name="address" class="eventra-form-textarea" rows="4" required>{{ old('address', $venue->address) }}</textarea>
                        @error('address') <p class="eventra-form-error">{{ $message }}</p> @enderror
                    </div>

                    <div class="eventra-form-grid">
                        <div class="eventra-form-field">
                            <label>{{ app()->getLocale() === 'id' ? 'Kota' : 'City' }} *</label>
                            <input type="text" name="city" value="{{ old('city', $venue->city) }}" class="eventra-form-input" required>
                        </div>
                        <div class="eventra-form-field">
                            <label>{{ app()->getLocale() === 'id' ? 'Provinsi' : 'Province' }}</label>
                            <input type="text" name="province" value="{{ old('province', $venue->province) }}" class="eventra-form-input">
                        </div>
                    </div>

                    <div class="eventra-form-grid">
                        <div class="eventra-form-field">
                            <label>{{ app()->getLocale() === 'id' ? 'Kode Pos' : 'Postal Code' }}</label>
                            <input type="text" name="postal_code" value="{{ old('postal_code', $venue->postal_code) }}" class="eventra-form-input">
                        </div>
                        <div class="eventra-form-field">
                            <label>{{ app()->getLocale() === 'id' ? 'Kapasitas' : 'Capacity' }}</label>
                            <input type="number" name="capacity" min="1" value="{{ old('capacity', $venue->capacity) }}" class="eventra-form-input">
                        </div>
                    </div>
                </div>
            </div>

            <div class="eventra-form-side-column">
                <div class="eventra-form-card">
                    <h3>{{ app()->getLocale() === 'id' ? 'Koordinat & Status' : 'Coordinates & Status' }}</h3>

                    <div class="eventra-form-grid">
                        <div class="eventra-form-field">
                            <label>Latitude</label>
                            <input type="number" step="0.0000001" name="latitude" value="{{ old('latitude', $venue->latitude) }}" class="eventra-form-input">
                        </div>
                        <div class="eventra-form-field">
                            <label>Longitude</label>
                            <input type="number" step="0.0000001" name="longitude" value="{{ old('longitude', $venue->longitude) }}" class="eventra-form-input">
                        </div>
                    </div>

                    <div class="eventra-form-field">
                        <label>{{ app()->getLocale() === 'id' ? 'Deskripsi' : 'Description' }}</label>
                        <textarea name="description" class="eventra-form-textarea" rows="4">{{ old('description', $venue->description) }}</textarea>
                    </div>

                    <div class="eventra-form-field">
                        <label>{{ app()->getLocale() === 'id' ? 'Status' : 'Status' }}</label>
                        <select name="status" class="eventra-form-select">
                            <option value="active" @selected(old('status', $venue->status) === 'active')>{{ app()->getLocale() === 'id' ? 'Aktif' : 'Active' }}</option>
                            <option value="inactive" @selected(old('status', $venue->status) === 'inactive')>{{ app()->getLocale() === 'id' ? 'Tidak Aktif' : 'Inactive' }}</option>
                        </select>
                    </div>
                </div>

                <div class="eventra-form-actions">
                    <button type="submit" class="eventra-btn-primary">{{ __('messages.save') }}</button>
                    <a href="{{ route('admin.venues.index', ['locale' => app()->getLocale()]) }}" class="eventra-btn-secondary">{{ __('messages.cancel') }}</a>
                </div>
            </div>
        </div>
    </form>
@endsection
