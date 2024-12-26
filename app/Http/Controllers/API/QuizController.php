<?php

namespace App\Http\Controllers\API;

use App\Models\Quiz;
use App\Models\QuizResult;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\apiresponse;

class QuizController extends Controller
{
    use apiresponse;
    public function index($courseId)
    {
        // Fetch quizzes based on the provided course_id
        $quizzes = Quiz::where('course_id', $courseId)
            ->withCount('questions')
            ->get(['id', 'title', 'total_time', 'course_id']);

        // Check if any quizzes are found for the given course_id
        if ($quizzes->isEmpty()) {
            return $this->error('No quizzes found for the specified course.', 404);
        }

        // Format the data to include total questions and total time for each quiz
        $formattedQuizzes = $quizzes->map(function ($quiz) {
            return [
                'id' => $quiz->id,
                'title' => $quiz->title,
                'total_time' => $quiz->total_time,
                'course_id' => $quiz->course_id,
                'total_questions' => $quiz->questions_count, // Provided by withCount
            ];
        });

        // Return the quizzes under the specified course_id
        return $this->success(
            [
                'quizzes' => $formattedQuizzes,
            ],
            'Quizzes fetched successfully',
            200,
        );
    }
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'total_time' => 'required|integer',
            'question_ids' => 'required|array',
            'question_ids.*' => 'exists:questions,id',
        ]);

        $quiz = Quiz::create($request->only('title', 'total_time'));

        $quiz->questions()->attach($request->question_ids);

        return $quiz->load('questions');
    }

    public function calculateResult(Request $request)
    {
        // $request->validate([
        //     'quiz_id' => 'required|exists:quizzes,id',
        //     'answers' => 'required|array',
        //     'answers.*' => 'exists:options,id',
        // ]);

        // $quiz = Quiz::with('questions.options')->findOrFail($request->quiz_id);
        // $correctAnswers = 0;

        // foreach ($quiz->questions as $question) {
        //     $userAnswer = $request->answers[$question->id] ?? null;
        //     $correctOption = $question->options->where('is_correct', true)->first();

        //     if ($correctOption && $correctOption->id == $userAnswer) {
        //         $correctAnswers++;
        //     }
        // }

        // $totalQuestions = $quiz->questions->count();
        // $percentage = ($correctAnswers / $totalQuestions) * 100;

        // return QuizResult::create([
        //     'quiz_id' => $quiz->id,
        //     'user_id' => auth()->id(), // Ensure user is logged in
        //     'score' => $correctAnswers,
        //     'total_questions' => $totalQuestions,
        //     'percentage' => round($percentage, 2),
        // ]);

        // Validate the incoming request
        $request->validate([
            'quiz_id' => 'required|exists:quizzes,id',
            'answers' => 'required|array', // User's answers in question_id => option_id format
            'answers.*' => 'exists:options,id',
        ]);

        // Find the quiz with its questions and options
        $quiz = Quiz::with('questions.options')->findOrFail($request->quiz_id);
        $correctAnswers = 0;
        $results = [];

        // Loop through the questions to check answers and gather the required info
        foreach ($quiz->questions as $question) {
            $userAnswer = $request->answers[$question->id] ?? null; // Get user's answer for this question
            $correctOption = $question->options->where('is_correct', true)->first(); // Get correct option
            $selectedOption = $question->options->find($userAnswer); // Get the selected option

            // Store the result for this question
            $results[] = [
                'question_id' => $question->id,
                'question_text' => $question->question_text,
                'selected_option' => $selectedOption ? $selectedOption->option_text : null, // Selected option text
                'correct_option' => $correctOption ? $correctOption->option_text : null, // Correct option text
                'is_correct' => $selectedOption && $selectedOption->id == $correctOption->id, // Whether the answer is correct
                'explanation' => $question->note, // Assuming you have an 'explanation' field in the 'questions' table
            ];

            // If the user's answer is correct, increment the score
            if ($selectedOption && $selectedOption->id == $correctOption->id) {
                $correctAnswers++;
            }
        }

        // Calculate the percentage
        $totalQuestions = $quiz->questions->count();
        $percentage = ($correctAnswers / $totalQuestions) * 100;

        // Save the result in the database
        $result = QuizResult::create([
            'quiz_id' => $quiz->id,
            'user_id' => auth()->id(), // Authenticated user ID
            'score' => $correctAnswers,
            'total_questions' => $totalQuestions,
            'percentage' => round($percentage, 2),
            'answers' => $request->answers, // Store user answers
        ]);

        // Return the results
        return response()->json([
            'result' => $result,
            'results' => $results,
            'message' => 'Quiz completed successfully',
        ]);
    }

    public function show($id)
    {
        try {
            // Fetch the quiz with the given quiz ID and ensure it belongs to the specified course ID
            $quiz = Quiz::with('questions.options')->findOrFail($id);

            // Return the quiz data if found
            return response()->json([
                'quiz' => [
                    'id' => $quiz->id,
                    'title' => $quiz->title,
                    'total_time' => $quiz->total_time,
                    'questions' => $quiz->questions->map(function ($question) {
                        return [
                            'id' => $question->id,
                            'text' => $question->question_text,
                            'options' => $question->options->map(function ($option) {
                                return [
                                    'id' => $option->id,
                                    'text' => $option->option_text, // Do not include 'is_correct' here
                                ];
                            }),
                        ];
                    }),
                ],
            ]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            // Return an error response if quiz or course ID is not found
            return response()->json(
                [
                    'error' => 'Quiz not found for the specified quiz ID.',
                ],
                404,
            );
        }
    }

    public function getResultByResultId($quizResultId)
    {
        // Fetch the quiz result by its ID
        $quizResult = QuizResult::with('quiz.questions.options')
            ->where('id', $quizResultId)
            ->where('user_id', auth()->id()) // Ensure the result belongs to the authenticated user
            ->firstOrFail();

        // Access the quiz associated with this result
        $quiz = $quizResult->quiz;

        $results = [];

        // Loop through the questions to gather the required info
        foreach ($quiz->questions as $question) {
            $userAnswer = $quizResult->answers[$question->id] ?? null; // User's saved answer
            $correctOption = $question->options->where('is_correct', true)->first(); // Correct option

            // Format the options with additional info
            $options = $question->options->map(function ($option) use ($userAnswer, $correctOption) {
                return [
                    'id' => $option->id,
                    'text' => $option->option_text,
                    'is_correct' => $option->is_correct,
                    'is_selected' => $option->id == $userAnswer,
                ];
            });

            $results[] = [
                'question_id' => $question->id,
                'question_text' => $question->question_text,
                'options' => $options, // Include all options with their details
                'correct_option' => $correctOption ? $correctOption->option_text : null,
                'is_correct' => $correctOption && $userAnswer == $correctOption->id,
                'explanation' => $question->note,
            ];
        }

        // Return detailed quiz result
        return response()->json([
            'quiz' => [
                'id' => $quiz->id,
                'title' => $quiz->title, // Assuming there's a 'title' field in quizzes
            ],
            'result' => [
                'score' => $quizResult->score,
                'total_questions' => $quizResult->total_questions,
                'percentage' => $quizResult->percentage,
            ],
            'questions' => $results,
            'message' => 'Quiz result retrieved successfully',
        ]);
    }

    public function submitPracticeAnswer(Request $request, $quizId, $questionId)
    {
        $userId = $request->user()->id; // Get the authenticated user's ID

        // Validate the incoming request
        $request->validate([
            'selected_option_id' => 'required|integer|exists:options,id',
        ]);

        // Fetch the quiz along with its questions and options
        $quiz = Quiz::with(['questions.options'])->findOrFail($quizId);

        // Retrieve the specific question
        $question = $quiz->questions->where('id', $questionId)->first();

        if (!$question) {
            return response()->json(['message' => 'Question not found'], 404);
        }

        // Get the selected option
        $selectedOption = $question->options->where('id', $request->selected_option_id)->first();

        if (!$selectedOption) {
            return response()->json(['message' => 'Invalid option selected'], 400);
        }

        // Find the correct option for the question
        $correctOption = $question->options->where('is_correct', true)->first();

        // Determine if the user's answer is correct
        $isCorrect = $selectedOption->id === $correctOption->id;

        // Format the options with additional info
        $options = $question->options->map(function ($option) use ($selectedOption) {
            return [
                'id' => $option->id,
                'text' => $option->option_text,
                'is_correct' => $option->is_correct,
                'is_selected' => $option->id == $selectedOption->id,
            ];
        });

        // Prepare the response
        $response = [
            'question_id' => $question->id,
            'question_text' => $question->question_text,
            'options' => $options,
            'selected_option' => $selectedOption->option_text,
            'correct_option' => $correctOption ? $correctOption->option_text : null,
            'is_correct' => $isCorrect,
            'explanation' => $question->note,
        ];

        return response()->json([
            'data' => $response,
            'message' => $isCorrect ? 'Correct answer!' : 'Incorrect answer.',
        ]);
    }

    public function showWithCorrectAnswers($id)
    {
        try {
            // Fetch the quiz with the given quiz ID and include questions and options
            $quiz = Quiz::with('questions.options')->findOrFail($id);

            // Return the quiz data with correct answers and explanations included
            return response()->json([
                'quiz' => [
                    'id' => $quiz->id,
                    'title' => $quiz->title,
                    'total_time' => $quiz->total_time,
                    'questions' => $quiz->questions->map(function ($question) {
                        // Extract correct option
                        $correctOption = $question->options->firstWhere('is_correct', true);

                        return [
                            'id' => $question->id,
                            'text' => $question->question_text,
                            'correct_option' => $correctOption ? $correctOption->id : null,
                            'is_correct' => $correctOption ? true : false,
                            'explanation' => $question->note ?? 'No explanation provided.', // Optional explanation field
                            'options' => $question->options->map(function ($option) {
                                return [
                                    'id' => $option->id,
                                    'text' => $option->option_text,
                                    'is_correct' => $option->is_correct, // Include correct answer flag
                                ];
                            }),
                        ];
                    }),
                ],
            ]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            // Return an error response if the quiz is not found
            return response()->json(
                [
                    'error' => 'Quiz not found for the specified quiz ID.',
                ],
                404,
            );
        }
    }
}
