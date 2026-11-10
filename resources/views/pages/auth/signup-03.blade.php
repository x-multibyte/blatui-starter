{{-- Source: https://blatui.remix-it.com/r/blocks/signup-03.json --}}
<x-layouts.app title="Sign up 03">
    <div class="bg-muted flex min-h-svh flex-col items-center justify-center gap-6 p-6 md:p-10">
        <div class="flex w-full max-w-sm flex-col gap-6">
            <a href="{{ route('home') }}" class="flex items-center gap-2 self-center font-medium">
                <div class="bg-primary text-primary-foreground flex size-6 items-center justify-center rounded-md">
                    <x-lucide-gallery-vertical-end class="size-4" />
                </div>
                Acme Inc.
            </a>
            <div class="flex flex-col gap-6">
                <x-ui.card variant="sectioned">
                    <x-ui.card-header class="text-center">
                        <x-ui.card-title class="text-xl">Create your account</x-ui.card-title>
                        <x-ui.card-description>
                            Enter your email below to create your account
                        </x-ui.card-description>
                    </x-ui.card-header>
                    <x-ui.card-content>
                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            <x-ui.field-group>
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
                                    <x-ui.field-description class="text-center">
                                        Already have an account? <a href="{{ route('login') }}" class="underline underline-offset-4">Sign in</a>
                                    </x-ui.field-description>
                                </x-ui.field>
                            </x-ui.field-group>
                        </form>
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
