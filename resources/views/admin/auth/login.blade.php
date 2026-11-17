@extends('layouts.admin')

@section('content')
    <div class="narrow-panel">
        <h1>Administrator sign in</h1>
        <p>Sign in to create and publish events.</p>

        <x-error-summary />

        <form class="stacked-form" action="{{ route('login.store') }}" method="POST" novalidate>
            @csrf

            <div class="field">
                <label for="email">Email address</label>
                <input id="email" name="email" type="email" value="{{ old('email') }}" required autocomplete="username"
                    @error('email') aria-invalid="true" aria-describedby="email-error" @enderror>
                @error('email')
                    <p class="field-error" id="email-error">{{ $message }}</p>
                @enderror
            </div>

            <div class="field">
                <label for="password">Password</label>
                <input id="password" name="password" type="password" required autocomplete="current-password"
                    @error('password') aria-invalid="true" aria-describedby="password-error" @enderror>
                @error('password')
                    <p class="field-error" id="password-error">{{ $message }}</p>
                @enderror
            </div>

            <button class="button" type="submit">Sign in</button>
        </form>
    </div>
@endsection
