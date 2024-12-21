<?php

namespace Database\Seeders;

use App\Models\Question;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $questions = [
            [
                'category_id' => 1,
                'question_text' => 'What is 2 + 2?',
                'note' => 'Basic math question.'
            ],
            [
                'category_id' => 2,
                'question_text' => 'What is the chemical symbol for water?',
                'note' => 'Common knowledge question.'
            ],
            [
                'category_id' => 3,
                'question_text' => 'Who was the first President of the United States?',
                'note' => 'History-related question.'
            ],
            [
                'category_id' => 4,
                'question_text' => 'What is the capital of France?',
                'note' => 'General knowledge question.'
            ]
        ];

        foreach ($questions as $question) {
            Question::create($question);
        }
    }
}
