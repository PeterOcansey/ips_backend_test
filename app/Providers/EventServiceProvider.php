<?php

namespace App\Providers;


use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use App\Events\LessonWatched;
use App\Events\CommentWritten;
use App\Events\AchievementUnlocked;
use App\Events\BadgeUnlocked;
use App\Listeners\CommentWrittenNotifier;
use App\Listeners\LessonWatchedNotifier;
use App\Listeners\StoreUnlockedAchievementNotifier;
use App\Listeners\StoreUnlockedBadgeNotifier;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        CommentWritten::class => [
            //
            CommentWrittenNotifier::class
        ],
        LessonWatched::class => [
            //
            LessonWatchedNotifier::class
        ],
        AchievementUnlocked::class => [
            //
            StoreUnlockedAchievementNotifier::class
        ],
        BadgeUnlocked::class => [
            //
            StoreUnlockedBadgeNotifier::class
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
