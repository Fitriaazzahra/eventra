@csrf

<div class="eventra-form-layout">
    <div class="eventra-form-main-column">
        <div class="eventra-form-card">
            <h3>{{ app()->getLocale() === 'id' ? 'Informasi Dasar' : 'Basic Information' }}</h3>

            <div class="eventra-form-field">
                <label>{{ app()->getLocale() === 'id' ? 'Nama Acara' : 'Event Name' }} *</label>
                <input type="text" name="name" value="{{ old('name', $event->name ?? '') }}" class="eventra-form-input" required>
                @error('name') <p class="eventra-form-error">{{ $message }}</p> @enderror
            </div>

            <div class="eventra-form-field">
                <label>{{ app()->getLocale() === 'id' ? 'Kategori' : 'Category' }} *</label>
                <select name="category_id" class="eventra-form-select" required>
                    <option value="">-- {{ app()->getLocale() === 'id' ? 'Pilih Kategori' : 'Select Category' }} --</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" @selected(old('category_id', $event->category_id ?? '') == $category->id)>{{ $category->name }}</option>
                    @endforeach
                </select>
                @error('category_id') <p class="eventra-form-error">{{ $message }}</p> @enderror
            </div>

            <div class="eventra-form-field">
                <label>{{ app()->getLocale() === 'id' ? 'Deskripsi' : 'Description' }}</label>
                <textarea name="description" rows="4" class="eventra-form-textarea">{{ old('description', $event->description ?? '') }}</textarea>
            </div>

            <div class="eventra-form-field">
                <label>{{ app()->getLocale() === 'id' ? 'Cover Image' : 'Cover Image' }}</label>
                <input type="file" name="cover_image" accept="image/*" class="eventra-form-file">
                @error('cover_image') <p class="eventra-form-error">{{ $message }}</p> @enderror
            </div>
        </div>

        <div class="eventra-form-card">
            <h3>{{ app()->getLocale() === 'id' ? 'Jadwal' : 'Schedule' }}</h3>
            <div class="eventra-form-grid">
                <div class="eventra-form-field">
                    <label>{{ app()->getLocale() === 'id' ? 'Tanggal Mulai' : 'Start Date' }} *</label>
                    <input type="date" name="start_date" value="{{ old('start_date', isset($event) ? $event->start_date?->format('Y-m-d') : '') }}" class="eventra-form-input" required>
                </div>
                <div class="eventra-form-field">
                    <label>{{ app()->getLocale() === 'id' ? 'Tanggal Selesai' : 'End Date' }}</label>
                    <input type="date" name="end_date" value="{{ old('end_date', isset($event) ? $event->end_date?->format('Y-m-d') : '') }}" class="eventra-form-input">
                </div>
                <div class="eventra-form-field">
                    <label>{{ app()->getLocale() === 'id' ? 'Jam Mulai' : 'Start Time' }}</label>
                    <input type="time" name="start_time" value="{{ old('start_time', $event->start_time ?? '') }}" class="eventra-form-input">
                </div>
                <div class="eventra-form-field">
                    <label>{{ app()->getLocale() === 'id' ? 'Jam Selesai' : 'End Time' }}</label>
                    <input type="time" name="end_time" value="{{ old('end_time', $event->end_time ?? '') }}" class="eventra-form-input">
                </div>
            </div>
        </div>

        <div class="eventra-form-card">
            <h3>{{ __('messages.speakers') }}</h3>
            <div class="eventra-form-field">
                <select name="speakers[]" multiple class="eventra-form-select eventra-form-select-multi">
                    @foreach ($speakers as $speaker)
                        <option value="{{ $speaker->id }}" @selected(in_array($speaker->id, old('speakers', $selectedSpeakers ?? [])))>{{ $speaker->name }} — {{ $speaker->company }}</option>
                    @endforeach
                </select>
            </div>
            <p class="eventra-form-hint">{{ app()->getLocale() === 'id' ? 'Tahan Ctrl (Windows) / Cmd (Mac) untuk pilih lebih dari satu.' : 'Hold Ctrl (Windows) / Cmd (Mac) to select multiple.' }}</p>
        </div>
    </div>

    <div class="eventra-form-side-column">
        <div class="eventra-form-card">
            <h3>{{ __('messages.venues') }}</h3>
            <div class="eventra-form-field">
                <label>{{ app()->getLocale() === 'id' ? 'Venue' : 'Venue' }}</label>
                <select name="venue_id" class="eventra-form-select" required>
                    <option value="">-- {{ app()->getLocale() === 'id' ? 'Pilih Venue' : 'Select Venue' }} --</option>
                    @foreach ($venues as $venue)
                        <option value="{{ $venue->id }}" @selected(old('venue_id', $event->venue_id ?? '') == $venue->id)>{{ $venue->name }} — {{ $venue->city }}</option>
                    @endforeach
                </select>
            </div>

            <div class="eventra-form-field">
                <label>{{ app()->getLocale() === 'id' ? 'Kapasitas' : 'Capacity' }}</label>
                <input type="number" name="capacity" min="1" value="{{ old('capacity', $event->capacity ?? '') }}" class="eventra-form-input">
            </div>
        </div>

        <div class="eventra-form-card">
            <h3>{{ app()->getLocale() === 'id' ? 'Tiket' : 'Ticket' }}</h3>
            <div class="eventra-form-field">
                <label>{{ app()->getLocale() === 'id' ? 'Harga Tiket (Rp)' : 'Ticket Price' }}</label>
                <input type="number" name="ticket_price" min="0" value="{{ old('ticket_price', $event->ticket_price ?? 0) }}" class="eventra-form-input">
            </div>
        </div>

        <div class="eventra-form-card">
            <h3>{{ app()->getLocale() === 'id' ? 'Status' : 'Status' }}</h3>
            <div class="eventra-form-field">
                <select name="status" class="eventra-form-select" required>
                    @php
                        $statuses = ['draft' => 'Draft', 'published' => 'Published', 'completed' => 'Completed', 'cancelled' => 'Cancelled'];
                    @endphp
                    @foreach ($statuses as $value => $label)
                        <option value="{{ $value }}" @selected(old('status', $event->status ?? 'draft') === $value)>{{ $label }}</option>
                    @endforeach
                </select>
            </div>

            <div class="eventra-form-field">
                <label class="eventra-toggle-wrap">
                    <input type="checkbox" name="is_featured" value="1" @checked(old('is_featured', isset($event) ? $event->is_featured : false))>
                    <span>{{ app()->getLocale() === 'id' ? 'Tampilkan sebagai Acara Unggulan' : 'Show as Featured Event' }}</span>
                </label>
            </div>
        </div>

        <div class="eventra-form-actions">
            <button type="submit" class="eventra-btn-primary">{{ __('messages.save') }}</button>
            <a href="{{ route('admin.events.index', ['locale' => app()->getLocale()]) }}" class="eventra-btn-secondary">{{ __('messages.cancel') }}</a>
        </div>
    </div>
</div>