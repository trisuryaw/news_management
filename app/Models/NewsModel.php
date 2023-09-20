<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewsModel extends Model
{
    use HasFactory;
    protected $table = 'news';
    protected $primaryKey = 'id';
    protected $keyType = 'int';

    protected $fillable = ['user_id', 'title', 'content', 'image'];

    public function comments()
    {
        return $this->hasMany(CommentModel::class, 'news_id');
    }
}
