<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\EventCategory;
use App\Models\SiteAboutSetting;
use Illuminate\Http\Request;
use App\Models\Participant; 
use App\Models\Speaker;
use Illuminate\Support\Str;

class PublicPageController extends Controller
{
    public function home()
    {
        $featuredEvents = Event::with(['category', 'venue'])
            ->where('status', 'published')
            ->where('is_featured', true)
            ->orderBy('start_date', 'asc')
            ->limit(3)
            ->get();

        if ($featuredEvents->isEmpty()) {
            $featuredEvents = Event::with(['category', 'venue'])
                ->where('status', 'published')
                ->orderBy('start_date', 'asc')
                ->limit(3)
                ->get();
        }

        $upcomingEvents = Event::with(['category', 'venue'])
            ->orderBy('start_date', 'asc')
            ->limit(4)
            ->get();

        $categories = EventCategory::orderBy('name')->get();
        $speakers = Speaker::orderBy('name')->limit(4)->get();

        return view('public.home', compact('featuredEvents', 'upcomingEvents', 'categories', 'speakers'));
    }

    public function events()
    {
        $events = Event::with(['category', 'venue'])
            ->orderBy('start_date', 'asc')
            ->paginate(9)
            ->withQueryString();

        $categories = EventCategory::orderBy('name')->get();

        return view('public.events', compact('events', 'categories'));
    }

public function showEvent(string $locale, string $slug)
{
    $event = Event::with(['category', 'venue', 'speakers'])
        ->where('slug', $slug)
        ->firstOrFail();

    $relatedEvents = Event::with(['category', 'venue'])
        ->where('id', '!=', $event->id)
        ->orderBy('start_date', 'asc')
        ->limit(3)
        ->get();

    return view('public.event-detail', compact('event', 'relatedEvents'));
}

public function registerEvent(Request $request, string $locale, string $slug)
{
    $event = Event::where('slug', $slug)->firstOrFail();

    $validated = $request->validate([
        'name'  => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'phone' => 'nullable|string|max:30',
    ]);

    Participant::create([
        'participant_code'  => 'PTC-' . strtoupper(Str::random(8)),
        'name'              => $validated['name'],
        'email'             => $validated['email'],
        'phone'             => $validated['phone'] ?? null,
        'event_id'          => $event->id,
        'ticket_type'       => 'regular',
        'registration_date' => now()->toDateString(),
        'status'            => 'registered',
    ]);

    return back()->with('success', $locale === 'id'
        ? 'Pendaftaran berhasil! Sampai jumpa di acara.'
        : 'Registration successful! See you at the event.');
}

    public function speakers()
    {
        $speakers = Speaker::orderBy('name')->get();

        return view('public.speakers', compact('speakers'));
    }

    public function about()
    {
        $settings = SiteAboutSetting::orderBy('sort_order')->get()->keyBy('key');

        $stats = [
            ['label' => app()->getLocale() === 'id' ? 'Acara' : 'Events', 'value' => '120+'],
            ['label' => app()->getLocale() === 'id' ? 'Komunitas' : 'Communities', 'value' => '35'],
            ['label' => app()->getLocale() === 'id' ? 'Kota' : 'Cities', 'value' => '14'],
            ['label' => app()->getLocale() === 'id' ? 'Pembicara' : 'Speakers', 'value' => '90+'],
        ];

        return view('public.about', compact('settings', 'stats'));
    }

    public function profile()
    {
        $profile = [
            'name' => 'Alya Putri',
            'email' => 'alya@eventra.com',
            'location' => 'Jakarta, Indonesia',
            'member_since' => 'Januari 2025',
            'bio' => 'Event enthusiast yang suka mengikuti komunitas startup, creator, dan pengalaman live yang berdampak.',
        ];

        $tickets = [
            ['title' => 'Tech & Startup Summit 2026', 'date' => '18 Aug 2026', 'status' => 'Confirmed'],
            ['title' => 'Creator Growth Workshop', 'date' => '24 Sep 2026', 'status' => 'Pending'],
        ];

        $savedEvents = [
            ['title' => 'Women in Product Night', 'date' => '12 Oct 2026', 'tag' => 'Community'],
            ['title' => 'Indonesia Design Week', 'date' => '18 Oct 2026', 'tag' => 'Design'],
            ['title' => 'Future of AI Forum', 'date' => '29 Oct 2026', 'tag' => 'AI'],
        ];

        return view('public.profile', compact('profile', 'tickets', 'savedEvents'));
    }
}
