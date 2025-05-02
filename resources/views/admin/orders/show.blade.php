@extends('admin.partials.master')

@session('title')
    Chi tiết đơn hàng {{ $order->id }}
@endsession

@section('content')
    <div class="m-2">
        <h1>Chi tiết đơn hàng {{ $order->id }}</h1>

        <p><strong>Người đặt:</strong> {{ $order->user->name ?? 'N/A' }}</p>
        <p><strong>Bàn:</strong> {{ $order->table_id ?? 'Chưa chọn' }}</p>
        <p><strong>Mã PIN:</strong> {{ $order->pin_code }}</p>
        <p><strong>Tổng tiền:</strong> {{ number_format($order->price_total) }}₫</p>
        <p><strong>Ngày đặt:</strong> {{ $order->created_at->format('d/m/Y H:i') }}</p>
        <p><strong>Trạng thái:</strong> 
            <span class="badge {{ $order->status == 0 ? 'bg-success' : 'bg-secondary' }}">
                {{ $order->status == 0 ? 'Đã thanh toán' : 'Chưa thanh toán' }}
            </span>
        </p>

        <h3 class="mt-4">Danh sách món ăn</h3>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Tên món</th>
                    <th>Số lượng</th>
                    <th>Đơn giá</th>
                    <th>Thành tiền</th>
                </tr>
            </thead>
            <tbody>
                @foreach($order->orderDetails as $detail)
                    <tr>
                        <td>{{ $detail->dish->name ?? 'N/A' }}</td>
                        <td>{{ $detail->quantity }}</td>
                        <td>{{ number_format($detail->unit_price) }}₫</td>
                        <td>{{ number_format($detail->unit_price * $detail->quantity) }}₫</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary">Quay lại</a>
    </div>
@endsection
