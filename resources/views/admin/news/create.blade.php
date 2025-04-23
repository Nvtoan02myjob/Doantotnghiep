@extends('admin.partials.master')

@session('title')
    Thêm bài viết
@endsession

@section('content')
<div class="p-4">
    <h1>Thêm bài viết</h1>
    <form action="{{ route('admin.news.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">

        <div class="form-group">
            <label for="title">Tiêu đề</label>
            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title') }}" required>
            @error('title')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="summary">Tóm tắt</label>
            <textarea class="form-control @error('summary') is-invalid @enderror" id="summary" name="summary" rows="3" required>{{ old('summary') }}</textarea>
            @error('summary')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="content">Nội dung</label>
            <textarea class="form-control @error('content') is-invalid @enderror" id="content" name="content" rows="5" required>{{ old('content') }}</textarea>
            @error('content')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="image">Ảnh chính</label>
            <input type="file" name="image" class="form-control @error('image') is-invalid @enderror">
            @error('image')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="type_news_id">Thể loại</label>
            <select class="form-control @error('type_news_id') is-invalid @enderror" id="type_news_id" name="type_news_id" required>
                @foreach ($type_news as $item)
                    <option value="{{ $item->id }}" @selected(old('type_news_id') == $item->id)>{{ $item->name }}</option>
                @endforeach
            </select>
            @error('type_news_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <br>
        <button type="submit" class="btn btn-primary">Thêm</button>
    </form>
</div>
@endsection

@section('js-custom')
<!-- Thêm CKEditor từ CDN khác -->
<script src="https://cdn.jsdelivr.net/npm/@ckeditor/ckeditor5-build-classic@35.0.0/build/ckeditor.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Kiểm tra xem CKEditor đã được tải chưa
        if (typeof ClassicEditor !== 'undefined') {
            // Khởi tạo CKEditor cho trường tóm tắt
            ClassicEditor
                .create(document.querySelector('#summary'))  
                .catch(error => console.error('CKEditor summary:', error));

            // Khởi tạo CKEditor cho trường nội dung
            ClassicEditor
                .create(document.querySelector('#content'))  
                .catch(error => console.error('CKEditor content:', error));
        } else {
            console.error('CKEditor không được tải đúng cách!');
        }
    });
</script>
@endsection
