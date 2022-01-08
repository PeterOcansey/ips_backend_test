<?php 

namespace App\IPS\Repos;

use App\Models\UserBadge;

class UserBadgeRepo
{
    public function addBadge(Array $data)
    {
        return UserBadge::create($data);
    }
}