<div>
    <nav class="navbar navbar-expand-lg">
        <div class="navbar_menu">
            <i class="bi bi-menu-button-wide-fill"></i>
        </div>
        <div class="container navbar_main">
            <li class="nav-item col-xxl-1 col-xl-1 col-lg-1 d-flex justify-content-end" style="list-style:none;">
                <a class="nav-link active" aria-current="page" href="/">
                    <img src="../assets/img/logo.png" alt="" class="logo">
                </a>
            </li>
            <div class="collapse navbar-collapse col-xxl-6 col-xl-56 col-lg-6" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 col-xxl-12 col-xl-12 col-lg-12 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('table') }}">Bàn</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('about') }}">Giới thiệu</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('contact') }}">Liên hệ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Tin tức</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="color: var(--color-white);">
                            Danh mục món ăn
                        </a>
                        <ul class="dropdown-menu">
                            @foreach($categories as $cate_item)
                                <li class="header_drop_img">
                                    <a href="{{ route('danhmuc',['id' => $cate_item->id]) }}" class="dropdown-item dropdown-item-text d-flex align-items-center">
                                        <div class="header_img_box">
                                            <img src="{{ $cate_item->image }}" alt="img" class="header_img_dish">

                                        </div>
                                        {{ $cate_item->name }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </li>

                </ul>

            </div>
            <div class="nav_right col-xxl-5 col-xl-5 col-lg-5 d-flex align-items-center">
                <div class="header_search d-flex justify-content-end col-xxl-4 col-xl-4 col-lg-4">
                    <i class="bi bi-search header_search_icon" style="padding: 5px;">
                        <form action="" method="" class="form_search">
                            <input type="search" name="data-search" id="header_from_search" placeholder="Hôm nay món gì...">
                            <button type="submit">Tìm kiếm</button>
                        </form>
                    </i>
                </div>
                <div class="header_bell d-flex justify-content-end col-xxl-3 col-xl-3 col-lg-3">
                    <i class="bi bi-bag-check-fill header_bell_icon" data-bs-toggle="modal" data-bs-target="#cartModel">
                    <!-- <i class="bi bi-bag-check-fill"></i> -->
                        <span>
                            {{ $count_cart }}
                        </span>


                    </i>

                </div>
                <div class="header_user d-flex justify-content-center col-xxl-5 col-xl-5 col-lg-5">
                <!--Đã ẩn-->
                    <i class="bi bi-person header_user_icon">
                        <ul class="header_information_user">
                            <!-- <li class="header_information_item"><a href="">Thông tin cá nhân</a></li>
                            <li class="header_information_item"><a href="">Đăng xuất</a></li> -->

                        </ul>
                    </i>
                    @if (Route::has('login'))
                        <nav class="register-login d-flex -mx-3 flex flex-1 justify-end">
                            @auth
                                <div class="dropdown">
                                    <button class="button_login dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                        {{ auth()->user()->name}}

                                    </button>
                                    <ul class="dropdown-menu dropdown_menu_user" aria-labelledby="dropdownMenuButton1">
                                        <li><a class="dropdown-item button_profile" href="{{ route('profile.edit') }}"> Thông tin cá nhân</a></li>
                                        <li><a class="dropdown-item button_profile" href="{{ route('order_history') }}"> Lịch sử gọi món</a></li>
                                        <li><form action="{{ route('logout') }}" method="post" class="dropdown-item form_logout">@csrf<button class="button_logout"><i class="bi bi-box-arrow-right"></i> Đăng xuất</button> </form></li>
                                    </ul>
                                </div>
                            @else
                                <a
                                    href="{{ route('login') }}"
                                    class="login_rtr text-end rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                                >
                                    Đăng nhập
                                </a>

                                @if (Route::has('register'))
                                    <a
                                        href="{{ route('register') }}"
                                        class="register_rtr rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                                    >
                                        Đăng kí
                                    </a>
                                @endif
                            @endauth
                        </nav>
                    @endif
                </div>
            </div>
        </div>
    </nav>

</div>

<!-- Modal -->
<div class="modal fade" id="cartModel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title" id="exampleModalLabel" style="font-size: 16px;"><i class="bi bi-bag-check" style="font-size: 18px !important;"></i> Thêm vào thực đơn</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
            <form action="{{ route('add_order_orderDetail'); }}" method="post" class="header_infomation_order">
                @csrf
                @if($carts->isNotEmpty())
                <div class="checkAll_main d-flex align-items-center justify-content-end">Tất cả <input id="checkAll" type="checkbox" name="" id="" style="margin-left: 6px;"></div>
                    @foreach($carts as $cart_item)
                        @php
                            $dish = $dishes_cart[$cart_item->dish_id] ?? null;

                        @endphp
                        <div class="infomation_order_items d-flex align-items-center">
                            <div id="header_img_order">
                                <div class="header_img_oder_main">
                                    <img src="{{ $dish ? $dish->img : '' }}" alt="img" >

                                </div>
                            </div>

                            <div class="header_name_dish_order">{{ $dish ? $dish->name : 'Không tìm thấy món' }}</div>
                            <div class="header_unitPrice">{{ $dish ? number_format($dish->price, 0, ',', '.') : 0 }}</div>
                            <div class="header_X">X</div>
                            <div class="header_amount">{{ $cart_item->quantity }}</div>
                            <a href="{{ route('delete_dish_in_cart',['id'=> $cart_item->id])}}" class="header_delete text-center">Xóa</a>
                            <input class="header_checkbox" type="checkbox" name="checkbox_data[]" value="{{ $cart_item->id }}" id="" data-price="{{ $dish->price}}" data-quantity="{{ $cart_item->quantity }}">
                        </div>
                    @endforeach
                @else
                    <p class="text-center" style="color:var(--color-main);">Bạn chưa có thực đơn <i class="bi bi-emoji-frown"></i>.</p>
                @endif
            </form>

      </div>

    </div>
  </div>
</div>

