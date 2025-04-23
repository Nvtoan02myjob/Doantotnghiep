@extends('admin.partials.master')

@session('title')
    Sửa bài viết
@endsession

@section('content')
    <div class="p-4">
        <h1>Sửa bài viết</h1>
        
        {{-- Form sửa bài viết --}}
        <form action="{{ route('admin.news.update', $new->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            {{-- Tiêu đề --}}
            <div class="form-group">
                <label for="title">Tiêu đề</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" required value="{{ old('title', $new->title) }}">
                @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            {{-- Nội dung --}}
            <div class="form-group">
                <label for="body">Nội dung</label>
                <textarea class="form-control @error('content') is-invalid @enderror" id="body" name="content" rows="5">{{ old('content', $new->content) }}</textarea>
                @error('content')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Ảnh chính --}}
            <div class="form-group">
                <label for="image">Ảnh chính</label>
                <input type="file" name="image" class="form-control @error('image') is-invalid @enderror">
                <img src="{{ asset($new->image) }}" alt="Ảnh bài viết" width="100px" class="mt-2">
                @error('image')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Thể loại --}}
            <div class="form-group">
                <label for="type_news_id">Thể loại</label>
                <select class="form-control @error('type_news_id') is-invalid @enderror" id="type_news_id" name="type_news_id">
                    @foreach ($type_news as $item)
                        <option @if ($new->type_news_id == $item->id) selected @endif value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                </select>
                @error('type_news_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            {{-- Nút sửa --}}
            <button type="submit" class="btn btn-primary">Sửa</button>
        </form>
    </div>
@endsection
