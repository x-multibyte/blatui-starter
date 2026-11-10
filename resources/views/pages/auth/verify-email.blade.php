<x-layouts.auth title="Verify email" heading="Verify your email" description="Thanks for signing up! Before getting started, please verify your email address by clicking the link we just emailed to you.">
    @if (session('status') == 'verification-link-sent')
        <x-ui.alert tone="success" class="mb-6">
            <x-lucide-circle-check />
            <x-ui.alert-description>A new verification link has been sent to the email address you provided during registration.</x-ui.alert-description>
        </x-ui.alert>
    @endif

    <div class="flex flex-col gap-3">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <x-ui.button type="submit" class="w-full">Resend Verification Email</x-ui.button>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <x-ui.button type="submit" variant="ghost" class="w-full">Log Out</x-ui.button>
        </form>
    </div>
</x-layouts.auth>
