<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $fillable = [
        'content',
        'id_user',
        'image',
    ];


    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
    public function likes()
{
    return $this->belongsToMany(User::class, 'likes', 'post_id', 'user_id');
}
}
