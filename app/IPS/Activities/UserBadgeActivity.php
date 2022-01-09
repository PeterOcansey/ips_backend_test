<?php

namespace App\IPS\Activities;

use App\IPS\Repos\UserBadgeRepo;
use Carbon\Carbon;
use App\IPS\Utils\BadgeUtil;
use App\Models\User;
use App\Events\BadgeUnlocked;

class UserBadgeActivity
{

    protected $userBadgeRepo;


    public function __construct(UserBadgeRepo $userBadgeRepo)
    {
        $this->userBadgeRepo = $userBadgeRepo;
    }

    /**
     * Add a new badge to a user
     * @param String $name
     * @param App\Models\User $user
     * @return App\Models\UserBadge
     */
    public function addBadge(String $name, User $user)
    {
        $data = [];
        $data["name"] = $name;
        $data["user_id"] = $user->id;
        $data["created_at"] = Carbon::now();
        $data["updated_at"] = Carbon::now();

        return $this->userBadgeRepo->addBadge($data);
    }

    public function userHasBadge(String $badge_name, User $user)
    {
        return $this->userBadgeRepo->getUserBadge($badge_name, $user->id) != null ? true : false; 
    }

    public function getUserCurrentBadge($user)
    {
        $current_badge = $this->userBadgeRepo->getUserCurrentBadge($user->id);
        return $current_badge != null ? $current_badge->name : BadgeUtil::listBadges()[0];
    }

    /**
     * Check and reward the user with a badge
     * @param App\Models\User $user
     * @return void
     */
    public function rewardBadge(User $user)
    {
        $achievement_count = count($user->achievements);
        
        //Get a user badge base on user achievements count
        $user_badge = BadgeUtil::getAchievementsBadge($achievement_count);
        if($user_badge != null && !$this->userHasBadge($user_badge, $user))
        {
            //Notify Badge event listeners of the new reward
            event(new BadgeUnlocked($user_badge, $user));
        }
    }
}