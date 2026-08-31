@extends('layouts.admin')

@section('title', __('messages.edit') . ' ' . $event->name)
@section('breadcrumb', __('messages.events') . ' / ' . __('messages.edit'))

@section('content')
    <div class="eventra-heading-row">
        <div>
            <h1>{{ __('messages.edit') }}: {{ $event->name }}</h1>
            <p>{{ app()->getLocale() === 'id' ? 'Perbarui informasi acara, jadwal, dan status publikasi.' : 'Update event information, scheduling, and publication status.' }}</p>
        </div>
        <a href="{{ route('admin.events.index', ['locale' => app()->getLocale()]) }}" class="eventra-btn-secondary">
            {{ app()->getLocale() === 'id' ? 'Kembali' : 'Back' }}
        </a>
    </div>

    <form method="POST" action="{{ route('admin.events.update', ['locale' => app()->getLocale(), 'event' => $event->id]) }}" enctype="multipart/form-data" class="eventra-form-shell">
        @method('PUT')
        @include('admin.events._form')
    </form>
@endsection