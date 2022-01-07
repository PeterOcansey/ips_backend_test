<?php 

namespace App\IPS\Repos;

use App\Models\UserAchievement;

class UserAchievementRepo
{

    public function addAchievement(Array $data)
    {
        return UserAchievement::create($data);
    }
}