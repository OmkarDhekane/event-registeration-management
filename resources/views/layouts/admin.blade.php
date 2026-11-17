<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'Admin' }} | {{ config('app.name') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <a class="skip-link" href="#main-content">Skip to main content</a>

    <header class="site-header admin-header">
        <div class="container header-inner">
            <a class="site-name" href="{{ route('admin.events.index') }}">Event administration</a>
            <nav aria-label="Administrator navigation">
                <a href="{{ route('events.index') }}">Public events</a>
                @auth
                    <form class="inline-form" action="{{ route('admin.logout') }}" method="POST">
                        @csrf
                        <button class="button-link" type="submit">Sign out</button>
                    </form>
                @endauth
            </nav>
        </div>
    </header>

    <main id="main-content" class="container main-content" tabindex="-1">
        @if (session('status'))
            <p class="status-message" role="status">{{ session('status') }}</p>
        @endif

        @yield('content')
    </main>
</body>
</html>
