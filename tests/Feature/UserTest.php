<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Lesson;

class UserTest extends TestCase
{
    /**
     * Test a user can be created
     * Assert our database has the right record
     * 
     * @return void
     */
    public function test_create_user()
    {
        $this->withoutExceptionHandling();

        $user = User::factory()->create();

        $this->assertModelExists($user);
    }

    /**
     * Test a user can be add lessons
     * Assert our database has the right record
     * 
     * @return void
     */
    public function test_user_watch_lesson()
    {
        $user = User::factory()
            ->has(Lesson::factory()->count(3), 'lessons')
            ->create();

        $this->assertDatabaseHas('lesson_user', [
            'user_id' => $user->id,
        ]);
    }
}
