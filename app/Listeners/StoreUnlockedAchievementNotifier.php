<?php

namespace App\Listeners;

use App\Events\AchievementUnlocked;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\IPS\Activities\UserAchievementActivity;

class StoreUnlockedAchievementNotifier
{
    protected $userAchievementActivity;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(UserAchievementActivity $userAchievementActivity)
    {
        //
        $this->userAchievementActivity = $userAchievementActivity;
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\AchievementUnlocked  $event
     * @return void
     */
    public function handle(AchievementUnlocked $event)
    {
        //
        $this->userAchievementActivity->addAchievement($event->achievement_name, $event->user); 
        
    }
}
