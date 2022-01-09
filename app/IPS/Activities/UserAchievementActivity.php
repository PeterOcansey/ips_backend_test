<?php

namespace App\IPS\Activities;

use App\IPS\Repos\UserAchievementRepo;
use Carbon\Carbon;
use App\Models\User;
use App\IPS\Utils\AchievementUtil;
use App\IPS\Activities\UserBadgeActivity;
use App\IPS\Utils\BadgeUtil;

class UserAchievementActivity
{

    protected $userAchievementRepo;
    protected $userBadgeActivity;


    public function __construct(UserAchievementRepo $userAchievementRepo, UserBadgeActivity $userBadgeActivity)
    {
        $this->userAchievementRepo = $userAchievementRepo;
        $this->userBadgeActivity = $userBadgeActivity;
    }

    public function addAchievement(String $name, User $user)
    {
        $data = [];
        $data["name"] = $name;
        $data["user_id"] = $user->id;
        $data["created_at"] = Carbon::now();
        $data["updated_at"] = Carbon::now();

        return $this->userAchievementRepo->addAchievement($data);
    }

    public function getUserAchievementStates(User $user)
    {
        $data = [];

        //Get user unlocked achievements
        $achievements_data = $this->userAchievementRepo->getUserAchievementNames($user)->toArray();
        $user_achievements = array_map(function($user_achievement){
                                return $user_achievement["name"];
                            }, $achievements_data);
        
        //Get user next available achievements
        $achievements = array_merge(AchievementUtil::listLessonsWatchedAchievemnts(), AchievementUtil::listCommentsWrittenAchievements());
        $next_available_achievemnts = array_diff($achievements, $user_achievements);

        //Get user current badge
        $user_current_badge = $this->userBadgeActivity->getUserCurrentBadge($user);
        
        //Get user next badge
        $user_next_badge = BadgeUtil::listBadges()[array_search($user_current_badge, BadgeUtil::listBadges()) + 1];

        //Get user next badge count
        $current_badge_count = count($user->badges);
        $user_next_badge_count = (count(BadgeUtil::listBadges()) - ($current_badge_count == 0 ? 1 : $current_badge_count));

        $data["unlocked_achievements"] = $user_achievements;
        $data["next_available_achievements"] = array_values($next_available_achievemnts);
        $data["current_badge"] = $user_current_badge;
        $data["next_badge"] = $user_next_badge;
        $data['remaing_to_unlock_next_badge'] = $user_next_badge_count;

        return $data;

    }
}