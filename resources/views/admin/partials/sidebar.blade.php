<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
            <!-- <i class="fas fa-laugh-wink"></i> -->
        </div>
        <div class="sidebar-brand-text mx-3"> Admin <sup></sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <!-- <li class="nav-item active">
        <a class="nav-link" href="{{ route('admin.index') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li> -->

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->




    <!-- Heading -->
    <div class="sidebar-heading">
       Danh mục
    </div>

    <!-- Nav Item - Tables -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.statistical')}}">
            <i class="fas fa-fw fa-table"></i>
            <span>Thống kê</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.table_dish')}}">
            <i class="fas fa-fw fa-table"></i>
            <span>Bàn</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.tables.index')}}">
            <i class="fas fa-fw fa-table"></i>
            <span>Số bàn</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.orders.index')}}">
            <i class="fas fa-fw fa-table"></i>
            <span>Order</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.categories.index')}}">
            <i class="fas fa-fw fa-table"></i>
            <span>Danh mục món án</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.dishes.index')}}">
            <i class="fas fa-fw fa-table"></i>
            <span>Món ăn </span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.type_news.index')}}">
            <i class="fas fa-fw fa-table"></i>
            <span>Loại bài viết</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.news.index')}}">
            <i class="fas fa-fw fa-table"></i>
            <span>Bài viết</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.voucher.index')}}">
            <i class="fas fa-fw fa-table"></i>
            <span>Mã giảm giá</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.payments.index')}}">
            <i class="fas fa-fw fa-table"></i>
            <span>Thanh toán</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{route('admin.users.index')}}">
            <i class="fas fa-fw fa-table"></i>
            <span>Tài khoản</span></a>
    </li>
    <li class="nav-item">
         <a class="nav-link" href="{{route('roles.index')}}">
             <i class="fas fa-fw fa-table"></i>
             <span>Phân quyền</span></a>
     </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>



</ul>
