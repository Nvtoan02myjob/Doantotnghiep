@extends('Layout')

@section('noidung')
<div style="margin-top: 80px;" class="breadcrumb_mb d-flex justify-content-center">
        <nav aria-label="breadcrumb" style="width: 90%;">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/"><i class="bi bi-house" style="margin-right: 5px;"></i>Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Chi tiết bài viết</li>
        </ol>
        </nav>

    </div>

    <div class="about-banner">
        <h1>Chi tiết bài viết</h1>
    </div>
<div class="main-content-wrapper" style="min-height: calc(100vh - 350px); margin-bottom: 30px; margin-top: 60px;">
    <div class="container my-5">
        <div class="row g-4">
            <!-- Main Content -->
            <div class="col-lg-8" style="height: auto;">
                <div class="news-header bg-white p-4 rounded shadow-sm animate__animated animate__fadeIn">
                    <h1 class="fw-bold text-dark mb-3" style="font-family: 'Roboto', sans-serif; font-size: 2rem;">
                        {{ $new->title }}
                    </h1>
                    <p class="text-muted small mb-3">
                        <i class="bi bi-clock me-2"></i>
                        {{ \Carbon\Carbon::parse($new->created_at)->format('d/m/Y H:i') }}
                    </p>
                    <img src="{{ asset($new->image) }}" class="img-fluid rounded mb-4" alt="{{ $new->title }}" style="max-height: 50vh; object-fit: cover; width: 100%;">
                    <div class="content text-dark" style="font-family: 'Roboto', sans-serif; line-height: 1.8;">
                        {!! $new->content !!}
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <div class="sidebar bg-white p-4 rounded shadow-sm sticky-top" style="top: 20px; max-height: calc(100vh - 370px);">
                    <!-- Search Bar -->
                    <div class="mb-4">
                        <input type="text" class="form-control rounded-pill py-2" placeholder="Tìm kiếm tin tức..." style="border-color: #dc3545;">
                    </div>

                    <!-- Recent Posts -->
                    <h5 class="fw-bold text-dark mb-3" style="font-family: 'Roboto', sans-serif;">Bài viết mới</h5>
                    <ul class="list-unstyled">
                        @foreach ($news as $item)
                            <li class="mb-2">
                                <a href="{{ route('newShow', $item->id) }}" class="text-dark text-decoration-none hover-text-danger">
                                    {{ Str::limit($item->title, 50) }}
                                </a>
                                <p class="text-muted small mb-0">
                                    {{ \Carbon\Carbon::parse($item->created_at)->format('d/m/Y') }}
                                </p>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<style>


/* Content Styling */
.content p {
    margin-bottom: 1rem;
}
.content h1, .content h2, .content h3, .content h4, .content h5, .content h6 {
    margin-top: 1.5rem;
    margin-bottom: 1rem;
    font-weight: bold;
}
.content ul, .content ol {
    margin-bottom: 1rem;
    padding-left: 2rem;
}
.content li {
    margin-bottom: 0.5rem;
}
.content img {
    max-width: 100%;
    height: auto;
    margin: 1rem 0;
}
.content table {
    width: 100%;
    border-collapse: collapse;
}
.content table, .content th, .content td {
    border: 1px solid #ddd;
    padding: 8px;
}
.content iframe {
    max-width: 100%;
    height: auto;
}

/* Mobile Adjustments */
@media (max-width: 576px) {
    .header {
        padding: 5px !important;
    }
    .header .search-bar {
        font-size: 0.85rem !important;
        padding: 5px !important;
    }
    .header .logo {
        width: 50px !important;
    }
    .header .icons {
        font-size: 1rem !important;
    }
    .main-content-wrapper {
        margin-top: 50px !important;
        min-height: calc(100vh - 150px) !important;
        margin-bottom: 20px !important;
    }
    .news-header {
        padding: 15px !important;
    }
    .news-header h1 {
        font-size: 1.5rem !important;
    }
    .news-header img {
        max-height: 30vh !important;
    }
    .content {
        font-size: 0.9rem !important;
    }
    .content img {
        max-height: 200px !important;
    }
    .content table {
        font-size: 0.9rem !important;
    }
    .sidebar {
        position: static !important;
        max-height: none !important;
    }
    .sidebar .form-control {
        font-size: 0.85rem !important;
        padding: 0.5rem !important;
    }
}

@media (max-width: 991px) {
    .sidebar {
        position: static !important;
        max-height: none !important;
    }
}
</style>
@endsection
