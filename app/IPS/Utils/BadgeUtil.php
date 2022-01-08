<?php 

namespace App\IPS\Utils; 

class BadgeUtil
{
	public static function getAchievementsBadge(int $userAchievements)
	{
		if($userAchievements == 0)
            return self::listBadges()[0];
        else if($userAchievements == 4)
            return self::listBadges()[1];
        else if($userAchievements == 8)
            return self::listBadges()[2];
        else if($userAchievements == 10)
            return self::listBadges()[3];
        else
            return null;

	}

    private static function listBadges()
    {
        return [
            "Beginner",
            "Intermediate",
            "Advanced",
            "Master" 
        ];
    }

}