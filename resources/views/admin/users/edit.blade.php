<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
@extends('admin.partials.master')
@session('title')
    Thêm danh mục
@endsession
@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show rounded-pill" role="alert">
                    <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <div class="card shadow rounded-4">
                <div class="card-header bg-primary text-white rounded-top-4">
                    <h4 class="mb-0"><i class="bi bi-pencil-square me-2"></i>Cập nhật người dùng</h4>
                </div>

                <div class="card-body">
                    <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="name" class="form-label">Họ tên</label>
                            <input type="text" name="name" id="name"
                                   class="form-control rounded-pill @error('name') is-invalid @enderror"
                                   value="{{ old('name', $user->name) }}" required>
                            @error('name')
                                <div class="invalid-feedback ms-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" id="email"
                                   class="form-control rounded-pill @error('email') is-invalid @enderror"
                                   value="{{ old('email', $user->email) }}" required>
                            @error('email')
                                <div class="invalid-feedback ms-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="phone" class="form-label">Số điện thoại</label>
                            <input type="text" name="phone" id="phone"
                                   class="form-control rounded-pill @error('phone') is-invalid @enderror"
                                   value="{{ old('phone', $user->phone_number) }}" required>
                            @error('phone')
                                <div class="invalid-feedback ms-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Mật khẩu mới (nếu thay đổi)</label>
                            <input type="password" name="password" id="password" class="form-control rounded-pill @error('password') is-invalid @enderror">
                             @error('password')
                            <div class="invalid-feedback ms-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="password_confirmation" class="form-label">Xác nhận mật khẩu</label>
                            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control rounded-pill">
                        </div>

                        <!-- Thêm phần Role -->
                        <div class="mb-3">
                            <label for="role_id" class="form-label">Phân quyền</label>
                            <select name="role_id" id="role_id" class="form-control rounded-pill @error('role_id') is-invalid @enderror" required>
                                <option value="">Chọn quyền</option>
                                @foreach($roles as $role_item)
                                    <option value="{{ $role_item->id }}" {{ old('role_id', $user->role_id) == $role_item->id ? 'selected' : '' }}>{{ $role_item->role_name }}</option>
                                @endforeach
                            </select>
                            @error('role_id')
                                <div class="invalid-feedback ms-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('admin.users.index') }}" class="btn btn-secondary rounded-pill">
                                <i class="bi bi-arrow-left-circle"></i> Quay lại
                            </a>
                            <button type="submit" class="btn btn-primary rounded-pill">
                                <i class="bi bi-save2-fill"></i> Cập nhật
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
