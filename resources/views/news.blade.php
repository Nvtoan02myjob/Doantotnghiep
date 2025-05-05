@extends('Layout')
@section('noidung')
<div style="margin-top: 80px;" class="breadcrumb_mb d-flex justify-content-center">
    <nav aria-label="breadcrumb" style="width: 90%;">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/"><i class="bi bi-house" style="margin-right: 5px;"></i>Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Tin tức</li>
      </ol>
    </nav>

</div>
    <div class="container mt-5 new_page_show">
        <h6 style="font-size: 24px;" class="display-4 fw-bold text-center text-warning mb-5 animate__animated animate__fadeIn">Tất cả bài viết</h6>
        <div class="row g-4">
            @foreach ($news as $item)
                <div class="col-md-6 col-lg-4">
                    <div class="card border-0 shadow-lg news-card h-100 overflow-hidden position-relative animate__animated animate__fadeInUp" style="border-radius: 15px; transition: transform 0.3s ease, box-shadow 0.3s ease;">
                        <div class="position-relative overflow-hidden" style="height: 220px;">
                            <img src="{{ $item->image }}" class="card-img-top w-100 h-100 object-fit-cover" alt="{{ $item->title }}" style="transition: transform 0.5s ease;">
                            <div class="image-overlay position-absolute top-0 start-0 w-100 h-100" style="background: linear-gradient(to bottom, rgba(0,0,0,0.2), rgba(0,0,0,0.5)); opacity: 0; transition: opacity 0.3s ease;"></div>
                            <div class="category-badge position-absolute top-0 start-0 m-3 px-3 py-1 bg-danger text-white rounded-pill small fw-bold" style="z-index: 1;">
                                {{ $item->category->name ?? 'Tin tức' }}
                            </div>
                        </div>
                        <div class="card-body p-4 bg-white">
                            <h5 class="card-title fw-bold text-dark mb-3" style="font-family: 'Roboto', sans-serif; font-size: 1.3rem; line-height: 1.4;">
                                {{ Str::limit($item->title, 60) }}
                            </h5>
                            <p class="text-muted small mb-3">
                                <i class="bi bi-clock me-2"></i>
                                {{ \Carbon\Carbon::parse($item->created_at)->format('d/m/Y H:i') }}
                            </p>
                            <p class="card-text text-secondary small" style="font-size: 0.95rem; line-height: 1.6;">
                                {{ Str::limit(strip_tags($item->content), 120) }}
                            </p>
                            <a href="{{ route('newShow', $item->id) }}" class="btn btn-outline-danger btn-sm mt-3 rounded-pill px-4 py-2 fw-bold text-uppercase" style="transition: background-color 0.3s ease, color 0.3s ease;">
                                Xem chi tiết
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <br>
@endsection
