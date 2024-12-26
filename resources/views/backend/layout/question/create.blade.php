@extends('backend.app')


@section('title', 'Add New Question')

@push('style')
  
    <link rel="stylesheet"
          href="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css') }}"/>
    
    <link rel="stylesheet"
          href="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css') }}"/>
          
    <style type="text/css">
        
        .dropify-wrapper .dropify-message p {
            font-size: initial;
        }

        
        .ck-editor__editable[role="textbox"] {
            min-height: 150px;
        }
    </style>
@endpush


@section('content')
    <div class="app-content-area">
        <div class="container-fluid">
            
            <div class="row mt-5">
                <div class="col-12">
                    <div class="write-journal-title">
                        <h2>Create a Question</h2>
                        <a class="bg-transparent" href="#">
                        </a>
                    </div>
                    <!-- card -->
                    <div class="card mb-4 mx-5">
                        <!-- card body -->
                        <div class="card-body">
                          
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
                                    <a href="{{ route('questions.create') }}" class="btn btn-danger text-white w-auto">Cancel</a>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    
    <script src="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js') }}"></script>
    <script src="{{ asset('backend/js/form-validation.js') }}"></script>
    
    <script src="{{ asset('https://cdn.ckeditor.com/ckeditor5/35.1.0/classic/ckeditor.js') }}"></script>  
@endpush
<!-- End:Script -->