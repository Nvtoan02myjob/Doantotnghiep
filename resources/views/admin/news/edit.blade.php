@extends('admin.partials.master')
@section('title')
    Sửa bài viết
@endsection

@section('content')
    <div class="p-4">
        <h1>Sửa bài viết</h1>
        <form action="{{ route('admin.news.update', $new->id) }}" method="post" enctype="multipart/form-data" id="newsForm" novalidate>
            @csrf
            @method('PUT')
            <input type="hidden" class="form-control" id="user_id" name="user_id" value="{{ Auth::check() ? Auth::user()->id : '' }}">

            <div class="form-group">
                <label for="title">Tiêu đề</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title', $new->title) }}" required>
                @error('title')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="body">Tóm tắt</label>
                <textarea class="form-control @error('summary') is-invalid @enderror" id="body" name="summary" rows="3">{{ old('summary', $new->summary) }}</textarea>
                <span class="text-danger" id="summaryError"></span>
                @error('summary')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="noidung">Nội dung</label>
                <textarea class="form-control @error('content') is-invalid @enderror" id="noidung" name="content" rows="10">{{ old('content', $new->content) }}</textarea>
                <span class="text-danger" id="contentError"></span>
                @error('content')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="image">Ảnh chính</label>
                <input type="file" name="image" class="form-control @error('image') is-invalid @enderror">
                @if ($new->image)
                    <img src="{{ asset($new->image) }}" alt="Ảnh bài viết" width="100px" class="mt-2">
                @endif
                @error('image')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="type_news_id">Thể loại</label>
                <select class="form-control @error('type_news_id') is-invalid @enderror" id="type_news_id" name="type_news_id">
                    @if (!empty($type_news))
                        @foreach ($type_news as $item)
                            <option value="{{ $item->id }}" {{ old('type_news_id', $new->type_news_id) == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
                        @endforeach
                    @else
                        <option value="">Không có thể loại</option>
                    @endif
                </select>
                @error('type_news_id')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <br>
            <button type="submit" class="btn btn-primary">Sửa</button>
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
