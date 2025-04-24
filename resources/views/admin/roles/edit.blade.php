
 @extends('admin.partials.master')
 
 @section('content')
 <div class="container mt-5">
     <h2 class="mb-4">✏️ Chỉnh sửa quyền</h2>
     <form action="{{ route('roles.update', $role->id) }}" method="POST">
         @csrf
         @method('PUT')
         <div class="mb-3">
             <label for="role_name" class="form-label">Tên quyền:</label>
             <input type="text" name="role_name" class="form-control" value="{{ $role->role_name }}" required>
         </div>
         <button type="submit" class="btn btn-primary">Cập nhật</button>
         <a href="{{ route('roles.index') }}" class="btn btn-secondary">Quay lại</a>
     </form>
 </div>
 @endsection