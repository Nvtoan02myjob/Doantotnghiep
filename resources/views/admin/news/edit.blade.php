@extends('admin.partials.master')
@section('title', 'Sửa bài viết')

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
    <h2>Sửa bài viết</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('admin.news.update', $new->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Tiêu đề</label>
            <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                   value="{{ old('title', $new->title) }}">
            @error('title')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Nội dung</label>
            <textarea name="content" class="form-control @error('content') is-invalid @enderror"
                      rows="5">{{ old('content', $new->content) }}</textarea>
            @error('content')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Ảnh hiện tại</label><br>
            <img src="{{ asset($new->image) }}" style="width: 120px;">
        </div>

        <div class="mb-3">
            <label class="form-label">Chọn ảnh mới (nếu muốn thay)</label>
            <input type="file" name="image" class="form-control @error('image') is-invalid @enderror">
            @error('image')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Thể loại</label>
            <select name="type_news_id" class="form-select @error('type_news_id') is-invalid @enderror">
                @foreach($type_news as $type)
                    <option value="{{ $type->id }}" {{ (old('type_news_id', $new->type_news_id) == $type->id) ? 'selected' : '' }}>
                        {{ $type->name }}
                    </option>
                @endforeach
            </select>
            @error('type_news_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Cập nhật</button>
    </form>
</div>
@endsection
