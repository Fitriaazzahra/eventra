@extends('layouts.admin')

@section('title', app()->getLocale() === 'id' ? 'Edit Halaman Tentang' : 'Edit About Page')
@section('breadcrumb', app()->getLocale() === 'id' ? 'Edit Halaman Tentang' : 'Edit About Page')

@section('content')
    <div class="eventra-heading-row">
        <div>
            <h1>{{ app()->getLocale() === 'id' ? 'Edit Konten Halaman Tentang' : 'Edit About Page Content' }}</h1>
            <p>{{ app()->getLocale() === 'id' ? 'Ubah teks, judul, dan konten halaman Tentang yang tampil di sisi user.' : 'Update the About page text and content shown to users.' }}</p>
        </div>
    </div>

    <form method="POST" action="{{ route('admin.settings.update', ['locale' => app()->getLocale()]) }}" class="eventra-form-card">
        @csrf

        <div class="eventra-form-grid eventra-form-grid-wide">
            <div class="eventra-form-panel">
                <h3>{{ app()->getLocale() === 'id' ? 'Halaman Tentang' : 'About Page' }}</h3>
                @foreach ($aboutSettings as $setting)
                    @php
                        $currentLocale = app()->getLocale();
                        $aboutValueKey = $currentLocale === 'id' ? 'value_id' : 'value_en';
                        $aboutValue = old('about.' . $setting->key . '.' . $aboutValueKey, $currentLocale === 'id' ? $setting->value_id : $setting->value_en);
                    @endphp

                    <div class="eventra-form-block">
                        <div class="eventra-form-field">
                            <label>{{ $currentLocale === 'id' ? 'Teks halaman' : 'Page text' }} ({{ $setting->key }})</label>
                            <textarea name="about[{{ $setting->key }}][value]" rows="3">{{ $aboutValue }}</textarea>
                        </div>

                        <div class="eventra-form-field">
                            <label>{{ app()->getLocale() === 'id' ? 'Urutan' : 'Order' }}</label>
                            <input type="number" min="1" name="about[{{ $setting->key }}][sort_order]" value="{{ old('about.' . $setting->key . '.sort_order', $setting->sort_order) }}" required>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="eventra-form-actions">
            <button type="submit" class="eventra-add-btn">{{ app()->getLocale() === 'id' ? 'Simpan Perubahan' : 'Save Changes' }}</button>
        </div>
    </form>
@endsection
