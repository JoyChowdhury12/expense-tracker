<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div class="mb-4">
            <label for="name" class="form-label fw-medium text-secondary" style="font-size: 0.9rem;">Full Name</label>
            <input id="name" class="form-control form-control-lg bg-light border-0 px-3 @error('name') is-invalid @enderror" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name" placeholder="John Doe">
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Email Address -->
        <div class="mb-4">
            <label for="email" class="form-label fw-medium text-secondary" style="font-size: 0.9rem;">Email Address</label>
            <input id="email" class="form-control form-control-lg bg-light border-0 px-3 @error('email') is-invalid @enderror" type="email" name="email" value="{{ old('email') }}" required autocomplete="username" placeholder="mail@example.com">
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Password -->
        <div class="mb-4">
            <label for="password" class="form-label fw-medium text-secondary" style="font-size: 0.9rem;">Password</label>
            <input id="password" class="form-control form-control-lg bg-light border-0 px-3 @error('password') is-invalid @enderror" type="password" name="password" required autocomplete="new-password" placeholder="Min. 8 characters">
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Confirm Password -->
        <div class="mb-5">
            <label for="password_confirmation" class="form-label fw-medium text-secondary" style="font-size: 0.9rem;">Confirm Password</label>
            <input id="password_confirmation" class="form-control form-control-lg bg-light border-0 px-3" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="Min. 8 characters">
        </div>

        <!-- Submit Button -->
        <div class="d-grid gap-2">
            <button type="submit" class="btn btn-primary btn-lg shadow-sm">
                Register Account <i class="bi bi-person-plus ms-2"></i>
            </button>
        </div>

        <!-- Already Registered -->
        <div class="text-center mt-4">
            <p class="text-muted mb-0" style="font-size: 0.95rem;">
                Already have an account? 
                <a href="{{ route('login') }}" class="text-decoration-none fw-bold" style="color: #4318FF;">Sign in instead</a>
            </p>
        </div>
    </form>
</x-guest-layout>
