<?php

namespace App\IPS\Activities;

use App\IPS\Repos\UserBadgeRepo;
use Carbon\Carbon;

class UserBadgeActivity
{

    protected $userBadgeRepo;


    public function __construct(UserBadgeRepo $userBadgeRepo)
    {
        $this->userBadgeRepo = $userBadgeRepo;
    }

    public function addBadge(String $name, User $user)
    {
        $data = [];
        $data["name"] = $name;
        $data["user_id"] = $user->id;
        $data["created_at"] = Carbon::now();
        $data["updated_at"] = Carbon::now();

        return $this->userBadgeRepo->addBadge($data);
    }
}