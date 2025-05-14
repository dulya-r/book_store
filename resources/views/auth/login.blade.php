<x-guest-layout>

    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <x-validation-errors class="mb-4" />

        @session('status')
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ $value }}
            </div>
        @endsession

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div>
                <x-label for="email" value="{{ __('Email') }}" class="text-purple-600" />
                <x-input id="email" class="block mt-1 w-full border-2 border-purple-600 focus:border-purple-700 focus:ring focus:ring-purple-500 focus:ring-opacity-50" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            </div>

            <div class="mt-4">
                <x-label for="password" value="{{ __('Password') }}" class="text-purple-600" />
                <x-input id="password" class="block mt-1 w-full border-2 border-purple-600 focus:border-purple-700 focus:ring focus:ring-purple-500 focus:ring-opacity-50" type="password" name="password" required autocomplete="current-password" />
            </div>

            <div class="block mt-4">
                <label for="remember_me" class="flex items-center">
                    <x-checkbox id="remember_me" name="remember" class="text-purple-600" />
                    <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-purple-600 hover:text-purple-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

                <x-button class="ms-4 bg-purple-600 hover:bg-purple-700 focus:ring-2 focus:ring-offset-2 focus:ring-purple-500">
                    {{ __('Log in') }}
                </x-button>
            </div>
        </form>
    </x-authentication-card>
    
</x-guest-layout>
