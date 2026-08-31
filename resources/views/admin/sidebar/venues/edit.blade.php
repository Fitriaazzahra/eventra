@extends('layouts.admin')

@section('title', 'Edit Lokasi')
@section('breadcrumb', 'Lokasi / Edit')

@section('content')
    <div class="eventra-heading-row">
        <div>
            <h1>Edit Lokasi</h1>
            <p>Perbarui informasi tempat pelaksanaan untuk acara mendatang.</p>
        </div>
        <a href="{{ route('admin.venues.index', ['locale' => app()->getLocale()]) }}" class="eventra-btn-secondary">
            Kembali
        </a>
    </div>

    <form method="POST" action="{{ route('admin.venues.update', ['locale' => app()->getLocale(), 'venue' => $venue->id]) }}" class="eventra-form-shell">
        @csrf
        @method('PUT')

        <div class="eventra-form-layout">
            <div class="eventra-form-main-column">
                <div class="eventra-form-card">
                    <h3>Detail Lokasi</h3>

                    <div class="eventra-form-field">
                        <label>Nama Tempat *</label>
                        <input type="text" name="name" value="{{ old('name', $venue->name) }}" class="eventra-form-input" required>
                        @error('name') <p class="eventra-form-error">{{ $message }}</p> @enderror
                    </div>

                    <div class="eventra-form-field">
                        <label>Alamat *</label>
                        <textarea name="address" class="eventra-form-textarea" rows="4" required>{{ old('address', $venue->address) }}</textarea>
                        @error('address') <p class="eventra-form-error">{{ $message }}</p> @enderror
                    </div>

                    <div class="eventra-form-grid">
                        <div class="eventra-form-field">
                            <label>Kota *</label>
                            <input type="text" name="city" value="{{ old('city', $venue->city) }}" class="eventra-form-input" required>
                        </div>
                        <div class="eventra-form-field">
                            <label>Provinsi</label>
                            <input type="text" name="province" value="{{ old('province', $venue->province) }}" class="eventra-form-input">
                        </div>
                    </div>

                    <div class="eventra-form-grid">
                        <div class="eventra-form-field">
                            <label>Kode Pos</label>
                            <input type="text" name="postal_code" value="{{ old('postal_code', $venue->postal_code) }}" class="eventra-form-input">
                        </div>
                        <div class="eventra-form-field">
                            <label>Kapasitas Tempat</label>
                            <input type="number" name="capacity" min="1" value="{{ old('capacity', $venue->capacity) }}" class="eventra-form-input">
                        </div>
                    </div>
                </div>
            </div>

            <div class="eventra-form-side-column">
                <div class="eventra-form-card">
                    <h3>Informasi & Status</h3>

                    <div class="eventra-form-field">
                        <label>Deskripsi Tempat</label>
                        <textarea name="description" class="eventra-form-textarea" rows="4">{{ old('description', $venue->description) }}</textarea>
                    </div>

                    <div class="eventra-form-field">
                        <label>Status Tempat</label>
                        <select name="status" class="eventra-form-select">
                            <option value="active" @selected(old('status', $venue->status) === 'active')>Aktif</option>
                            <option value="inactive" @selected(old('status', $venue->status) === 'inactive')>Tidak Aktif</option>
                        </select>
                    </div>
                </div>

                <div class="eventra-form-actions">
                    <button type="submit" class="eventra-btn-primary">Simpan Perubahan</button>
                    <a href="{{ route('admin.venues.index', ['locale' => app()->getLocale()]) }}" class="eventra-btn-secondary">Batal</a>
                </div>
            </div>
        </div>
    </form>
@endsection