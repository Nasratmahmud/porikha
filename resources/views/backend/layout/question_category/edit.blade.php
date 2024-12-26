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

            <div class="row mt-5">
                <div class="col-12">
                    <div class="write-journal-title">
                        <h2>Create a Course</h2>
                        <a class="bg-transparent" href="{{ route('question.category.index') }}">
                           
                        </a>
                    </div>

                    <div class="card mb-4 mx-5">

                        <div class="card-body">
                            <form class="needs-validation" novalidate action="{{ route('question.category.update',[ 'id' =>$questionCategory->id]) }}" method="POST"
                                  enctype="multipart/form-data">
                                @csrf
                                @method('patch')

                                <div class="row">

                                    <div class="col-md-6 mb-3">
                                        <label class="form-label" for="question_title">Question Category Name</label>
                                        <input type="text" name="question_title"
                                               class="form-control {{ $errors->has('question_title') ? 'is-invalid' : '' }}"
                                               value="{{ $questionCategory->name }}" required>
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

@push('script')

    <script src="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js') }}"></script>
    <script src="{{ asset('backend/js/form-validation.js') }}"></script>

    <script src="{{ asset('https://cdn.ckeditor.com/ckeditor5/35.1.0/classic/ckeditor.js') }}"></script>

    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

    toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": false,
        "progressBar": true,
        "positionClass": "toast-top-right",  // Custom position
        "preventDuplicates": true,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",  // 5 seconds
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    };

@endpush
<!-- End:Script -->