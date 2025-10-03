<!-- filepath: c:\laragon\www\PT Sena\resources\views\app.blade.php -->
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title inertia>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Font Awesome - Official CDN -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.4.0/css/all.css">

    <!-- Disable browser scroll restoration on reload and force start at top -->
    <script>
        (function() {
            try {
                if ('scrollRestoration' in history) {
                    history.scrollRestoration = 'manual';
                }
            } catch (e) {}

            function snapTop() {
                if (location.hash) return;
                var docEl = document.scrollingElement || document.documentElement;
                // Temporarily disable smooth behavior
                var prev = docEl.style.scrollBehavior;
                docEl.style.scrollBehavior = 'auto';
                window.scrollTo({
                    top: 0,
                    left: 0,
                    behavior: 'auto'
                });
                // Restore previous behavior
                docEl.style.scrollBehavior = prev;
            }

            // Try multiple times in early frames to defeat late restores/layout
            function snapLoop(frames) {
                if (location.hash) return;
                snapTop();
                if (frames > 0) requestAnimationFrame(function() {
                    snapLoop(frames - 1);
                });
            }

            window.addEventListener('load', function() {
                snapLoop(8);
            }, {
                once: true
            });
            window.addEventListener('pageshow', function(e) {
                if (!location.hash && (e && e.persisted)) snapLoop(8);
            });
        })();
    </script>

    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-X6JE07K5MZ"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'G-X6JE07K5MZ');
    </script>

    <!-- Scripts -->
    @routes
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @inertiaHead
</head>

<body class="font-sans antialiased">
    @inertia
</body>

</html>
