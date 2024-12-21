@extends('frontend.app')
<!-- Title -->
@section('title', 'Quiz')
@push('style')
    <style>
        input {
            margin-left: 0;
        }
    </style>
@endpush

{{-- Main Content --}}
@section('content')
    <div class="faq">
        <div class="container small">
            <div class="techwave_fn_accordion" data-type="accordion">
                <form
                    action="{{ route('course.quiz.submit', ['quiz_id' => $quiz->id, 'course_id' => $quiz->course_id, 'course_module_id' => $quiz->course_module_id]) }}"
                    method="POST">
                    @csrf
                    @foreach ($shuffledQuestions as $key => $question)
                        <!-- #1 accordion item -->
                        <div class="acc__item {{ 0 == $key ? 'opened' : '' }}">
                            <div class="acc__header">
                                <h2 class="acc__title">{{ $question['question'] }}</h2>
                                <div class="acc__icon"></div>
                            </div>
                            <div class="acc__content">
                                @if ($question['type'] == 1)
                                    <div>
                                        <input type="radio" name="{{ $question['id'] }}"
                                            id="option_one_{{ $key }}" value="{{ $question['option_one'] }}">
                                        <label for="option_one_{{ $key }}">
                                            {{ $question['option_one'] }}
                                        </label>
                                    </div>
                                    <div>
                                        <input type="radio" name="{{ $question['id'] }}"
                                            id="option_two_{{ $key }}" value="{{ $question['option_two'] }}">
                                        <label for="option_two_{{ $key }}">
                                            {{ $question['option_two'] }}
                                        </label>
                                    </div>
                                    <div>
                                        <input type="radio" name="{{ $question['id'] }}"
                                            id="option_three_{{ $key }}" value="{{ $question['option_three'] }}">
                                        <label for="option_three_{{ $key }}">
                                            {{ $question['option_three'] }}
                                        </label>
                                    </div>
                                    <div>
                                        <input type="radio" name="{{ $question['id'] }}"
                                            id="option_four_{{ $key }}" value="{{ $question['option_four'] }}">
                                        <label for="option_four_{{ $key }}">
                                            {{ $question['option_four'] }}
                                        </label>
                                    </div>
                                @else
                                    <div class="form-group">
                                        <input class="form-control" type="text" name="{{ $question['id'] }}"
                                            id="option_fill_in_the_gap_{{ $key }}" placeholder="Your answer">
                                    </div>
                                @endif
                                <div style="margin-top: 12px;"><b>Note:</b> {{ $question['note'] }}</div>
                            </div>
                        </div>
                        <!-- !#1 accordion item -->
                    @endforeach
                    <button style="border: none;cursor:pointer;" class="techwave_fn_button" type="submit">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endsection
