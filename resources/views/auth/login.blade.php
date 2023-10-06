{{-- 
    
    
    
    <x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ml-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>    
    --}}



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('assets/css/login.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('assets/css/boxicons.min.css') }}" type="text/css">
</head>

<body>
    <div class="wrapper">
        <form action="{{ route('login') }}" method="POST">
            @csrf
            <h1>Connexion</h1>

            <div class="input-box">
                <input type="email" name="email" placeholder="Email" required>
                <i class="bx bxs-user"></i>
            </div>

            <div class="input-box">
                <input type="password" name="password" placeholder="Mot de passe" required>
                <i class='bx bxs-lock-alt'></i>
            </div>

            <div class="remember-forgot">
                <label for="">
                    <input type="checkbox"> Se souvenir
                </label>
                <a href="">Mot de passe oublié ?</a>
            </div>

            <button type="submit" class="btn">Se connecter</button>

            <div class="register-link">
                <p>
                    Vous n'avez pas encore de compte ? <a href="{{ route('register') }}">Inscrivez-vous</a>
                </p>
            </div>
        </form>
    </div>
</body>

</html>
