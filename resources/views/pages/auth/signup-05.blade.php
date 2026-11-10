{{-- Source: https://blatui.remix-it.com/r/blocks/signup-05.json --}}
<x-layouts.app title="Sign up 05">
    <div class="bg-background flex min-h-svh flex-col items-center justify-center gap-6 p-6 md:p-10">
        <div class="w-full max-w-sm">
            <div class="flex flex-col gap-6">
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <x-ui.field-group>
                        <div class="flex flex-col items-center gap-2 text-center">
                            <a href="{{ route('home') }}" class="flex flex-col items-center gap-2 font-medium">
                                <div class="flex size-8 items-center justify-center rounded-md">
                                    <x-lucide-gallery-vertical-end class="size-6" />
                                </div>
                                <span class="sr-only">Acme Inc.</span>
                            </a>
                            <h1 class="text-xl font-bold">Welcome to Acme Inc.</h1>
                            <x-ui.field-description>
                                Already have an account? <a href="{{ route('login') }}" class="underline underline-offset-4">Sign in</a>
                            </x-ui.field-description>
                        </div>
                        <x-ui.field>
                            <x-ui.field-label for="name">Full Name</x-ui.field-label>
                            <x-ui.input id="name" type="text" name="name" :value="old('name')" placeholder="John Doe" required autofocus autocomplete="name" />
                            <x-ui.field-error :messages="$errors->get('name')" />
                        </x-ui.field>
                        <x-ui.field>
                            <x-ui.field-label for="email">Email</x-ui.field-label>
                            <x-ui.input id="email" type="email" name="email" :value="old('email')" placeholder="m@example.com" required autocomplete="username" />
                            <x-ui.field-error :messages="$errors->get('email')" />
                        </x-ui.field>
                        <x-ui.field>
                            <x-ui.field-label for="password">Password</x-ui.field-label>
                            <x-ui.input id="password" type="password" name="password" required autocomplete="new-password" />
                            <x-ui.field-error :messages="$errors->get('password')" />
                        </x-ui.field>
                        <x-ui.field>
                            <x-ui.field-label for="password_confirmation">Confirm Password</x-ui.field-label>
                            <x-ui.input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" />
                            <x-ui.field-error :messages="$errors->get('password_confirmation')" />
                        </x-ui.field>
                        <x-ui.field>
                            <x-ui.button type="submit">Create Account</x-ui.button>
                        </x-ui.field>
                        <x-ui.field-separator>Or</x-ui.field-separator>
                        <x-ui.field class="grid gap-4 sm:grid-cols-2">
                            <x-ui.button variant="outline" type="button">
                                <x-lucide-apple class="size-4" />
                                Continue with Apple
                            </x-ui.button>
                            <x-ui.button variant="outline" type="button">
                                <svg class="size-4" viewBox="0 0 24 24">
                                    <path fill="#4285F4" d="M23.745 12.27c0-.7-.06-1.4-.19-2.07H12v4.51h6.6c-.29 1.52-1.14 2.82-2.4 3.68v3.05h3.88c2.27-2.09 3.665-5.17 3.665-9.17Z"/>
                                    <path fill="#34A853" d="M12 24c3.24 0 5.95-1.08 7.93-2.91l-3.88-3.05c-1.08.72-2.45 1.16-4.05 1.16-3.12 0-5.77-2.1-6.72-4.93H1.25v3.15C3.26 21.36 7.33 24 12 24Z"/>
                                    <path fill="#FBBC05" d="M5.28 14.27c-.25-.72-.38-1.49-.38-2.27s.13-1.55.38-2.27V6.58H1.25C.45 8.18 0 9.99 0 12s.45 3.82 1.25 5.42l4.03-3.15Z"/>
                                    <path fill="#EA4335" d="M12 4.75c1.77 0 3.35.61 4.6 1.8l3.42-3.42C17.95 1.19 15.24 0 12 0 7.33 0 3.26 2.64 1.25 6.58l4.03 3.15c.95-2.83 3.6-4.98 6.72-4.98Z"/>
                                </svg>
                                Continue with Google
                            </x-ui.button>
                        </x-ui.field>
                    </x-ui.field-group>
                </form>
                <x-ui.field-description class="px-6 text-center">
                    By clicking continue, you agree to our <a href="#">Terms of Service</a>
                    and <a href="#">Privacy Policy</a>.
                </x-ui.field-description>
            </div>
        </div>
    </div>
</x-layouts.app>
