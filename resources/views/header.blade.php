<div>
    <nav class="navbar navbar-expand-lg">
<!--phần giao diện header mobile-->
        <div class="navbar_menu">
            <a href="/" class="col-sm-4">
                <img src="../assets/img/logo.png" alt="" class="logo_vs_mobile">

            </a>
            <div class="header_search_mobile col-sm-4 text-end position-relative">
<<<<<<< HEAD
        <i class="bi bi-search header_search_icon_2" id="search-toggle-mobile" style="padding: 5px;"></i>
        <div id="searchBackdrop-mobile" class="modal-backdrop fade show" style="display: none;"></div>
        <form action="{{ route('search.dish') }}" method="GET" class="form_search_2" id="search-form-mobile" style="display: none; position: absolute; z-index: 1050; right: 0;">
            <input type="search" name="q" id="header_from_search_mobile" placeholder="Hôm nay món gì..." class="form-control" style="width: 250px;">
            <ul id="search-results-mobile" class="search-results-list" style="display: none; border: 1px solid #ddd; background: #fff; width: 250px; max-height: 200px; overflow-y: auto; list-style: none; padding: 0; margin: 0;">
                <!-- Kết quả tìm kiếm sẽ được chèn vào đây -->
            </ul>
        </form>
    </div>
=======
                <i class="bi bi-search header_search_icon_2 me-2"></i>
                <form action="{{ route('search.dish') }}" method="GET" class="form_search_2 align-items-center">
                    <div id="searchBackdrop2" class="modal-backdrop fade show" style="display: none;"></div>
                    <input type="search" name="q" id="header_from_search_mobile" placeholder="Hôm nay món gì..." class="form-control">
                    <ul id="search-results-mobile" style="display: none; border: 1px solid #ddd; background: #fff; width:450px; max-height: 200px; overflow-y: auto;">
                    <!-- Kết quả tìm kiếm sẽ được chèn vào đây -->
                    </ul>
                </form>

            </div>

>>>>>>> e42b11bcfee027bcf27377cb0a9e72190323377b

            <div class="header_bell d-flex justify-content-end text-end col-sm-2 col-xxl-3 col-xl-3 col-lg-3">
                <i class="bi bi-bag-check-fill header_bell_icon" data-bs-toggle="modal" data-bs-target="#cartModel">
                    <span>
                        {{ $count_cart }}
                    </span>


                </i>

            </div>
            <i class="bi bi-list col-sm-2 text-center"  data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="offcanvasExample"></i>
                <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
                    <div class="offcanvas-header">
                        <a href="/" class="col-sm-2">
                            <img src="../assets/img/logo.png" alt="" class="logo_vs_mobile2">
                        </a>

                        @if (Route::has('login'))
                            <nav class="col-sm-6 register-login d-flex -mx-3 flex flex-1 justify-end">
                                @auth
                                    <div class="dropdown">
                                        <button class="button_login2 dropdown-toggle" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
                                            {{ auth()->user()->name}}

                                        </button>
                                        <ul class="dropdown-menu dropdown_menu_user" aria-labelledby="dropdownMenuButton2">
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
                        <button type="button" class="btn-close col-sm-4" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body d-flex flex-column justify-content-between">
                        <ul class="header_data_mb mt-4">
                            <li><a href="{{ route('table') }}"><i class="bi bi-diagram-2"></i> Bàn</a></li>
                            <li><a href="{{ route('about') }}"><i class="bi bi-calendar3-range"></i> Giới thiệu</a></li>
                            <li><a href="{{ route('contact') }}"><i class="bi bi-phone-vibrate"></i> Liên hệ</a></li>
                            <li><a href="{{route('news')}}"><i class="bi bi-newspaper"></i> Tin tức</a></li>

                            <li class="dropdown">
                                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false">
                                    <i class="bi bi-bookmark-check"></i> Danh mục món ăn
                                </a>
                                <ul class="dropdown-menu dropdown-menu-lg-end">
                                    @foreach($categories as $cate_item2)
                                        <li>
                                            <a class="dropdown-item d-flex" href="{{ route('danhmuc',['id' => $cate_item2->id]) }}">
                                                <div class="header_img_box">
                                                    <img src="{{ $cate_item2->image }}" alt="img" class="header_img_dish">

                                                </div>
                                                 {{ $cate_item2->name }}
                                            </a>
                                        </li>
                                    @endforeach

                                </ul>
                            </li>
                        </ul>



                    </div>
                </div>
        </div>





<!--phần giao diện header web-->

        <div class="container navbar_main">
            <li class="nav-item col-xxl-1 col-xl-1 col-lg-1 d-flex justify-content-end" style="list-style:none;">
                <a class="nav-link active" aria-current="page" href="/">
                    <img src="../assets/img/logo.png" alt="" class="logo">
                </a>
            </li>
            <div class="collapse navbar-collapse col-xxl-6 col-xl-6 col-lg-6" id="navbarSupportedContent">
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
                        <a class="nav-link" href="{{route('news')}}">Tin tức</a>
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
                    <div id="searchBackdrop" class="modal-backdrop fade show" style="display: none;"></div>
                    <i class="bi bi-search header_search_icon" style="padding: 5px;"></i>
                    <form action="" method="" class="form_search">
                        <input type="search" name="data-search" id="header_from_search" placeholder="Hôm nay món gì..."class="form-control">
                        <ul id="search-results" style="display: none; border: 1px solid #ddd; position: absolute; background: #fff; width:450px; max-height: 200px; overflow-y: auto;">
                        <!-- Kết quả tìm kiếm sẽ được chèn vào đây -->
                        </ul>
                    </form>
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
                    @auth
                        <div class="dropdown">
                            <button class="button_login dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                {{ auth()->user()->name }}
                            </button>
                            <ul class="dropdown-menu dropdown_menu_user" aria-labelledby="dropdownMenuButton1">
                                @if (auth()->user()->role_id != 1)
                                    <li>
                                        <a class="dropdown-item button_profile" href="{{ route('admin.index') }}">
                                            <i class="bi bi-shield-lock-fill"></i> Quản trị admin
                                        </a>
                                    </li>
                                @endif


                                <li><a class="dropdown-item button_profile" href="{{ route('profile.edit') }}">Thông tin cá nhân</a></li>
                                <li><a class="dropdown-item button_profile" href="{{ route('order_history') }}">Lịch sử gọi món</a></li>
                                <li>
                                    <form action="{{ route('logout') }}" method="post" class="dropdown-item form_logout">
                                        @csrf
                                        <button class="button_logout"><i class="bi bi-box-arrow-right"></i> Đăng xuất</button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    @endauth



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
                                    <img src="{{ asset(storage/$dish ? $dish->img : '') }}" alt="img" >

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
                        <div class="header_total d-flex justify-content-around align-items-center">
                            <span><span class="total_price_cart"></span><i class="bi bi-cash-coin"></i></span>
                            <input type="hidden" name="total_price_hidden" class="total_cart_hidden">
                            <button type="submit">Gọi món</button>
                        </div>
                @else
                    <p class="text-center" style="color:var(--color-main);">Bạn chưa có thực đơn <i class="bi bi-emoji-frown"></i>.</p>
                @endif
            </form>

      </div>

    </div>
  </div>
</div>

