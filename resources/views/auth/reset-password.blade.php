<x-layouts.auth title="Reset password" heading="Reset your password" description="Choose a new password for your account.">
    <form method="POST" action="{{ route('password.store') }}">
        @csrf

        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <x-ui.field-group>
            <x-ui.field>
                <x-ui.field-label for="email">Email</x-ui.field-label>
                <x-ui.input id="email" type="email" name="email" :value="old('email', $request->email)" required autofocus autocomplete="username" />
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

            <x-ui.button type="submit">Reset Password</x-ui.button>
        </x-ui.field-group>
    </form>
</x-layouts.auth>
