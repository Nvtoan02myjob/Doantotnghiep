<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;
    protected $table = "categories";

    protected $fillable = [
        'user_id',
        'name',
        'image',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
}
