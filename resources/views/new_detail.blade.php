@extends('Layout')
@section('noidung')
<div class="main-content-wrapper" style="min-height: calc(100vh - 350px); padding-bottom: 30px; margin-bottom: 350px;">
        <div class="container my-5">
            <div class="row g-4">
                <!-- Main Content -->
                <div class="col-lg-8">
                    <div class="news-header bg-white p-4 rounded shadow-sm animate__animated animate__fadeIn">
                        <h1 class="fw-bold text-dark mb-3" style="font-family: 'Roboto', sans-serif; font-size: 2rem;">
                            {{ $new->title }}
                        </h1>
                        <p class="text-muted small mb-3">
                            <i class="bi bi-clock me-2"></i>
                            {{ \Carbon\Carbon::parse($new->created_at)->format('d/m/Y H:i') }}
                        </p>
                        <img src="{{ asset($new->image) }}" class="img-fluid rounded mb-4" alt="{{ $new->title }}" style="max-height: 400px; object-fit: cover; width: 100%;">
                        <div class="content text-dark" style="font-family: 'Roboto', sans-serif; line-height: 1.8;">
                            {!! nl2br(e($new->content)) !!}
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
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
