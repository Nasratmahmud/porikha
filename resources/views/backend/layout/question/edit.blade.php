@extends('backend.app')


@section('title', 'Add New Question')

@push('style')
   
    <link rel="stylesheet"
          href="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css') }}"/>
    
    <link rel="stylesheet"
          href="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css') }}"/>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
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
            <!-- row -->
            <div class="row mt-5">
                <div class="col-12">
                    <div class="write-journal-title">
                        <h2>Create a Course</h2>
                        <a class="bg-transparent" href="{{ route('questions.index') }}">
                        </a>
                    </div>
                    
                    <div class="card mb-4 mx-5">
                        <!-- card body -->
                        <div class="card-body">
                        
                            <form method="POST" action="{{ route('questions.update', $question->id) }}">
                                @csrf
                              
                        
                                <div class="form-group col-md-6  mb-3">
                                    <label for="category_id" class="form-label">Category</label>
                                    <select name="category_id" id="category_id" class="form-control @error('category_id') is-invalid @enderror">
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}" {{ $category->id == $question->category_id ? 'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                        
                                <div class="form-group col-md-6  mb-3">
                                    <label for="question_title" class="form-label">Question</label>
                                    <input type="text" name="question_title" id="question_title" class="form-control @error('question_title') is-invalid @enderror" value="{{ old('question_title', $question->question_text) }}">
                                    @error('question_title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                        
                                <div class="form-group  col-md-6 mb-3 ">
                                    <label class="col-md-9 form-label">Options</label>
                                    
                                    <div class="options-container">
                                        @foreach ($question->options as $index => $option)
                                            <div class="option d-flex align-items-center mb-3 col-md-11">
                                               
                                                <input type="text" 
                                                       name="options[{{ $index }}][option_text]" 
                                                       value="{{ $option->option_text }}" 
                                                       class="form-control @error('options.' . $index . '.option_text') is-invalid @enderror" 
                                                       required
                                                       style="flex: 1;">
                                                
                                                <input type="hidden" name="options[{{ $index }}][id]" value="{{ $option->id }}">
                                               
                                                <div class="form-check ml-3 m-3 ">
                                                    <input type="radio" 
                                                           name="corrects" 
                                                           value="{{ $index }}" 
                                                           {{ $option->is_correct ? 'checked' : '' }} 
                                                           class="form-check-input">
                                                </div>
                                    
                                                @error('options.' . $index . '.option_text')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        @endforeach
                                    </div>
                                    
                                    
                                </div>
                                <div class="form-group col-md-6  mb-3">
                                    <label for="note" class="form-label">Note</label>
                                    <textarea name="note" id="note" class="form-control @error('note') is-invalid @enderror">{{ old('note', $question->note) }}</textarea>
                                    @error('note')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                        
                                <div class="col-12 mt-3">
                                    <button type="submit" class="btn btn-success text-white w-auto">Update</button>
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
<!-- Start:Script -->
@push('script')
    {{-- Dropify Cdn --}}
    <script src="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js') }}"></script>
    <script src="{{ asset('backend/js/form-validation.js') }}"></script>
    {{-- Editor Cdn  --}}
    <script src="{{ asset('https://cdn.ckeditor.com/ckeditor5/35.1.0/classic/ckeditor.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
@endpush