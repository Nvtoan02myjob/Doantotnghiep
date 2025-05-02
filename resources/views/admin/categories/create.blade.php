@extends('admin.partials.master')

@session('title')
    Thêm danh mục
@endsession

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <h1>Thêm danh mục</h1>

        {{-- Thông báo thành công --}}
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

       

        {{-- Nút quay lại --}}
        <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary mb-3">Quay lại danh sách</a>

        {{-- Form --}}
        <form action="{{ route('admin.categories.store') }}" method="post">
            @csrf

            <div class="form-group mb-3">
                <label for="name">Tên danh mục</label>
                <input
                    type="text"
                    class="form-control @error('name') is-invalid @enderror"
                    id="name"
                    name="name"
                    value="{{ old('name') }}"
                    required
                >
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Thêm</button>
        </form>
    </div>
</div>
@endsection
