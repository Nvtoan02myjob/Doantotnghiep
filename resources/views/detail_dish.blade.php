@extends('layout')
@section('noidung')
<div class="d-flex justify-content-center" style="margin-top: 80px">
    <div class="detail_main d-flex">
        <div class="detail_main_image col-sm-5">
            <img src="https://food.ibin.vn/images/data/product/mi-kim-chi-bo/mi-kim-chi-bo-001.jpg" alt="ảnh">
        </div>
        <div class="detail_main_informations col-sm-7">
            <div class="informations_name">Mì cay kim chi</div>
            <div class="informations_decription">
                Mì cay kim chi món ăn bán chạy và được đánh giá cao nhất trong nhà hàng.
                Mì cay kim chi món ăn bán chạy và được đánh giá cao nhất trong nhà hàng.
                Mì cay kim chi món ăn bán chạy và được đánh giá cao nhất trong nhà hàng.
                Mì cay kim chi món ăn bán chạy và được đánh giá cao nhất trong nhà hàng.
            </div>
            <div class="informations_price">50.000<span>đ</span></div>
            <section class="information_quantity">
                <p>Số lượng</p>
                <div class="information_quantity_select">
                    <button type="button" onclick="Up_down(-1)">-</button>
                    <input type="text" name="" id="quantiy_product_buy" value=1>
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
        </div>
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
