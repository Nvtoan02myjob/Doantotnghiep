@extends('admin.partials.master')

@session('title')
    Sửa mã giảm giá
@endsession

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">   
            <h1 >Sửa mã giảm giá</h1>

    {{-- Hiển thị lỗi chung nếu có --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.voucher.update', $voucher->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Tên voucher:</label>
            <input type="text" name="name" 
                   value="{{ old('name', $voucher->name) }}" 
                   class="form-control @error('name') is-invalid @enderror"
                   placeholder="Nhập tên voucher">
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Hình ảnh hiện tại:</label><br>
            <img src="{{ asset('storage/'.$voucher->image) }}" width="150" class="mb-2 rounded border">
            <input type="file" name="image" class="form-control @error('image') is-invalid @enderror mt-2">
            @error('image')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Điều kiện:</label>
            <input type="text" name="condition" 
                   value="{{ old('condition', $voucher->condition) }}" 
                   class="form-control @error('condition') is-invalid @enderror"
                   placeholder="Nhập điều kiện giảm giá">
            @error('condition')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Ngày hết hạn:</label>
            <input type="date" name="time_end" 
                   value="{{ old('time_end', $voucher->time_end ? \Carbon\Carbon::parse($voucher->time_end)->format('Y-m-d') : '') }}" 
                   class="form-control @error('time_end') is-invalid @enderror">
            @error('time_end')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Cập nhật</button>
        <a href="{{ route('admin.voucher.index') }}" class="btn btn-secondary">Quay lại</a>
    </form>
</div>
@endsection
