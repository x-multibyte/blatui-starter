{{-- Source: https://blatui.remix-it.com/templates/saas --}}
@props([
    'nav' => null,
])

@php
    $rawNav = $nav ?? config('blatui.navigation', []);
    $navItems = [];

    foreach ($rawNav as $key => $value) {
        if (is_array($value)) {
            $navItems[] = [
                'label' => $value['title'] ?? $value['label'] ?? (string) $key,
                'href' => $value['href'] ?? $value['url'] ?? '#',
            ];
        } else {
            $navItems[] = [
                'label' => (string) $key,
                'href' => (string) $value,
            ];
        }
    }

    $user = auth()->user();
    $initials = $user
        ? str($user->name)->squish()->explode(' ')->take(2)->map(fn ($part) => mb_strtoupper(mb_substr($part, 0, 1)))->implode('')
        : '';
@endphp

<header class="bg-background/80 supports-[backdrop-filter]:bg-background/60 sticky top-0 z-40 border-b backdrop-blur-xl">
    <div class="mx-auto flex h-16 max-w-6xl items-center gap-4 px-6">
        <a href="{{ route('home') }}" class="flex items-center gap-2 font-semibold tracking-tight">
            <span class="bg-primary text-primary-foreground flex size-8 items-center justify-center rounded-lg">
                <x-lucide-cloud class="size-5" />
            </span>
            {{ config('app.name') }}
        </a>

        <nav class="ml-4 hidden items-center gap-1 text-sm md:flex">
            @foreach ($navItems as $item)
                <a
                    href="{{ $item['href'] }}"
                    class="text-muted-foreground hover:text-foreground hover:bg-accent/60 rounded-md px-3 py-1.5 font-medium transition-colors"
                >
                    {{ $item['label'] }}
                </a>
            @endforeach
        </nav>

        <div class="ml-auto flex items-center gap-1.5">
            <button
                type="button"
                @click="$store.theme && $store.theme.toggle()"
                class="hover:bg-accent inline-flex size-9 items-center justify-center rounded-md transition-colors"
                aria-label="Toggle theme"
            >
                <x-lucide-sun class="size-4 dark:hidden" />
                <x-lucide-moon class="hidden size-4 dark:block" />
            </button>

            @auth
                <x-ui.dropdown-menu>
                    <x-ui.dropdown-menu-trigger>
                        <button
                            type="button"
                            class="ring-offset-background focus-visible:ring-ring inline-flex items-center justify-center rounded-full focus-visible:ring-2 focus-visible:ring-offset-2 focus-visible:outline-none"
                            aria-label="User menu"
                        >
                            <x-ui.avatar class="size-8">
                                <x-ui.avatar-fallback>{{ $initials }}</x-ui.avatar-fallback>
                            </x-ui.avatar>
                        </button>
                    </x-ui.dropdown-menu-trigger>
                    <x-ui.dropdown-menu-content align="end" class="w-56">
                        <x-ui.dropdown-menu-label class="font-normal">
                            <div class="flex flex-col space-y-1">
                                <p class="text-sm leading-none font-medium">{{ $user->name }}</p>
                                <p class="text-muted-foreground text-xs leading-none">{{ $user->email }}</p>
                            </div>
                        </x-ui.dropdown-menu-label>
                        <x-ui.dropdown-menu-separator />
                        <x-ui.dropdown-menu-group>
                            <x-ui.dropdown-menu-item :href="route('dashboard')">
                                <x-lucide-layout-dashboard />
                                Dashboard
                            </x-ui.dropdown-menu-item>
                            <x-ui.dropdown-menu-item :href="route('profile.edit')">
                                <x-lucide-settings />
                                Settings
                            </x-ui.dropdown-menu-item>
                        </x-ui.dropdown-menu-group>
                        <x-ui.dropdown-menu-separator />
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-ui.dropdown-menu-item type="submit" class="w-full">
                                <x-lucide-log-out />
                                Log out
                            </x-ui.dropdown-menu-item>
                        </form>
                    </x-ui.dropdown-menu-content>
                </x-ui.dropdown-menu>
            @else
                <x-ui.button :href="route('login')" variant="ghost" size="sm" class="hidden sm:inline-flex">
                    Sign in
                </x-ui.button>
                <x-ui.button :href="route('register')" size="sm" class="hidden sm:inline-flex">
                    Get started <x-lucide-arrow-right class="size-4" />
                </x-ui.button>
            @endauth

            {{-- Mobile menu --}}
            <x-ui.sheet>
                <x-ui.sheet-trigger class="md:hidden">
                    <x-ui.button variant="outline" size="icon" aria-label="Open menu">
                        <x-lucide-menu class="size-4" />
                    </x-ui.button>
                </x-ui.sheet-trigger>
                <x-ui.sheet-content side="right">
                    <x-ui.sheet-header>
                        <x-ui.sheet-title>{{ config('app.name') }}</x-ui.sheet-title>
                    </x-ui.sheet-header>
                    <nav class="grid gap-1 px-4 text-sm">
                        @foreach ($navItems as $item)
                            <a
                                href="{{ $item['href'] }}"
                                @click="open = false"
                                class="hover:bg-accent rounded-md px-3 py-2 font-medium"
                            >
                                {{ $item['label'] }}
                            </a>
                        @endforeach
                    </nav>
                    <x-ui.sheet-footer>
                        @auth
                            <x-ui.button :href="route('dashboard')" class="w-full">Dashboard</x-ui.button>
                            <form method="POST" action="{{ route('logout') }}" class="w-full">
                                @csrf
                                <x-ui.button type="submit" variant="outline" class="w-full">Log out</x-ui.button>
                            </form>
                        @else
                            <x-ui.button :href="route('register')" class="w-full">Get started</x-ui.button>
                            <x-ui.button :href="route('login')" variant="outline" class="w-full">Sign in</x-ui.button>
                        @endauth
                    </x-ui.sheet-footer>
                </x-ui.sheet-content>
            </x-ui.sheet>
        </div>
    </div>
</header>
