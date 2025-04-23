@extends('admin.partials.master')
@session('title')
    Danh sách món ăn
@endsession
@section('content')
    <div class="m-2">
        <h1>Danh sách món ăn</h1>
        <a class="btn btn-info" href="{{ route('admin.dishes.create') }}">Thêm món ăn mới</a>
        
        {{-- Uncomment and fix the search form when needed --}}
        {{-- <form class="mt-5" action="{{ route('admin.dishes.seach') }}" method="get">
            <select name="category_id" class="form-select">
                <option value="" hidden>Thể loại</option>
                @foreach ($category as $item)
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                @endforeach
            </select>
            <input type="text" class="form-select" name="keyword" placeholder="Tìm kiếm...">
            <button type="submit">Search</button>
        </form> --}}
        
        <table class="table table-striped p-3 mt-3">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tên món ăn</th>
                    <th>Ảnh minh họa</th>
                    <th>Loại món ăn</th>
                    <th>Mô tả món ăn</th>
                    <th>Giá</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($dishes as $dish)
    <tr>
        <td>{{ $dish->id }}</td>
        <td>{{ $dish->name }}</td>
        <td>
            <img src="{{ asset($dish->img) }}" alt="Ảnh minh họa" 
             style="width: 100px; height: 100px; object-fit: cover;">
        </td>
        <td>{{ $dish->categories ? $dish->categories->name : 'Chưa phân loại' }}</td>
        <td>{{ $dish->description }}</td>
        <td>{{ $dish->price }}</td>
        <td>
    <a href="{{ route('admin.dishes.toggleStatus', $dish->id) }}" 
       class="btn btn-sm {{ $dish->status ? 'btn-success' : 'btn-secondary' }}">
        {{ $dish->status ? 'Hiện' : 'Ẩn' }}
    </a>
</td>

        <td>
            <a class="btn btn-warning" href="{{ route('admin.dishes.edit', $dish->id) }}">Sửa</a>
            <a class="btn btn-success" href="{{ route('admin.dishes.show', $dish->id) }}">Show</a>
            <form action="{{ route('admin.dishes.destroy', $dish->id) }}" method="post" style="display: inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" onclick="return confirm('Bạn có chắc muốn xóa món ăn này?')">Xóa</button>
            </form>
        </td>
    </tr>
@endforeach

            </tbody>
        </table>

        <span style="font-size: 12px; padding: 5px;">
            {{ $dishes->links() }}
        </span>
    </div>
@endsection
