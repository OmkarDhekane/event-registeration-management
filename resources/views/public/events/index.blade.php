@extends('layouts.public')

@section('content')
    <header class="page-heading">
        <p class="eyebrow">Upcoming events</p>
        <h1>Find an event</h1>
        <p>Search upcoming events and register for one that interests you.</p>
    </header>

    <form class="filter-form" action="{{ route('events.index') }}" method="GET" role="search">
        <div class="field">
            <label for="query">Search events</label>
            <input id="query" name="query" type="search" value="{{ $filters['query'] ?? '' }}">
        </div>

        <div class="field">
            <label for="format">Event format</label>
            <select id="format" name="format">
                <option value="">All formats</option>
                <option value="in-person" @selected(($filters['format'] ?? '') === 'in-person')>In person</option>
                <option value="online" @selected(($filters['format'] ?? '') === 'online')>Online</option>
                <option value="hybrid" @selected(($filters['format'] ?? '') === 'hybrid')>Hybrid</option>
            </select>
        </div>

        <div class="filter-actions">
            <button class="button" type="submit">Apply filters</button>
            <a href="{{ route('events.index') }}">Clear filters</a>
        </div>
    </form>

    <section aria-labelledby="results-heading">
        <div class="results-heading">
            <h2 id="results-heading">{{ $events->count() }} {{ Str::plural('event', $events->count()) }}</h2>
        </div>

        @if ($events->isEmpty())
            <p class="empty-state">No upcoming events match your search. Try changing or clearing the filters.</p>
        @else
            <div class="event-grid">
                @foreach ($events as $event)
                    <article class="event-card">
                        <p class="event-meta">
                            <time datetime="{{ $event->start_at->toIso8601String() }}">
                                {{ $event->start_at->format('F j, Y \a\t g:i A') }}
                            </time>
                        </p>
                        <h3><a href="{{ route('events.show', $event) }}">{{ $event->title }}</a></h3>
                        <p>{{ Str::limit($event->description, 150) }}</p>
                        <span class="tag">{{ ucfirst(str_replace('-', ' ', $event->format)) }}</span>
                    </article>
                @endforeach
            </div>
        @endif
    </section>
@endsection
