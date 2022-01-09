<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserAchievementTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * An integration test to get user achievemnts
     *
     * @return void
     */
    public function test_user_achievement_api_call()
    {
        $user = User::factory()->create();
        
        $response = $this->get("/users/{$user->id}/achievements");

        $response->assertStatus(200);
    }
}
