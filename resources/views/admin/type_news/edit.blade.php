@extends('admin.partials.master')
@session('title')
    Sửa danh mục
@endsession
@section('content')
<div class="container my-5">
    <div class="row justify-content-center">     
           <h1>Sửa danh mục</h1>
        <form action="{{ route('admin.type_news.update',$type_new->id) }}" method="post">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="name">Tên danh mục</label>
                <input 
                            type="text" 
                            class="form-control @error('name') is-invalid @enderror" 
                            id="name" 
                            name="name" 
                            value="{{ old('name', $type_new->name) }}" 
                            required
                        >
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <button type="submit" class="btn btn-primary">Cập nhật</button>
                    <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">Hủy</a>
            
        </form>


    </div>
@endsection
