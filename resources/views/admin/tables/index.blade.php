@extends('admin.partials.master')

@session('title')
    Bảng danh sách bàn
@endsession

@section('content')
<div class="m-2">
    <h1>Danh sách bàn</h1>
    <a class="btn btn-info" href="{{ route('admin.tables.create') }}">Thêm bàn</a>

    <table class="table table-striped p-3 mt-3">
        <thead>
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
                    <span class="badge {{ $table->status == 1 ? 'bg-success' : 'bg-secondary' }}">
                            {{ $table->status == 0 ? 'Còn trống' : 'Đã đặt bàn' }}
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
                        <a class="btn btn-warning" href="{{ route('admin.tables.edit', $table) }}">Sửa</a>
                        <form action="{{ route('admin.tables.destroy', $table) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger"
                                onclick="return confirm('Bạn có chắc muốn xóa bàn này?')">Xóa</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
