<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\IPS\Activities\UserAchievementActivity;

class AchievementsController extends Controller
{
    protected $userAchievementActivity;

    public function __construct(UserAchievementActivity $userAchievementActivity)
    {
        $this->userAchievementActivity = $userAchievementActivity;
    }

    public function index(User $user)
    {
        $data = $this->userAchievementActivity->getUserAchievementStates($user);
        return response()->json([
            'unlocked_achievements' => $data['unlocked_achievements'],
            'next_available_achievements' => $data['next_available_achievements'],
            'current_badge' => $data['current_badge'],
            'next_badge' => $data['next_badge'],
            'remaing_to_unlock_next_badge' => $data['remaing_to_unlock_next_badge']
        ]);
    }
}
