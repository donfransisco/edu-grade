<x-app-layout>
    <x-slot name="header">
        <h1 class="text-lg font-semibold text-edu-text">Profile</h1>
    </x-slot>

    <div class="max-w-2xl space-y-6">
        <div class="edu-card border border-edu-hairline">
            @include('profile.partials.update-profile-information-form')
        </div>

        <div class="edu-card border border-edu-hairline">
            @include('profile.partials.update-password-form')
        </div>

        <div class="edu-card border border-edu-hairline">
            @include('profile.partials.delete-user-form')
        </div>
    </div>
</x-app-layout>
