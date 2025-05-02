@extends('admin.partials.master')

@section('title')
    Thêm bàn
@endsection

@section('content')
<div class="container mt-4">
    <h1>Thêm bàn</h1>

    


    <form action="{{ route('admin.tables.store') }}" method="post" enctype="multipart/form-data">
        @csrf

        {{-- QR Code --}}
        <div class="form-group mb-3">
            <label for="qr_code">QR Code</label>
            <input type="text" class="form-control @error('qr_code') is-invalid @enderror" id="qr_code" name="qr_code" value="{{ old('qr_code') }}" >
            @error('qr_code')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        {{-- Số lượng người --}}
        <div class="form-group mb-3">
            <label for="quantity_person">Số lượng người</label>
            <input type="number" class="form-control @error('quantity_person') is-invalid @enderror" id="quantity_person" name="quantity_person" value="{{ old('quantity_person') }}" >
            @error('quantity_person')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <!-- {{-- Trạng thái bàn --}}
        <div class="form-group mb-3">
            <label for="status">Trạng thái bàn</label>
            <select class="form-control @error('status') is-invalid @enderror" id="status" name="status" required>
                <option value="">-- Chọn trạng thái --</option>
                <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>Đã có khách</option>
                <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Còn trống</option>
            </select>
            @error('status')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div> -->

        {{-- Ảnh QR --}}
        <div class="form-group mb-3">
            <label for="qr_img">Ảnh QR</label>
            <input type="file" class="form-control @error('qr_img') is-invalid @enderror" id="qr_img" name="qr_img">
            @error('qr_img')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <input type="hidden" name="status" value="0">


        <button type="submit" class="btn btn-primary">Thêm</button>
    </form>
</div>
@endsection
