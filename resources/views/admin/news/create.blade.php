@extends('admin.partials.master')
@section('title')
    Thêm bài viết
@endsection

@section('content')
    <div class="p-4">
        <h1>Thêm bài viết</h1>
        <form action="{{ route('admin.news.store') }}" method="post" enctype="multipart/form-data" id="newsForm" novalidate>
            @csrf
            <input type="hidden" class="form-control" id="user_id" name="user_id" value="{{ Auth::check() ? Auth::user()->id : '' }}">

            <div class="form-group">
                <label for="title">Tiêu đề</label>
                <input type="text" class="form-control" id="title" name="title">
                @error('title')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="body">Tóm tắt</label>
                <textarea class="form-control" id="body" name="summary" rows="3"></textarea>
                <span class="text-danger" id="summaryError"></span>
                @error('summary')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="noidung">Nội dung</label>
                <textarea class="form-control" id="noidung" name="content" rows="10"></textarea>
                <span class="text-danger" id="contentError"></span>
                @error('content')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="image">Ảnh chính</label>
                <input type="file" name="image" class="form-control" required>
                @error('image')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="type_news_id">Thể loại</label>
                <select class="form-control" id="type_news_id" name="type_news_id">
                    @if (!empty($type_news))
                        @foreach ($type_news as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
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
            <button type="submit" class="btn btn-primary">Thêm</button>
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
