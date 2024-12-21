<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\QuestionCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class QuestionCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = ['Math', 'Science', 'History', 'General Knowledge'];

        foreach ($categories as $category) {
            QuestionCategory::create(['name' => $category]);
        }
    }
}
