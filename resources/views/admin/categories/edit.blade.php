@extends('admin.partials.master')

@session('title')
    Sửa danh mục
@endsession

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
                <h1>Sửa danh mục</h1>
        
        

                <form action="{{ route('admin.categories.update', $category->id) }}" method="post" class="mt-4">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="name" class="form-label">Tên danh mục</label>
                        <input 
                            type="text" 
                            class="form-control @error('name') is-invalid @enderror" 
                            id="name" 
                            name="name" 
                            value="{{ old('name', $category->name) }}" 
                            required
                        >
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Cập nhật</button>
                    <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">Hủy</a>
                </form>

    </div>
@endsection
