@extends('admin.partials.master')
@session('title')
    Thêm mã giảm giá
@endsession
@section('content')
<div class="container my-4">
    <h1 class="mb-4">Thêm mã giảm giá</h1>
    <form action="{{ route('admin.voucher.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label class="form-label">Tên voucher:</label>
            <input type="text" name="name" class="form-control" placeholder="Nhập tên voucher">
        </div>

        <div class="mb-3">
            <label class="form-label">Hình ảnh:</label>
            <input type="file" name="image" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Điều kiện:</label>
            <input type="text" name="condition" class="form-control" placeholder="Nhập điều kiện giảm giá">
        </div>

        <div class="mb-3">
            <label class="form-label">Ngày hết hạn:</label>
            <input type="date" name="time_end" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Thêm</button>
        <a href="{{ route('admin.voucher.index') }}" class="btn btn-secondary">Quay lại</a>
    </form>
</div>
@endsection
