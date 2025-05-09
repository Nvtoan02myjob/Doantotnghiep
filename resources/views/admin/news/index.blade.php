@extends('admin.partials.master')
@session('title')
    Danh sách bài viết
@endsession
@section('content')
<div class="container my-5">
<div class="row justify-content-center">
        <h1>Danh sách bài viết</h1>
        <a class="btn btn-info" href="{{ route('admin.news.create') }}">Thêm bài viết</a>

        {{-- Form tìm kiếm --}}
        {{--
        <form class="mt-5" action="{{ route('admin.news.seach') }}" method="get">
            <select name="category_id" class="form-select">
                <option value="" hidden>Thể loại</option>
                @foreach ($category as $item)
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                @endforeach
            </select>
            <input type="text" class="form-control" name="keyword" placeholder="Tìm kiếm...">
            <button type="submit">Search</button>
        </form>
        --}}

        <table class="table table-striped p-3 mt-3">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Tiêu đề</th>
                    <th>Tóm tắt</th>
                    <th>Ảnh đại diện</th>
                    <th>Thể loại</th>
                    <th>Ngày đăng</th>
                    <th>Tác giả</th>
                    <th>Trạng thái</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($news as $new)
                    <tr>
                        <td>{{ $new->id }}</td>

                        <td>{{ $new->title }}</td>
                        <td>{{ \Illuminate\Support\Str::limit(strip_tags($new->summary), 100) }}</td>

                        <td>
                            <img src="{{ asset($new->image) }}" alt="Ảnh đại diện"
                                 style="width: 100px; height: 100px; object-fit: cover;">
                        </td>
                        <td>{{ $new->type_news->name }}</td>
                        <td>{{ $new->created_at }}</td>
                        <td>{{ $new->user->name }}</td>
                        <td>
                            <a href="{{ route('admin.news.changeStatus', $new->id) }}"
                               class="btn btn-sm {{ $new->status ? 'btn-success' : 'btn-secondary' }}">
                                {{ $new->status ? 'Hiện' : 'Ẩn' }}
                            </a>
                        </td>
                        <td>
                            @if ($new->trashed()) <!-- Check if the article is soft-deleted -->
                                <a href="{{ route('admin.news.restore', $new->id) }}" class="btn btn-primary">Khôi phục</a>
                                <form action="{{ route('admin.news.forceDelete', $new->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Bạn có chắc muốn xóa vĩnh viễn bài viết này?')">Xóa vĩnh viễn</button>
                                </form>
                            @else
                                <a class="btn btn-warning" href="{{ route('admin.news.edit', $new->id) }}">Sửa</a>
                                <a class="btn btn-success" href="{{ route('admin.news.show', $new->id) }}">Xem</a>
                                <form action="{{ route('admin.news.destroy', $new->id) }}" method="post" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Bạn có chắc muốn xóa bài viết này?')">Xóa</button>
                                </form>
                            @endif
                        </td>


                    </tr>
                @endforeach
            </tbody>
        </table>

        <span style="font-size: 10px; padding: 3px;">
            {{ $news->links('pagination::bootstrap-4') }}
        </span>
    </div>
@endsection
