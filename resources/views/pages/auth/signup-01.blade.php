{{-- Source: https://blatui.remix-it.com/r/blocks/signup-01.json --}}
<x-layouts.app title="Sign up 01">
    <div class="flex min-h-svh w-full items-center justify-center p-6 md:p-10">
        <div class="w-full max-w-sm">
            <x-ui.card variant="sectioned">
                <x-ui.card-header>
                    <x-ui.card-title>Create an account</x-ui.card-title>
                    <x-ui.card-description>
                        Enter your information below to create your account
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
                                <x-ui.field-description>
                                    We'll use this to contact you. We will not share your email with anyone else.
                                </x-ui.field-description>
                            </x-ui.field>
                            <x-ui.field>
                                <x-ui.field-label for="password">Password</x-ui.field-label>
                                <x-ui.input id="password" type="password" name="password" required autocomplete="new-password" />
                                <x-ui.field-error :messages="$errors->get('password')" />
                                <x-ui.field-description>
                                    Must be at least 8 characters long.
                                </x-ui.field-description>
                            </x-ui.field>
                            <x-ui.field>
                                <x-ui.field-label for="password_confirmation">Confirm Password</x-ui.field-label>
                                <x-ui.input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" />
                                <x-ui.field-error :messages="$errors->get('password_confirmation')" />
                                <x-ui.field-description>Please confirm your password.</x-ui.field-description>
                            </x-ui.field>
                            <x-ui.field-group>
                                <x-ui.field>
                                    <x-ui.button type="submit">Create Account</x-ui.button>
                                    <x-ui.button variant="outline" type="button">
                                        Sign up with Google
                                    </x-ui.button>
                                    <x-ui.field-description class="px-6 text-center">
                                        Already have an account? <a href="{{ route('login') }}" class="underline underline-offset-4">Sign in</a>
                                    </x-ui.field-description>
                                </x-ui.field>
                            </x-ui.field-group>
                        </x-ui.field-group>
                    </form>
                </x-ui.card-content>
            </x-ui.card>
        </div>
    </div>
</x-layouts.app>
