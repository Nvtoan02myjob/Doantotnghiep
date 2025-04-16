<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = "comments";

    protected $fillable = [
        'content', 
        'quantity_star', 
        'user_id',
        'dish_id',
        'image'
    ];
    protected $casts = [
        'image' => 'array', 
    ];
}
