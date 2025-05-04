@extends('Layout')
@section('noidung')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lịch Sử Order - Dream Stealers Restaurant</title>
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Flatpickr CSS for date picker -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <style>
        .main-content {
            padding: 40px 20px;
        }
        .filter-section {
            background-color: #fff;
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }
        .order-table {
            table-layout: fixed; /* Cố định kích thước cột */
            width: 100%;
        }
        .order-table th, .order-table td {
            text-align: center;
            vertical-align: middle;
            word-wrap: break-word; /* Cho phép nội dung xuống dòng */
            overflow-wrap: break-word; /* Đảm bảo nội dung xuống dòng nếu quá dài */
            padding: 8px; /* Thêm padding để nội dung không bị sát mép */
        }
        /* Điều chỉnh chiều rộng cho từng cột */
        .order-table th:nth-child(1), .order-table td:nth-child(1) { /* Mã Đơn Hàng */
            width: 8%;
        }
        .order-table th:nth-child(2), .order-table td:nth-child(2) { /* Mã Khách Hàng */
            width: 10%;
        }
        .order-table th:nth-child(3), .order-table td:nth-child(3) { /* Tên Khách Hàng */
            width: 15%;
        }
        .order-table th:nth-child(4), .order-table td:nth-child(4) { /* Ngày Đặt */
            width: 12%;
        }
        .order-table th:nth-child(5), .order-table td:nth-child(5) { /* Tổng Tiền */
            width: 10%;
        }
        .order-table th:nth-child(6), .order-table td:nth-child(6) { /* Phương Thức Thanh Toán */
            width: 12%;
        }
        .order-table th:nth-child(7), .order-table td:nth-child(7) { /* Nhân Viên Order */
            width: 15%;
        }
        .order-table th:nth-child(8), .order-table td:nth-child(8) { /* Trạng Thái */
            width: 8%;
        }
        .order-table th:nth-child(9), .order-table td:nth-child(9) { /* Hành Động */
            width: 15%;
        }
        .order-table th {
            background-color: var(--color-main);
            color: white;
            word-wrap: break-word; /* Đảm bảo tiêu đề cột cũng xuống dòng nếu cần */
            overflow-wrap: break-word;
        }
        .order-table .status-pending {
            background-color: #ffca2c;
            color: #333;
            padding: 5px 10px;
            border-radius: 15px;
            font-weight: 500;
        }
        .order-table .status-completed {
            background-color: #28a745;
            color: white;
            padding: 5px 10px;
            border-radius: 15px;
            font-weight: 500;
        }
        .order-table .btn-details, .order-table .btn-cancel {
            padding: 5px 15px;
            border-radius: 15px;
            border: none;
            transition: background-color 0.3s;
            margin: 0 5px; /* Thêm khoảng cách giữa các nút */
        }
        .order-table .btn-details {
            background-color: var(--color-main);
            color: white;
        }
        .order-table .btn-details:hover {
            background-color: #ffca2c;
            color: #333;
        }
        .order-table .btn-cancel {
            background-color: var(--color-main);
            color: white;
        }
        .order-table .btn-cancel:hover {
            background-color: #ffca2c;
            color: #333;
        }
        .modal-content {
            border-radius: 15px;
        }

        .modal-body p {
            word-wrap: break-word; /* Đảm bảo nội dung trong modal xuống dòng */
            overflow-wrap: break-word;
        }
        .modal-body table th, .modal-body table td {
            text-align: center;
            word-wrap: break-word; /* Đảm bảo nội dung trong bảng modal xuống dòng */
            overflow-wrap: break-word;
        }
        /* Custom Pagination Styles */
        .custom-pagination .page-link {
            color: #333;
            border: 1px solid #dee2e6;
            border-radius: 5px;
            margin: 0 5px;
        }
        .custom-pagination .page-item.active .page-link {
            background-color: var(--color-main);
            border-color: var(--color-main);
            color: white;
        }
        .custom-pagination .page-item.disabled .page-link {
            color: #6c757d;
            background-color: #fff;
            border-color: #dee2e6;
        }
        .custom-pagination .page-item:not(.disabled) .page-link:hover {
            background-color: #ffca2c;
            color: #333;
        }
        .custom-pagination .page-item .page-link[aria-label="Previous"],
        .custom-pagination .page-item .page-link[aria-label="Next"] {
            font-size: 1.5rem;
            padding: 10px 20px;
        }
        .custom-pagination .page-item:not(.disabled) .page-link[aria-label="Next"] {
            color: #007bff;
        }
    </style>
</head>
<body>
   <!-- Main Content -->
    <div class="main-content">
        <div class="container">
            <h2 class="mb-4 text-center">Lịch Sử Order</h2>

            <!-- Filter Section -->
            <div class="filter-section">
                <form method="GET" action="{{ route('order_history') }}">
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="status" class="form-label">Trạng Thái</label>
                            <select name="status" id="status" class="form-select">
                                <option value="">Tất cả</option>
                                <option value="1" {{ request('status') === '1' ? 'selected' : '' }}>Pending</option>
                                <option value="0" {{ request('status') === '0' ? 'selected' : '' }}>Completed</option>
                            </select>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="date" class="form-label">Ngày Đặt</label>
                            <input type="date" name="date" id="date" class="form-control" placeholder="Chọn ngày" value="{{ request('date') }}">
                        </div>
                        <div class="col-md-4 d-flex align-items-end mb-3">
                            <button type="submit" class="btn btn-primary w-100">Lọc</button>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Order Table -->
            <div class="table-responsive">
                <table class="table table-bordered order-table">
                    <thead>
                        <tr>
                            <th style="width: 5%">Mã Đơn Hàng</th>
                            <th class="table_none" style="width: 5%">Mã Khách Hàng</th>
                            <th style="width: 5%">Mã bàn</th>
                            <th class="table_none" style="width: 10%">Tên Khách Hàng</th>
                            <th class="table_none" style="width: 20%">Ngày Đặt</th>
                            <th style="width: 15%">Tổng Tiền</th>
                            <th style="width: 15%">Trạng Thái</th>
                            <th style="width: 15%">Hành Động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($paginatedOrders as $order)
                            <tr>
                                <td>#{{ $order['id'] }}</td>
                                <td class="table_none">{{ $order['user_id'] }}</td>
                                <td>{{ $order['table_id'] }}</td>
                                <td class="table_none">{{ auth()->user()->id == $order['user_id'] ? auth()->user()->name : ' '}}</td>
                                <td class="table_none">{{ \Carbon\Carbon::parse($order['created_at'])->timezone('Asia/Ho_Chi_Minh')->format('d/m/Y H:i') }}</td>
                                <td>{{ number_format($order['price_total'], 0, ',', '.') }} VNĐ</td>
                                <td>
                                    <span class="status-{{ $order['status'] }}">
                                        @if($order['status'] == 1)
                                            Pending
                                            @elseif($order['status'] == 0)
                                                Complete
                                        @endif
                                    </span>
                                </td>
                                <td>
                                    <button class="btn btn-details" data-bs-toggle="modal" data-bs-target="#orderModal{{ $order['id'] }}">Xem Chi Tiết</button>
                                    @if($order['status'] == 1)
                                        <a href="{{ route('vnpay.payment', ['order_id' => $order['id'], 'price_total' => $order['price_total']])}}" class="btn btn-success mt-2" style="border-radius: 15px;">Thanh toán</a>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="9" class="text-center text-muted">Bạn chưa có đơn hàng nào.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Custom Pagination -->
            @if($totalPages > 1)
                <div class="custom-pagination">
                    <!-- Previous and Next buttons (top) -->
                    <ul class="pagination justify-content-center">
                        <li class="page-item {{ $currentPage == 1 ? 'disabled' : '' }}">
                            <a class="page-link" href="{{ route('order_history', array_merge(request()->query(), ['page' => $currentPage - 1])) }}" aria-label="Previous">
                                « Previous
                            </a>
                        </li>
                        <li class="page-item {{ $currentPage == $totalPages ? 'disabled' : '' }}">
                            <a class="page-link" href="{{ route('order_history', array_merge(request()->query(), ['page' => $currentPage + 1])) }}" aria-label="Next">
                                Next »
                            </a>
                        </li>
                    </ul>

                    <!-- Showing results -->
                    <div class="text-center mt-2">
                        Showing {{ $firstItem }} to {{ $lastItem }} of {{ $totalItems }} results
                    </div>

                    <!-- Page numbers with Previous and Next buttons -->
                    <ul class="pagination justify-content-center mt-2">
                        <!-- Previous Button -->
                        <li class="page-item {{ $currentPage == 1 ? 'disabled' : '' }}">
                            <a class="page-link" href="{{ route('order_history', array_merge(request()->query(), ['page' => $currentPage - 1])) }}" aria-label="Previous">
                                <span aria-hidden="true"><</span>
                            </a>
                        </li>

                        <!-- Page Numbers -->
                        @foreach($pages as $page)
                            <li class="page-item {{ $page == $currentPage ? 'active' : '' }}">
                                <a class="page-link" href="{{ route('order_history', array_merge(request()->query(), ['page' => $page])) }}">{{ $page }}</a>
                            </li>
                        @endforeach

                        <!-- Next Button -->
                        <li class="page-item {{ $currentPage == $totalPages ? 'disabled' : '' }}">
                            <a class="page-link" href="{{ route('order_history', array_merge(request()->query(), ['page' => $currentPage + 1])) }}" aria-label="Next">
                                <span aria-hidden="true">></span>
                            </a>
                        </li>
                    </ul>
                </div>
            @endif
        </div>
    </div>

    <!-- Order Detail Modals -->
    @foreach($paginatedOrders as $order)
        <div class="modal fade" id="orderModal{{ $order['id'] }}" tabindex="-1" aria-labelledby="orderModalLabel{{ $order['id'] }}" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="orderModalLabel{{ $order['id'] }}">Chi Tiết Đơn Hàng #{{ $order['id'] }}</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p><strong>Mã Đơn Hàng:</strong> #{{ $order['id'] }}</p>
                        <p><strong>Mã Khách Hàng:</strong> {{ $order['user_id'] }}</p>
                        <p><strong>Tên Khách Hàng:</strong> {{ auth()->user()->id == $order['user_id'] ? auth()->user()->name : ' '}}</p>
                        <p><strong>Ngày Đặt:</strong>{{ \Carbon\Carbon::parse($order['created_at'])->timezone('Asia/Ho_Chi_Minh')->format('d/m/Y H:i') }}</p>
                        <p><strong>Trạng Thái:</strong> 
                            @if($order['status'] == 1)
                                Pending
                                @elseif($order['status'] == 0)
                                    Complete
                            @endif
                        </p>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Món</th>
                                    <th>Số Lượng</th>
                                    <th>Giá</th>
                                    <th>Thành Tiền</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($order_details as $detail)
                                @if($detail->order_id == $order['id'])
                                    @foreach($dish_details as $dish_details_item)
                                        @if($dish_details_item->id == $detail->dish_id)
                                            <tr>
                                                <td>{{ $dish_details_item->name }}</td>
                                                <td>{{ $detail->quantity }}</td>
                                                <td>{{ number_format($dish_details_item->price, 0, ',', '.') }} VNĐ</td>
                                                <td>{{ number_format($dish_details_item->price * $detail->quantity, 0, ',', '.') }} VNĐ</td>
                                            </tr>
                                        @endif
                                    @endforeach
                                @endif
                            @endforeach
                            </tbody>
                        </table>
                        <p class="text-end"><strong>Tổng Tiền:</strong> {{ number_format($order['price_total'], 0, ',', '.') }} VNĐ</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    <!-- Flatpickr JS for date picker -->
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        // Initialize Flatpickr for date picker
        // flatpickr("#date", {
        //     dateFormat: "d/m/Y",
        //     maxDate: "today",
        // });

        // Function to handle order cancellation
        function cancelOrder(orderId) {
            if (confirm('Bạn có chắc muốn hủy đơn hàng #' + orderId + ' không?')) {
                alert('Đơn hàng #' + orderId + ' đã được hủy.');
                // Logic to cancel order (e.g., send AJAX request to server)
                // For now, just reload the page
                window.location.reload();
            }
        }
    </script>
</body>
</html>
@endsection