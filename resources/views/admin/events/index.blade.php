@extends('layouts.admin')

@section('content')
    <div class="page-heading with-action">
        <div>
            <p class="eyebrow">Administrator</p>
            <h1>Unpublished events</h1>
        </div>
        <a class="button" href="{{ route('admin.events.create') }}">Create an event</a>
    </div>

    @if ($events->isEmpty())
        <p class="empty-state">There are no unpublished events. Create an event to get started.</p>
    @else
        <div class="admin-list">
            @foreach ($events as $event)
                <article class="admin-list-item">
                    <div>
                        <p class="tag">Unpublished</p>
                        <h2>{{ $event->title }}</h2>
                        <p>{{ $event->start_at->format('F j, Y \a\t g:i A') }}</p>
                    </div>
                    <a class="button button-secondary" href="{{ route('admin.events.publish.confirm', $event) }}">
                        Review and publish
                    </a>
                </article>
            @endforeach
        </div>
    @endif
@endsection
