@extends('admin.partials.master')
@session('title')
    Danh sách bài viết
@endsession
@section('content')
    <div class="m-2">
        <h1>Danh sách bài viết</h1>
        <a class="btn btn-info" href="{{ route('admin.posts.create') }}">Thêm bài viết</a>

        <form class="mt-5" action="{{ route('admin.posts.seach') }}" method="get">
            <select name="category_id" class="form-sekect">
                <option value="" hidden>Thể loại</option>
                @foreach ($category as $item)
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                @endforeach
            </select>
            <input type="text" class="form-select" name="keyword"  placeholder="Tìm kiếm...">
            <button type="submit">Search</button>
        </form>


        <table class="table table-striped p-3 mt-3">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tiêu đề</th>
                    <th>Ảnh đại diện</th>
                    <th>Thể loại</th>
                    <th>Ngày đăng</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($posts as $post)
                    <tr>
                        <td>{{ $post->id }}</td>
                        <td>{{ $post->title }}</td>
                        <td><img src="{{ asset($post->image) }}" alt="" width="200px"></td>
                        <td>{{ $post->category->name }}</td>

                        <td>{{ $post->created_at }}</td>
                        <td>
                            <a class="btn btn-warning" href="{{ route('admin.posts.edit', $post->id) }}">Sửa</a>
                            <a class="btn btn-success" href="{{ route('admin.posts.show', $post->id) }}">show</a>
                            <form action="{{ route('admin.posts.destroy', $post->id) }}" method="POST"
                                style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger"
                                    onclick="return confirm('Bạn có chắc muốn xóa bài viết này?')">Xóa</button>
                            </form>
                        </td>
                @endforeach
            </tbody>
        </table>
        {{-- {{ $posts->link()}} --}}
    </div>
@endsection
