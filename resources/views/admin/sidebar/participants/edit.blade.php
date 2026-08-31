@extends('layouts.admin')

@section('title', app()->getLocale() === 'id' ? 'Edit Peserta' : 'Edit Participant')
@section('breadcrumb', app()->getLocale() === 'id' ? 'Peserta / Edit' : 'Participants / Edit')

@section('content')
    <div class="eventra-heading-row">
        <div>
            <h1>{{ app()->getLocale() === 'id' ? 'Edit Peserta' : 'Edit Participant' }}</h1>
            <p>{{ app()->getLocale() === 'id' ? 'Perbarui data pendaftaran peserta.' : 'Update participant registration details.' }}</p>
        </div>
        <a href="{{ route('admin.participants.index', ['locale' => app()->getLocale()]) }}" class="eventra-btn-secondary">
            {{ app()->getLocale() === 'id' ? 'Kembali' : 'Back' }}
        </a>
    </div>

    <form method="POST" action="{{ route('admin.participants.update', ['locale' => app()->getLocale(), 'participant' => $participant->id]) }}" class="eventra-form-shell">
        @csrf
        @method('PUT')

        <div class="eventra-form-layout">
            <div class="eventra-form-main-column">
                <div class="eventra-form-card">
                    <h3>{{ app()->getLocale() === 'id' ? 'Data Peserta' : 'Participant Data' }}</h3>

                    <div class="eventra-form-grid">
                        <div class="eventra-form-field">
                            <label>{{ app()->getLocale() === 'id' ? 'Kode Peserta' : 'Participant Code' }} *</label>
                            <input type="text" name="participant_code" value="{{ old('participant_code', $participant->participant_code) }}" class="eventra-form-input" required>
                            @error('participant_code') <p class="eventra-form-error">{{ $message }}</p> @enderror
                        </div>
                        <div class="eventra-form-field">
                            <label>{{ app()->getLocale() === 'id' ? 'Nama' : 'Name' }} *</label>
                            <input type="text" name="name" value="{{ old('name', $participant->name) }}" class="eventra-form-input" required>
                            @error('name') <p class="eventra-form-error">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div class="eventra-form-grid">
                        <div class="eventra-form-field">
                            <label>{{ app()->getLocale() === 'id' ? 'Email' : 'Email' }} *</label>
                            <input type="email" name="email" value="{{ old('email', $participant->email) }}" class="eventra-form-input" required>
                            @error('email') <p class="eventra-form-error">{{ $message }}</p> @enderror
                        </div>
                        <div class="eventra-form-field">
                            <label>{{ app()->getLocale() === 'id' ? 'Telepon' : 'Phone' }}</label>
                            <input type="text" name="phone" value="{{ old('phone', $participant->phone) }}" class="eventra-form-input">
                        </div>
                    </div>
                </div>
            </div>

            <div class="eventra-form-side-column">
                <div class="eventra-form-card">
                    <h3>{{ app()->getLocale() === 'id' ? 'Detail Acara' : 'Event Details' }}</h3>

                    <div class="eventra-form-field">
                        <label>{{ app()->getLocale() === 'id' ? 'Acara' : 'Event' }} *</label>
                        <select name="event_id" class="eventra-form-select" required>
                            <option value="">-- {{ app()->getLocale() === 'id' ? 'Pilih Acara' : 'Select Event' }} --</option>
                            @foreach ($events as $event)
                                <option value="{{ $event->id }}" @selected(old('event_id', $participant->event_id) == $event->id)>{{ $event->name }}</option>
                            @endforeach
                        </select>
                        @error('event_id') <p class="eventra-form-error">{{ $message }}</p> @enderror
                    </div>

                    <div class="eventra-form-field">
                        <label>{{ app()->getLocale() === 'id' ? 'Tipe Tiket' : 'Ticket Type' }} *</label>
                        <input type="text" name="ticket_type" value="{{ old('ticket_type', $participant->ticket_type) }}" class="eventra-form-input" required>
                    </div>

                    <div class="eventra-form-field">
                        <label>{{ app()->getLocale() === 'id' ? 'Tanggal Pendaftaran' : 'Registration Date' }} *</label>
                        <input type="date" name="registration_date" value="{{ old('registration_date', $participant->registration_date?->format('Y-m-d')) }}" class="eventra-form-input" required>
                    </div>

                    <div class="eventra-form-field">
                        <label>{{ app()->getLocale() === 'id' ? 'Status' : 'Status' }}</label>
                        <select name="status" class="eventra-form-select">
                            <option value="Registered" @selected(old('status', $participant->status) === 'Registered')>Registered</option>
                            <option value="Confirmed" @selected(old('status', $participant->status) === 'Confirmed')>Confirmed</option>
                            <option value="Cancelled" @selected(old('status', $participant->status) === 'Cancelled')>Cancelled</option>
                            <option value="Attended" @selected(old('status', $participant->status) === 'Attended')>Attended</option>
                        </select>
                    </div>
                </div>

                <div class="eventra-form-actions">
                    <button type="submit" class="eventra-btn-primary">{{ __('messages.save') }}</button>
                    <a href="{{ route('admin.participants.index', ['locale' => app()->getLocale()]) }}" class="eventra-btn-secondary">{{ __('messages.cancel') }}</a>
                </div>
            </div>
        </div>
    </form>
@endsection
