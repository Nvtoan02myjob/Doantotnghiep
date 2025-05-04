@extends('admin.partials.master')

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
    <h2>Danh sách món ăn</h2>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('admin.dishes.create') }}" class="btn btn-success mb-3">Thêm món ăn mới</a>

    <table class="table table-bordered table-hover">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Ảnh</th>
                <th>Tên món</th>
                <th>Giá</th>
                <th>Mô tả</th>
                <th>Danh mục</th> 
                <th>Trạng thái</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($dishes as $dish)
                <tr @if($dish->deleted_at) style="background-color: #f8d7da;" @endif>
                    <td>{{ $dish->id }}</td>
                    <td>
                        @if ($dish->img)
                            <img src="{{ asset('storage/' . $dish->img) }}" width="80" height="60" style="object-fit:cover;">
                        @else
                            Không có ảnh
                        @endif
                    </td>
                    <td>{{ $dish->name }}</td>
                    <td>{{ number_format($dish->price) }} VNĐ</td>
                    <td>{{ $dish->description }}</td>
                    
                        
                    <td>
                        {{ $dish->category->name ?? 'Chưa phân loại' }}
                    </td>
                    
                    <td>
                        @if ($dish->status)
                            <span class="badge bg-success">Hiển thị</span>
                        @else
                            <span class="badge bg-secondary">Đang ẩn</span>
                        @endif
                    </td>
                   

                    <td>
                        @if ($dish->deleted_at)
                            <a href="{{ route('admin.dishes.restore', $dish->id) }}" class="btn btn-warning btn-sm mb-1">Khôi phục</a>

                            <form action="{{ route('admin.dishes.forceDelete', $dish->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Bạn có chắc chắn muốn xóa vĩnh viễn?')" class="btn btn-danger btn-sm">Xóa vĩnh viễn</button>
                            </form>
                        @else
                            <a href="{{ route('admin.dishes.edit', $dish->id) }}" class="btn btn-primary btn-sm mb-1">Sửa</a>

                            <form action="{{ route('admin.dishes.destroy', $dish->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Bạn có chắc chắn muốn xóa?')" class="btn btn-danger btn-sm">Xóa</button>
                            </form>
                        @endif
                        <a href="{{ route('admin.dishes.toggleStatus', $dish->id) }}" class="btn btn-warning btn-sm">
                            @if ($dish->status)
                                Ẩn
                            @else
                                Hiện
                            @endif
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
