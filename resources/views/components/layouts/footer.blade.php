{{-- Source: https://blatui.remix-it.com/templates/saas --}}
@props([
    'footer' => null,
])

@php
    $footerColumns = $footer ?? config('blatui.footer', []);
@endphp

<footer class="border-t">
    <div class="mx-auto max-w-6xl px-6 py-14">
        <div class="grid gap-10 sm:grid-cols-2 lg:grid-cols-6">
            <div class="lg:col-span-2">
                <a href="{{ route('home') }}" class="flex items-center gap-2 font-semibold">
                    <span class="bg-primary text-primary-foreground flex size-8 items-center justify-center rounded-lg">
                        <x-lucide-cloud class="size-5" />
                    </span>
                    {{ config('app.name') }}
                </a>
                <p class="text-muted-foreground mt-3 max-w-xs text-sm">
                    Analytics, automation and collaboration for modern teams.
                </p>
                <div class="mt-5 flex gap-2">
                    @foreach (['github', 'twitter', 'linkedin', 'youtube'] as $s)
                        <a
                            href="#"
                            aria-label="{{ $s }}"
                            class="text-muted-foreground hover:text-foreground hover:bg-accent inline-flex size-9 items-center justify-center rounded-md border transition-colors"
                        >
                            <x-dynamic-component :component="'lucide-'.$s" class="size-4" />
                        </a>
                    @endforeach
                </div>
            </div>
            @foreach ($footerColumns as $heading => $links)
                <div>
                    <h3 class="text-sm font-semibold">{{ $heading }}</h3>
                    <ul class="mt-3 space-y-2 text-sm">
                        @foreach ($links as $key => $link)
                            @php
                                $label = is_int($key) ? $link : $key;
                                $href = is_int($key) ? '#' : $link;
                            @endphp
                            <li>
                                <a
                                    href="{{ $href }}"
                                    class="text-muted-foreground hover:text-foreground transition-colors"
                                >{{ $label }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endforeach
        </div>
        <x-ui.separator class="my-8" />
        <div class="text-muted-foreground flex flex-col items-center justify-between gap-3 text-sm sm:flex-row">
            <span>© {{ date('Y') }} {{ config('app.name') }}, Inc. All rights reserved.</span>
            <span class="flex items-center gap-1.5"><x-lucide-shield-check class="size-4" /> SOC 2 Type II · GDPR ready</span>
        </div>
    </div>
</footer>
