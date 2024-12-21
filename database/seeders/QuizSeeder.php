<?php

namespace Database\Seeders;

use App\Models\Quiz;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class QuizSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $quizzes = [
            [
                'title' => 'Basic Math Quiz',
                'total_time' => 10 ,// 10 minutes
                'course_id' => 1,
            ],
            [
                'title' => 'Science Knowledge Quiz',
                'total_time' => 15, // 15 minutes
                'course_id' => 1,
            ]
        ];

        foreach ($quizzes as $quiz) {
            Quiz::create($quiz);
        }
    }
}
