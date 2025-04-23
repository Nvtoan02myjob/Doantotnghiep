@extends('admin.partials.master')

@section('title')
    Sửa bàn
@endsection

@section('content')
<div class="m-2">
    <h1>Sửa bàn</h1>

    <form action="{{ route('admin.tables.update', $table->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        {{-- QR Code --}}
        <div class="form-group mb-3">
            <label for="qr_code" class="form-label fw-bold">QR Code</label>
            <input type="text" class="form-control {{ $errors->has('qr_code') ? 'is-invalid' : '' }}" id="qr_code" name="qr_code" value="{{ old('qr_code', $table->qr_code) }}" required>
            @error('qr_code')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Số lượng người --}}
        <div class="form-group mb-3">
            <label for="quantity_person" class="form-label fw-bold">Số lượng người</label>
            <input type="number" class="form-control {{ $errors->has('quantity_person') ? 'is-invalid' : '' }}" id="quantity_person" name="quantity_person" value="{{ old('quantity_person', $table->quantity_person) }}" min="1" required>
            @error('quantity_person')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Trạng thái bàn --}}
        <div class="form-group mb-3">
            <label for="status" class="form-label fw-bold">Trạng thái bàn</label>
            <select class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}" id="status" name="status" required>
                <option value="">-- Chọn trạng thái --</option>
                <option value="1" {{ old('status', $table->status) == '1' ? 'selected' : '' }}>Đã có khách</option>
                <option value="0" {{ old('status', $table->status) == '0' ? 'selected' : '' }}>Còn trống</option>
            </select>
            @error('status')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Ảnh QR --}}
        <div class="form-group mb-3">
            <label for="qr_img" class="form-label fw-bold">Ảnh QR</label>
            <input type="file" class="form-control {{ $errors->has('qr_img') ? 'is-invalid' : '' }}" id="qr_img" name="qr_img">
            @error('qr_img')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror

            @if($table->qr_img)
                <div class="mt-2">
                    <p class="fw-bold">Ảnh hiện tại:</p>
                    <img src="{{ asset('storage/' . $table->qr_img) }}" alt="QR Image" width="100" class="img-thumbnail">
                </div>
            @endif
        </div>

        <button type="submit" class="btn btn-primary">Cập nhật</button>
    </form>
</div>
@endsection
