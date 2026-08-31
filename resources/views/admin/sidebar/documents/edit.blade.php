@extends('layouts.admin')

@section('title', app()->getLocale() === 'id' ? 'Edit Dokumen' : 'Edit Document')
@section('breadcrumb', app()->getLocale() === 'id' ? 'Dokumen / Edit' : 'Documents / Edit')

@section('content')
    <div class="eventra-heading-row">
        <div>
            <h1>{{ app()->getLocale() === 'id' ? 'Edit Dokumen' : 'Edit Document' }}</h1>
            <p>{{ app()->getLocale() === 'id' ? 'Perbarui informasi dokumen yang terkait dengan event.' : 'Update document details related to an event.' }}</p>
        </div>
        <a href="{{ route('admin.documents.index', ['locale' => app()->getLocale()]) }}" class="eventra-btn-secondary">
            {{ app()->getLocale() === 'id' ? 'Kembali' : 'Back' }}
        </a>
    </div>

    <form method="POST" action="{{ route('admin.documents.update', ['locale' => app()->getLocale(), 'document' => $document->id]) }}" enctype="multipart/form-data" class="eventra-form-shell">
        @csrf
        @method('PUT')

        <div class="eventra-form-layout">
            <div class="eventra-form-main-column">
                <div class="eventra-form-card">
                    <h3>{{ app()->getLocale() === 'id' ? 'Informasi Dokumen' : 'Document Information' }}</h3>

                    <div class="eventra-form-field">
                        <label>{{ app()->getLocale() === 'id' ? 'Nama Dokumen' : 'Document Name' }} *</label>
                        <input type="text" name="document_name" value="{{ old('document_name', $document->document_name) }}" class="eventra-form-input" required>
                        @error('document_name') <p class="eventra-form-error">{{ $message }}</p> @enderror
                    </div>

                    <div class="eventra-form-field">
                        <label>{{ app()->getLocale() === 'id' ? 'Ganti File' : 'Replace File' }}</label>
                        <input type="file" name="file" class="eventra-form-file">
                        @error('file') <p class="eventra-form-error">{{ $message }}</p> @enderror
                    </div>
                </div>
            </div>

            <div class="eventra-form-side-column">
                <div class="eventra-form-card">
                    <h3>{{ app()->getLocale() === 'id' ? 'Terkait Acara' : 'Related Event' }}</h3>

                    <div class="eventra-form-field">
                        <label>{{ app()->getLocale() === 'id' ? 'Acara' : 'Event' }}</label>
                        <select name="event_id" class="eventra-form-select">
                            <option value="">-- {{ app()->getLocale() === 'id' ? 'Pilih Acara' : 'Select Event' }} --</option>
                            @foreach ($events as $event)
                                <option value="{{ $event->id }}" @selected(old('event_id', $document->event_id) == $event->id)>{{ $event->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="eventra-form-actions">
                    <button type="submit" class="eventra-btn-primary">{{ __('messages.save') }}</button>
                    <a href="{{ route('admin.documents.index', ['locale' => app()->getLocale()]) }}" class="eventra-btn-secondary">{{ __('messages.cancel') }}</a>
                </div>
            </div>
        </div>
    </form>
@endsection
