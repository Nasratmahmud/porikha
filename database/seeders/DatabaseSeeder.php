<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run() {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call( UserSeeder::class );
        $this->call( PermissionSeeder::class );
        $this->call( AdminAsignAllPermissionSeeder::class );
        //$this->call(CourseSeeder::class);
        //$this->call(QuestionCategorySeeder::class);
        //$this->call(QuestionSeeder::class);
        //$this->call(OptionSeeder::class);
        //$this->call(QuizSeeder::class);
        //$this->call(QuizQuestionSeeder::class);



    }
}
