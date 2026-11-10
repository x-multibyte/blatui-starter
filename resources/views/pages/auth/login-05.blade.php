{{-- Source: https://blatui.remix-it.com/r/blocks/login-05.json --}}
@php
    $errors = $errors ?? new \Illuminate\Support\ViewErrorBag();
@endphp

<x-layouts.app title="Login 05">
    <div class="bg-background flex min-h-svh flex-col items-center justify-center gap-6 p-6 md:p-10">
        <div class="w-full max-w-sm">
            <div class="flex flex-col gap-6">
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <x-ui.field-group>
                        <div class="flex flex-col items-center gap-2 text-center">
                            <a href="{{ route('home') }}" class="flex flex-col items-center gap-2 font-medium">
                                <div class="flex size-8 items-center justify-center rounded-md">
                                    <x-lucide-gallery-vertical-end class="size-6" />
                                </div>
                                <span class="sr-only">Acme Inc.</span>
                            </a>
                            <h1 class="text-xl font-bold">Welcome to Acme Inc.</h1>
                            @if (Route::has('register'))
                                <x-ui.field-description>
                                    Don't have an account? <a href="{{ route('register') }}" class="underline underline-offset-4">Sign up</a>
                                </x-ui.field-description>
                            @endif
                        </div>

                        @if (session('status'))
                            <x-ui.alert tone="success" class="mb-6">
                                <x-lucide-circle-check />
                                <x-ui.alert-description>{{ session('status') }}</x-ui.alert-description>
                            </x-ui.alert>
                        @endif

                        <x-ui.field>
                            <x-ui.field-label for="email">Email</x-ui.field-label>
                            <x-ui.input id="email" type="email" name="email" :value="old('email')" placeholder="m@example.com" required autofocus autocomplete="username" />
                            <x-ui.field-error :messages="$errors->get('email')" />
                        </x-ui.field>
                        <x-ui.field>
                            <div class="flex items-center">
                                <x-ui.field-label for="password">Password</x-ui.field-label>
                                @if (Route::has('password.request'))
                                    <a href="{{ route('password.request') }}" class="ml-auto text-sm underline-offset-4 hover:underline">
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
                        </x-ui.field>
                        <x-ui.field-separator>Or</x-ui.field-separator>
                        <x-ui.field class="grid gap-4 sm:grid-cols-2">
                            <x-ui.button variant="outline" type="button">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="size-4 shrink-0" fill="currentColor">
                                    <path d="M12.152 6.896c-.948 0-2.415-1.078-3.96-1.04-2.04.027-3.91 1.183-4.961 3.014-2.117 3.675-.546 9.103 1.519 12.09 1.013 1.454 2.208 3.09 3.792 3.039 1.52-.065 2.09-.987 3.935-.987 1.831 0 2.35.987 3.96.948 1.637-.026 2.676-1.48 3.676-2.948 1.156-1.688 1.636-3.325 1.662-3.415-.039-.013-3.182-1.221-3.22-4.857-.026-3.04 2.48-4.494 2.597-4.559-1.429-2.09-3.623-2.324-4.39-2.376-2-.156-3.675 1.09-4.61 1.09zM15.53 3.83c.843-1.012 1.4-2.427 1.245-3.83-1.207.052-2.662.805-3.532 1.818-.78.896-1.454 2.338-1.273 3.714 1.338.104 2.715-.688 3.559-1.701" />
                                </svg>
                                Continue with Apple
                            </x-ui.button>
                            <x-ui.button variant="outline" type="button">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="size-4 shrink-0" fill="currentColor">
                                    <path d="M12.48 10.92v3.28h7.84c-.24 1.84-.853 3.187-1.787 4.133-1.147 1.147-2.933 2.4-6.053 2.4-4.827 0-8.6-3.893-8.6-8.72s3.773-8.72 8.6-8.72c2.6 0 4.507 1.027 5.907 2.347l2.307-2.307C18.747 1.44 16.133 0 12.48 0 5.867 0 .307 5.387.307 12s5.56 12 12.173 12c3.573 0 6.267-1.173 8.373-3.36 2.16-2.16 2.84-5.213 2.84-7.667 0-.76-.053-1.467-.173-2.053H12.48z" />
                                </svg>
                                Continue with Google
                            </x-ui.button>
                        </x-ui.field>
                    </x-ui.field-group>
                </form>
                <x-ui.field-description class="px-6 text-center">
                    By clicking continue, you agree to our <a href="#">Terms of Service</a>
                    and <a href="#">Privacy Policy</a>.
                </x-ui.field-description>
            </div>
        </div>
    </div>
</x-layouts.app>
