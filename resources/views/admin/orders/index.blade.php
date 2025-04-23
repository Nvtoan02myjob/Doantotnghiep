@extends('admin.partials.master')

@section('title', 'Danh sách đơn hàng')

@section('content')
<div class="m-2">
    <h1>Danh sách đơn hàng</h1>

    <table class="table table-striped p-3 mt-3">
        <thead>
            <tr>
                <th>ID</th>
                <th>Người đặt</th>
                <th>Bàn</th>
                <th>Mã PIN</th>
                <th>Tổng tiền</th>
                <th>Ngày đặt</th>
                <th>Trạng thái</th>
                <th>Thanh toán</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order)
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->user->name ?? 'N/A' }}</td>
                    <td>{{ $order->table_id ?? 'Chưa chọn' }}</td>
                    <td>{{ $order->pin_code }}</td>
                    <td>{{ number_format($order->price_total) }}₫</td>
                    <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
                    <td>
                        <span class="badge {{ $order->status == 1 ? 'bg-success' : 'bg-secondary' }}">
                            {{ $order->status == 0 ? 'Đã thanh toán' : 'Chưa thanh toán' }}
                        </span>
                    </td>
                    <td>
                        @if($order->status == 1)
                            <a href="{{ route('admin.payments.create', ['order_id' => $order->id]) }}" class="btn btn-primary btn-sm">Thanh toán</a>
                        @else
                            <span class="text-success">Đã thanh toán</span>
                        @endif
                    </td>
                    <td>
                        <a class="btn btn-success btn-sm" href="{{ route('admin.orders.show', $order->id) }}">Xem</a>

                        <form action="{{ route('admin.orders.destroy', $order->id) }}" method="post" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm"
                                onclick="return confirm('Bạn có chắc muốn xóa đơn hàng này?')">Xóa</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div style="font-size: 12px; padding: 5px;">
        {{ $orders->links() }}
    </div>
</div>
@endsection
