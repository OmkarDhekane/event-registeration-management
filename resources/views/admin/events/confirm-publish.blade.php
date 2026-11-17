@extends('layouts.admin')

@section('content')
    <a class="back-link" href="{{ route('admin.events.index') }}">Back to dashboard</a>

    <div class="narrow-panel">
        <p class="eyebrow">Confirm publication</p>
        <h1>Publish {{ $event->title }}?</h1>
        <p>Publishing makes this event visible on the public event listing.</p>

        <dl class="event-facts">
            <div>
                <dt>Date and time</dt>
                <dd>{{ $event->start_at->format('F j, Y, g:i A') }}</dd>
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

        <div class="button-group">
            <form action="{{ route('admin.events.publish', $event) }}" method="POST">
                @csrf
                <button class="button" type="submit">Publish event</button>
            </form>
            <a class="button button-secondary" href="{{ route('admin.events.index') }}">Keep unpublished</a>
        </div>
    </div>
@endsection
