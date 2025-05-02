@extends('admin.partials.master')

@session('title')
    Thêm mã giảm giá
@endsession

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
    <h1 >Thêm mã giảm giá</h1>
    @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <a href="{{ route('admin.voucher.index') }}" class="btn btn-secondary mb-3">Quay lại danh sách</a>

    

    <form action="{{ route('admin.voucher.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label class="form-label">Tên voucher:</label>
            <input type="text" name="name" class="form-control" value="{{ old('name') }}" placeholder="Nhập tên voucher">
            @error('name')
                <div class="text-danger mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Hình ảnh:</label>
            <input type="file" name="image" class="form-control">
            @error('image')
                <div class="text-danger mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Điều kiện:</label>
            <input type="text" name="condition" class="form-control" value="{{ old('condition') }}" placeholder="Nhập điều kiện giảm giá">
            @error('condition')
                <div class="text-danger mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Ngày hết hạn:</label>
            <input type="date" name="time_end" class="form-control" value="{{ old('time_end') }}">
            @error('time_end')
                <div class="text-danger mt-1">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Thêm</button>
        <a href="{{ route('admin.voucher.index') }}" class="btn btn-secondary">Quay lại</a>
    </form>
</div>
@endsection
