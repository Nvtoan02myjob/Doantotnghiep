<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xác Thực OTP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .otp-input {
            width: 50px;
            height: 50px;
            text-align: center;
            font-size: 24px;
            margin: 5px;
        }
    </style>
</head>
<body class="d-flex justify-content-center align-items-center vh-100 bg-light">

    <div class="card p-4 shadow-lg">
        <h3 class="text-center">Xác Thực OTP</h3>
        <p class="text-center text-muted">Nhập mã OTP gồm 6 chữ số</p>
        <form id="otp-form" action="{{route('otp_verify_data');}}" method="post">
            @csrf
            <div class="d-flex justify-content-center">
                <input type="text" class="otp-input form-control" maxlength="1" name="otp_data[]">
                <input type="text" class="otp-input form-control" maxlength="1" name="otp_data[]">
                <input type="text" class="otp-input form-control" maxlength="1" name="otp_data[]">
                <input type="text" class="otp-input form-control" maxlength="1" name="otp_data[]">
                <input type="text" class="otp-input form-control" maxlength="1" name="otp_data[]">
            </div>
            <button type="submit" class="btn btn-primary w-100 mt-3">Xác Nhận</button>
        </form>
    </div>
    