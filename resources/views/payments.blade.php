@extends('admin.partials.master')
@section('title')
    Trang chủ admin
@endsection
@section('content')
    <!DOCTYPE html>
    <html lang="vi">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Danh sách sản phẩm</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <style>
            .details-row {
                display: none;
                background: #f8f9fa;
            }
        </style>
    </head>
    <body>
    <div class="container mt-4">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Số bàn</th>
                    <th>Tên người dùng</th>
                    <th>Tổng thanh toán</th>
                    <th>Thời gian Gọi món</th>
                    <th>Thực hiện</th>
                </tr>
            </thead>
            <tbody id="productTable">
                @foreach($orders as $order_item)  
                    @php
                        $user = $users->firstWhere('id', $order_item->user_id);
                        $details = $order_detail->where('order_id', $order_item->id);
                    @endphp
                    <tr>
                        <td>{{ $order_item->table_id }}</td>
                        <td>{{ $user ? $user->name : 'Không xác định' }}</td>
                        <td>{{ number_format($order_item->price_total) }}đ</td>
                        <td>{{ \Carbon\Carbon::parse($order_item->created_at)->format('d/m/Y H:i') }}</td>
                        <td>
                            <button class="btn btn-success" data-bs-toggle="dropdown" aria-expanded="false">Thanh toán</button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">Thanh toán thủ công</a></li>
                                <li><a href="{{ route('vnpay.payment', ['order_id' => $order_item->id, 'price_total' => $order_item->price_total])}}" >Thanh toán chuyển khoản</a></li>
                            </ul>
                            <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal{{ $order_item->id }}">Từ chối</button>
                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal{{ $order_item->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Xóa Order <span class="text-danger">{{ $order_item->id }}</span></h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Bạn có chắc muốn xóa dữ liệu order này
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Quay lại</button>
                                        <button type="button" class="btn btn-danger">Xóa</button>
                                    </div>
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-info toggle-details">Xem chi tiết</button>
                        </td>
                    </tr>
                    <tr class="details-row">
                        <td colspan="3">
                            @foreach($details as $detail_item)
                                <strong>Mã món: </strong> {{ $detail_item->dish_id }}. <br>
                                <strong>Số lượng: </strong> {{ $detail_item->quantity }}. <br>
                                <strong>Đơn giá: </strong> {{ number_format($detail_item->unit_price) }}đ. <br>
                                <hr>
                            @endforeach
                        </td>
                    
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <script src="../../assets/js/payment.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    </body>
    </html>
@endsection


