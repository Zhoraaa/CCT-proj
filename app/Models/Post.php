<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        "theme", "text", "post_type_id", "author_id", "reply_to"
    ];

    public function replies()
    {
        return $this->hasMany(Post::class, 'reply_to');
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }
    public function __get($key)
    {
        if ($key == 'author') {
            return $this->author()->first()->login;
        }
        return parent::__get($key);
    }
}
