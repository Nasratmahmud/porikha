<?php

namespace Database\Seeders;

use App\Models\Quiz;
use App\Models\Question;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class QuizQuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $quiz = Quiz::first(); // Get the first quiz
        $questions = Question::all(); // Get all questions

        foreach ($questions as $question) {
            $quiz->questions()->attach($question->id);
        }
    }
}
