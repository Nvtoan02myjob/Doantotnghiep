<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<x-guest-layout>
    <form method="POST" action="{{ route('test') }}">
        @csrf

        <!-- Name -->
        <div>
            <div class="d-flex">
                <i class="bi bi-person" style="margin-right: 8px; font-size: 20px; color: orange;"></i>
                <x-input-label for="name" :value="__('Name')" style="color: orange;" />
            </div>
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="Nhập Tên" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
        <div class="d-flex align-items-center">
        <i class="bi bi-envelope" style="margin-right: 8px; font-size: 20px; color: orange;"></i>
        <x-input-label for="email" :value="__('Email')" style="color: orange;" />
    </div>
    <x-text-input id="email" class="block mt-1 w-full form-control"
        type="email" name="email"
        :value="old('email')"
        required autocomplete="username"
        placeholder="Nhập Email" />
    <x-input-error :messages="$errors->get('email')" class="mt-2" />
</div>

<!-- Phone number -->
<div class="mt-4">
    <div class="d-flex align-items-center">
        <i class="bi bi-telephone" style="margin-right: 8px; font-size: 20px; color: orange;"></i>
        <x-input-label for="phone" :value="__('Phone')" style="color: orange;" />
    </div>
    <x-text-input id="phone" class="block mt-1 w-full form-control"
        type="tel" name="phone"
        pattern="[0-9]{10}" maxlength="10"
        placeholder="Nhập số điện thoại"
        :value="old('phone')"
        required autocomplete="tel" />
    <x-input-error :messages="$errors->get('phone')" class="mt-2" />
</div>


        <!-- Password -->
        <div class="mt-4">
            <div class="d-flex">
                <i class="bi bi-key" style="margin-right: 8px; font-size: 20px; color: orange;"></i>
                <x-input-label for="password" :value="__('Password')" style="color: orange;" />
            </div>

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" placeholder="Nhập Password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
        <div class="d-flex">
            <i class="bi bi-check-circle" style="margin-right: 8px; font-size: 20px; color: orange;"></i>
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" style="color: orange;"  />
        </div>

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" placeholder="Xác Nhận Password"/>

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4" >
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}" style="color: orange; font-weight: bold;" >
                {{ __('Bạn Đã Có Tài Khoản?') }}
            </a>

            <x-primary-button class="ms-4" style="color: white; background-color: orange; border: 1px solid orange;">
                {{ __('Đăng Kí') }}
            </x-primary-button>

        </div>
    </form>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</x-guest-layout>
