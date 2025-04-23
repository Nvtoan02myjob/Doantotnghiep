<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class News extends Model
{
    use SoftDeletes;
    use HasFactory;
    protected $table = "news";
    protected $fillable = [
        'user_id',
        'type_news_id',
        'title',
        'summary',
        'content',
        'image',
        'status'
    ];
    public function type_news()
    {
        return $this->belongsTo(Type_new::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
}
