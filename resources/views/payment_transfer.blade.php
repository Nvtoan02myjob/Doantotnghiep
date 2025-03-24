<link rel="stylesheet" href="../assets/css/payment.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<div class="bill_modal">
    <div class="content_payment_bill ">
        <img src="{{ $QR }}" alt="ảnh QR" class="order_img_qr mt-4">
        <p><strong> Nội dung chuyển khoản: CKNH{{ $content }}</strong></p>
        <P><strong> Tổng tiền: {{ number_format($price)}}đ</strong></P>
        <table class="table table-bordered" style="margin: auto; width: 85% !important;">
            <thead>
                <tr>
                    <th class="text-center" style="width: 35%">Tên món</th>
                    <th class="text-center" style="width: 25%">Số lượng</th>
                    <th class="text-center" style="width: 20%">Đơn giá</th>
                    <th class="text-center" style="width: 20%">Thành tiền</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data_list_detail as $detail_item)
                    @php
                        $dish = $dishs->where('id', $detail_item['dish_id'])->first();
                    @endphp
                    <tr>
                        <td>{{ $dish['name']}}</td>
                        <td>{{ $detail_item['quantity']}}</td>
                        <td>{{ number_format( $detail_item['unit_price'])}}đ</td>
                        <td>{{ number_format($detail_item['unit_price'] *  $detail_item['quantity'])}}đ</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        

    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>