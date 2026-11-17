<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreEventRequest;
use App\Models\Event;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;

class EventController extends Controller
{
    public function index(): View
    {
        $events = Event::query()
            ->where('is_published', false)
            ->orderBy('start_at')
            ->get();

        return view('admin.events.index', compact('events'));
    }

    public function create(): View
    {
        return view('admin.events.create');
    }

    public function store(StoreEventRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['slug'] = Str::slug($data['title']).'-'.Str::lower(Str::random(6));

        Event::query()->create($data);

        return to_route('admin.events.index')
            ->with('status', 'Event created as unpublished.');
    }

    public function confirmPublish(Event $event): View
    {
        abort_if($event->is_published, 404);

        return view('admin.events.confirm-publish', compact('event'));
    }

    public function publish(Event $event): RedirectResponse
    {
        abort_if($event->is_published, 404);

        $event->update([
            'is_published' => true,
            'published_at' => now(),
        ]);

        return to_route('admin.events.index')
            ->with('status', 'Event published to the public listing.');
    }
}
