@extends('admin.partials.master')

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
    <h2>Thêm món ăn mới</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Vui lòng kiểm tra lại dữ liệu!</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.dishes.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label class="form-label">Tên món ăn</label>
            <input type="text" name="name" class="form-control" value="{{ old('name') }}">
        </div>


        <div class="mb-3">
            <label class="form-label">Giá</label>
            <input type="number" name="price" class="form-control" value="{{ old('price') }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Mô tả</label>
            <textarea name="description" class="form-control">{{ old('description') }}</textarea>
        </div>

        <div class="mb-3">
    <label class="form-label">Danh mục</label>
    <select name="cate_id" class="form-control" required>
        <option value="">-- Chọn danh mục --</option>
        @foreach ($categories as $category)
            <option value="{{ $category->id }}">{{ $category->name }}</option>
        @endforeach
    </select>
</div>


        <div class="mb-3">
            <label class="form-label">Hình ảnh</label>
            <input type="file" name="img" class="form-control">
        </div>

        <button type="submit" class="btn btn-success">Lưu món ăn</button>
        <a href="{{ route('admin.dishes.index') }}" class="btn btn-secondary">Quay lại</a>
    </form>
</div>
@endsection
