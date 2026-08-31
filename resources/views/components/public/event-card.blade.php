@props(['event'])

<article class="group overflow-hidden rounded-[22px] border border-border bg-white shadow-sm transition-all duration-200 hover:-translate-y-1 hover:shadow-lg">
    <div class="relative overflow-hidden">
        <img src="{{ $event->cover_image ?: 'https://images.unsplash.com/photo-1492684223066-81342ee5ff30?auto=format&fit=crop&w=1200&q=80' }}" alt="{{ $event->name }}" class="h-56 w-full object-cover transition duration-300 group-hover:scale-105" />
        <div class="absolute left-4 top-4 inline-flex rounded-full bg-white/90 px-2.5 py-1 text-[11px] font-semibold text-primary-dark shadow-sm backdrop-blur-sm">
            {{ $event->category?->name ?? 'Event' }}
        </div>
    </div>

    <div class="space-y-4 p-5">
        <div class="space-y-2">
            <h3 class="text-xl font-semibold text-text line-clamp-2">{{ $event->name }}</h3>
            <div class="flex items-center gap-2 text-sm text-text-muted">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3M5 11h14M5 19h14a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2Z" /></svg>
                <span>{{ $event->start_date?->translatedFormat('d M Y') ?? 'TBD' }}</span>
            </div>
            <div class="flex items-center gap-2 text-sm text-text-muted">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 21s-6.716-4.35-9.192-7.89C.97 11.11 2.17 7 6.41 7c2.308 0 3.74 1.34 4.59 2.4.85-1.06 2.282-2.4 4.59-2.4 4.24 0 5.44 4.11 3.602 6.11C18.716 16.65 12 21 12 21Z" /></svg>
                <span>{{ $event->venue?->city ?? 'Location' }}</span>
            </div>
        </div>

        <div class="flex items-center justify-between border-t border-border pt-4">
            <div>
                <div class="text-[11px] uppercase tracking-[0.12em] text-text-muted">{{ app()->getLocale() === 'id' ? 'Harga' : 'Price' }}</div>
                <div class="text-lg font-bold text-text">{{ $event->ticket_price > 0 ? 'Rp' . number_format($event->ticket_price, 0, ',', '.') : (app()->getLocale() === 'id' ? 'Gratis' : 'Free') }}</div>
            </div>
            <a href="{{ route('public.events.show', ['locale' => app()->getLocale(), 'slug' => $event->slug]) }}" class="inline-flex items-center rounded-full bg-primary/10 px-3.5 py-2 text-sm font-semibold text-primary-dark transition hover:bg-primary hover:text-white">
                {{ app()->getLocale() === 'id' ? 'Lihat' : 'View' }}
            </a>
        </div>
    </div>
</article>
