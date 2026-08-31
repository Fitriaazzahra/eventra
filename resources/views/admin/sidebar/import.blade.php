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
            {{-- Form untuk upload file --}}
            <form action="{{ route('admin.import.process') }}" method="POST" enctype="multipart/form-data" class="eventra-empty-state" style="padding: 40px 20px;">
                @csrf
                
                <p class="mb-3">{{ app()->getLocale() === 'id' ? 'Pilih file Excel atau CSV untuk mengimpor data:' : 'Select an Excel or CSV file to import data:' }}</p>
                
                {{-- Input File --}}
                <div class="mb-4">
                    <input type="file" name="file" accept=".xlsx, .xls, .csv" required style="padding: 10px; border: 1px dashed #dcd0ff; border-radius: 8px; background-color: #fcfaff; cursor: pointer;">
                </div>

                {{-- Tombol Submit --}}
                <button type="submit" class="eventra-add-btn eventra-add-btn-inline">
                    {{ __('messages.import') }}
                </button>
            </form>
        </div>
    </div>
@endsection