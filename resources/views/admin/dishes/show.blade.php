@extends('admin.partials.master')
@session('title')
    Chi tiết món ăn
@endsession
@section('content')
    <div class="p-3">
        <h1>Chi tiết món ăn</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>Tên cột</th>
                    <th>Nội dung chi tiết</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($dishes->toArray() as $key => $value)
                    <tr>
                        <td>{{ ucfirst($key) }}</td>
                        <td>
                            @if ($key == 'img')
                                <img src="{{ asset($value) }}" alt="Dish Image" width="100px">
                            @elseif ($key == 'cate_id')
                                {{ $dishes->categories->name ?? 'Chưa phân loại' }}
                            @else
                                {{ $value }}
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <a class="btn btn-primary" href="{{ route('admin.dishes.index') }}">Quay lại</a>
    </div>
@endsection
