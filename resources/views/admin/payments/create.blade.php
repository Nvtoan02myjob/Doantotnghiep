@extends('admin.partials.master')

@section('title', 'Thêm thanh toán')

@section('content')
<div class="m-2">
    <h1>Thêm thanh toán cho Đơn hàng {{ $order->id }}</h1>

    <!-- Hiển thị tổng tiền của đơn hàng -->
    <div class="mb-3">
        <strong>Tổng tiền đơn hàng: </strong>{{ number_format($order->price_total) }}₫
    </div>

    <!-- Hiển thị thông tin người đặt (User ID) -->
    <div class="mb-3">
        <strong>Người đặt: </strong>{{ $order->user->name ?? 'N/A' }} (ID: {{ $order->user->id ?? 'N/A' }})
    </div>

    <!-- Form để thêm thanh toán -->
    <form action="{{ route('admin.payments.store') }}" method="post">
        @csrf
        <div class="form-group">
            <label for="money">Số tiền nhận được</label>
            <input type="text"  value="{{ number_format($order->price_total) }}đ" readonly id="money" class="form-control"  >
        </div>
        <div class="form-group">
            <label for="payment_method">Phương thức thanh toán</label>
            <select name="payment_method" id="payment_method" class="form-control" required>
                <option value="Cash">Tiền mặt</option>
                
            </select>
        </div>
        <div class="form-group">
            <label for="node">Ghi chú</label>
            <textarea name="node" id="node" class="form-control"></textarea>
        </div>

        <!-- Thêm các trường ẩn để gửi order_id và table_id -->
        <input type="hidden" name="order_id" value="{{ $order->id }}">
        <input type="hidden" name="money" value="{{ $order->price_total ?? '' }}">


        <button type="submit" class="btn btn-primary">Thêm thanh toán</button>
    </form>
</div>
@endsection