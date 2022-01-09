<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Events\LessonWatched;
use App\Listeners\LessonWatchedNotifier;
use App\Models\User;
use App\Models\Lesson;
use Illuminate\Support\Facades\Event;

class LessonWatchedTest extends TestCase
{
    /**
     * Test a comment can be created
     * Test functionality of LessonWatchedNotifer listener when LessonWatched event is triggered
     * Assert our database has the right record
     * 
     * @return void
     */
    public function test_user_lesson_watched()
    {
        $this->withoutExceptionHandling();

        $user = User::factory()
            ->hasAttached(
                Lesson::factory()->count(3),
                ['watched' => true]
            )->create();

        event(new LessonWatched($user->lessons[0], $user));

        $this->assertModelExists($user);
    }

    /**
     * Assert our LessonWatchedNotifer event listener is attached to the LessonWatched event
     * 
     * @return void
     */
    public function test_is_attached_to_event()
    {
        Event::fake();
        Event::assertListening(
            LessonWatched::class,
            LessonWatchedNotifier::class
        );
    }
}
