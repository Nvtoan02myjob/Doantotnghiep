<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
@extends('admin.partials.master')
@session('title')
    Thêm danh mục
@endsession
@section('content')
<div class="container my-4">
    <div class="card shadow rounded-4">
        <div class="card-header bg-primary text-white rounded-top-4 d-flex justify-content-between align-items-center">
            <h4 class="mb-0"><i class="bi bi-people-fill me-2"></i>Danh sách người dùng</h4>
            <a href="{{route('admin.users.create')}}" class="btn btn-light btn-sm rounded-pill">
                <i class="bi bi-pencil-square me-1"></i> Thêm mới
            </a>
        </div>

        <div class="card-body p-0">
            <table class="table table-hover table-bordered align-middle text-center mb-0">
                <thead class="table-light">
                    <tr class="text-uppercase">
                        <th>Họ tên</th>
                        <th>Email</th>
                        <th>Trạng thái</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr class="{{ $user->deleted_at ? 'table-danger' : '' }}">
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td></td>
                            <td>
                                @if ($user->deleted_at)
                                    <span class="badge bg-danger rounded-pill px-3 py-2">
                                        <i class="bi bi-x-circle-fill me-1"></i> Đã xoá mềm
                                    </span>
                                @else
                                    <span class="badge bg-success rounded-pill px-3 py-2">
                                        <i class="bi bi-check-circle-fill me-1"></i> Hoạt động
                                    </span>
                                @endif
                            </td>
                            <td>
                                @if ($user->deleted_at)
                                    <form action="{{ route('admin.users.restore', $user->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-warning rounded-pill">
                                            <i class="bi bi-arrow-counterclockwise"></i> Khôi phục
                                        </button>
                                    </form>

                                    <form action="{{ route('admin.users.forceDelete', $user->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Xoá vĩnh viễn người dùng này?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger rounded-pill">
                                            <i class="bi bi-trash3-fill"></i> Xoá vĩnh viễn
                                        </button>
                                    </form>
                                @else
                                    <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-sm btn-outline-primary rounded-pill">
                                        <i class="bi bi-pencil-square"></i> Sửa
                                    </a>

                                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Xác nhận xoá người dùng này?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill">
                                            <i class="bi bi-x-lg"></i> Xoá
                                        </button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
