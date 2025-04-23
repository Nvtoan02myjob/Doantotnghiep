<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dish;

class DishController extends Controller
{
    // Phương thức hiển thị chi tiết món ăn
    public function show($id)
    {
        $dish = Dish::findOrFail($id); // Lấy món ăn theo id

        return view('dish.detail', compact('dish')); // Trả về view chi tiết món ăn
    }
}
