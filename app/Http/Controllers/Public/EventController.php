<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index(Request $request): View
    {
        $filters = $request->validate([
            'query' => ['nullable', 'string', 'max:100'],
            'format' => ['nullable', 'in:in-person,online,hybrid'],
        ]);

        $events = Event::query()
            ->published()
            ->upcoming()
            ->when($filters['query'] ?? null, function ($query, string $search): void {
                $query->where(function ($query) use ($search): void {
                    $query->where('title', 'like', "%{$search}%")
                        ->orWhere('description', 'like', "%{$search}%");
                });
            })
            ->when($filters['format'] ?? null, fn ($query, string $format) => $query->where('format', $format))
            ->orderBy('start_at')
            ->get();

        return view('public.events.index', [
            'events' => $events,
            'filters' => $filters,
        ]);
    }

    public function show(Event $event): View
    {
        abort_unless($event->is_published, 404);

        return view('public.events.show', compact('event'));
    }
}
