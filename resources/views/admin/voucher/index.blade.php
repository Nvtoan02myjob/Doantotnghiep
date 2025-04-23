@extends('admin.partials.master')

@section('title')
    Mã giảm giá 
@endsection

@section('content')
    <div class="m-2">
        <h1>Mã giảm giá</h1>
        <a class="btn btn-info" href="{{ route('admin.voucher.create') }}">Thêm mã giảm giá</a>
        <table class="table table-striped p-3 mt-3">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Danh mục</th>
                    <th>Hình ảnh</th>
                    <th>Điều kiện</th>
                    <th>Thời gian kết thúc</th>
                    <th>Ngày tạo</th>
                    <th>Ngày cập nhật</th>
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
                        <a href="{{ route('admin.voucher.edit', $voucher->id) }}">Sửa</a>
                            <form action="{{ route('admin.voucher.destroy', $voucher->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Bạn có chắc chắn muốn xóa mã giảm giá này không?')">Xóa</button>
                            </form>

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{-- Pagination --}}
        {{ $vouchers->links() }}
    </div>
@endsection
