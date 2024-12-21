<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Option;

class OptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $options = [
            [
                'question_id' => 1,
                'option_text' => '3',
                'is_correct' => false
            ],
            [
                'question_id' => 1,
                'option_text' => '4',
                'is_correct' => true
            ],
            [
                'question_id' => 1,
                'option_text' => '5',
                'is_correct' => false
            ],
            [
                'question_id' => 1,
                'option_text' => '6',
                'is_correct' => false
            ],
            [
                'question_id' => 2,
                'option_text' => 'H2O',
                'is_correct' => true
            ],
            [
                'question_id' => 2,
                'option_text' => 'O2',
                'is_correct' => false
            ],
            [
                'question_id' => 2,
                'option_text' => 'CO2',
                'is_correct' => false
            ],
            [
                'question_id' => 2,
                'option_text' => 'NaCl',
                'is_correct' => false
            ],
            // Add similar options for other questions...
        ];

        foreach ($options as $option) {
            Option::create($option);
        }
    }
}
