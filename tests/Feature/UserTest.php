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
}
