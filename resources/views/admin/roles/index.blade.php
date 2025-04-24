
 @extends('admin.partials.master')
 
 @section('content')
 <div class="container mt-5">
     <h2 class="mb-4 text-center">Danh sách phân quyền</h2>
     <a href="{{ route('roles.create') }}" class="btn btn-success mb-3">➕ Thêm phân quyền</a>
 
     <table class="table table-bordered table-hover">
         <thead class="table-Success">
             <tr>
                 <th>ID</th>
                 <th>Tên quyền</th>
                 <th>Thao tác</th>
             </tr>
         </thead>
         <tbody>
             @foreach ($roles as $role)
                 <tr>
                     <td>{{ $role->id }}</td>
                     <td>{{ $role->role_name }}</td>
                     <td>
                         <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-primary btn-sm"> Sửa</a>
                         <form action="{{ route('roles.destroy', $role->id) }}" method="POST" style="display:inline-block;">
                             @csrf
                             @method('DELETE')
                             <button onclick="return confirm('Bạn có chắc muốn xoá không?')" class="btn btn-danger btn-sm">Xoá</button>
                         </form>
                     </td>
                 </tr>
             @endforeach
         </tbody>
     </table>
 </div>
 @endsection