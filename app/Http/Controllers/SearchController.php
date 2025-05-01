<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dish;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('query'); // Nhận từ khóa tìm kiếm từ request

        // Kiểm tra nếu từ khóa tìm kiếm trống
        if (empty($query)) {
            return response()->json([]); // Trả về mảng rỗng nếu không có từ khóa
        }

        // Tìm kiếm món ăn theo tên hoặc mô tả
        $dishes = Dish::where('name', 'LIKE', '%' . $query . '%')
                      ->orWhere('description', 'LIKE', '%' . $query . '%')
                      ->get(['id', 'name', 'img', 'price']); // Trả về id, name, img, price

        return response()->json($dishes); // Trả về kết quả dưới dạng JSON
    }
}

