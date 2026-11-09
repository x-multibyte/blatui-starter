@props([
    'title' => null,
    'heading' => null,
    'description' => null,
])

<x-layouts.app :title="$title ?? $heading">
    <div class="bg-muted/40 flex min-h-svh w-full flex-col items-center justify-center gap-6 p-6 md:p-10">
        <a href="{{ route('home') }}" class="flex items-center gap-2 font-semibold tracking-tight">
            <span class="bg-primary text-primary-foreground flex size-7 items-center justify-center rounded-md">
                <x-lucide-command class="size-4" />
            </span>
            {{ config('app.name') }}
        </a>

        <div class="w-full max-w-sm">
            <x-ui.card variant="sectioned">
                @if ($heading || $description)
                    <x-ui.card-header>
                        @if ($heading)
                            <x-ui.card-title class="text-xl">{{ $heading }}</x-ui.card-title>
                        @endif
                        @if ($description)
                            <x-ui.card-description>{{ $description }}</x-ui.card-description>
                        @endif
                    </x-ui.card-header>
                @endif
                <x-ui.card-content>
                    {{ $slot }}
                </x-ui.card-content>
            </x-ui.card>
        </div>
    </div>
</x-layouts.app>
