@extends('Layout')
@section('noidung')

    <!-- Tất cả bài viết -->
    <div class="container mt-4">
        <h1 class="fw-bold text-warning p-5">Tất cả bài viết</h1>

        <div class="row g-4">
                @foreach ($news as $item)
                    <div class="col-md-6 col-lg-4 animate__animated animate__fadeInUp">
                        <div class="card border-0 shadow-sm news-card h-100 overflow-hidden">
                            <div class="position-relative">
                                <img src="{{ asset($item->image) }}" class="card-img-top" alt="{{ $item->title }}" style="height: 200px; object-fit: cover; transition: transform 0.3s ease;">
                                <div class="image-overlay"></div>
                                <div class="category-badge position-absolute top-0 start-0 m-2 px-3 py-1 bg-danger text-white rounded small">
                                    {{ $item->category->name ?? 'Tin tức' }}
                                </div>
                            </div>
                            <div class="card-body p-3">
                                <h5 class="card-title fw-bold text-dark mb-2" style="font-family: 'Roboto', sans-serif; font-size: 1.25rem;">
                                    {{ Str::limit($item->title, 60) }}
                                </h5>
                                <p class="text-muted small mb-2">
                                    <i class="bi bi-clock me-2"></i>
                                    {{ \Carbon\Carbon::parse($item->created_at)->format('d/m/Y H:i') }}
                                </p>
                                <p class="card-text text-secondary small">{{ Str::limit(strip_tags($item->content), 100) }}</p>
                                <a href="{{ route('newShow', $item->id) }}" class="btn btn-outline-danger btn-sm mt-2 rounded-pill px-3">Xem chi tiết</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
@endsection
