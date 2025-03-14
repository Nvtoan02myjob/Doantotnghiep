<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order_detail extends Model
{
    protected $table = "order_details";

    protected $fillable = [
        'order_id',
        'dish_id',
        'quantity',
        'unit_price'
    ];
}
