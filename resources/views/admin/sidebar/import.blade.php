@extends('layouts.admin')

@section('title', __('messages.import'))
@section('breadcrumb', __('messages.import'))

@section('content')
    <div class="eventra-heading-row">
        <div>
            <h1>{{ __('messages.import') }}</h1>
            <p>{{ app()->getLocale() === 'id' ? 'Impor data event, peserta, dan dokumen dari file eksternal.' : 'Import event, participant, and document data from external files.' }}</p>
        </div>
    </div>

    <div class="eventra-form-card">
        <div class="eventra-table-wrap">
            <div class="eventra-empty-state">
                <p>{{ app()->getLocale() === 'id' ? 'Fitur impor data siap digunakan.' : 'Import feature is ready to use.' }}</p>
                <button type="button" class="eventra-add-btn eventra-add-btn-inline">{{ __('messages.import') }}</button>
            </div>
        </div>
    </div>
@endsection
