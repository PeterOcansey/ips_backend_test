<?php

namespace App\Listeners;

use App\Events\AchievementUnlocked;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\IPS\Activities\UserAchievementActivity;
use App\IPS\Activities\UserBadgeActivity;

class StoreUnlockedAchievementNotifier
{
    protected $userAchievementActivity;
    protected $userBadgeActivity;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(UserAchievementActivity $userAchievementActivity, UserBadgeActivity $userBadgeActivity)
    {
        //
        $this->userAchievementActivity = $userAchievementActivity;
        $this->userBadgeActivity = $userBadgeActivity;
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
        //dd($event->achievement_name);
        $this->userAchievementActivity->addAchievement($event->achievement_name, $event->user);
        
        //Check and reward the user a new badge
        $this->userBadgeActivity->rewardBadge($event->user);
    }
}
