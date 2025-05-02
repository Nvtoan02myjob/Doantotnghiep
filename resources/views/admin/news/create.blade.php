@extends('admin.partials.master')
@section('title', 'Thêm bài viết')

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
    <h2>Thêm bài viết</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('admin.news.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="title" class="form-label">Tiêu đề</label>
            <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                   value="{{ old('title') }}" placeholder="Nhập tiêu đề">
            @error('title')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="summary" class="form-label" >Tóm tắt</label>
            <textarea name="summary" id="body" class="form-control @error('title') is-invalid @enderror">{{ old('summary') }}</textarea>
            @error('summary')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>


        <div class="mb-3">
            <label for="content"class="form-label">Nội dung</label>
            <textarea name="content" id="noidung"  class="form-control @error('content') is-invalid @enderror"
                      rows="5" placeholder="Nhập nội dung">{{ old('content') }}</textarea>
            @error('content')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Ảnh đại diện</label>
            <input type="file" name="image" class="form-control @error('image') is-invalid @enderror">
            @error('image')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="type_news_id" class="form-label">Thể loại</label>
            <select name="type_news_id" class="form-select @error('type_news_id') is-invalid @enderror">
                <option value="">-- Chọn thể loại --</option>
                @foreach($type_news as $type)
                    <option value="{{ $type->id }}" {{ old('type_news_id') == $type->id ? 'selected' : '' }}>
                        {{ $type->name }}
                    </option>
                @endforeach
            </select>
            @error('type_news_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <input type="hidden" name="user_id" value="{{ $user->id }}">
        <button type="submit" class="btn btn-primary">Thêm bài viết</button>
    </form>
</div>

    <!-- CKEditor CDN -->
    <script src="https://cdn.ckeditor.com/ckeditor5/35.2.0/classic/ckeditor.js"></script>
    <script>
        let summaryEditor, contentEditor;

        ClassicEditor
            .create(document.querySelector('#body'))
            .then(editor => {
                summaryEditor = editor;
            })
            .catch(error => {
                console.error(error);
            });

        ClassicEditor
            .create(document.querySelector('#noidung'))
            .then(editor => {
                contentEditor = editor;
            })
            .catch(error => {
                console.error(error);
            });

        document.querySelector('#newsForm').addEventListener('submit', (event) => {
            let isValid = true;

            // Validate summary
            const summaryError = document.querySelector('#summaryError');
            if (summaryEditor && !summaryEditor.getData().trim()) {
                summaryError.textContent = 'Vui lòng nhập tóm tắt.';
                isValid = false;
            } else {
                summaryError.textContent = '';
            }

            // Validate content
            const contentError = document.querySelector('#contentError');
            if (contentEditor && !contentEditor.getData().trim()) {
                contentError.textContent = 'Vui lòng nhập nội dung.';
                isValid = false;
            } else {
                contentError.textContent = '';
            }

            // Sync CKEditor data
            if (summaryEditor) {
                document.querySelector('#body').value = summaryEditor.getData();
            }
            if (contentEditor) {
                document.querySelector('#noidung').value = contentEditor.getData();
            }

            // Prevent form submission if validation fails
            if (!isValid) {
                event.preventDefault();
            }
        });
    </script>
@endsection
