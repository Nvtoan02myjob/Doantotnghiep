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
}
