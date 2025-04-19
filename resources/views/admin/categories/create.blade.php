@extends('admin.partials.master')
@session('title')
    Thêm danh mục
@endsession
@section('content')
    <div class="m-2">
        <h1>Thêm danh mục</h1>
        <form action="{{ route('admin.categories.store') }}" method="post">
            @csrf
            <div class="form-group">
                <label for="name">Tên danh mục</label>
                <input type="text" class="form-control" id="name" name="name" required>

            </div>
            <button type="submit" class="btn btn-primary">Thêm</button>

        </form>


    </div>
@endsection
