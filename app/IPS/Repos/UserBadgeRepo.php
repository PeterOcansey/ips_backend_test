<?php 

namespace App\IPS\Repos;

use App\Models\UserBadge;

class UserBadgeRepo
{
    public function addBadge(Array $data)
    {
        return UserBadge::create($data);
    }

    public function getUserBadge(String $badge_name, int $user_id)
    {
        return UserBadge::where('name', $badge_name)
                    ->where('user_id', $user_id)
                    ->first();
    }

    public function getUserCurrentBadge(int $user_id)
    {
        return UserBadge::select("name")->where('user_id', $user_id)->orderBy('created_at','DESC')->first();
    }
}