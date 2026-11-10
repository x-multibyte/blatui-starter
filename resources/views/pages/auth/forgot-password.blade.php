<x-layouts.auth
    title="Forgot password"
    heading="Forgot your password?"
    description="Enter your email address and we will email you a link to choose a new one."
>
    @if (session('status'))
        <x-ui.alert tone="success" class="mb-6">
            <x-lucide-circle-check />
            <x-ui.alert-description>{{ session('status') }}</x-ui.alert-description>
        </x-ui.alert>
    @endif

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <x-ui.field-group>
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
                />
                <x-ui.field-error :messages="$errors->get('email')" />
            </x-ui.field>

            <x-ui.field>
                <x-ui.button type="submit">Email Password Reset Link</x-ui.button>
                <x-ui.field-description class="text-center">
                    Remembered it? <a href="{{ route('login') }}" class="underline underline-offset-4">Back to login</a>
                </x-ui.field-description>
            </x-ui.field>
        </x-ui.field-group>
    </form>
</x-layouts.auth>
