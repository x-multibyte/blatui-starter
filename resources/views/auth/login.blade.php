<x-layouts.auth title="Log in" heading="Login to your account" description="Enter your email below to login to your account">
    @if (session('status'))
        <x-ui.alert tone="success" class="mb-6">
            <x-lucide-circle-check />
            <x-ui.alert-description>{{ session('status') }}</x-ui.alert-description>
        </x-ui.alert>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <x-ui.field-group>
            <x-ui.field>
                <x-ui.field-label for="email">Email</x-ui.field-label>
                <x-ui.input id="email" type="email" name="email" :value="old('email')" placeholder="m@example.com" required autofocus autocomplete="username" />
                <x-ui.field-error :messages="$errors->get('email')" />
            </x-ui.field>

            <x-ui.field>
                <div class="flex items-center">
                    <x-ui.field-label for="password">Password</x-ui.field-label>
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="ml-auto inline-block text-sm underline-offset-4 hover:underline">
                            Forgot your password?
                        </a>
                    @endif
                </div>
                <x-ui.input id="password" type="password" name="password" required autocomplete="current-password" />
                <x-ui.field-error :messages="$errors->get('password')" />
            </x-ui.field>

            <x-ui.field orientation="horizontal">
                <x-ui.checkbox id="remember_me" name="remember" />
                <x-ui.field-label for="remember_me" class="font-normal">Remember me</x-ui.field-label>
            </x-ui.field>

            <x-ui.field>
                <x-ui.button type="submit">Login</x-ui.button>
                @if (Route::has('register'))
                    <x-ui.field-description class="text-center">
                        Don't have an account? <a href="{{ route('register') }}" class="underline underline-offset-4">Sign up</a>
                    </x-ui.field-description>
                @endif
            </x-ui.field>
        </x-ui.field-group>
    </form>
</x-layouts.auth>
