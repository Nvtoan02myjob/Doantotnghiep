@extends('admin.partials.master')

@session('title')
    Danh mục
@endsession

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <h1>Danh mục</h1>
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <a class="btn btn-info mb-3" href="{{ route('admin.categories.create') }}">Thêm danh mục</a>

        <table class="table table-bordered table-hover">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Danh mục</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                    <tr>
                        <td>{{ $category->id }}</td>
                        <td>{{ $category->name }}</td>
                        <td>
                            @if($category->trashed())
                                <!-- Hiển thị nút khôi phục và xóa vĩnh viễn nếu danh mục đã bị xóa mềm -->
                                <form action="{{ route('admin.categories.restore', $category) }}" method="POST" style="display: inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-success">Khôi phục</button>
                                </form>

                                <form action="{{ route('admin.categories.forceDelete', $category) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Bạn có chắc muốn xóa vĩnh viễn danh mục này?')">Xóa vĩnh viễn</button>
                                </form>
                            @else
                                <!-- Hiển thị nút sửa và xóa bình thường nếu danh mục chưa bị xóa mềm -->
                                <a class="btn btn-warning" href="{{ route('admin.categories.edit', $category) }}">Sửa</a>
                                <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Bạn có chắc muốn xóa danh mục này?')">Xóa</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Phân trang -->
        {{ $categories->links() }}
    </div>
</div>
@endsection
