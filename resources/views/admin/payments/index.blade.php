@extends('admin.partials.master')

@section('title', 'Danh sách thanh toán')

@section('content')
<div class="m-2">
    <h1>Danh sách thanh toán</h1>

    <div class="mb-3">
        @if ($payments->isNotEmpty())
            @foreach ($payments as $payment)
                @if ($payment->status == 0)
                    <a href="{{ route('admin.payments.create', ['order_id' => $payment->order_id]) }}" class="btn btn-primary">Thanh toán</a>
                @endif
            @endforeach
        @endif
    </div>

    <table class="table table-striped p-3 mt-3">
        <thead>
            <tr>
                <th>ID</th>
                <th>Đơn hàng</th>
                <th>Số tiền</th>
                <th>Phương thức</th>
                <th>Mã VNPAY</th>
                <th>Mã ngân hàng</th>
                <th>Ghi chú</th>
                <th>Trạng thái</th>
                <th>Thời gian thanh toán</th> <!-- Cột mới -->
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($payments as $payment)
                <tr>
                    <td>{{ $payment->id }}</td>
                    <td>{{ $payment->order_id }}</td>
                    <td>{{ number_format($payment->money) }}₫</td>
                    <td>{{ $payment->payment_method }}</td>
                    <td>{{ $payment->code_vnpay ?? '---' }}</td>
                    <td>{{ $payment->code_bank ?? '---' }}</td>
                    <td>{{ $payment->note ?? '---' }}</td>
                    <td>
                        <span class="badge {{ $payment->status == 1 ? 'bg-success' : 'bg-secondary' }}">
                            {{ $payment->status == 1 ? 'Đã thanh toán' : 'Chưa thanh toán' }}
                        </span>
                    </td>
                    <td>
                        {{ $payment->updated_at->format('d/m/Y H:i') }}
                    </td>
                    <td>
                        <form action="{{ route('admin.payments.destroy', $payment->id) }}" method="post" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc muốn xóa thanh toán này?')">Xóa</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div style="font-size: 12px; padding: 5px;">
        {{ $payments->links() }}
    </div>
</div>
@endsection
