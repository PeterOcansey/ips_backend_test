<?php

namespace App\IPS\Activities;

use App\IPS\Repos\UserRepo;
use Carbon\Carbon;

class UserActivity
{

    protected $userRepo;


    public function __construct(UserRepo $userRepo)
    {
        $this->userRepo = $userRepo;
    }

}