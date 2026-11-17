@extends('layouts.public')

@section('content')
    <a class="back-link" href="{{ route('events.show', $event) }}">Back to event details</a>
    <h1>Register for {{ $event->title }}</h1>
    <p>All fields are required.</p>

    <x-error-summary />

    <form class="stacked-form" action="{{ route('registrations.store', $event) }}" method="POST" novalidate>
        @csrf

        <div class="field">
            <label for="name">Full name <span aria-hidden="true">*</span></label>
            <input id="name" name="name" type="text" value="{{ old('name') }}" required autocomplete="name"
                @error('name') aria-invalid="true" aria-describedby="name-error" @enderror>
            @error('name')
                <p class="field-error" id="name-error">{{ $message }}</p>
            @enderror
        </div>

        <div class="field">
            <label for="email">Email address <span aria-hidden="true">*</span></label>
            <input id="email" name="email" type="email" value="{{ old('email') }}" required autocomplete="email"
                @error('email') aria-invalid="true" aria-describedby="email-error" @enderror>
            @error('email')
                <p class="field-error" id="email-error">{{ $message }}</p>
            @enderror
        </div>

        <button class="button" type="submit">Complete registration</button>
    </form>
@endsection
