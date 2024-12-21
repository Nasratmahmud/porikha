@extends('backend.app')

<!-- Start:Title -->
@section('title', 'Add New Question')
<!-- End:Title -->
@push('style')
    {{-- font awesome cdn --}}
    <link rel="stylesheet"
          href="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css') }}"/>
    {{-- Dropify Css cdn --}}
    <link rel="stylesheet"
          href="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css') }}"/>
          <!-- Add these in the <head> section of your layout file -->
    <style type="text/css">
        /* dropify css  */
        .dropify-wrapper .dropify-message p {
            font-size: initial;
        }

        /* editor css  */
        .ck-editor__editable[role="textbox"] {
            min-height: 150px;
        }
    </style>
@endpush

<!-- Start:Content -->
@section('content')
    <div class="app-content-area">
        <div class="container-fluid">
            <!-- row -->
            <div class="row mt-5">
                <div class="col-12">
                    <div class="write-journal-title">
                        <h2>Create a Question</h2>
                        <a class="bg-transparent" href="#">
                            {{-- <i class="bi bi-chevron-left"></i> Back to Course Page --}}
                            {{-- href="{{ route('question.category.index') }} --}}
                        </a>
                    </div>
                    <!-- card -->
                    <div class="card mb-4 mx-5">
                        <!-- card body -->
                        <div class="card-body">
                            {{-- <form class="needs-validation" novalidate action="{{ route('questions.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                            
                                <div class="mb-4">
                                    <p class="text-muted">Fill out the form below to create a new question.</p>
                                </div>
                            
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label class="form-label" for="question_category">Select Question Category</label>
                                        <select name="question_category" class="form-select {{ $errors->has('question_category') ? 'is-invalid' : '' }}" required>
                                            <option value="">Choose a Category</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('question_category'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('question_category') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label class="form-label" for="question_title">Question</label>
                                        <input type="text" name="question_title"
                                            class="form-control {{ $errors->has('question_title') ? 'is-invalid' : '' }}"
                                            value="{{ old('question_title') }}" required>
                                        @if ($errors->has('question_title'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('question_title') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="row mb-3">
                                        <div class="col-md-5">
                                            <label class="form-label" for="option1">Options</label>
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <input type="text" name="option1"
                                                        class="form-control {{ $errors->has('option1') ? 'is-invalid' : '' }}" value="{{ old('option1') }}" placeholder="A" required>
                                                        @if ($errors->has('option1'))
                                                            <div class="invalid-feedback">
                                                                {{ $errors->first('option1') }}
                                                            </div>
                                                        @endif
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <input type="text" name="option2"
                                                        class="form-control {{ $errors->has('option2') ? 'is-invalid' : '' }}" value="{{ old('option2') }}" placeholder="B" required>
                                                        @if ($errors->has('option2'))
                                                            <div class="invalid-feedback">
                                                                {{ $errors->first('option2') }}
                                                            </div>
                                                        @endif
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <input type="text" name="option3"
                                                        class="form-control {{ $errors->has('option3') ? 'is-invalid' : '' }}" value="{{ old('option3') }}" placeholder="C" required>
                                                        @if ($errors->has('option3'))
                                                            <div class="invalid-feedback">
                                                                {{ $errors->first('option3') }}
                                                            </div>
                                                        @endif
                                                </div>
                                            </div>
                                            <div class="row mb-5">
                                                <div class="col-md-6">
                                                    <input type="text" name="option4"
                                                        class="form-control {{ $errors->has('option4') ? 'is-invalid' : '' }}" value="{{ old('option4') }}" placeholder="D" required>
                                                        @if ($errors->has('option4'))
                                                            <div class="invalid-feedback">
                                                                {{ $errors->first('option4') }}
                                                            </div>
                                                        @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="row mb-5">
                                                <label class="form-label" for="option1">Is_Correct</label>
                                                <div class="col-md-6">
                                                    <div class="mt-2">
                                                        <div class="form-check">
                                                            <input class="form-check-input {{ $errors->has('option1Correct') ? 'is-invalid' : '' }}" 
                                                                type="radio" name="option1Correct" value="1" {{ old('option1Correct') == '1' ? 'checked' : '' }} >
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mb-5">
                                                <div class="col-md-6">
                                                    <div class="mt-2">
                                                        <div class="form-check">
                                                            <input class="form-check-input {{ $errors->has('option2Correct') ? 'is-invalid' : '' }}" 
                                                                type="radio" name="option2Correct" value="1" {{ old('option2Correct') == '1' ? 'checked' : '' }} >
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mb-5">
                                                <div class="col-md-6">
                                                    <div class="mt-2">
                                                        <div class="form-check">
                                                            <input class="form-check-input {{ $errors->has('option3Correct') ? 'is-invalid' : '' }}" 
                                                                type="radio" name="option3Correct" value="1" {{ old('option3Correct') == '1' ? 'checked' : '' }} >
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <div class="mt-2">
                                                        <div class="form-check">
                                                            <input class="form-check-input {{ $errors->has('option4Correct') ? 'is-invalid' : '' }}" 
                                                                type="radio" name="option4Correct" value="1" {{ old('option4Correct') == '1' ? 'checked' : '' }} >
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label class="form-label" for="note">Additional Notes</label>
                                        <textarea name="note" class="form-control {{ $errors->has('note') ? 'is-invalid' : '' }}" rows="4" placeholder="Enter any additional notes here..."></textarea>
                                        @if ($errors->has('note'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('note') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            
                                <hr>
                            
                                <div class="col-12 mt-3">
                                    <button type="submit" class="btn btn-success text-white w-auto">Save</button>
                                    <a href="{{ route('questions.create') }}" type="submit"
                                       class="btn btn-danger text-white w-auto">Cancel</a>
                                </div>
                            </form> --}}
                            <form class="needs-validation" novalidate action="{{ route('questions.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                            
                            
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label class="form-label" for="question_category">Select Question Category</label>
                                        <select name="category_id" class="form-select {{ $errors->has('question_category') ? 'is-invalid' : '' }}" required>
                                            <option value="">Choose a Category</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('question_category'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('question_category') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label class="form-label" for="question_title">Question</label>
                                        <input type="text" name="question_title"
                                            class="form-control {{ $errors->has('question_title') ? 'is-invalid' : '' }}"
                                            value="{{ old('question_title') }}" required>
                                        @if ($errors->has('question_title'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('question_title') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-5">
                                        <label class="form-label" for="options">Options</label>
                                        
                                        @foreach (['option1', 'option2', 'option3', 'option4'] as $index => $option)
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <input type="text" name="options[{{ $index }}][option_text]"
                                                           class="form-control {{ $errors->has('options.' . $index . '.option_text') ? 'is-invalid' : '' }}"
                                                           value="{{ old('options.' . $index . '.option_text') }}" placeholder="{{ chr(65 + $index) }}" required>
                                                    @if ($errors->has('options.' . $index . '.option_text'))
                                                        <div class="invalid-feedback">
                                                            {{ $errors->first('options.' . $index . '.option_text') }}
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Is_Correct</label>
                                        @foreach (['option1Correct', 'option2Correct', 'option3Correct', 'option4Correct'] as $index => $correct)
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <div class="mt-2">
                                                        <div class="form-check">
                                                            {{-- <input hidden name="correctes[{{$index}}]"  value="1" type="radio" /> --}}
                                                            <input class="form-check-input {{ $errors->has('correct.' . $index . '.is_correct') ? 'is-invalid' : '' }}"
                                                                   type="radio" name="corrects" value="{{ $index }}">
                                                        </div>
                                                    </div>
                                                    @if ($errors->has('correct.' . $index . '.is_correct'))
                                                        <div class="invalid-feedback">
                                                            {{ $errors->first('correct.' . $index . '.is_correct') }}
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                {{-- Additional Notes --}}
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label class="form-label" for="note">Additional Notes</label>
                                        <textarea name="note" class="form-control {{ $errors->has('note') ? 'is-invalid' : '' }}" rows="4" placeholder="Enter any additional notes here..."></textarea>
                                        @if ($errors->has('note'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('note') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <hr>
                                {{-- Submit & Cancel Buttons --}}
                                <div class="col-12 mt-3">
                                    <button type="submit" class="btn btn-success text-white w-auto">Save</button>
                                    <a href="{{ route('questions.create') }}" class="btn btn-danger text-white w-auto">Cancel</a>
                                </div>
                            </form>
                            
                            
                            {{-- <form class="needs-validation" novalidate action="{{ route('questions.store') }}" method="POST"
                                  enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="mb-3">
                                        <div class="col-md-6">
                                            <label class="form-label" for="question_category">Select Question Category</label>
                                            <select name="question_category" class="form-select {{ $errors->has('question_category') ? 'is-invalid' : '' }}" required>
                                                <option value="1">Choose a Category</option>
                                                @foreach ($categories as $category)
                                                <option value="{{$category->id}}">{{ $category->name}}</option>
                                                @endforeach
                                                
                                            </select>
                                            @if ($errors->has('question_category'))
                                                <div class="invalid-feedback">
                                                    {{ $errors->first('question_category') }}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <!-- Input Item -->
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label" for="question_title">Question</label>
                                        <input type="text" name="question_title"
                                               class="form-control {{ $errors->has('question_title') ? 'is-invalid' : '' }}"
                                               value="{{ old('question_title') }}" required>
                                        @if ($errors->has('question_title'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('question_title') }}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="col-md-6 mb-3 ">
                                        <div class="row">
                                           <div class="col-md-6 ">
                                            <label class="form-label" for="question_title">Option 1</label>
                                                <input type="text" name="option1" class="form-control {{ $errors->has('option1') ? 'is-invalid' : '' }}"
                                                value="{{ old('option1') }}" required>
                                                @if ($errors->has('option1'))
                                                    <div class="invalid-feedback">
                                                        {{ $errors->first('option1') }}
                                                    </div>
                                                @endif
                                           </div>
                                           <div class="col-md-6 ">
                                            <label class="form-label" for="question_title">Option 2</label>
                                                <input type="text" name="option2" class="form-control {{ $errors->has('option2') ? 'is-invalid' : '' }}"
                                                value="{{ old('option2') }}" required>
                                                @if ($errors->has('option2'))
                                                    <div class="invalid-feedback">
                                                        {{ $errors->first('option1') }}
                                                    </div>
                                                @endif
                                           </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3 ">
                                        <div class="row">
                                           <div class="col-md-6 ">
                                            <label class="form-label" for="question_title">Option 1</label>
                                                <input type="text" name="option1" class="form-control {{ $errors->has('option1') ? 'is-invalid' : '' }}"
                                                value="{{ old('option1') }}" required>
                                                @if ($errors->has('option1'))
                                                    <div class="invalid-feedback">
                                                        {{ $errors->first('option1') }}
                                                    </div>
                                                @endif
                                           </div>
                                           <div class="col-md-6 ">
                                            <label class="form-label" for="question_title">Option 2</label>
                                                <input type="text" name="option2" class="form-control {{ $errors->has('option2') ? 'is-invalid' : '' }}"
                                                value="{{ old('option2') }}" required>
                                                @if ($errors->has('option2'))
                                                    <div class="invalid-feedback">
                                                        {{ $errors->first('option1') }}
                                                    </div>
                                                @endif
                                           </div>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <div class="col-md-6">
                                            <label class="form-label" for="note">Additional Notes</label>
                                            <textarea name="note" class="form-control {{ $errors->has('note') ? 'is-invalid' : '' }}" rows="4" placeholder="Enter any additional notes here..."></textarea>
                                            @if ($errors->has('note'))
                                                <div class="invalid-feedback">
                                                    {{ $errors->first('note') }}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="col-12 mt-3">
                                    <button type="submit" class="btn btn-success text-white w-auto">Save</button>
                                    <a href="{{ route('questions.create') }}" type="submit"
                                       class="btn btn-danger text-white w-auto">Cancel</a>
                                </div>
                            </form> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
<!-- Start:Script -->
@push('script')
    {{-- Dropify Cdn --}}
    <script src="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js') }}"></script>
    <script src="{{ asset('backend/js/form-validation.js') }}"></script>
    {{-- Editor Cdn  --}}
    <script src="{{ asset('https://cdn.ckeditor.com/ckeditor5/35.1.0/classic/ckeditor.js') }}"></script>  
@endpush
<!-- End:Script -->