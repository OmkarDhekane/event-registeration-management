@extends('layouts.public')

@section('content')
    <div class="confirmation-panel">
        <p class="eyebrow">Registration complete</p>
        <h1>You are registered</h1>
        <p>Your registration for <strong>{{ $event->title }}</strong> has been received.</p>
        <a class="button" href="{{ route('events.index') }}">Browse more events</a>
    </div>
@endsection
