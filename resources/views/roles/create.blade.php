<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
@extends('admin.partials.master')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4">➕ Thêm quyền mới</h2>
    <form action="{{ route('roles.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="role_name" class="form-label">Tên quyền:</label>
            <input type="text" name="role_name" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">Lưu</button>
        <a href="{{ route('roles.index') }}" class="btn btn-secondary">Quay lại</a>
    </form>
</div>
@endsection
