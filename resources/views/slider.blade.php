<div style="width: 85%; border-radius: 5px;">
    <div class="banner_main col-xxl-12 col-xl-12 col-lg-12 d-flex">
        <div id="carouselExampleIndicators" class="carousel slide banner_slide col-xxl-8 col-xl-8 col-lg-8" class="carousel-item active">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
                @if($banners)
                    @foreach($banners as $banner_item)
                        <div class="carousel-item active">
                            <img src="{{ $banner_item->image}}" class="d-block w-100" alt="ảnh 2">
                            <div class="carousel-caption d-none d-md-block">
                                <p>{{ $banner_item->text}}</p>
                            </div>
                        </div>
                    @endforeach
                @endif

            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>  
        <div class="banner_img col-xxl-4 col-xl-4 col-lg-4"> 
            <div class="banner_img_item d-flex"><img src="../assets/img/z6404838732289_4729a29ccd6f5e7f5a356c86e8bd290a.jpg" alt="ảnh"></div>
            <div class="banner_img_item d-flex flex-column justify-content-end"><img src="../assets/img/z6404838483197_027fbe8752ea9cefcc8c3c15b4caadba.jpg" alt="ảnh"></div>
        </div>
    </div>

</div>