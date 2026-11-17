<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Http\Requests\Public\StoreRegistrationRequest;
use App\Models\Event;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class RegistrationController extends Controller
{
    public function create(Event $event): View
    {
        $this->ensureRegistrationIsOpen($event);

        return view('public.events.register', compact('event'));
    }

    public function store(StoreRegistrationRequest $request, Event $event): RedirectResponse
    {
        $this->ensureRegistrationIsOpen($event);

        $event->registrations()->create($request->validated());

        return to_route('registrations.confirmation', $event)
            ->with('registration_complete', true);
    }

    public function confirmation(Event $event): View|RedirectResponse
    {
        abort_unless($event->is_published, 404);

        if (! session('registration_complete')) {
            return to_route('events.show', $event);
        }

        return view('public.events.confirmation', compact('event'));
    }

    private function ensureRegistrationIsOpen(Event $event): void
    {
        abort_unless($event->is_published && $event->start_at->isFuture(), 404);
    }
}
