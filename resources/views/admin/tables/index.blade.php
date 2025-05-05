@extends('admin.partials.master')


@section('content')
<div class="container mt-4">
    <h1>Danh sách bàn</h1>
    <a class="btn btn-info" href="{{ route('admin.tables.create') }}">Thêm bàn</a>

    <table class="table table-bordered table-hover">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>User ID</th>
                <th>QR Code</th>
                <th>Số người</th>
                <th>Trạng thái</th>
                <th>QR Image</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tables as $table)
                <tr>
                    <td>{{ $table->id }}</td>
                    <td>{{ $table->user_id }}</td>
                    <td>{{ $table->qr_code }}</td>




                    <td>{{ $table->quantity_person }}</td>
                    <td>
                    <span class="badge {{ $table->status ? 'bg-success' : 'bg-warning' }}">
                        {{ $table->status ? 'Đã có khách' : 'Còn trống' }}
                    </span>

                    </td>
                    <td>
                        @if ($table->qr_img)
                            <img src="{{ asset('storage/' . $table->qr_img) }}" alt="QR Image" width="80">
                        @else
                            Không có ảnh
                        @endif
                    </td>
                    <td>
                        @if ($table->deleted_at)
                            <a href="{{ route('admin.tables.restore', $table->id) }}" class="btn btn-warning btn-sm mb-1">Khôi phục</a>

                            <form action="{{ route('admin.tables.forceDelete', $table->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Bạn có chắc chắn muốn xóa vĩnh viễn?')" class="btn btn-danger btn-sm">Xóa vĩnh viễn</button>
                            </form>
                        @else
                            <a href="{{ route('admin.tables.edit', $table->id) }}" class="btn btn-primary btn-sm mb-1">Sửa</a>

                            <form action="{{ route('admin.tables.destroy', $table ->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Bạn có chắc chắn muốn xóa?')" class="btn btn-danger btn-sm">Xóa</button>
                            </form>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
