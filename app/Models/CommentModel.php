<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommentModel extends Model
{
    use HasFactory;

    protected $table = 'comments';
    protected $primaryKey = 'id';
    protected $keyType = 'int';

    protected $fillable = ['user_id', 'news_id', 'text'];
}
