{{-- Source: https://blatui.remix-it.com/r/blocks/login-02.json --}}
@php
    $errors = $errors ?? new \Illuminate\Support\ViewErrorBag;
@endphp

<x-layouts.app title="Login 02">
    <div class="grid min-h-svh lg:grid-cols-2">
        <div class="flex flex-col gap-4 p-6 md:p-10">
            <div class="flex justify-center gap-2 md:justify-start">
                <a href="{{ route('home') }}" class="flex items-center gap-2 font-medium">
                    <div class="bg-primary text-primary-foreground flex size-6 items-center justify-center rounded-md">
                        <x-lucide-gallery-vertical-end class="size-4" />
                    </div>
                    Acme Inc.
                </a>
            </div>
            <div class="flex flex-1 items-center justify-center">
                <div class="w-full max-w-xs">
                    @if (session('status'))
                        <x-ui.alert tone="success" class="mb-6">
                            <x-lucide-circle-check />
                            <x-ui.alert-description>{{ session('status') }}</x-ui.alert-description>
                        </x-ui.alert>
                    @endif

                    <form method="POST" action="{{ route('login') }}" class="flex flex-col gap-6">
                        @csrf

                        <x-ui.field-group>
                            <div class="flex flex-col items-center gap-1 text-center">
                                <h1 class="text-2xl font-bold">Login to your account</h1>
                                <p class="text-muted-foreground text-sm text-balance">
                                    Enter your email below to login to your account
                                </p>
                            </div>
                            <x-ui.field>
                                <x-ui.field-label for="email">Email</x-ui.field-label>
                                <x-ui.input
                                    id="email"
                                    type="email"
                                    name="email"
                                    :value="old('email')"
                                    placeholder="m@example.com"
                                    required
                                    autofocus
                                    autocomplete="username"
                                />
                                <x-ui.field-error :messages="$errors->get('email')" />
                            </x-ui.field>
                            <x-ui.field>
                                <div class="flex items-center">
                                    <x-ui.field-label for="password">Password</x-ui.field-label>
                                    @if (Route::has('password.request'))
                                        <a
                                            href="{{ route('password.request') }}"
                                            class="ml-auto text-sm underline-offset-4 hover:underline"
                                        >
                                            Forgot your password?
                                        </a>
                                    @endif
                                </div>
                                <x-ui.input
                                    id="password"
                                    type="password"
                                    name="password"
                                    required
                                    autocomplete="current-password"
                                />
                                <x-ui.field-error :messages="$errors->get('password')" />
                            </x-ui.field>
                            <x-ui.field orientation="horizontal">
                                <x-ui.checkbox id="remember_me" name="remember" />
                                <x-ui.field-label for="remember_me" class="font-normal">Remember me</x-ui.field-label>
                            </x-ui.field>
                            <x-ui.field>
                                <x-ui.button type="submit">Login</x-ui.button>
                            </x-ui.field>
                            <x-ui.field-separator>Or continue with</x-ui.field-separator>
                            <x-ui.field>
                                <x-ui.button variant="outline" type="button">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="size-4 shrink-0" fill="currentColor">
                                        <path d="M12 .297c-6.63 0-12 5.373-12 12 0 5.303 3.438 9.8 8.205 11.385.6.113.82-.258.82-.577 0-.285-.01-1.04-.015-2.04-3.338.724-4.042-1.61-4.042-1.61C4.422 18.07 3.633 17.7 3.633 17.7c-1.087-.744.084-.729.084-.729 1.205.084 1.838 1.236 1.838 1.236 1.07 1.835 2.809 1.305 3.495.998.108-.776.417-1.305.76-1.605-2.665-.3-5.466-1.332-5.466-5.93 0-1.31.465-2.38 1.235-3.22-.135-.303-.54-1.523.105-3.176 0 0 1.005-.322 3.3 1.23.96-.267 1.98-.399 3-.405 1.02.006 2.04.138 3 .405 2.28-1.552 3.285-1.23 3.285-1.23.645 1.653.24 2.873.12 3.176.765.84 1.23 1.91 1.23 3.22 0 4.61-2.805 5.625-5.475 5.92.42.36.81 1.096.81 2.22 0 1.606-.015 2.896-.015 3.286 0 .315.21.69.825.57C20.565 22.092 24 17.592 24 12.297c0-6.627-5.373-12-12-12" />
                                    </svg>
                                    Login with GitHub
                                </x-ui.button>
                                @if (Route::has('register'))
                                    <x-ui.field-description class="text-center">
                                        Don't have an account?
                                        <a href="{{ route('register') }}" class="underline underline-offset-4"
                                            >Sign up</a>
                                    </x-ui.field-description>
                                @endif
                            </x-ui.field>
                        </x-ui.field-group>
                    </form>
                </div>
            </div>
        </div>
        <div class="bg-muted relative hidden lg:block">
            <img
                src="https://images.unsplash.com/photo-1579546929518-9e396f3cc809?w=1200&q=80&auto=format&fit=crop"
                alt=""
                class="absolute inset-0 h-full w-full object-cover dark:brightness-[0.2] dark:grayscale"
            />
        </div>
    </div>
</x-layouts.app>
