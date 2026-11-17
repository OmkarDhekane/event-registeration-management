<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'Events' }} | {{ config('app.name') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <a class="skip-link" href="#main-content">Skip to main content</a>

    <header class="site-header">
        <div class="container header-inner">
            <a class="site-name" href="{{ route('events.index') }}">Event Registration System</a>
            <a href="{{ route('login') }}">Admin sign in</a>
        </div>
    </header>

    <main id="main-content" class="container main-content" tabindex="-1">
        @yield('content')
    </main>
</body>
</html>
