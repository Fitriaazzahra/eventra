<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Document;
use App\Models\Event;
use App\Models\Participant;
use App\Models\Speaker;
use App\Models\Venue;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_events' => Event::count(),
            'upcoming_events' => Event::where('start_date', '>=', now())->count(),
            'participants' => Participant::count(),
            'speakers' => Speaker::count(),
            'venues' => Venue::count(),
            'documents' => Document::count(),
        ];

        $monthlyEvents = [];
        $maxMonthlyValue = 1;

        for ($i = 5; $i >= 0; $i--) {
            $monthDate = now()->copy()->subMonths($i)->startOfMonth();
            $monthValue = Event::whereBetween('start_date', [
                $monthDate->copy()->startOfMonth(),
                $monthDate->copy()->endOfMonth(),
            ])->count();

            $monthlyEvents[] = [
                'label' => $monthDate->translatedFormat('M'),
                'value' => $monthValue,
            ];

            $maxMonthlyValue = max($maxMonthlyValue, $monthValue);
        }

        return view('admin.dashboard', compact('stats', 'monthlyEvents', 'maxMonthlyValue'));
    }
}