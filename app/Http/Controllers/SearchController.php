<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dish;

class SearchController extends Controller
{
    // Phương thức tìm kiếm
    public function search(Request $request)
    {
        $query = $request->input('query'); // Nhận từ khóa tìm kiếm từ request

        // Tìm kiếm món ăn theo tên hoặc mô tả và lấy id, name, img, price
        $dishes = Dish::where('name', 'LIKE', '%' . $query . '%')
                    ->orWhere('description', 'LIKE', '%' . $query . '%')
                    ->get(['id', 'name', 'img', 'price']); // Bao gồm id để sử dụng trong URL

        return response()->json($dishes); // Trả về kết quả dưới dạng JSON
    }
}
