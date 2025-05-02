@extends('admin.partials.master')

@session('title')
    Danh mục
@endsession

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <h1>Loại tin</h1>
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <a class="btn btn-info mb-3" href="{{ route('admin.type_news.create') }}">Thêm loại</a>

        <table class="table table-striped p-3 mt-3">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Loại</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($type_news as $type)
                    <tr>
                        <td>{{ $type->id }}</td>
                        <td>{{ $type->name }}</td>
                        <td>
                            @if ($type->trashed())
                                <a href="{{ route('admin.type_news.restore', $type->id) }}" class="btn btn-primary btn-sm">Khôi phục</a>
                                <form action="{{ route('admin.type_news.forceDelete', $type->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Xóa vĩnh viễn loại tin này?')">Xóa vĩnh viễn</button>
                                </form>
                            @else
                                <a class="btn btn-warning btn-sm" href="{{ route('admin.type_news.edit', $type->id) }}">Sửa</a>
                                <form action="{{ route('admin.type_news.destroy', $type->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc muốn xóa loại tin này?')">Xóa</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{ $type_news->links() }}
    </div>
</div>
@endsection
