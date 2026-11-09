<x-ui.card variant="sectioned">
    <x-ui.card-header>
        <x-ui.card-title>Delete Account</x-ui.card-title>
        <x-ui.card-description>
            Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.
        </x-ui.card-description>
    </x-ui.card-header>

    <x-ui.card-content>
        <x-ui.alert-dialog :open="$errors->userDeletion->isNotEmpty()">
            <x-ui.alert-dialog-trigger>
                <x-ui.button variant="destructive">Delete Account</x-ui.button>
            </x-ui.alert-dialog-trigger>

            <x-ui.alert-dialog-content>
                {{-- The dialog content is teleported to <body>, so the whole form lives inside it. --}}
                <form method="POST" action="{{ route('profile.destroy') }}" class="grid gap-4">
                    @csrf
                    @method('delete')

                    <x-ui.alert-dialog-header>
                        <x-ui.alert-dialog-title>Are you sure you want to delete your account?</x-ui.alert-dialog-title>
                        <x-ui.alert-dialog-description>
                            Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.
                        </x-ui.alert-dialog-description>
                    </x-ui.alert-dialog-header>

                    <x-ui.field>
                        <x-ui.field-label for="delete_password" class="sr-only">Password</x-ui.field-label>
                        <x-ui.input id="delete_password" name="password" type="password" placeholder="Password" />
                        <x-ui.field-error :messages="$errors->userDeletion->get('password')" />
                    </x-ui.field>

                    <x-ui.alert-dialog-footer>
                        <x-ui.alert-dialog-cancel>Cancel</x-ui.alert-dialog-cancel>
                        <x-ui.button type="submit" variant="destructive">Delete Account</x-ui.button>
                    </x-ui.alert-dialog-footer>
                </form>
            </x-ui.alert-dialog-content>
        </x-ui.alert-dialog>
    </x-ui.card-content>
</x-ui.card>
