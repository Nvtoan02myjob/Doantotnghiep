@extends('layout')
@section('noidung')
    @if (session('errorInPageAdmin'))
        <script>
            Swal.fire({
                title: 'Bạn không có quyền truy cập, ngừng truy cập ngay!',
                text: '{{ session('errorInPageAdmin') }}',
                icon: 'error',
                confirmButtonText: 'OK'
            });
        </script>
    @endif
    @if (session('payment_status'))
        <script>
            Swal.fire({
                title: 'thanh toán thành công!',
                text: '{{ session('payment_status') }}',
                icon: 'success',
                confirmButtonText: 'OK'
            });
        </script>
    @endif
    @if (session('payment_status_fail'))
        <script>
            Swal.fire({
                title: 'Hủy thanh toán thành công!',
                text: '{{ session('payment_status_fail') }}',
                icon: 'error',
                confirmButtonText: 'OK'
            });
        </script>
    @endif
    @if(session('success_add_cart'))
        <script>
            Swal.fire({
                title: 'thành công!',
                text: '{{ session('success_add_cart') }}',
                icon: 'success',
                confirmButtonText: 'OK'
            });
        </script>
    @endif


<div class="product_main_space d-flex justify-content-center">
    <div class="product_main">
        <h5 class="product_title text-center">MENU</h5><hr>
        <ul class="product_list d-flex flex-wrap col-sm-12 col-xxl-12 col-xl-12 col-lg-12">
            @foreach($dishes as $dish_item)
                <li class="product_box d-flex justify-content-center col-sm-6 col-xxl-3 col-xl-3 col-lg-3">
                    <a href="{{ route('detail', $dish_item->id)}}" class="product_item">
                        <div class="product_item_category"><i class="bi bi-bookmark"></i> 
                            @if ($dish_item->cate_id == 1)
                                Mì Cay
                            @elseif ($dish_item->cate_id == 2)
                                Lẩu
                            @elseif ($dish_item->cate_id == 3)
                                Bánh
                            @elseif ($dish_item->cate_id == 4)
                                Nước uống
                            @elseif ($dish_item->cate_id == 5)
                                Cơm trộn
                            
                            @endif
                        </div>
                        <div class="product_item_img bg-light">
                            <img src="{{ $dish_item->img }}" alt="ảnh">
                            
                        </div>
                        <div class="product_item_name">{{ $dish_item->name }}</div>
                        <div class="product_item_star">
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-half"></i>
                        </div>
                        <div class="product_item_buy d-flex align-items-center justify-content-evenly">
                            <div class="product_item_price">{{ number_format($dish_item->price) }}đ</div>
                            <div class="product_buy_name text-center">Gọi món</div>
                            
                        </div>
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</div>
<div class="d-flex justify-content-center">
    <div class="service_customer" style="width: 80%;">
        <h4 class="title_service text-center">DỊCH VỤ KHÁCH HÀNG</h4>
        <div class="service_main d-flex mt-4 col-sm-12 col-xxl-12 col-xl-12 col-lg-12">
            <div class="service_box col-sm-12 col-xxl-4 col-xl-4 col-lg-4 d-flex justify-content-end">
                <div class="card text-center shadow-lg">
                    <div class="card-body">
                        <div class="service_item_logo mb-3">
                            <i class="bi bi-headset fs-2" style="color: var(--color-main)"></i>
                           
                        </div>
                        <h5 class="card-title">Dịch vụ hoàn hảo</h5>
                        <p class="card-text">
                            Không chỉ biết đến thiên đường của những món mì cay, Mì cay Hot Hot còn được nhiều bạn trẻ yêu thích bởi không gian thoải mái.
                        </p>
                    </div>
                </div>
            </div>

            <div class="service_box col-sm-12 col-xxl-4 col-xl-4 col-lg-4 d-flex justify-content-end">
                <div class="card text-center shadow-lg">
                    <div class="card-body">
                        <div class="service_item_logo mb-3">
                            <i class="bi bi-star" style="color: var(--color-star)"></i>
                            <i class="bi bi-star" style="color: var(--color-star)"></i>
                            <i class="bi bi-star" style="color: var(--color-star)"></i>
                            <i class="bi bi-star" style="color: var(--color-star)"></i>
                            <i class="bi bi-star" style="color: var(--color-star)"></i>
                        </div>
                        <h5 class="card-title">Chất lượng hàng đầu</h5>
                        <p class="card-text">
                            Từng món ăn đều được chế biến cẩn thận với công thức riêng biệt, giữ trọn hương vị đặc trưng của quán.
                        </p>
                    </div>
                </div>
            </div>

            <div class="service_box col-sm-12 col-xxl-4 col-xl-4 col-lg-4 d-flex justify-content-end">
                <div class="card text-center shadow-lg">
                    <div class="card-body">
                        <div class="service_item_logo mb-3"><i class="bi bi-emoji-smile fs-2 text-info"></i></div>
                        <h5 class="card-title">Không gian thân thiện</h5>
                        <p class="card-text">
                            Không gian được thiết kế hiện đại, ấm cúng, phù hợp cho các buổi họp mặt bạn bè hay gia đình.
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </div>

</div>

<div class="d-flex justify-content-center">
    <div class="introduce_website" style="width: 85%;">
        <div class="introduce_main col-sm-12 col-xxl-12 col-xl-12 col-lg-12 d-flex">
            <div class="introduce_item  col-sm-12 col-xxl-6 col-xl-6 col-lg-6">
                <h5 class="introduce_title d-flex justify-content-center align-items-center">Giới thiệu</h5>
                <p class="introduce_content">
                "Dream Stealers – Điểm đến lý tưởng cho những tín đồ ẩm thực!

                    Tại Dream Stealers, chúng tôi không chỉ mang đến những tô mì cay đậm đà mà còn có vô số món ăn hấp dẫn khác, từ lẩu nóng hổi, cơm trộn Hàn Quốc, đến những món ăn vặt đặc sắc và đồ uống tươi mát.

                    Với nguyên liệu tươi ngon, công thức chế biến độc quyền và sự chăm chút trong từng món ăn, chúng tôi cam kết mang đến cho thực khách những trải nghiệm ẩm thực tuyệt vời nhất. Dù bạn yêu thích hương vị cay nồng, béo ngậy hay thanh mát, thực đơn phong phú của Dream Stealers chắc chắn sẽ làm hài lòng mọi khẩu vị.

                    Hãy ghé Dream Stealers để tận hưởng những món ăn ngon, không gian ấm cúng và những khoảnh khắc đáng nhớ cùng bạn bè, người thân!"
                </p>
            </div>
            <div class="introduce_item_img col-sm-12 col-xxl-6 col-xl-6 col-lg-6">
                <img src="https://cdn.justfly.vn/2048x1536/media/202106/17/1623924854-quan-mi-cay-seoul-yen-lang-trung-liet-dong-da.jpg" alt="">
                
            </div>
        </div>
    </div>

</div>

<div class="Evaluate_customer_space d-flex justify-content-center">
    <div class="Evaluate_customer">
        <h5 class="Evaluate_title text-center">ĐÁNH GIÁ KHÁCH HÀNG</h5><hr>
        <ul class="Evaluate_main col-sm-12 col-xxl-12 col-xl-12 col-lg-12 d-flex">
            @forelse($comments as $comment)
                @php
                    $user_cmt = $user_for_comments->firstWhere('id', $comment->user_id);
                @endphp
                <li class="Evaluate_box col-sm-6 col-xxl-3 col-xl-3 col-lg-3">
                    <div class="Evaluate_item text-center">
                        <div class="Evaluate_image d-flex justify-content-center">
                            <div class="box_image">
                                <img src="https://tse4.mm.bing.net/th?id=OIP.uv-cMhUR4CMvUNz33xRDDwHaE8&pid=Api&P=0&h=180" alt="ảnh">

                            </div>
                        </div>
                        <p class="Evaluate_name">{{ $user_cmt->name }}</p>
                        <p class="Evaluate_star">
                            @for($i = 0 ; $i < $comment->quantity_star; $i++)
                                <i class="bi bi-star-fill"></i>
                            @endfor
                           
                        </p>
                        <p class="Evaluate_content">
                            {{ $comment->content}}
                        </p>
                    </div>
                </li>
                @empty

            @endforelse

            
            
        </ul>
    </div>
</div>

<div class="d-flex justify-content-center">
    <div class="dishes_menu">
        <h5 class="dish_menu_title text-center">THỰC ĐƠN</h5><hr>
        <div class="dishes_menu_main col-sm-12 col-xxl-12 col-xl-12 col-lg-12 d-flex flex-wrap justify-content-evenly">
            @foreach($categories as $cate_item2)
                <div class="dishes_menu_box col-sm-12 col-xxl-4 col-xl-4 col-lg-4 d-flex justify-content-center">
                    <a href="{{ route('danhmuc',['id' => $cate_item2->id]) }}" class="dishes_menu_item">
                        <p class="dishes_menu_image">
                            <img src="{{ $cate_item2->image}}" alt="ảnh">
                        </p>
                    </a>
                    <p class="dishes_menu_name text-center">{{ $cate_item2->name}}</p>
                </div>
            @endforeach
       

            

        </div>
    </div>
</div>

<div class="d-flex justify-content-center">
    <div class="news_main">
        <h5 class="news_title text-center">Tin tức</h5><hr>
        <ul class="news_list d-flex flex-wrap col-xxl-12 col-xl-12 col-lg-12">
            <li class="news_box d-flex justify-content-end col-xxl-3 col-xl-3 col-lg-3">
                <a href="#" class="news_item">
                    <div class="news_img d-flex justify-content-center">
                        <img src="https://tse1.mm.bing.net/th?id=OIP.gMy99QJCghS7b4ydWlQUBgHaFj&pid=Api&P=0&h=180" alt="ảnh">
                    </div>
                    <div class="news_summary">
                        Nạp vitamin “CAY” cho một tuần mới thật năng lượng gggggggggggggggg
                    </div>
    
                </a>
            </li>
            <li class="news_box d-flex justify-content-end col-xxl-3 col-xl-3 col-lg-3">
                <a href="#" class="news_item">
                    <div class="news_img d-flex justify-content-center">
                        <img src="https://tse1.mm.bing.net/th?id=OIP.gMy99QJCghS7b4ydWlQUBgHaFj&pid=Api&P=0&h=180" alt="ảnh">
                    </div>
                    <div class="news_summary">
                        Nạp vitamin “CAY” cho một tuần mới thật năng lượng gggggggggggggggg
                    </div>
    
                </a>
            </li>
            <li class="news_box d-flex justify-content-end col-xxl-3 col-xl-3 col-lg-3">
                <a href="#" class="news_item">
                    <div class="news_img d-flex justify-content-center">
                        <img src="https://toplist.vn/images/800px/seoul-tan-an-1358327.jpg" alt="ảnh">
                    </div>
                    <div class="news_summary">
                        Nạp vitamin “CAY” cho một tuần mới thật năng lượng gggggggggggggggg
                    </div>
    
                </a>
            </li>
            <li class="news_box d-flex justify-content-end col-xxl-3 col-xl-3 col-lg-3">
                <a href="#" class="news_item">
                    <div class="news_img d-flex justify-content-center">
                        <img src="https://toplist.vn/images/800px/seoul-tan-an-1358327.jpg" alt="ảnh">
                    </div>
                    <div class="news_summary">
                        Nạp vitamin “CAY” cho một tuần mới thật năng lượng gggggggggggggggg
                    </div>
    
                </a>
            </li>
            <li class="news_box d-flex justify-content-end col-xxl-3 col-xl-3 col-lg-3">
                <a href="#" class="news_item">
                    <div class="news_img d-flex justify-content-center">
                        <img src="https://toplist.vn/images/800px/seoul-tan-an-1358327.jpg" alt="ảnh">
                    </div>
                    <div class="news_summary">
                        Nạp vitamin “CAY” cho một tuần mới thật năng lượng gggggggggggggggg
                    </div>
    
                </a>
            </li>
            <li class="news_box d-flex justify-content-end col-xxl-3 col-xl-3 col-lg-3">
                <a href="#" class="news_item">
                    <div class="news_img d-flex justify-content-center">
                        <img src="https://tse1.mm.bing.net/th?id=OIP.gMy99QJCghS7b4ydWlQUBgHaFj&pid=Api&P=0&h=180" alt="ảnh">
                    </div>
                    <div class="news_summary">
                        Nạp vitamin “CAY” cho một tuần mới thật năng lượng gggggggggggggggg
                    </div>
    
                </a>
            </li>
        </ul>

    </div>
</div>
@include('model_payment')


<script>
    let seconds = 10;
    const countdown = document.getElementById('countdown');
    const overlay = document.getElementById('overlay');

    const timer = setInterval(() => {
        seconds--;
        countdown.textContent = seconds;

        if (seconds <= 0) {
            clearInterval(timer);
            overlay.style.display = 'none';
        }
    }, 1000);
    const success_add_cart = document.getElementById('success_add_cart');
    if(success_add_cart){
        alert(success_add_cart.value);
    }
</script>
@endsection