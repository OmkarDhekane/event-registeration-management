@extends('layouts.public')

@section('content')
    <a class="back-link" href="{{ route('events.index') }}">Back to all events</a>

    <article class="event-detail">
        <p class="eyebrow">{{ ucfirst(str_replace('-', ' ', $event->format)) }} event</p>
        <h1>{{ $event->title }}</h1>

        <dl class="event-facts">
            <div>
                <dt>Date and time</dt>
                <dd>
                    <time datetime="{{ $event->start_at->toIso8601String() }}">{{ $event->start_at->format('F j, Y, g:i A') }}</time>
                    to
                    <time datetime="{{ $event->end_at->toIso8601String() }}">{{ $event->end_at->format('g:i A') }}</time>
                </dd>
            </div>
            <div>
                <dt>Format</dt>
                <dd>{{ ucfirst(str_replace('-', ' ', $event->format)) }}</dd>
            </div>
            <div>
                <dt>Location</dt>
                <dd>{{ $event->location_details }}</dd>
            </div>
        </dl>

        <div class="prose">
            <h2>About this event</h2>
            <p>{{ $event->description }}</p>
        </div>

        @if ($event->start_at->isFuture())
            <a class="button" href="{{ route('registrations.create', $event) }}">Register for this event</a>
        @else
            <p class="status-message">Registration is closed because this event has passed.</p>
        @endif
    </article>
@endsection
