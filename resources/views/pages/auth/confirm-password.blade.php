<x-layouts.auth
    title="Confirm password"
    heading="Confirm your password"
    description="This is a secure area of the application. Please confirm your password before continuing."
>
    <form method="POST" action="{{ route('password.confirm') }}">
        @csrf

        <x-ui.field-group>
            <x-ui.field>
                <x-ui.field-label for="password">Password</x-ui.field-label>
                <x-ui.input
                    id="password"
                    type="password"
                    name="password"
                    required
                    autofocus
                    autocomplete="current-password"
                />
                <x-ui.field-error :messages="$errors->get('password')" />
            </x-ui.field>

            <x-ui.button type="submit">Confirm</x-ui.button>
        </x-ui.field-group>
    </form>
</x-layouts.auth>
