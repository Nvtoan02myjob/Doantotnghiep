@extends('admin.partials.master')
@section('title')
    Trang chủ admin
@endsection

@section('content')
    <div class="content_statistical">
        <form action="{{ route('admin.calculate')}}" method="post">
            @csrf
            <div class="form-group">
                <select name="filter_type" id="filter_type" onchange="show_input(this.value)">
                    <option value="">-Lựa chọn thống kê-</option>
                    <option value="1">Thống kê theo ngày</option>
                    <option value="2">Thống kê theo tháng</option>
                    <option value="3">Thống kê theo năm</option>
                </select>
            </div>

            <div id="date_input" class="input-group"  style="display: none;">
                <label for="date">Chọn ngày:</label>
                <input type="date" name="date" id="date" value="{{ old('date') }}" max="{{ date('Y-m-d') }}"  class="form-control">
            </div>

            <div id="month_input" class="input-group" style="display: none;">
                <label for="month">Chọn tháng:</label>
                <input type="month" name="month" id="month" value="{{ old('month') }}" min="2022-01" max="{{ date('Y-m') }}" class="form-control">
            </div>

            <div id="year_input" class="input-group" style="display: none;">
                <label for="year">Chọn năm:</label>
                <input type="number" name="year" id="year" value="{{ old('year') }}" min="2024" max="{{ date('Y') }}" class="form-control">
            </div>

            <input type="submit" value="Xác nhận" class="btn btn-primary mt-2">
        </form>
        <div class="data_money mt-4">
            @if(isset($success) && isset($total))
                <div class="alert alert-info" role="alert">
                    Tổng tiền trong {{ $success }} là: {{ number_format($total, 0, ',', '.') }} VNĐ     
                </div>
                <table border=1 style="width: 100%">
                    <thead>
                        <tr>
                            <th>Phương thức thanh toán</th>
                            <th>Thời gian</th>
                            <th>Số tiền</th>
                            <th>Ngân hàng</th>
                            <th>Trạng thái</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach($payment as $payment_item)
                            <tr>
                                <td>{{ $payment_item->payment_method }}</td>
                                <td>{{ \Carbon\Carbon::parse($payment_item->created_at)->format('d/m/Y') }}</td>
                                <td>{{ number_format($payment_item->money) }} vnđ</td>
                                <td>{{ $payment_item->code_bank }}</td>
                                <td>
                                    @if($payment_item->status == 1)
                                        Thành công
                                    @endif
                                    
                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
            @if(session('error'))
                <div class="alert alert-danger" role="alert">
                    {{ session('error') }}        
                </div>
            @endif
        </div>
    </div>

    <script>
        function show_input(value) {
            document.getElementById('date_input').style.display = 'none';
            document.getElementById('month_input').style.display = 'none';
            document.getElementById('year_input').style.display = 'none';

            if (value == '1') {
                document.getElementById('date_input').style.display = 'flex';
            } else if (value == '2') {
                document.getElementById('month_input').style.display = 'flex';
            } else if (value == '3') {
                document.getElementById('year_input').style.display = 'flex';
            }
        }

    </script>
@endsection
