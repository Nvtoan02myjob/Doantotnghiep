@extends('admin.partials.master')

@section('title', 'Chi tiết liên hệ')

@section('content')
<div class="container mt-4">
    <h3>Chi Tiết Liên Hệ</h3>

    <div class="card mt-3">
        <div class="card-body">
            <p><strong>Tiêu đề:</strong> {{ $contact->subject }}</p>
            <p><strong>Nội dung:</strong> {{ $contact->content }}</p>
            <p><strong>Thời gian gửi:</strong> {{ $contact->created_at->format('H:i d/m/Y') }}</p>
        </div>
    </div>

    <a href="{{ route('admin.contact.index') }}" class="btn btn-secondary mt-3">Quay lại</a>
</div>
@endsection
