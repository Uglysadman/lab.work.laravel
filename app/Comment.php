<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    public $table = 'comments';

    protected $fillable = [
        'post_id', 'author', 'text_comment'
    ];

    public function post()
    {
        return $this->belongsTo(Post::class, 'post_id');
    }
}
