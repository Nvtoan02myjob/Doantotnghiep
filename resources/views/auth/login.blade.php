<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

<x-guest-layout>
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="p-4 shadow rounded bg-light" style="max-width: 400px; margin: auto;">
        @csrf

        <!-- Email Address -->
        <div class="mb-3">
            <label for="email" class="form-label fw-bold" style="color: #af2020;"><i class="bi bi-person me-2"></i>Email</label>
            <input id="email" class="form-control border-danger" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" style="border-radius:20px;">
            <x-input-error :messages="$errors->get('email')" class="text-danger mt-1" />
        </div>

        <!-- Password -->
        <div class="mb-3">
            <label for="password" class="form-label fw-bold" style="color: #af2020;"><i class="bi bi-key me-2"></i>Password</label>
            <input id="password" class="form-control border-danger" type="password" name="password" required autocomplete="current-password" style="border-radius:20px;">
            <x-input-error :messages="$errors->get('password')" class="text-danger mt-1" />
        </div>

        <!-- Remember Me -->
        <div class="form-check mb-3">
            <input id="remember_me" type="checkbox" class="form-check-input" name="remember">
            <label for="remember_me" class="form-check-label" style="color: #af2020;">Nhớ tôi</label>
        </div>

        <div class="d-flex justify-content-between align-items-center">
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="text-decoration-none fw-bold" style="color: #af2020;">Quên mật khẩu?</a>
            @endif
            <button type="submit" class="btn text-white" style="background-color: #af2020;">Đăng nhập</button>
        </div>

        <!-- Đăng ký ngay -->
        <div class="text-center mt-3">
            <span style="color: #af2020;">Bạn chưa đăng ký?</span>
            <a href="{{ route('register') }}" class="fw-bold text-decoration-none" style="color: #af2020;">Đăng ký ngay</a>
        </div>
    </form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</x-guest-layout>
