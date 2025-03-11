<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class Chendulieu_table_categories extends Seeder
{
    public function run(): void
    {
        Category::insert([
            [
                "employee_id" => 1,
                "name" => "Mì cay",
                "image" => "https://food.ibin.vn/images/data/product/mi-kim-chi-bo/mi-kim-chi-bo-001.jpg",
            ],
            [
                "employee_id" => 1,
                "name" => "Lẩu",
                "image" => "https://digiticket.vn/blog/wp-content/uploads/2021/05/set-an-198k-1920x1280.jpg",
            ],
            [
                "employee_id" => 1,
                "name" => "Bánh",
                "image" => "https://img5.thuthuatphanmem.vn/uploads/2021/12/07/xuc-xich_041911469.jpg",
            ],
            [
                "employee_id" => 1,
                "name" => "Nước",
                "image" => "https://khonguyenlieu.com/wp-content/uploads/2017/08/homemade-peach-tea-600x600.jpg",
            ],
        ]);
    }
}
