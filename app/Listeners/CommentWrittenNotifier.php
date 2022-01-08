<?php

namespace App\Listeners;

use App\Events\CommentWritten;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\IPS\Utils\AchievementUtil;
use App\Events\AchievementUnlocked;

class CommentWrittenNotifier
{
    public $achievementUtil;
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
        
        //Get the next achievement for the user based on the number of comments
        $userAchievement = AchievementUtil::getCommentsWrittenAchievement(count($user->comments));
        if($userAchievement != null)
        {
            event(new AchievementUnlocked($userAchievement, $user));
        }
    }
}
