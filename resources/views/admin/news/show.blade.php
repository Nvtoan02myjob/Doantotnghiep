@extends('admin.partials.master')

@session('title')
    Chi tiết bài viết
@endsession

@section('content')
    <div class="p-3">
        <h1 class="mb-4">Chi tiết bài viết</h1>

        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th class="text-center">Thuộc tính</th>
                        <th class="text-center">Giá trị</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="font-weight-bold">ID</td>
                        <td>{{ $new->id }}</td>
                    </tr>
                    <tr>
                        <td class="font-weight-bold">Người tạo</td>
                        <td>{{ $new->user->name ?? 'Không có' }}</td>
                    </tr>
                    <tr>
                        <td class="font-weight-bold">Thể loại</td>
                        <td>{{ $new->type_news->name }}</td>
                    </tr>
                    <tr>
                        <td class="font-weight-bold">Tiêu đề</td>
                        <td>{{ $new->title }}</td>
                    </tr>
                    <tr>
                        <td class="font-weight-bold">Tóm tắt</td>
                        <td>{{ $new->summary }}</td>
                    </tr>
                    <tr>
                        <td class="font-weight-bold">Nội dung</td>
                        <td>{!! nl2br(e($new->content)) !!}</td> <!-- Ensures new lines in content are preserved -->
                    </tr>
                    <tr>
                        <td class="font-weight-bold">Ảnh</td>
                        <td>
                            @if ($new->image)
                                <img src="{{ asset($new->image) }}" alt="Image" class="img-fluid" style="max-width: 150px;">
                            @else
                                Chưa có ảnh
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <td class="font-weight-bold">Ngày tạo</td>
                        <td>{{ $new->created_at->format('d-m-Y H:i') }}</td>
                    </tr>
                    <tr>
                        <td class="font-weight-bold">Ngày cập nhật</td>
                        <td>{{ $new->updated_at->format('d-m-Y H:i') }}</td>
                    </tr>
                    <tr>
                        <td class="font-weight-bold">Trạng thái</td>
                        <td>{{ $new->status ? 'Hiển thị' : 'Ẩn' }}</td>
                    </tr>

                </tbody>
            </table>
        </div>

        <a class="btn btn-primary" href="{{ route('admin.news.index') }}">
            <i class="fa fa-arrow-left"></i> Quay lại
        </a>
    </div>
@endsection
