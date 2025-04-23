@extends('admin.partials.master')
@session('title')
    Sửa danh mục
@endsession
@section('content')
    <div class="m-2">
        <h1>Sửa danh mục</h1>
        <form action="{{ route('admin.type_news.update',$type_new->id) }}" method="post">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Tên danh mục</label>
                <input type="text" class="form-control" id="name" name="name" required value="{{ $type_new->name }}">
            </div>
            <button type="submit" class="btn btn-primary">Sửa</button>

        </form>


    </div>
@endsection
