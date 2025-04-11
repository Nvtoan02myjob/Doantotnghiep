<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\models\Banner;

class Chendulieu_table_banners extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Banner::insert([
            [
                "user_id" => 12,
                "image"=> "https://digiticket.vn/blog/wp-content/uploads/2021/05/set-an-198k-1920x1280.jpg",
                "text"=>"Những nồi lẩu thơm ngon, nóng hổi, kết hợp cùng nguyên liệu tươi sạch, đảm bảo chất lượng. Hương vị lẩu đặc trưng giúp mỗi bữa ăn trở thành một trải nghiệm đáng nhớ."

            ],
            [
                "user_id" => 12,
                "image"=> "https://img5.thuthuatphanmem.vn/uploads/2021/12/08/mi-cay-tai-nha_084814081.jpg",
                "text"=>"Những tô mì cay với hương vị đậm đà, sợi mì dai ngon cùng nước dùng thơm nồng, kích thích vị giác. Bạn có thể lựa chọn cấp độ cay phù hợp để thử thách giới hạn của bản thân!"

            ],
            [
                "user_id" => 12,
                "image"=> "https://cdn.eva.vn/upload/1-2013/images/2013-03-12/1363025714-com-tron.jpg",
                "text"=>"Những phần cơm trộn chuẩn vị, kết hợp giữa cơm nóng, rau củ tươi, trứng lòng đào béo ngậy và nước sốt đặc biệt, tạo nên một hương vị hài hòa khó cưỡng."

            ],
        ]);
        
    }
}
