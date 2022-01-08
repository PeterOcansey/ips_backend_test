<?php

namespace App\Listeners;

use App\Events\BadgeUnlocked;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\IPS\Activities\UserBadgeActivity;

class StoreUnlockedBadgeNotifier
{
    protected $userBadgeActivity;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(UserBadgeActivity $userBadgeActivity)
    {
        //
        $this->userBadgeActivity = $userBadgeActivity;
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\BadgeUnlocked  $event
     * @return void
     */
    public function handle(BadgeUnlocked $event)
    {
        //
        $this->userBadgeActivity->addBadge($event->badge_name, $event->user);
    }
}
