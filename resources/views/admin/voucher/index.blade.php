@extends('admin.partials.master')

@section('title')
    Mã giảm giá
@endsection

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <h1>Mã giảm giá</h1>
        <a class="btn btn-info" href="{{ route('admin.voucher.create') }}">Thêm mã giảm giá</a>

        @if(session('success'))
            <div class="alert alert-success mt-2">
                {{ session('success') }}
            </div>
        @endif

        <table class="table table-striped p-3 mt-3">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Tên</th>
                    <th>Hình ảnh</th>
                    <th>Điều kiện</th>
                    <th>Kết thúc</th>
                    <th>Tạo lúc</th>
                    <th>Cập nhật</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
                @foreach($vouchers as $voucher)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $voucher->name }}</td>
                        <td><img src="{{ asset('storage/'.$voucher->image) }}" width="100"></td>
                        <td>{{ $voucher->condition }}</td>
                        <td>{{ $voucher->time_end }}</td>
                        <td>{{ $voucher->created_at }}</td>
                        <td>{{ $voucher->updated_at }}</td>
                        <td>
                            @if ($voucher->trashed())
                                <!-- Đã bị xóa mềm -->
                                <form action="{{ route('admin.voucher.restore', $voucher->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-success">Khôi phục</button>
                                </form>

                                <form action="{{ route('admin.voucher.forceDelete', $voucher->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Xóa vĩnh viễn voucher này?')">Xóa vĩnh viễn</button>
                                </form>
                            @else
                                <!-- Còn hoạt động -->
                                <a href="{{ route('admin.voucher.edit', $voucher->id) }}" class="btn btn-sm btn-warning">Sửa</a>

                                <form action="{{ route('admin.voucher.destroy', $voucher->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Xóa mềm voucher này?')">Xóa</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{ $vouchers->links() }}
    </div>
@endsection
