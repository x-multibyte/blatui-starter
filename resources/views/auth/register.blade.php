<x-layouts.auth title="Register" heading="Create an account" description="Enter your details below to create your account">
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <x-ui.field-group>
            <x-ui.field>
                <x-ui.field-label for="name">Name</x-ui.field-label>
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
                <x-ui.field-description class="text-center">
                    Already have an account? <a href="{{ route('login') }}" class="underline underline-offset-4">Sign in</a>
                </x-ui.field-description>
            </x-ui.field>
        </x-ui.field-group>
    </form>
</x-layouts.auth>
