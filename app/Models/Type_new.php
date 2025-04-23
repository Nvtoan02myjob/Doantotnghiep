<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Type_new extends Model
{
    use SoftDeletes;
    protected $table = "type_news";

    protected $fillable = [
        'user_id',
        'name',

    ];
    public function news()
    {
        return $this->hasMany(News::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
