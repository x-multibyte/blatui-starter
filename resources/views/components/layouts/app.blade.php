@props(['title' => null, 'description' => null, 'favicon' => null])

        <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <title>{{ $title ? $title.' — '.config('app.name') : config('app.name') }}</title>
    <meta name="description" content="{{ $description }}"/>

    <link rel="icon" href="{{ $favicon }}" sizes="any"/>

    {{-- No-flash: apply every persisted theme dimension before first paint.
         A ?t= shared-theme link is decoded and adopted (persisted) up front so
         it both paints correctly and becomes the working theme. --}}
    <script>
        (function () {
            const root = document.documentElement;
            try {
                const p = new URLSearchParams(location.search).get('t');
                if (p) {
                    const shared = JSON.parse(atob(p.replace(/-/g, '+').replace(/_/g, '/')));
                    if (shared && typeof shared === 'object') {
                        ['mode', 'base', 'preset', 'radius', 'font', 'shadow', 'spacing', 'tracking', 'inputStyle', 'fontHeading']
                            .forEach((k) => {
                                if (shared[k] != null) localStorage.setItem('theme:' + k, String(shared[k]));
                            });
                    }
                }
            } catch (e) { /* malformed share link — ignore */
            }
            const get = (k, d) => localStorage.getItem('theme:' + k) || d;
            const mode = get('mode', 'system');
            const dark = mode === 'dark' || (mode === 'system' && matchMedia('(prefers-color-scheme: dark)').matches);
            root.classList.toggle('dark', dark);
            const set = (attr, val, fallback) => {
                if (val && val !== fallback) root.setAttribute(attr, val);
                else root.removeAttribute(attr);
            };
            set('data-base', get('base', 'neutral'), 'neutral');
            set('data-theme', get('preset', 'default'), 'default');
            set('data-font', get('font', 'sans'), 'sans');
            set('data-shadow', get('shadow', 'default'), 'default');
            set('data-spacing', get('spacing', 'default'), 'default');
            set('data-tracking', get('tracking', 'normal'), 'normal');
            set('data-input-style', get('inputStyle', 'outline'), 'outline');
            set('data-font-heading', get('fontHeading', 'sans'), 'sans');
            root.setAttribute('data-radius', get('radius', '0.625'));
        })();
    </script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body x-data class="bg-background text-foreground min-h-screen font-sans antialiased">
{{ $slot }}
</body>
</html>
