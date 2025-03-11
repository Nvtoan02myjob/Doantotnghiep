<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\models\Category;

class Chendulieu_table_categories_2 extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::insert(
            [
                "employee_id" => 1,
                "name" => "Cơm trộn",
                "image" => "http://congthucphache.com/wp-content/uploads/2020/04/com-tron-han-quoc-ngon.jpg",
            ],
        );
    }
}
