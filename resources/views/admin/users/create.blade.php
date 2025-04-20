

<style>
    .form-label {
        font-weight: 600;
        color: #333;
    }

    .form-control {
        transition: all 0.3s ease-in-out;
    }

    .form-control:focus {
        box-shadow: 0 0 0 0.25rem rgba(25, 135, 84, 0.25);
        border-color: #198754;
    }

    .card-header {
        background: linear-gradient(90deg, #198754, #28a745);
    }

    .btn-success {
        background-color: #198754;
        border: none;
    }

    .btn-success:hover {
        background-color: #157347;
    }

    .btn-secondary:hover {
        background-color: #6c757d;
    }

    .form-wrapper {
        max-width: 700px;
        margin: auto;
    }
</style>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
@extends('admin.partials.master')
@session('title')
    Thêm danh mục
@endsession
@section('content')
<div class="container my-5">
    <div class="form-wrapper">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show rounded-pill shadow-sm" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <form action="{{ route('admin.users.store') }}" method="POST" class="card shadow-lg rounded-4 border-0">
            @csrf
            <div class="bg-primary text-white rounded-top-4 py-3 px-4 ">
                <h4 class="mb-0"><i class="bi bi-person-plus-fill me-2"></i> Thêm người dùng mới</h4>
            </div>

            <div class="card-body p-4">
                <div class="mb-3">
                    <label for="name" class="form-label">Họ tên</label>
                    <input type="text" name="name" id="name" class="form-control rounded-pill @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
                    @error('name')
                        <div class="invalid-feedback ms-2">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" id="email" class="form-control rounded-pill @error('email') is-invalid @enderror" value="{{ old('email') }}" required>
                    @error('email')
                        <div class="invalid-feedback ms-2">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="phone" class="form-label">Số điện thoại</label>
                    <input type="text" name="phone" id="phone" class="form-control rounded-pill @error('phone') is-invalid @enderror" value="{{ old('phone') }}" required>
                    @error('phone')
                        <div class="invalid-feedback ms-2">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Mật khẩu</label>
                    <input type="password" name="password" id="password" class="form-control rounded-pill @error('password') is-invalid @enderror" required>
                    @error('password')
                        <div class="invalid-feedback ms-2">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="password_confirmation" class="form-label">Xác nhận mật khẩu</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control rounded-pill" required>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('admin.users.index') }}" class="btn btn-secondary rounded-pill px-4">
                        <i class="bi bi-arrow-left-circle"></i> Quay lại
                    </a>
                    <button type="submit" class="btn bg-primary text-white rounded-pill px-4">
                        <i class="bi bi-plus-circle-fill"></i> Thêm mới
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
