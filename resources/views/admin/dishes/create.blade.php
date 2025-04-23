@extends('admin.partials.master')
@session('title')
    Thêm món ăn mới
@endsession
@section('content')
<div class="m-2">
        <h1>Thêm món ăn mới</h1>
       
<form action="{{ route('admin.dishes.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="mb-3">
        <label for="name">Tên món ăn</label>
        <input type="text" name="name" id="name" class="form-control" required>
    </div>

    <div class="mb-3">
        <label for="description">Mô tả món ăn</label>
        <textarea name="description" id="description" class="form-control" required></textarea>
    </div>

    <div class="mb-3">
        <label for="price">Giá</label>
        <input type="number" name="price" id="price" class="form-control" required>
    </div>

    <div class="mb-3">
        <label for="cate_id">Loại món ăn</label>
        <select name="cate_id" id="cate_id" class="form-select" required>
            @foreach($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
                <label for="img">Ảnh minh họa</label>
                {{-- <input type="text" class="form-control" name='img' > --}}
                <input type="file" name="img" class="form-control">
            </div>


    <button type="submit" class="btn btn-primary">Thêm món ăn</button>
</form>
@endsection