<?php

namespace App\Listeners;

use App\Events\LessonWatched;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\AchievementUnlocked;
use App\IPS\Utils\AchievementUtil;

class LessonWatchedNotifier
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
     * @param  \App\Events\LessonWatched  $event
     * @return void
     */
    public function handle(LessonWatched $event)
    {
        //
        $user = $event->user;

        //Get the next achievement for the user based on the number of lessons watched
        $userAchievement = AchievementUtil::getLessonsWatchedAchievement(count($user->watched));
        if($userAchievement != null)
        {
            event(new AchievementUnlocked($userAchievement, $user));
        }
    }
}
