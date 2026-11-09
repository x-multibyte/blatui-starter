<x-ui.card variant="sectioned">
    <x-ui.card-header>
        <x-ui.card-title>Update Password</x-ui.card-title>
        <x-ui.card-description>Ensure your account is using a long, random password to stay secure.</x-ui.card-description>
    </x-ui.card-header>

    <x-ui.card-content>
        <form method="POST" action="{{ route('password.update') }}">
            @csrf
            @method('put')

            <x-ui.field-group>
                <x-ui.field>
                    <x-ui.field-label for="update_password_current_password">Current Password</x-ui.field-label>
                    <x-ui.input id="update_password_current_password" name="current_password" type="password" autocomplete="current-password" />
                    <x-ui.field-error :messages="$errors->updatePassword->get('current_password')" />
                </x-ui.field>

                <x-ui.field>
                    <x-ui.field-label for="update_password_password">New Password</x-ui.field-label>
                    <x-ui.input id="update_password_password" name="password" type="password" autocomplete="new-password" />
                    <x-ui.field-error :messages="$errors->updatePassword->get('password')" />
                </x-ui.field>

                <x-ui.field>
                    <x-ui.field-label for="update_password_password_confirmation">Confirm Password</x-ui.field-label>
                    <x-ui.input id="update_password_password_confirmation" name="password_confirmation" type="password" autocomplete="new-password" />
                    <x-ui.field-error :messages="$errors->updatePassword->get('password_confirmation')" />
                </x-ui.field>

                <div class="flex items-center gap-4">
                    <x-ui.button type="submit">Save</x-ui.button>

                    @if (session('status') === 'password-updated')
                        <p
                            x-data="{ show: true }"
                            x-show="show"
                            x-transition
                            x-init="setTimeout(() => show = false, 2000)"
                            class="text-muted-foreground text-sm"
                        >Saved.</p>
                    @endif
                </div>
            </x-ui.field-group>
        </form>
    </x-ui.card-content>
</x-ui.card>
