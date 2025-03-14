@extends('layout')
@section('noidung')
<div class="container" style="text-align: center;
    margin-top: 100px;
    margin-bottom: 80px;
    width: 400px;
    height: 300px;
    background: #ff980008;
    box-shadow: 0 0 1px #ff980008;
    padding: 60px;">
    <h2>Xác thực email</h2>
    <p>Nhập mã xác nhận đã được gửi tới email của bạn.</p>

    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form action="{{ route('verify.code') }}" method="POST">
        @csrf
        <label for="code_auth">Mã xác nhận:</label>
        <input type="text" name="code_auth" required minlength="6" maxlength="6" style="background: oldlace;border: 1px solid orange;border-radius: 20px; padding: 4px 10px; margin-top: 5px;">
        <button type="submit" style="position: relative;top: 20px;background: orange;border: none;padding: 5px;border-radius: 25px;color:white;">Xác nhận</button>
    </form>
</div>
@endsection
