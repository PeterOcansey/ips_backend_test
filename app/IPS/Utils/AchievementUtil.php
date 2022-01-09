<?php 

namespace App\IPS\Utils; 

class AchievementUtil
{
	public static function getLessonsWatchedAchievement(int $lessonWatched)
	{
		if($lessonWatched == 1)
            return self::listLessonsWatchedAchievemnts()[0];
        else if($lessonWatched == 5)
            return self::listLessonsWatchedAchievemnts()[1];
        else if($lessonWatched == 10)
            return self::listLessonsWatchedAchievemnts()[2];
        else if($lessonWatched == 25)
            return self::listLessonsWatchedAchievemnts()[3];
        else if($lessonWatched == 50)
            return self::listLessonsWatchedAchievemnts()[4];
        else
            return null;

	}

	public static function getCommentsWrittenAchievement(int $commentWritten)
	{
        if($commentWritten == 1)
            return self::listCommentsWrittenAchievements()[0];
        else if($commentWritten == 3)
            return self::listCommentsWrittenAchievements()[1];
        else if($commentWritten == 5)
            return self::listCommentsWrittenAchievements()[2];
        else if($commentWritten == 10)
            return self::listCommentsWrittenAchievements()[3];
        else if($commentWritten == 20)
            return self::listCommentsWrittenAchievements()[4];
        else 
            return null;
	}

    public static function listLessonsWatchedAchievemnts()
    {
        return [
            "First Lesson Watched",
            "5 Lessons Watched",
            "10 Lessons Watched",
            "25 Lessons Watched",
            "50 Lessons Watched"
        ];
    }

    public static function listCommentsWrittenAchievements()
    {
        return [
            "First Comment Written",
            "3 Comments Written",
            "5 Comments Written",
            "10 Comment Written",
            "20 Comment Written",
        ];
    }
}