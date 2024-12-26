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
                        <a class="bg-transparent" href="{{ route('question.category.index') }}">
                            
                        </a>
                    </div>
                    <!-- card -->
                    <div class="card mb-4 mx-5">
                        <div class="card-body">
                            <form class="needs-validation" novalidate action="{{ route('question.category.store') }}" method="POST"
                                  enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <!-- Input Item -->
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label" for="question_title">Question Category Name</label>
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
                                <hr>
                                <div class="col-12 mt-3">
                                    <button type="submit" class="btn btn-success text-white w-auto">Save</button>
                                    <a href="{{ route('question.category.index') }}" type="submit"
                                       class="btn btn-danger text-white w-auto">Cancel</a>
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

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

    <script>
        toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": false,
        "progressBar": true,
        "positionClass": "toast-top-right", 
        "preventDuplicates": true,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",  
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    };
    </script>
@endpush
<!-- End:Script -->