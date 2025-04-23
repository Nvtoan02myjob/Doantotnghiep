@extends('admin.partials.master')
@session('title')
    Danh mục
@endsession
@section('content')
    <div class="m-2">
        <h1>Loại</h1>
        <a class="btn btn-info" href="{{ route('admin.type_news.create') }}">Thêm loại</a>
        <table class="table table-striped p-3 mt-3">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Loại</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($type_news as $tye)
                    <tr>
                        <td>{{ $tye->id }}</td>
                        <td>{{ $tye->name }}</td>
                        <td>
                            <a class="btn btn-warning" href="{{ route('admin.type_news.edit', $tye) }}">Sửa</a>
                            <form action="{{ route('admin.type_news.destroy', $tye) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger"
                                    onclick="return confirm('Bạn có chắc muốn xóa bài viết này?')">Xóa</button>
                            </form>
                        </td>
                @endforeach
            </tbody>
        </table>
        {{-- {{ $tyes->link()}} --}}
    </div>
@endsection