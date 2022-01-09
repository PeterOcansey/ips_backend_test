<?php 

namespace App\IPS\Repos;

use App\Models\UserAchievement;
use App\Models\User;

class UserAchievementRepo
{

    public function addAchievement(Array $data)
    {
        return UserAchievement::create($data);
    }

    public function getUserAchievementNames(User $user)
    {
        return UserAchievement::select("name")->where("user_id", $user->id)->get();
    }
}