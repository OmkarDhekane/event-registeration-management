@extends('layouts.admin')

@section('content')
    <a class="back-link" href="{{ route('admin.events.index') }}">Back to dashboard</a>
    <h1>Create an event</h1>
    <p>All fields are required. New events remain unpublished until you publish them from the dashboard.</p>

    <x-error-summary />

    <form class="stacked-form wide-form" action="{{ route('admin.events.store') }}" method="POST" novalidate>
        @csrf

        <div class="field">
            <label for="title">Event title</label>
            <input id="title" name="title" type="text" value="{{ old('title') }}" required
                @error('title') aria-invalid="true" aria-describedby="title-error" @enderror>
            @error('title')<p class="field-error" id="title-error">{{ $message }}</p>@enderror
        </div>

        <div class="field">
            <label for="description">Description</label>
            <textarea id="description" name="description" rows="7" required
                @error('description') aria-invalid="true" aria-describedby="description-error" @enderror>{{ old('description') }}</textarea>
            @error('description')<p class="field-error" id="description-error">{{ $message }}</p>@enderror
        </div>

        <div class="form-grid">
            <div class="field">
                <label for="start_at">Start date and time</label>
                <input id="start_at" name="start_at" type="datetime-local" value="{{ old('start_at') }}" required
                    @error('start_at') aria-invalid="true" aria-describedby="start_at-error" @enderror>
                @error('start_at')<p class="field-error" id="start_at-error">{{ $message }}</p>@enderror
            </div>

            <div class="field">
                <label for="end_at">End date and time</label>
                <input id="end_at" name="end_at" type="datetime-local" value="{{ old('end_at') }}" required
                    @error('end_at') aria-invalid="true" aria-describedby="end_at-error" @enderror>
                @error('end_at')<p class="field-error" id="end_at-error">{{ $message }}</p>@enderror
            </div>
        </div>

        <div class="field">
            <label for="format">Event format</label>
            <select id="format" name="format" required @error('format') aria-invalid="true" aria-describedby="format-error" @enderror>
                <option value="">Select a format</option>
                <option value="in-person" @selected(old('format') === 'in-person')>In person</option>
                <option value="online" @selected(old('format') === 'online')>Online</option>
                <option value="hybrid" @selected(old('format') === 'hybrid')>Hybrid</option>
            </select>
            @error('format')<p class="field-error" id="format-error">{{ $message }}</p>@enderror
        </div>

        <div class="field">
            <label for="location_details">Location or online-delivery details</label>
            <input id="location_details" name="location_details" type="text" value="{{ old('location_details') }}" required
                @error('location_details') aria-invalid="true" aria-describedby="location_details-error" @enderror>
            @error('location_details')<p class="field-error" id="location_details-error">{{ $message }}</p>@enderror
        </div>

        <button class="button" type="submit">Create unpublished event</button>
    </form>
@endsection
