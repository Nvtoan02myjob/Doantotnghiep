@extends('layout')
@section('noidung')
    <div style="margin-top: 80px;" class="d-flex justify-content-center breadcrumb_mb">
        <nav aria-label="breadcrumb" style="width: 90%;">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/"><i class="bi bi-house" style="margin-right: 5px;"></i>Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Món</li>
        </ol>
        </nav>

    </div>
    <div class="category_product_main">
        <h5 class="title_category d-flex justify-content-center"><div class="title_category_main text-center">Danh mục món: Mì cay</div></h5>
        <hr class="hr">
        <div class="select_arrange d-flex justify-content-end">
            <button class="btn-arrange btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" data-bs-auto-close="true" aria-expanded="false">
                <i class="bi bi-funnel-fill"></i> Lọc theo 
            </button>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#">Mới nhất</a></li>
                <li><a class="dropdown-item" href="#"><i class="bi bi-sort-up"></i> Thấp đến cao</a></li>
                <li><a class="dropdown-item" href="#"><i class="bi bi-sort-down"></i> Cao đến thấp</a></li>
            </ul>
        </div>

        
        @if($dish_in_category->isNotEmpty())
            <ul class="product_list d-flex flex-wrap col-sm-12 col-xxl-12 col-xl-12 col-lg-12">
                @foreach($dish_in_category as $dish_in_category_item)
                    <li class="product_box d-flex justify-content-center col-sm-6 col-xxl-3 col-xl-3 col-lg-3">
                        <a href="{{ route('detail', $dish_in_category_item->id)}}" class="product_item">
                            <div class="product_item_category">
                                <i class="bi bi-bookmark"></i>
                                @if($dish_in_category_item->cate_id == 1)
                                    Mì
                                    @elseif($dish_in_category_item->cate_id == 2)
                                        Lẩu 
                                    @elseif($dish_in_category_item->cate_id == 3)
                                        Bánh
                                    @elseif($dish_in_category_item->cate_id == 4)
                                        Nước
                                    @elseif($dish_in_category_item->cate_id == 5)
                                        Cơm trộn
                                @endif
                            </div>
                            <div class="product_item_img">
                                <img src="{{ $dish_in_category_item->img }}" alt="ảnh">
                                
                            </div>
                            <div class="product_item_name">{{ $dish_in_category_item->name }}</div>
                            <div class="product_item_star">
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-half"></i>
                            </div>
                            <div class="product_item_buy d-flex align-items-center justify-content-evenly">
                            <div class="product_item_price">{{ number_format($dish_in_category_item->price) }}đ</div>
                            <div class="product_buy_name text-center">Gọi món</div>
                            
                        </div>
                        </a>
                    </li>
                @endforeach
            </ul>
        @else
            <p class="text-center" style="padding: 100px 0;">Danh sách trống <i class="bi bi-emoji-dizzy"></i></p>
        @endif

            
    </div>
@endsection