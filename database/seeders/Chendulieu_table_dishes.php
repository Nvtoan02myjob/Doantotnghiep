<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\models\Dish;
class Chendulieu_table_dishes extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                "cate_id" => 3,
                "user_id" => 12,
                "name" => "Mì cay hải sản",
                "img" => "https://food.ibin.vn/images/data/product/mi-kim-chi-hai-san/mi-kim-chi-hai-san-002.jpg",
                "description" => "Mì Cay Hải Sản - Dream Stealers, mì dai ngon hòa quyện nước dùng đậm đà, cay nồng cùng hải sản tươi như tôm, mực, ngao. Ăn kèm rau, nấm, trứng, tùy chọn độ cay. Hương vị bùng nổ, thử ngay tại Dream Stealers!",
                "price" => 48000

            ],
            [
                "cate_id" => 3,
                "user_id" => 12,
                "name" => "Mì cay đùi gà",
                "img" => "https://mycayseouly.vn/Images/image/mycay/My-kim-chi-dui-ga.jpg",
                "description" => "Mì Cay Đùi Gà - Dream Stealers, mì dai ngon kết hợp nước dùng cay nồng, đậm đà cùng đùi gà mềm mọng, thấm vị. Ăn kèm rau, nấm, trứng, tùy chỉnh độ cay. Thử ngay tại Dream Stealers để cảm nhận hương vị tròn đầy!",
                "price" => 50000

            ],
            [
                "cate_id" => 3,
                "user_id" => 12,
                "name" => "Mì cay chả bò",
                "img" => "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTBynG6TwQN2Utwd3IQVECtJSrDCR1pMiaK6Va4w2Ji0o66GQoRHxKYaYAC1eTqNWgUbxE&usqp=CAU",
                "description" => "Mì Cay Chả Bò - Dream Stealers, thưởng thức Mì Cay Chả Bò với nước dùng đậm đà, cay nồng, được hầm từ xương và gia vị đặc trưng. Sợi mì dai giòn kết hợp với chả bò thơm ngon, dai nhẹ, thấm vị. Món ăn được bổ sung rau tươi, nấm, trứng và các topping hấp dẫn, giúp cân bằng hương vị.",
                "price" => 50000

            ],
            [
                "cate_id" => 3,
                "user_id" => 12,
                "name" => "Mì cay xúc xích",
                "img" => "https://food.ibin.vn/images/data/product/mi-kim-chi-hai-san/mi-kim-chi-hai-san-002.jpg",
                "description" => "Mì Cay Xúc Xích - Dream Stealers, sợi mì dai ngon hòa quyện với nước dùng cay nồng, đậm đà. Xúc xích vàng ruộm, thơm lừng, thấm vị cay hấp dẫn. Kèm theo rau tươi, nấm, trứng, tạo nên hương vị tròn đầy.",
                "price" => 49000

            ],
        ];

        foreach($data as $data_item){
            Dish::create($data_item);
        }
    }
}
