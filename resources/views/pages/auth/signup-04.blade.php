{{-- Source: https://blatui.remix-it.com/r/blocks/signup-04.json --}}
<x-layouts.app title="Sign up 04">
    <div class="bg-muted flex min-h-svh flex-col items-center justify-center p-6 md:p-10">
        <div class="w-full max-w-sm md:max-w-4xl">
            <div class="flex flex-col gap-6">
                <x-ui.card variant="sectioned" class="overflow-hidden p-0">
                    <x-ui.card-content class="grid p-0 md:grid-cols-2">
                        <form method="POST" action="{{ route('register') }}" class="p-6 md:p-8">
                            @csrf
                            <x-ui.field-group>
                                <div class="flex flex-col items-center gap-2 text-center">
                                    <h1 class="text-2xl font-bold">Create your account</h1>
                                    <p class="text-muted-foreground text-sm text-balance">
                                        Enter your email below to create your account
                                    </p>
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
                                    <x-ui.field-description>
                                        We'll use this to contact you. We will not share your email with anyone else.
                                    </x-ui.field-description>
                                </x-ui.field>
                                <x-ui.field>
                                    <x-ui.field class="grid grid-cols-2 gap-4">
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
                                    </x-ui.field>
                                    <x-ui.field-description>
                                        Must be at least 8 characters long.
                                    </x-ui.field-description>
                                </x-ui.field>
                                <x-ui.field>
                                    <x-ui.button type="submit">Create Account</x-ui.button>
                                </x-ui.field>
                                <x-ui.field-separator class="*:data-[slot=field-separator-content]:bg-card">
                                    Or continue with
                                </x-ui.field-separator>
                                <x-ui.field class="grid grid-cols-3 gap-4">
                                    <x-ui.button variant="outline" type="button">
                                        <x-lucide-apple class="size-4" />
                                        <span class="sr-only">Sign up with Apple</span>
                                    </x-ui.button>
                                    <x-ui.button variant="outline" type="button">
                                        <svg class="size-4" viewBox="0 0 24 24">
                                            <path fill="#4285F4" d="M23.745 12.27c0-.7-.06-1.4-.19-2.07H12v4.51h6.6c-.29 1.52-1.14 2.82-2.4 3.68v3.05h3.88c2.27-2.09 3.665-5.17 3.665-9.17Z"/>
                                            <path fill="#34A853" d="M12 24c3.24 0 5.95-1.08 7.93-2.91l-3.88-3.05c-1.08.72-2.45 1.16-4.05 1.16-3.12 0-5.77-2.1-6.72-4.93H1.25v3.15C3.26 21.36 7.33 24 12 24Z"/>
                                            <path fill="#FBBC05" d="M5.28 14.27c-.25-.72-.38-1.49-.38-2.27s.13-1.55.38-2.27V6.58H1.25C.45 8.18 0 9.99 0 12s.45 3.82 1.25 5.42l4.03-3.15Z"/>
                                            <path fill="#EA4335" d="M12 4.75c1.77 0 3.35.61 4.6 1.8l3.42-3.42C17.95 1.19 15.24 0 12 0 7.33 0 3.26 2.64 1.25 6.58l4.03 3.15c.95-2.83 3.6-4.98 6.72-4.98Z"/>
                                        </svg>
                                        <span class="sr-only">Sign up with Google</span>
                                    </x-ui.button>
                                    <x-ui.button variant="outline" type="button">
                                        <svg class="size-4" viewBox="0 0 24 24" fill="currentColor">
                                            <path d="M12 16.223c-2.316 0-4.04-1.748-4.98-3.568.916-1.874 2.64-3.655 4.98-3.655 2.34 0 4.064 1.781 4.98 3.655-.94 1.82-2.664 3.568-4.98 3.568zm0-9.223c-3.542 0-6.19 2.502-7.514 5.223C5.81 14.945 8.458 17.447 12 17.447s6.19-2.502 7.514-5.224C18.19 9.502 15.542 7 12 7z"/>
                                        </svg>
                                        <span class="sr-only">Sign up with Meta</span>
                                    </x-ui.button>
                                </x-ui.field>
                                <x-ui.field-description class="text-center">
                                    Already have an account? <a href="{{ route('login') }}" class="underline underline-offset-4">Sign in</a>
                                </x-ui.field-description>
                            </x-ui.field-group>
                        </form>
                        <div class="bg-muted relative hidden md:block">
                            <img src="https://images.unsplash.com/photo-1618005182384-a83a8bd57fbe?w=1200&q=80&auto=format&fit=crop" alt=""
                                class="absolute inset-0 h-full w-full object-cover dark:brightness-[0.2] dark:grayscale" />
                        </div>
                    </x-ui.card-content>
                </x-ui.card>
                <x-ui.field-description class="px-6 text-center">
                    By clicking continue, you agree to our <a href="#">Terms of Service</a>
                    and <a href="#">Privacy Policy</a>.
                </x-ui.field-description>
            </div>
        </div>
    </div>
</x-layouts.app>
