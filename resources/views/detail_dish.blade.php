@extends('layout')
@section('noidung')
<div style="margin-top: 80px;" class="d-flex justify-content-center">
    <nav aria-label="breadcrumb" style="width: 90%;">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/"><i class="bi bi-house" style="margin-right: 5px;"></i>Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Detail</li>
      </ol>
    </nav>

</div>
<div class="d-flex justify-content-center">
    <h5 style=" margin-top: 100px; font-size: 20px;">
        Chi tiết sản phẩm 
        <span style=" background-color: var(--color-main); color: var(--color-while); padding: 4px 10px; font-size: 10px; position: relative; top: -14;">
            @if ($dish->cate_id == 3)
                Mì Cay
            @elseif ($dish->cate_id == 4)
                Lẩu
            @elseif ($dish->cate_id == 5)
                Bánh
            @elseif ($dish->cate_id == 6)
                Nước uống
            @elseif ($dish->cate_id == 7)
                Cơm trộn
            
            @endif
        </span>
    </h5>
</div>
<hr style="border: 1px solid var(--color-main);">
<div class="d-flex justify-content-center" style="margin-top: 40px">

    <div class="detail_main d-flex">
        <div class="detail_main_image col-sm-5">
            <img src="{{ $dish->img }}" alt="ảnh">
        </div>
        <form action="{{ route('addCart', $dish->id); }}" method="post" class="detail_main_informations col-sm-7">
            @csrf
            <div class="informations_name">{{ $dish->name }}</div>
            <div class="informations_decription">
                {{ $dish->description }}
            </div>
            <div class="informations_price">{{ number_format($dish->price) }}<span>đ</span></div>
            <section class="information_quantity">
                <p>Số lượng</p>
                <div class="information_quantity_select">
                    <button type="button" onclick="Up_down(-1)">-</button>
                    <input type="text" name="quantity_dish" id="quantiy_product_buy" value=1>
                    <!---->
                    <button type="button" onclick="Up_down(1)">+</button>
                </div>
            </section>
            <section class="information_button_list">
                <button type="submit" class="button_add_cart">
                    <i class="bi bi-plus-circle"></i>
                    Thêm Vào Thực Đơn
                </button>
                
            </section>
        </form>
    </div>



</div>

<div class="d-flex justify-content-center" style="margin-top: 20px">
    <div class="detail_evaluate">
        <div class="detail_evaluate_content">
            <hr>
            <h5 class="text-center">🔥 Đánh Giá Khách Hàng - Dream Stealers Mì Cay 🔥</h5>
            <p>
                💬 Hãy Chia Sẻ Trải Nghiệm Của Bạn!
                Chúng tôi luôn mong muốn mang đến những món ăn ngon nhất và trải nghiệm tuyệt vời nhất cho khách hàng. Nếu bạn đã từng thưởng thức mì cay tại KobyHot, hãy để lại đánh giá để chúng tôi có thể phục vụ bạn tốt hơn!
            </p>
            <p>
                📢 Bạn có thể đánh giá về:
                <ul class="evaluate_content_list_check">
                    <li>✔️ Hương vị món ăn</li>
                    <li>✔️ Độ cay phù hợp</li>
                    <li>✔️ Chất lượng phục vụ</li>
                    <li>✔️ Không gian quán</li>
                    <li>✔️ Dịch vụ giao hàng</li>
                </ul>
            </p>
        </div>
        <div class="detail_evaluate_comment">
            <h5><i class="bi bi-pin-angle-fill"></i> Đánh giá từ khách hàng</h5>
            <ul class="comment_list">
                <li class="comment_list_item">
                    <div class="item_informations d-flex align-items-center">
                        <p class="item_star d-flex align-items-center">
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                        </p>
                        <div class="partition"></div>
                        <p class="item_user">Phạm công toàn(phamcongtoan92@gmail.com)</p>

                    </div>
                    <p class="item_contents">
                        Mì ăn rất ngon, giá cả phải chăng.
                    </p>
                </li>

                <li class="comment_list_item">
                    <div class="item_informations d-flex align-items-center">
                        <p class="item_star d-flex align-items-center">
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                        </p>
                        <div class="partition"></div>
                        <p class="item_user">Phạm công toàn(phamcongtoan92@gmail.com)</p>

                    </div>
                    <p class="item_contents">
                        Mì ăn rất ngon, giá cả phải chăng.
                    </p>
                </li>

                <li class="comment_list_item">
                    <div class="item_informations d-flex align-items-center">
                        <p class="item_star d-flex align-items-center">
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                        </p>
                        <div class="partition"></div>
                        <p class="item_user">Phạm công toàn(phamcongtoan92@gmail.com)</p>

                    </div>
                    <p class="item_contents">
                        Mì ăn rất ngon, giá cả phải chăng.
                    </p>
                </li>

                <li class="comment_list_item">
                    <div class="item_informations d-flex align-items-center">
                        <p class="item_star d-flex align-items-center">
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                        </p>
                        <div class="partition"></div>
                        <p class="item_user">Phạm công toàn(phamcongtoan92@gmail.com)</p>

                    </div>
                    <p class="item_contents">
                        Mì ăn rất ngon, giá cả phải chăng.
                    </p>
                </li>
            </ul>
        </div>
    </div>



</div>
<script>
    function Up_down(value){
        let quantity = document.getElementById('quantiy_product_buy');
        let currentQuantity = parseInt(quantity.value, 10); 
        if(value == -1){
            quantity.value = currentQuantity - 1;
            if(quantity.value < 1){
                quantity.value = 1;
            }
        }else if(value == 1){
            quantity.value = currentQuantity + 1;
        }
    }
</script>
@endsection
