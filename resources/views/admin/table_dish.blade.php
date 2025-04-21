@extends('admin.partials.master')
@section('title')
    Trang bàn order
@endsection
@section('content')
    <div class="container">
        @if($tables->isNotEmpty())
            <div class="row">
                @foreach($tables as $table)
                    <div class="col-md-3 mb-3">
                        @if($order_pendings->isNotEmpty())
                            @php
                                $orderForTable = $order_pendings->firstWhere('table_id', $table->id);
                            @endphp
                            @if($orderForTable)
                                <div class="table-card admin_table_status p-3 text-center d-flex flex-column align-items-center" data-bs-toggle="modal" data-bs-target="#exampleModalDetailDish">
                                    <h6 class="mb-2" style="color: var(--color-text-white)">B{{ $table->id }}</h6>
                                    <div class="table_info">
                                        <p class="mb-1">
                                            <i class="bi bi-clock-fill"></i>
                                            <span class="time-elapsed" data-start="{{ \Carbon\Carbon::parse($orderForTable->created_at)->toIso8601String() }}">
                                                {{ \Carbon\Carbon::parse($orderForTable->created_at)->diff(now())->format('%h giờ %i phút %s giây') }}
                                            </span>
                                        </p>
                                        <p class="mb-0">
                                            {{ number_format($orderForTable->price_total) }}đ
                                        </p>
                                        
                                        
                                    </div>
                                </div>
                                <!-- Modal -->
                                <div class="modal fade" id="exampleModalDetailDish" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Menu</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <table class="table table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>stt</th>
                                                        <th>Tên món</th>
                                                        <th>Số lượng</th>
                                                        <th>Đơn giá</th>
                                                        <th>Đã gửi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php
                                                        $i = 0;
                                                        $details = $detail_for_orderPendings->whereIn('order_id', [$orderForTable->id]);
                                                    @endphp
                                                    @if($details)
                                                        @foreach($details as $detail)
                                                            @php
                                                                
                                                                $dish = $dish_for_details->firstWhere('id', $detail->dish_id);
                                                            @endphp
                                      
                                                            <tr>
                                                                <td>#{{ ++$i }}</td>
                                                                <td>{{ $dish->name }}</td>
                                                                <td>{{ $detail->quantity}}</td>
                                                                <td>{{ number_format( $detail->unit_price) }}đ</td>
                                                                <td><input type="checkbox" data-id="{{ $i }}" name="" class="checkbox_employee"></td>
                                                            </tr>
                                                        @endforeach
                                                    @endif
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                                            <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                                        </div>
                                        </div>
                                    </div>
                                </div>

                                @else
                                    <div class="table-card table_info_null p-3 text-center d-flex flex-column align-items-center">
                                        <h6 class="mb-2" style="color: var(--color-text-black)">B{{ $table->id }}</h6>
                                        <div>Trống</div>
                                        
                                    </div>
                                        
                            @endif
                                        
                        @endif
                    </div>
            
                @endforeach
            </div>
        @endif
        
    </div>
    
@endsection
