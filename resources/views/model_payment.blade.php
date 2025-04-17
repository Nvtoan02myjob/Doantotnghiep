@if(isset($Order_detail) && isset($Order) && isset($Dish_colection))
    <div class="model_payment d-flex justify-content-end">
        <div class="model_payment_main d-flex align-items-center justify-content-evenly" data-bs-toggle="modal" data-bs-target="#exampleModal">
            <p><i class="bi bi-clock-history"></i> Chưa thanh toán</p>
            <p>{{number_format($Order->price_total)}} vnđ</p>
        </div>
    </div>
     <!-- Modal -->
     <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5>Tổng tiền: {{number_format($Order->price_total)}}đ</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <table border=1 class="table table-striped">
                <thead>
                    <tr>
                        <th>Tên món</th>
                        <th>Số lượng</th>
                        <th>Đơn giá</th>
                        <th>Tổng tiền</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($Order_detail as $Order_detail_item)
                         @foreach($Dish_colection as $Dish_colection_item)
                            @if($Dish_colection_item->id == $Order_detail_item->dish_id)
                         
                                <tr>
                                    <td>{{ $Dish_colection_item->name }}</td>
                                    <td>{{ $Order_detail_item->quantity }}</td>
                                    <td>{{ number_format($Order_detail_item->unit_price) }}đ</td>
                                    <td>{{ number_format($Order_detail_item->unit_price *$Order_detail_item->quantity)}}đ</td>
                                </tr>
                            @endif
                        @endforeach 

                    @endforeach
                </tbody>
            </table>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
            <button type="button" class="btn btn-primary"><a href="{{ route('vnpay.payment', ['order_id' => $Order->id, 'price_total' => $Order->price_total ])}}" style="color: var(--color-text-white); text-decoration: none;">Thanh toán</a> </button>
          </div>
        </div>
      </div>
    </div>

    @else
     <div></div>
@endif
   