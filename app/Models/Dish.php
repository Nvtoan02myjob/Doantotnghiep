<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Category;
class Dish extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = "dishes";

    protected $fillable = [
        'cate_id',
        'user_id',
        'name',
        'img',
        'description',
        'price'
    ];
      public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function category()
{
    return $this->belongsTo(Category::class, 'cate_id');
}


}
