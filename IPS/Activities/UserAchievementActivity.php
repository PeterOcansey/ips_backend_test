<?php

namespace App\IPS\Activities;

use App\IPS\Repos\UserAchievementRepo;
use Carbon\Carbon;

class UserAchievementActivity
{

    protected $userAchievementRepo;


    public function __construct(UserAchievementRepo $userAchievementRepo)
    {
        $this->userAchievementRepo = $userAchievementRepo;
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
}