@extends('admin.partials.master')
@session('title')
    Thêm bài viết
@endsession
@section('content')
    <div class="p-4">
        <h1>Thêm bài viết</h1>
        <form action="{{ route('admin.news.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group">

                <input type="text" class="form-control" id="title" name="user_id" value="{{ Auth::user()->id }}"
                    hidden>
            </div>
            <div class="form-group">
                <label for="title">Tiêu đề</label>
                <input type="text" class="form-control" id="title" name="title" required>
            </div>
            <div class="form-group">
                <label for="body">Tóm tắt</label>
                <textarea class="form-control" id="body" name="summary" rows="3" required></textarea>
            </div>
            <div class="form-group">
                <label for="body">Nội dung</label>
                <textarea class="form-control" id="body" name="content" rows="3" required></textarea>
            </div>
            <div class="form-group">
                <label for="image">Ảnh chính</label>
                {{-- <input type="text" class="form-control" name='image' > --}}
                <input type="file" name="image" class="form-control">
            </div>

            <div class="form-group">
                <label for="type_news_id">Thể loại</label>
                <select class="form-control" id="type_news_id" name="type_news_id">
                    @foreach ($type_news as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                </select>
            </div>

            <br>
            <button type="submit" class="btn btn-primary">Thêm</button>
        </form>

    </div>
@endsection
