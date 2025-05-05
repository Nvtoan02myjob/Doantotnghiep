@extends('layout')
@section('noidung')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @if(session('delete_success'))
        <script>
            Swal.fire({
                title: 'Xóa thành công!',
                text: '{{ session('delete_success') }}',
                icon: 'success',
                confirmButtonText: 'OK'
            });
        </script>
    @endif
    @if(session('add_comment_success'))
        <script>
            Swal.fire({
                title: 'Thêm thành công!',
                text: '{{ session('add_comment_success') }}',
                icon: 'success',
                confirmButtonText: 'OK'
            });
        </script>
    @endif
    <div style="margin-top: 80px;" class="breadcrumb_mb d-flex justify-content-center">
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
            <span style=" background-color: var(--color-main); color: var(--color-white); padding: 4px 10px; font-size: 10px; position: relative; top: -14;">
                @if ($dish->cate_id == 1)
                    Mì Cay
                @elseif ($dish->cate_id == 2)
                    Lẩu
                @elseif ($dish->cate_id == 3)
                    Bánh
                @elseif ($dish->cate_id == 4)
                    Nước uống
                @elseif ($dish->cate_id == 5)
                    Cơm trộn

                @endif
            </span>
        </h5>
    </div>
    <hr style="border: 1px solid var(--color-main);">
    <div class="d-flex justify-content-center detail_info_mb" style="margin-top: 40px">

        <div class="detail_main d-flex col-sm-12">
            <div class="detail_main_image col-sm-6">
                <img src="{{ asset('storage/' . $dish->img) }}" alt="ảnh">
            </div>
            <form action="{{ route('addCart', $dish->id); }}" method="post" class="detail_main_informations col-sm-6">
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
                <div data-bs-toggle="modal" data-bs-target="#exampleModal" class="mt-4" style="cursor: pointer; color: var(--color-main);">Thêm đánh giá <i class="bi bi-send-plus-fill" style=""></i></div>
                <ul class="comment_list">
                    @foreach($comments as $comment_item)
                        @php
                            $user = $user_ids->firstWhere('id', $comment_item->user_id);
                        @endphp
                        <li class="comment_list_item">
                            <div class="item_informations d-flex align-items-center">
                                <p style="color: var(--color-main); font-size: 9px;">{{ $comment_item->quantity_star }}</p>
                                <p class="item_star d-flex align-items-center">
                                @for ($i = 0; $i < $comment_item->quantity_star; $i++)
                                    <i class="bi bi-star-fill"></i>
                                @endfor

                                </p>
                                <div class="partition"></div>
                                <p class="item_user">

                                    {{ $user->name }} ({{ $user->email }})

                                </p>

                            </div>
                            <div class="item_contents d-flex align-item-center flex-wrap dropdown">
                                <p style="width: 90%; opacity: 0.8;">{{ $comment_item->content}}</p>
                                <i style="width: 10%; opacity: 0.8;" class="bi bi-three-dots-vertical" data-bs-toggle="dropdown"></i>
                                <ul class="item_list_image d-flex">
                                    @foreach($comment_item->image as $item_image)
                                        <li class="bg-light"><img src="{{ asset('storage/' . $item_image) }}" alt="" class="item_image"></li>
                                    @endforeach
                                </ul>

                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item text-danger" href="{{ route('cmt_delete', ['id'=> $comment_item->id]) }}">Xóa bình luận</a></li>

                                </ul>
                            </div>

                        </li>
                    @endforeach
                </ul>
            </div>
        </div>



    </div>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form method="post" action="{{ route('add_feedBack',['id' => $dish->id])}}"  enctype="multipart/form-data" class="modal-content" id="feedbackForm">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Đánh giá khách hàng</h1>
                <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @csrf
                <label for="textarea_feedback">Nhập nội dung đánh giá</label>
                <textarea id="textarea_feedback" style="width: 100%; border-radius: 5px ;margin-top: 10px; margin-bottom: 15px; padding: 10px;" name="content_feedback" cols="100" rows="4"></textarea>
                <div class="error_content_feedback"></div>
                <label for="">Thêm ảnh</label>
                <div class="feedback_image">
                    <input type="file" name="images[]" id="file_upload_detail" multiple><br>

                </div>
                <label for="" class="mt-4">Đánh giá về sự hài lòng</label>
                <ul class="star_feedback d-flex justify-content-center mt-4">
                    <li class="item_star_feedback"><i class="bi bi-star-fill item_star_feedback_i"></i></li>
                    <li class="item_star_feedback"><i class="bi bi-star-fill item_star_feedback_i"></i></li>
                    <li class="item_star_feedback"><i class="bi bi-star-fill item_star_feedback_i"></i></li>
                    <li class="item_star_feedback"><i class="bi bi-star-fill item_star_feedback_i"></i></li>
                    <li class="item_star_feedback"><i class="bi bi-star-fill item_star_feedback_i"></i></li>
                </ul>
                <div class="error_star"></div>
            </div>
            <input type="hidden" name="quantity_star" value="0" id="quantity_star">
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                <button type="submit" class="btn btn-primary" style="background-color: var(--color-main); border: none;">Lưu đánh giá</button>
            </div>
        </form>
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

        document.addEventListener("DOMContentLoaded", function() {
        var toastEl = document.querySelector('.toast');
        if (toastEl) {
            var toast = new bootstrap.Toast(toastEl);
            toast.show();
        }
         });
    </script>
@endsection
