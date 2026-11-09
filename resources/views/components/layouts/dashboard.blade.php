@props([
    'title' => null,
    'heading' => null,
])

@php
    $user = auth()->user();
    $initials = str($user->name)->squish()->explode(' ')->take(2)->map(fn ($part) => mb_strtoupper(mb_substr($part, 0, 1)))->implode('');

    $navMain = [
        ['title' => 'Dashboard', 'icon' => 'layout-dashboard', 'href' => route('dashboard')],
        ['title' => 'Lifecycle', 'icon' => 'list-todo', 'href' => '#'],
        ['title' => 'Analytics', 'icon' => 'chart-bar', 'href' => '#'],
        ['title' => 'Projects', 'icon' => 'folder', 'href' => '#'],
        ['title' => 'Team', 'icon' => 'users', 'href' => '#'],
    ];

    $documents = [
        ['name' => 'Data Library', 'icon' => 'database'],
        ['name' => 'Reports', 'icon' => 'file-chart-column'],
        ['name' => 'Word Assistant', 'icon' => 'file-text'],
    ];

    $navSecondary = [
        ['title' => 'Settings', 'icon' => 'settings', 'href' => route('profile.edit')],
        ['title' => 'Get Help', 'icon' => 'circle-help', 'href' => '#'],
        ['title' => 'Search', 'icon' => 'search', 'href' => '#'],
    ];
@endphp

<x-layouts.app :title="$title ?? $heading">
    <x-ui.sidebar-provider style="--sidebar-width: calc(var(--spacing) * 72); --header-height: calc(var(--spacing) * 12);">
        <x-ui.sidebar collapsible="offcanvas" variant="inset">
            <x-ui.sidebar-header>
                <x-ui.sidebar-menu>
                    <x-ui.sidebar-menu-item>
                        <x-ui.sidebar-menu-button class="data-[slot=sidebar-menu-button]:p-1.5!" :href="route('dashboard')">
                            <x-lucide-command class="size-5!" />
                            <span class="text-base font-semibold">{{ config('app.name') }}</span>
                        </x-ui.sidebar-menu-button>
                    </x-ui.sidebar-menu-item>
                </x-ui.sidebar-menu>
            </x-ui.sidebar-header>
            <x-ui.sidebar-content>
                {{-- Nav main --}}
                <x-ui.sidebar-group>
                    <x-ui.sidebar-group-content class="flex flex-col gap-2">
                        <x-ui.sidebar-menu>
                            <x-ui.sidebar-menu-item class="flex items-center gap-2">
                                <x-ui.sidebar-menu-button class="bg-primary text-primary-foreground min-w-8 duration-200 ease-linear hover:bg-primary/90 hover:text-primary-foreground active:bg-primary/90 active:text-primary-foreground">
                                    <x-lucide-circle-plus />
                                    <span>Quick Create</span>
                                </x-ui.sidebar-menu-button>
                                <x-ui.button size="icon" variant="outline" class="size-8 group-data-[collapsible=icon]:opacity-0">
                                    <x-lucide-mail />
                                    <span class="sr-only">Inbox</span>
                                </x-ui.button>
                            </x-ui.sidebar-menu-item>
                        </x-ui.sidebar-menu>
                        <x-ui.sidebar-menu>
                            @foreach ($navMain as $item)
                                <x-ui.sidebar-menu-item>
                                    <x-ui.sidebar-menu-button :href="$item['href']" :current="$item['href'] !== '#'">
                                        <x-dynamic-component :component="'lucide-'.$item['icon']" />
                                        <span>{{ $item['title'] }}</span>
                                    </x-ui.sidebar-menu-button>
                                </x-ui.sidebar-menu-item>
                            @endforeach
                        </x-ui.sidebar-menu>
                    </x-ui.sidebar-group-content>
                </x-ui.sidebar-group>

                {{-- Documents --}}
                <x-ui.sidebar-group class="group-data-[collapsible=icon]:hidden">
                    <x-ui.sidebar-group-label>Documents</x-ui.sidebar-group-label>
                    <x-ui.sidebar-menu>
                        @foreach ($documents as $doc)
                            <x-ui.sidebar-menu-item>
                                <x-ui.sidebar-menu-button href="#">
                                    <x-dynamic-component :component="'lucide-'.$doc['icon']" />
                                    <span>{{ $doc['name'] }}</span>
                                </x-ui.sidebar-menu-button>
                                <x-ui.dropdown-menu>
                                    <x-ui.dropdown-menu-trigger>
                                        <x-ui.sidebar-menu-action :show-on-hover="true" class="data-[state=open]:bg-accent rounded-sm">
                                            <x-lucide-more-horizontal />
                                            <span class="sr-only">More</span>
                                        </x-ui.sidebar-menu-action>
                                    </x-ui.dropdown-menu-trigger>
                                    <x-ui.dropdown-menu-content class="w-24 rounded-lg" side="right" align="start">
                                        <x-ui.dropdown-menu-item><x-lucide-folder /><span>Open</span></x-ui.dropdown-menu-item>
                                        <x-ui.dropdown-menu-item><x-lucide-share-2 /><span>Share</span></x-ui.dropdown-menu-item>
                                        <x-ui.dropdown-menu-separator />
                                        <x-ui.dropdown-menu-item variant="destructive"><x-lucide-trash-2 /><span>Delete</span></x-ui.dropdown-menu-item>
                                    </x-ui.dropdown-menu-content>
                                </x-ui.dropdown-menu>
                            </x-ui.sidebar-menu-item>
                        @endforeach
                    </x-ui.sidebar-menu>
                </x-ui.sidebar-group>

                {{-- Nav secondary --}}
                <x-ui.sidebar-group class="mt-auto">
                    <x-ui.sidebar-group-content>
                        <x-ui.sidebar-menu>
                            @foreach ($navSecondary as $item)
                                <x-ui.sidebar-menu-item>
                                    <x-ui.sidebar-menu-button :href="$item['href']" :current="$item['href'] !== '#'">
                                        <x-dynamic-component :component="'lucide-'.$item['icon']" />
                                        <span>{{ $item['title'] }}</span>
                                    </x-ui.sidebar-menu-button>
                                </x-ui.sidebar-menu-item>
                            @endforeach
                        </x-ui.sidebar-menu>
                    </x-ui.sidebar-group-content>
                </x-ui.sidebar-group>
            </x-ui.sidebar-content>
            <x-ui.sidebar-footer>
                <x-block.nav-user
                    :name="$user->name"
                    :email="$user->email"
                    :fallback="$initials"
                    :account-url="route('profile.edit')"
                    :logout-url="route('logout')"
                />
            </x-ui.sidebar-footer>
        </x-ui.sidebar>

        <x-ui.sidebar-inset>
            {{-- Site header --}}
            <header class="flex h-16 shrink-0 items-center gap-2 border-b px-4 lg:px-6">
                <x-ui.sidebar-trigger class="-ml-1" />
                <x-ui.separator orientation="vertical" class="mr-2 data-[orientation=vertical]:h-4" />
                <h1 class="text-base font-medium">{{ $heading ?? $title }}</h1>
                <div class="ml-auto flex items-center gap-2">
                    {{ $actions ?? '' }}
                </div>
            </header>

            <div class="flex flex-1 flex-col">
                {{ $slot }}
            </div>
        </x-ui.sidebar-inset>
    </x-ui.sidebar-provider>
</x-layouts.app>
