<x-guest-layout>
    <h2 class="auth-title">Register Now</h2>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div class="input-group">
            <input 
                id="name"
                type="text" 
                name="name" 
                placeholder="Full Name" 
                value="{{ old('name') }}" 
                required 
                autofocus 
                autocomplete="name"
            >
            <div class="input-icon icon-user"></div>
        </div>
        <x-input-error :messages="$errors->get('name')" class="error-message" />

        <!-- Email Address -->
        <div class="input-group">
            <input 
                id="email"
                type="email" 
                name="email" 
                placeholder="E-mail" 
                value="{{ old('email') }}" 
                required 
                autocomplete="username"
            >
            <div class="input-icon icon-email"></div>
        </div>
        <x-input-error :messages="$errors->get('email')" class="error-message" />

        <!-- Password -->
        <div class="input-group">
            <input 
                id="password"
                type="password" 
                name="password" 
                placeholder="Password" 
                required 
                autocomplete="new-password"
            >
            <div class="input-icon icon-lock"></div>
        </div>
        <x-input-error :messages="$errors->get('password')" class="error-message" />

        <!-- Confirm Password -->
        <div class="input-group">
            <input 
                id="password_confirmation"
                type="password" 
                name="password_confirmation" 
                placeholder="Confirm Password" 
                required 
                autocomplete="new-password"
            >
            <div class="input-icon icon-lock"></div>
        </div>
        <x-input-error :messages="$errors->get('password_confirmation')" class="error-message" />

        <button type="submit" class="auth-button" style="margin-top: 30px;">
            {{ __('Register') }}
        </button>

        <!-- Login Link -->
        <div class="auth-link">
            {{ __('Already registered?') }} <a href="{{ route('login') }}">Login here</a>
        </div>
    </form>
</x-guest-layout>