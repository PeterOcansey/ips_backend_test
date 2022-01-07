<?php

namespace Database\Seeders;

use App\Models\Lesson;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //Populate lessons table with 20 records
        $lessons = Lesson::factory()
            ->count(20)
            ->create();
        
        //Populate users table with 5 records
        $users = User::factory()
            ->count(5)
            ->create();
    }
}
