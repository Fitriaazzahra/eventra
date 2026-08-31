@extends('layouts.admin')

@section('title', __('messages.export'))
@section('breadcrumb', __('messages.export'))

@section('content')
    <div class="eventra-heading-row">
        <div>
            <h1>{{ __('messages.export') }}</h1>
            <p>{{ app()->getLocale() === 'id' ? 'Ekspor data event, peserta, dan dokumen ke format yang dapat dibagikan.' : 'Export event, participant, and document data to shareable formats.' }}</p>
        </div>
    </div>

    <div class="eventra-form-card">
        <div class="eventra-table-wrap">
            <div class="eventra-empty-state">
                <p>{{ app()->getLocale() === 'id' ? 'Fitur ekspor data siap digunakan.' : 'Export feature is ready to use.' }}</p>
                
                {{-- Diubah menjadi link unduh Excel --}}
                <a href="{{ route('admin.export.download') }}" class="eventra-add-btn eventra-add-btn-inline" style="display: inline-block; text-decoration: none;">
                    {{ __('messages.export') }}
                </a>
            </div>
        </div>
    </div>
@endsection