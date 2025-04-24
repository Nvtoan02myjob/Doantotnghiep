
 @extends('admin.partials.master')
 
 @section('content')
 <div class="container mt-5">
     <h2 class="mb-4">➕ Thêm quyền mới</h2>
     <form action="{{ route('roles.store') }}" method="POST">
         @csrf
         <div class="mb-3">
             <label for="role_name" class="form-label">Tên quyền:</label>
             <input type="text" name="role_name" class="form-control" required>
         </div>
         <button type="submit" class="btn btn-success">Lưu</button>
         <a href="{{ route('roles.index') }}" class="btn btn-secondary">Quay lại</a>
     </form>
 </div>
 @endsection