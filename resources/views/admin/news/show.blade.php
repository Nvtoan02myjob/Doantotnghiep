@extends('admin.partials.master')
@session('title')
    Chi tiết bài viết
@endsession
@section('content')
    <div class="p-3">
        <h1>Chi tiết bài viết</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>Tên cột</th>
                    <th>Nội dung chi tiết</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($new->toArray() as $key => $value)
                    <tr>
                        <td>{{ ucfirst($key) }}</td>
                        <td>
                            @if ($key == 'image')
                                <img src="{{ asset($value) }}" alt="" width="100px">
                            @elseif ($key == 'type_new_id')
                                {{ $new->type_news->name }}
                            @else
                                {{ $value }}
                            @endif
                        </td>


                    </tr>
                @endforeach


            </tbody>
        </table>
        <a class="btn btn-primary" href="{{ route('admin.news.index') }}">Quay lại</a>
    </div>
@endsection
