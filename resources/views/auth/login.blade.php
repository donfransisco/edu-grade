<x-guest-layout>
    <h1 class="text-xl font-bold text-edu-text text-center mb-1">{{ __('Welcome back') }}</h1>
    <p class="text-sm text-edu-muted text-center mb-6">{{ __('Sign in to your account') }}</p>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" />
        </div>

        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" />
        </div>

        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center gap-2 cursor-pointer">
                <input id="remember_me" type="checkbox" class="rounded border-edu-hairline bg-edu-dark text-edu-yellow focus:ring-edu-yellow/30 focus:ring-offset-0" name="remember">
                <span class="text-sm text-edu-muted">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-between mt-6">
            @if (Route::has('password.request'))
                <a class="text-sm text-edu-muted hover:text-edu-yellow transition-colors" href="{{ route('password.request') }}">
                    {{ __('Forgot password?') }}
                </a>
            @endif

            <x-primary-button>
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>

    <div class="mt-6 text-center">
        <p class="text-sm text-edu-muted">
            {{ __("Don't have an account?") }}
            <a href="{{ route('register') }}" class="text-edu-yellow hover:text-edu-yellow-active transition-colors font-medium">
                {{ __('Register') }}
            </a>
        </p>
    </div>
</x-guest-layout>
