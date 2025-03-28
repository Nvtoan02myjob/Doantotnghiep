@extends('admin.partials.master')
@session('title')
    Danh mục
@endsession
@section('content')
    <div class="m-2">
        <h1>Danh mục </h1>
        <a class="btn btn-info" href="{{ route('admin.categories.create') }}">Thêm danh mục</a>
        <table class="table table-striped p-3 mt-3">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Danh mục</th>

                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                    <tr>
                        <td>{{ $category->id }}</td>
                        <td>{{ $category->name }}</td>
                        <td>
                            <a class="btn btn-warning" href="{{ route('admin.categories.edit', $category) }}">Sửa</a>
                            <a class="btn btn-success" href="{{ route('admin.categories.show', $category) }}">show</a>
                            <form action="{{ route('admin.categories.destroy', $category) }}" method="POST"
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
       {{-- {{ $categories->link()}} --}}
    </div>
@endsection
