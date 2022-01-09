<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Events\CommentWritten;
use Illuminate\Support\Facades\Event;
use App\Models\Comment;
use App\Listeners\CommentWrittenNotifier;

class CommentWrittenTest extends TestCase
{
    //use RefreshDatabase;

    /**
     * Test a comment can be created
     * Test functionality of CommentWrittenNotifier listener when CommentWritten event is triggered
     * Assert our database has the right record
     * 
     * @return void
     */
    public function test_comment_written()
    {
        $this->withoutExceptionHandling();

        $comment = Comment::factory()->create();

        event(new CommentWritten($comment));

        $this->assertDatabaseHas('user_achievements', [
            'user_id' => $comment->user->id,
        ]);
        $this->assertModelExists($comment);
    }

    /**
     * Assert our CommentWrittenNotifier event listener is attached to the CommentWritten event
     * 
     * @return void
     */
    public function test_is_attached_to_event()
    {
        Event::fake();
        Event::assertListening(
            CommentWritten::class,
            CommentWrittenNotifier::class
        );
    }
}
