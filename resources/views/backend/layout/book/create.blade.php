@extends('backend.app')

<!-- Start:Title -->
@section('title', 'Add New Book')
<!-- End:Title -->
@push('style')
    {{-- TagInput css cdn  --}}
    <link rel="stylesheet" type="text/css"
        href="{{ asset('https://cdn.jsdelivr.net/bootstrap.tagsinput/0.8.0/bootstrap-tagsinput.css') }}">
    {{-- Dropify Css cdn  --}}
    <link rel="stylesheet" href="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css') }}" />
    <style type="text/css">
        /* tag input css  */
        .bootstrap-tagsinput {
            padding: 8px;
        }

        .bootstrap-tagsinput .tag {
            padding: .3rem;
            border-radius: 5px;
            background: #624bff;
            color: #fff;
        }

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
                        <h2>Create a Book</h2>
                        <a class="bg-transparent" href="{{ route('book.index') }}">
                            <i class="bi bi-chevron-left"></i> Back to Book Page
                        </a>
                    </div>
                    <!-- card -->
                    <div class="card mb-4 mx-5">
                        <!-- card body -->
                        <div class="card-body">
                            <form action="{{ route('book.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <!-- Input Item -->
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label" for="book_name">Book Name</label>
                                        <input type="text" name="book_name" id="book_name"
                                            class="form-control {{ $errors->has('book_name') ? 'is-invalid' : '' }}"
                                            value="{{ old('book_name') }}">
                                        @if ($errors->has('book_name'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('book_name') }}
                                            </div>
                                        @endif
                                    </div>
                                    <!-- Input Item -->
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label" for="book_author">Book Author</label>
                                        <input type="text" name="book_author" id="book_author"
                                            class="form-control {{ $errors->has('book_author') ? 'is-invalid' : '' }}"
                                            value="{{ old('book_author') }}">
                                        @if ($errors->has('book_author'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('book_author') }}
                                            </div>
                                        @endif
                                    </div>
                                    <!-- Input Item -->
                                    <div class="col-md-4 mb-3">
                                        <label for="category_id" class="form-label">Category</label>
                                        <select
                                            class="form-select text-capitalize {{ $errors->has('category_id') ? 'is-invalid' : '' }}"
                                            id="category_id" required="" name="category_id">
                                            <option selected disabled>Choose...</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category['id'] }}"
                                                    {{ old('category_id') == $category['id'] ? 'selected' : '' }}
                                                    class="text-capitalize">
                                                    {{ $category['category_name'] }}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('category_id'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('category_id') }}
                                            </div>
                                        @endif
                                    </div>
                                    <!-- Input Item -->
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label" for="publish_date">Publish Date</label>
                                        <input type="date" name="publish_date" id="publish_date"
                                            class="form-control {{ $errors->has('publish_date') ? 'is-invalid' : '' }}"
                                            value="{{ old('publish_date') }}">
                                        @if ($errors->has('publish_date'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('publish_date') }}
                                            </div>
                                        @endif
                                    </div>
                                    <!-- Input Item -->
                                    <div class="col-md-4 d-flex flex-column mb-3">
                                        <label class="form-label" for="tags">Tags</label>
                                        <input name='tag' value="{{ old('tag') }}" id="tags"
                                            class="form-control {{ $errors->has('tag') ? 'is-invalid' : '' }}"
                                            data-role="tagsinput">
                                        @if ($errors->has('tag'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('tag') }}
                                            </div>
                                        @endif
                                    </div>
                                    <!-- Input Item -->
                                    <div class="col-12 my-4">
                                        <label class="form-label" for="book_summary">Book Summary</label>
                                        <textarea name="book_summary" class="form-control {{ $errors->has('book_summary') ? 'is-invalid' : '' }}"
                                            id="book_summary" cols="30" rows="10">{{ old('book_summary') }}</textarea>
                                        @if ($errors->has('book_summary'))
                                            <div class="invalid-feedback my-2">
                                                {{ $errors->first('book_summary') }}
                                            </div>
                                        @endif
                                    </div>
                                    <!-- Input Item -->
                                    <div class="col-md-6 mb-4">
                                        <label class="form-label" for="feature_image">Feature Image</label>
                                        <input type="file"
                                            class="form-control dropify {{ $errors->has('feature_image') ? 'is-invalid' : '' }}"
                                            name="feature_image" id="feature_image">

                                        @if ($errors->has('feature_image'))
                                            <div class="invalid-feedback my-2 d-block">
                                                {{ $errors->first('feature_image') }}
                                            </div>
                                        @endif
                                    </div>
                                    <!-- Input Item -->
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label" for="file">File</label>
                                        <input type="file" name="file" id="file"
                                            class="form-control {{ $errors->has('file') ? 'is-invalid' : '' }}">
                                        @if ($errors->has('file'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('file') }}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-success text-white w-auto">Save</button>
                                        <a href="{{ route('book.index') }}"
                                            class="btn btn-danger text-white w-auto">Cancel</a>
                                    </div>
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
    {{-- TagInput cdn  --}}
    <script src="{{ asset('https://cdn.jsdelivr.net/bootstrap.tagsinput/0.8.0/bootstrap-tagsinput.min.js') }}"></script>
    {{-- Dropify Cdn  --}}
    <script src="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js') }}"></script>
    {{-- Editor Cdn  --}}
    <script src="{{ asset('https://cdn.ckeditor.com/ckeditor5/35.1.0/classic/ckeditor.js') }}"></script>
    <script>
        //initialized dropify
        $(document).ready(function() {
            $('.dropify').dropify();
        });
        //initialized editor
        ClassicEditor
            .create(document.querySelector('#book_summary'), {
                removePlugins: ['CKFinderUploadAdapter', 'CKFinder', 'EasyImage', 'Image', 'ImageCaption', 'ImageStyle',
                    'ImageToolbar', 'ImageUpload', 'MediaEmbed'
                ],
            })
            .catch(error => {
                console.error(error);
            });
    </script>
@endpush
<!-- End:Script -->
