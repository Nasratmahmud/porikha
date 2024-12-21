@extends('frontend.app')



<!-- Start:Title -->

@section('title', 'Retake Quiz')

<!-- Start:Content -->

@section('content')

    <div class="app-content-area">

        <!-- ./Dashboard Main Content :: Start -->

        <main class="dashboard-content-wrapper">

            <div class="quiz-section">

                <div class="container-fluid">

                    <h1 class="mb-3 h2 text-capitalize"><span class="text-danger">Re-take:</span> {{ $quiz->title }}</h1>

                    <!-- Accordion Example -->

                    <form
                        action="{{ route('course.quiz.retakeSubmit', ['quiz_id' => $quiz->id, 'course_id' => $quiz->course_id, 'course_module_id' => $quiz->course_module_id]) }}"
                        method="POST">

                        @csrf

                        <div class="accordion mb-5" id="question_accordion">

                            @foreach ($shuffledQuestions as $key => $question)
                                <div class="accordion-item">

                                    <h2 class="accordion-header" id="heading_{{ $key }}">

                                        <button class="accordion-button bg-primary text-light" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapse_{{ $key }}"
                                            aria-expanded="true" aria-controls="collapse_{{ $key }}">

                                            {{ $question['question'] }}

                                        </button>

                                    </h2>

                                    <div id="collapse_{{ $key }}" class="accordion-collapse collapse show"
                                        aria-labelledby="heading_{{ $key }}" data-bs-parent="#question_accordion">

                                        <div class="accordion-body">

                                            @if ($question['type'] == 1)
                                                <div class="form-check">

                                                    <input class="form-check-input" type="radio"
                                                        name="{{ $question['id'] }}" id="option_one_{{ $key }}"
                                                        value="{{ $question['option_one'] }}">

                                                    <label class="form-check-label" for="option_one_{{ $key }}">

                                                        {{ $question['option_one'] }}

                                                    </label>

                                                </div>

                                                <div class="form-check">

                                                    <input class="form-check-input" type="radio"
                                                        name="{{ $question['id'] }}" id="option_two_{{ $key }}"
                                                        value="{{ $question['option_two'] }}">

                                                    <label class="form-check-label" for="option_two_{{ $key }}">

                                                        {{ $question['option_two'] }}

                                                    </label>

                                                </div>

                                                <div class="form-check">

                                                    <input class="form-check-input" type="radio"
                                                        name="{{ $question['id'] }}" id="option_three_{{ $key }}"
                                                        value="{{ $question['option_three'] }}">

                                                    <label class="form-check-label" for="option_three_{{ $key }}">

                                                        {{ $question['option_three'] }}

                                                    </label>

                                                </div>

                                                <div class="form-check">

                                                    <input class="form-check-input" type="radio"
                                                        name="{{ $question['id'] }}" id="option_four_{{ $key }}"
                                                        value="{{ $question['option_four'] }}">

                                                    <label class="form-check-label" for="option_four_{{ $key }}">

                                                        {{ $question['option_four'] }}

                                                    </label>

                                                </div>
                                            @else
                                                <div class="form-group">

                                                    <input class="form-control" type="text" name="{{ $question['id'] }}"
                                                        id="option_fill_in_the_gap_{{ $key }}"
                                                        placeholder="Your answer">

                                                </div>
                                            @endif

                                            <div class="mt-3"><b>Note:</b> {{ $question['note'] }}</div>

                                        </div>

                                    </div>

                                </div>
                            @endforeach

                        </div>

                        <input class="btn btn-primary" type="submit" value="Submit">

                    </form>



                </div>

        </main>

    </div>

@endsection
