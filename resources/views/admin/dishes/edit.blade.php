@extends('admin.partials.master')

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
    <h2>Chỉnh sửa món ăn</h2>

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

    <form action="{{ route('admin.dishes.update', $dish->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Tên món ăn</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $dish->name) }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Giá</label>
            <input type="number" name="price" class="form-control" value="{{ old('price', $dish->price) }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Mô tả</label>
            <textarea name="description" class="form-control">{{ old('description', $dish->description) }}</textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">Chọn danh mục</label>
            <select name="cate_id" required class="form-control">
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>


        <div class="mb-3">
            <label class="form-label">Hình ảnh hiện tại</label><br>
            @if ($dish->img)
                <img  src="{{ asset('storage/'. $dish->img) }}" width="100" height="80" style="object-fit:cover;">
            @else
                Không có ảnh
            @endif
        </div>

        <div class="mb-3">
            <label class="form-label">Chọn hình ảnh mới (nếu muốn đổi)</label>
            <input type="file" name="img" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Cập nhật món ăn</button>
        <a href="{{ route('admin.dishes.index') }}" class="btn btn-secondary">Quay lại</a>
    </form>
</div>
@endsection
