<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4 text-success" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div class="mb-4">
            <label for="email" class="form-label fw-medium text-secondary" style="font-size: 0.9rem;">Email Address</label>
            <input id="email" class="form-control form-control-lg bg-light border-0 px-3 @error('email') is-invalid @enderror" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" placeholder="mail@example.com">
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Password -->
        <div class="mb-4">
            <label for="password" class="form-label fw-medium text-secondary" style="font-size: 0.9rem;">Password</label>
            <input id="password" class="form-control form-control-lg bg-light border-0 px-3 @error('password') is-invalid @enderror" type="password" name="password" required autocomplete="current-password" placeholder="Min. 8 characters">
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Remember Me & Forgot Password -->
        <div class="d-flex justify-content-between align-items-center mb-5 mt-1">
            <div class="form-check">
                <input class="form-check-input focus-ring-none shadow-sm" type="checkbox" name="remember" id="remember_me">
                <label class="form-check-label text-muted" for="remember_me" style="font-size: 0.9rem;">
                    Keep me logged in
                </label>
            </div>
            
            @if (Route::has('password.request'))
                <a class="text-decoration-none fw-semibold" style="font-size: 0.9rem; color: #4318FF;" href="{{ route('password.request') }}">
                    Forgot password?
                </a>
            @endif
        </div>

        <!-- Submit Button -->
        <div class="d-grid gap-2">
            <button type="submit" class="btn btn-primary btn-lg shadow-sm">
                Sign In <i class="bi bi-arrow-right ms-2"></i>
            </button>
        </div>

        <!-- Create Account -->
        <div class="text-center mt-4">
            <p class="text-muted mb-0" style="font-size: 0.95rem;">
                Not registered yet? 
                <a href="{{ route('register') }}" class="text-decoration-none fw-bold" style="color: #4318FF; transition: 0.2s;">Create an account</a>
            </p>
        </div>
    </form>
</x-guest-layout>
