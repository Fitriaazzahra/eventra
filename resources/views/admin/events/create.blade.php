@extends('layouts.admin')

@section('title', __('messages.add_event'))
@section('breadcrumb', __('messages.events') . ' / ' . __('messages.add_event'))

@section('content')
    <div class="eventra-heading-row">
        <div>
            <h1>{{ __('messages.add_event') }}</h1>
            <p>{{ app()->getLocale() === 'id' ? 'Tambahkan acara baru dan isi detail publikasi.' : 'Create a new event and complete its publication details.' }}</p>
        </div>
        <a href="{{ route('admin.events.index', ['locale' => app()->getLocale()]) }}" class="eventra-btn-secondary">
            {{ app()->getLocale() === 'id' ? 'Kembali' : 'Back' }}
        </a>
    </div>

    <form method="POST" action="{{ route('admin.events.store', ['locale' => app()->getLocale()]) }}" enctype="multipart/form-data" class="eventra-form-shell">
        @include('admin.events._form')
    </form>
@endsection