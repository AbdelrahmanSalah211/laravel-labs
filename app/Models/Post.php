<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Events\PostAdded;

class Post extends Model
{
    use HasFactory;
    use SoftDeletes;
    //
    protected $fillable = [
        'title',
        'body',
        'enabled',
        'user_id'
    ];


    public function user()
{
    return $this->belongsTo(User::class);
}


protected static function booted(): void
{
    static::created(function ($post) {
        PostAdded::dispatch($post);
    });

    static::deleted(function ($post) {
        if ($post->user_id) {
            $post->user->decrement('posts_count');
        }
    });
}

}
