@extends('admin.partials.master')

@session('title')
    Sửa món ăn
@endsession

@section('content')
    <div class="m-2">
        <h1>Sửa món ăn</h1>

        <form action="{{ route('admin.dishes.update', $dishes->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT') <!-- Sử dụng PUT method để cập nhật -->

            <div class="mb-3">
                <label for="name">Tên món ăn</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ $dishes->name }}" required>
            </div>

            <div class="mb-3">
                <label for="description">Mô tả món ăn</label>
                <textarea name="description" id="description" class="form-control" required>{{ $dishes->description }}</textarea>
            </div>

            <div class="mb-3">
                <label for="price">Giá</label>
                <input type="number" name="price" id="price" class="form-control" value="{{ $dishes->price }}" required>
            </div>

            <div class="mb-3">
                <label for="cate_id">Loại món ăn</label>
                <select name="cate_id" id="cate_id" class="form-select" required>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ $category->id == $dishes->cate_id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="img">Ảnh minh họa</label><br>

                <!-- Hiển thị ảnh hiện tại -->
                <div class="mb-2">
                    <img src="{{ asset($dishes->img) }}" alt="Dish Image" width="150" height="150">
                </div>

                <!-- Cho phép chọn ảnh mới -->
                <input type="file" name="img" class="form-control">
                <p class="mt-2 text-secondary">Nếu không chọn ảnh mới, ảnh hiện tại sẽ được giữ nguyên.</p>
            </div>

            <button type="submit" class="btn btn-primary">Cập nhật món ăn</button>
        </form>
    </div>
@endsection
