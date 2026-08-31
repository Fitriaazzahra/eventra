<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\UpdateEventRequest;
use App\Models\Event;
use App\Models\EventCategory;
use App\Models\Speaker;
use App\Models\Venue;
use Illuminate\Support\Str;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::with(['category', 'venue'])
            ->when(request('search'), fn ($q) => $q->where('name', 'like', '%' . request('search') . '%'))
            ->when(request('status'), fn ($q) => $q->where('status', request('status')))
            ->when(request('category'), fn ($q) => $q->where('category_id', request('category')))
            ->orderBy('start_date', 'desc')
            ->paginate(10)
            ->withQueryString();

        $categories = EventCategory::orderBy('name')->get();

        return view('admin.events.index', compact('events', 'categories'));
    }

    public function create()
    {
        $categories = EventCategory::orderBy('name')->get();
        $venues = Venue::orderBy('name')->get();
        $speakers = Speaker::orderBy('name')->get();

        return view('admin.events.create', compact('categories', 'venues', 'speakers'));
    }

    public function store(StoreEventRequest $request)
    {
        $data = $request->validated();
        $data['event_code'] = 'EVT-' . str_pad((Event::max('id') ?? 0) + 1, 5, '0', STR_PAD_LEFT);
        $data['slug'] = Str::slug($data['name']) . '-' . Str::random(5);
        $data['created_by'] = auth()->id();
        $data['is_featured'] = $request->boolean('is_featured');

        if ($request->hasFile('cover_image')) {
            $data['cover_image'] = $request->file('cover_image')->store('events', 'public');
        }

        $event = Event::create($data);
        $event->speakers()->sync($data['speakers'] ?? []);

        return redirect()
            ->route('admin.events.index', ['locale' => app()->getLocale()])
            ->with('success', app()->getLocale() === 'id' ? 'Acara berhasil dibuat.' : 'Event created successfully.');
    }

    public function edit(string $locale, Event $event)
    {
        $categories = EventCategory::orderBy('name')->get();
        $venues = Venue::orderBy('name')->get();
        $speakers = Speaker::orderBy('name')->get();
        $selectedSpeakers = $event->speakers->pluck('id')->toArray();

        return view('admin.events.edit', compact('event', 'categories', 'venues', 'speakers', 'selectedSpeakers'));
    }

    public function update(UpdateEventRequest $request, string $locale, Event $event)
    {
        $data = $request->validated();
        $data['is_featured'] = $request->boolean('is_featured');

        if ($request->hasFile('cover_image')) {
            $data['cover_image'] = $request->file('cover_image')->store('events', 'public');
        }

        $event->update($data);
        $event->speakers()->sync($data['speakers'] ?? []);

        return redirect()
            ->route('admin.events.index', ['locale' => app()->getLocale()])
            ->with('success', app()->getLocale() === 'id' ? 'Acara berhasil diperbarui.' : 'Event updated successfully.');
    }

    public function destroy(string $locale, Event $event)
    {
        $event->delete();

        return redirect()
            ->route('admin.events.index', ['locale' => app()->getLocale()])
            ->with('success', app()->getLocale() === 'id' ? 'Acara berhasil dihapus.' : 'Event deleted successfully.');
    }
}