<?php

namespace App\Listeners;

use App\Events\CommentWritten;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\IPS\Utils\AchievementUtil;

class CommentWrittenNotifier
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\CommentWritten  $event
     * @return void
     */
    public function handle(CommentWritten $event)
    {
        //
        $user = $event->comment->user;
        
        $userAchievement = AchievementUtil::getCommentsWrittenAchievement(count($user->comments));
        if($userAchievement != null)
        {
            event(new AchievementUnlocked($userAchievement, $user));
        }
    }
}
