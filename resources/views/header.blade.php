<div>
    <nav class="navbar navbar-expand-lg">
        <div class="navbar_menu">
            <i class="bi bi-menu-button-wide-fill"></i>
        </div>
        <div class="container navbar_main">
            <li class="nav-item col-xxl-1 col-xl-1 col-lg-1 d-flex justify-content-end" style="list-style:none;">
                <a class="nav-link active" aria-current="page" href="#">
                    <img src="../assets/img/logo.png" alt="" class="logo">
                </a>
            </li>
            <div class="collapse navbar-collapse col-xxl-6 col-xl-56 col-lg-6" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 col-xxl-12 col-xl-12 col-lg-12 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="#">Trang chủ</a>
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
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Danh mục món ăn
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item dropdown-item-text" href="#">
                                <img src="" alt="img" class="header_img_dish">
                                Mì cay
                                </a>
                            </li>
                            <li><a class="dropdown-item dropdown-item-text" href="#">
                                <img src="" alt="img" class="header_img_dish">
                                Lẩu
                                </a>
                            </li>
                            <li><a class="dropdown-item dropdown-item-text" href="#">
                                <img src="" alt="img" class="header_img_dish">
                                Nước uống
                                </a>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item dropdown-item-text" href="#">Khác</a></li>
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
                    <i class="bi bi-bell-fill header_bell_icon">
                        <span>0</span>
                        <form action="" method="" class="header_infomation_order">
                            <div class="checkAll d-flex align-items-center justify-content-end">Tất cả <input class="" type="checkbox" name="" id="" style="margin-left: 6px;"></div>
                            <div class="infomation_order_items d-flex align-items-center">
                                <div id="header_img_order">
                                    <img src="" alt="img" >
                                </div>
                                <div class="header_name_dish_order">Tên món</div>
                                <div class="header_unitPrice">1000000</div>
                                <div class="header_X">X</div>
                                <div class="header_amount">2</div>
                                <input class="header_checkbox" type="checkbox" name="" id="">
                               
                            </div>
                            <div class="infomation_order_items d-flex align-items-center">
                                <div id="header_img_order">
                                    <img src="" alt="img" >
                                </div>
                                <div class="header_name_dish_order">Tên món</div>
                                <div class="header_unitPrice">1000000</div>
                                <div class="header_X">X</div>
                                <div class="header_amount">2</div>
                                <input class="header_checkbox" type="checkbox" name="" id="">
                               
                            </div>
                            <div class="header_total d-flex justify-content-around">
                                <span>Tổng tiền: 2000000</span>
                                <button type="submit">Gọi món</button>
                            </div>
                        </form>
                    </i>
                </div>
                <div class="header_user d-flex justify-content-center col-xxl-5 col-xl-5 col-lg-5">
                <!--Đã ẩn-->
                    <i class="bi bi-person header_user_icon">
                        <ul class="header_information_user">
                            <li class="header_information_item"><a href="">Thông tin cá nhân</a></li>
                            <li class="header_information_item"><a href="">Đăng xuất</a></li>
                        
                        </ul>
                    </i>
                    @if (Route::has('login'))
                        <nav class="register-login d-flex -mx-3 flex flex-1 justify-end">
                            @auth
                                <a
                                    href="{{ url('/dashboard') }}"
                                    class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                                >
                                    Dashboard
                                </a>
                            @else
                                <a
                                    href="{{ route('login') }}"
                                    class="login_rtr text-end rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                                >
                                    Log in
                                </a>

                                @if (Route::has('register'))
                                    <a
                                        href="{{ route('register') }}"
                                        class="register_rtr rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                                    >
                                        Register
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
