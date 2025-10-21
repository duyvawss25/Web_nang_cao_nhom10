<x-guest-layout>
    <h2 class="auth-title">Login Quick</h2>
    
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div class="input-group">
            <input 
                id="email"
                type="email" 
                name="email" 
                placeholder="E-mail" 
                value="{{ old('email') }}" 
                required 
                autofocus 
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
                autocomplete="current-password"
            >
            <div class="input-icon icon-lock"></div>
        </div>
        <x-input-error :messages="$errors->get('password')" class="error-message" />

        <!-- Remember Me -->
        <div class="checkbox-group">
            <input id="remember_me" type="checkbox" name="remember">
            <label for="remember_me">{{ __('Remember me') }}</label>
        </div>

        <!-- Forgot Password & Login Button -->
        <div class="forgot-password">
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif
        </div>

        <button type="submit" class="auth-button">
            {{ __('Log in') }}
        </button>

        <!-- Register Link -->
        @if (Route::has('register'))
            <div class="auth-link">
                Don't have an account? <a href="{{ route('register') }}">Register here</a>
            </div>
        @endif
    </form>
</x-guest-layout>