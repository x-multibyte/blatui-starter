<x-ui.card variant="sectioned">
    <x-ui.card-header>
        <x-ui.card-title>Profile Information</x-ui.card-title>
        <x-ui.card-description>Update your account's profile information and email address.</x-ui.card-description>
    </x-ui.card-header>

    <x-ui.card-content>
        <form id="send-verification" method="POST" action="{{ route('verification.send') }}">
            @csrf
        </form>

        <form method="POST" action="{{ route('profile.update') }}">
            @csrf
            @method('patch')

            <x-ui.field-group>
                <x-ui.field>
                    <x-ui.field-label for="name">Name</x-ui.field-label>
                    <x-ui.input
                        id="name"
                        name="name"
                        type="text"
                        :value="old('name', $user->name)"
                        required
                        autofocus
                        autocomplete="name"
                    />
                    <x-ui.field-error :messages="$errors->get('name')" />
                </x-ui.field>

                <x-ui.field>
                    <x-ui.field-label for="email">Email</x-ui.field-label>
                    <x-ui.input
                        id="email"
                        name="email"
                        type="email"
                        :value="old('email', $user->email)"
                        required
                        autocomplete="username"
                    />
                    <x-ui.field-error :messages="$errors->get('email')" />

                    @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                        <x-ui.field-description>
                            Your email address is unverified.
                            <button form="send-verification" class="text-foreground underline underline-offset-4">
                                Click here to re-send the verification email.
                            </button>
                        </x-ui.field-description>

                        @if (session('status') === 'verification-link-sent')
                            <p class="text-success text-sm font-medium">
                                A new verification link has been sent to your email address.
                            </p>
                        @endif
                    @endif
                </x-ui.field>

                <div class="flex items-center gap-4">
                    <x-ui.button type="submit">Save</x-ui.button>

                    @if (session('status') === 'profile-updated')
                        <p
                            x-data="{ show: true }"
                            x-show="show"
                            x-transition
                            x-init="setTimeout(() => (show = false), 2000)"
                            class="text-muted-foreground text-sm"
                        >
                            Saved.
                        </p>
                    @endif
                </div>
            </x-ui.field-group>
        </form>
    </x-ui.card-content>
</x-ui.card>
