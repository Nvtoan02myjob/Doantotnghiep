<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dish extends Model
{
    protected $table = "dishes";

    protected $fillable = [
        'cate_id',
        'user_id',
        'name',
        'img',
        'description',
        'price'
    ];
      // Phương thức tìm kiếm theo tên món
      public static function searchByName($query)
      {
          return self::where('name', 'LIKE', '%' . $query . '%')->get();
      }

}
