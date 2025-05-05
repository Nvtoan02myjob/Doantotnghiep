@extends('Layout')

@section('noidung')
<style>
    /* Căn giữa form */
    .otp-container {
        max-width: 400px;
        margin: 100px auto;
        padding: 40px;
        background: white;
        border-radius: 12px;
        box-shadow: 0px 4px 10px rgba(255, 152, 0, 0.2);
        text-align: center;
        color: #af2020;
    }

    /* Tiêu đề */
    .otp-title {
        color: orange;
        font-weight: bold;
        font-size: 24px;
        color: #af2020;

    }

    /* Input OTP */
    .otp-input {
        display: flex;
        justify-content: center;
        gap: 10px;
        margin-top: 15px;
        color: #af2020;

    }

    .otp-input input {
        width: 50px;
        height: 50px;
        font-size: 22px;
        text-align: center;
        border: 2px solid #af2020;
        border-radius: 10px;
        background: while-white;
        outline: none;
        transition: 0.3s;
        color: #af2020;

    }

    .otp-input input:focus {
        border-color: #af2020;
        box-shadow: 0 0 5px #af2020;
        color: #af2020;

    }

    /* Nút xác nhận */
    .btn-confirm {
        background-color: #af2020;
        color: white;
        border: none;
        padding: 12px;
        width: 100%;
        font-size: 18px;
        font-weight: bold;
        border-radius: 25px;
        margin-top: 20px;
        transition: 0.3s;
        cursor: pointer;
        color: white;

    }

    .btn-confirm:hover {
        border: 2px solid var(--color-main);
        color: var(--color-main);
        background-color: white;
        transition: all 0.3s ease;
        

    }

    /* Thông báo lỗi */
    .alert-danger {
        background: #ffebee;
        color: #d32f2f;
        padding: 10px;
        border-radius: 5px;
        margin-top: 10px;
        color: #af2020;

    }

</style>

<div class="otp-container">
    <h2 class="otp-title">Xác thực email</h2>
    <p>Nhập mã xác nhận đã được gửi tới email của bạn.</p>

    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form action="{{ route('verify.code') }}" method="POST">
        @csrf

        <!-- Ô nhập OTP -->
        <div class="otp-input">
            <input type="text" name="code_auth[]" maxlength="1" required>
            <input type="text" name="code_auth[]" maxlength="1" required>
            <input type="text" name="code_auth[]" maxlength="1" required>
            <input type="text" name="code_auth[]" maxlength="1" required>
            <input type="text" name="code_auth[]" maxlength="1" required>
            <input type="text" name="code_auth[]" maxlength="1" required>
        </div>

        <button type="submit" class="btn-confirm">Xác nhận</button>
    </form>
</div>

<script>
    // Tự động focus ô tiếp theo khi nhập số
    document.querySelectorAll('.otp-input input').forEach((input, index, array) => {
        input.addEventListener('input', () => {
            if (input.value.length === 1 && index < array.length - 1) {
array[index + 1].focus();
            }
        });
        input.addEventListener('keydown', (e) => {
            if (e.key === 'Backspace' && !input.value && index > 0) {
                array[index - 1].focus();
            }
        });
    });
</script>

@endsection

