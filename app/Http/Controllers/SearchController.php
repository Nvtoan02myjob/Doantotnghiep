<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dish;

class SearchController extends Controller
{
    // Phương thức tìm kiếm món ăn theo tên
    public function search(Request $request)
    {
        // Lấy từ khóa tìm kiếm từ yêu cầu
        $query = $request->input('q');

        // Kiểm tra xem query có giá trị hay không
        if (!$query) {
            return response()->json([], 400); // Trả về lỗi nếu không có từ khóa tìm kiếm
        }

        // Tìm kiếm món ăn trong cơ sở dữ liệu theo tên
        $dishes = Dish::searchByName($query); // Sử dụng phương thức searchByName trong Model

        return response()->json($dishes); // Trả về kết quả dưới dạng JSON
    }
}
