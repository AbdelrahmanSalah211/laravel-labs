<?php

namespace App\Listeners;

use App\Events\PostAdded;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UserPostsCount
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(PostAdded $event): void
    {
        //
        $post = $event->post;

        if ($post->user_id) {
            $post->user->increment('posts_count');
        }
    }
}
