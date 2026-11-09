<x-layouts.dashboard title="Profile" heading="Profile settings">
    <div class="flex flex-col gap-6 p-4 lg:p-6">
        <div class="max-w-2xl space-y-6">
            @include('profile.partials.update-profile-information-form')
            @include('profile.partials.update-password-form')
            @include('profile.partials.delete-user-form')
        </div>
    </div>
</x-layouts.dashboard>
