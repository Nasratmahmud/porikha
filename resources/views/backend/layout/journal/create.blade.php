@extends('backend.app')

<!-- Start:Title -->
@section('title', 'Create New Journal')
<!-- End:Title -->
@push('style')
    {{-- TagInput css cdn  --}}
    <link rel="stylesheet" type="text/css"
        href="{{ asset('https://cdn.jsdelivr.net/bootstrap.tagsinput/0.8.0/bootstrap-tagsinput.css') }}">

    {{-- Dropify Css cdn  --}}
    <link rel="stylesheet" href="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css') }}" />

    {{-- Editor Cdn  --}}
    <script src="{{ asset('https://cdn.ckeditor.com/ckeditor5/35.1.0/classic/ckeditor.js') }}"></script>

    <style>
        .bootstrap-tagsinput {
            padding: 10px;
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
    </style>
@endpush

<!-- Start:Content -->
@section('content')
    <div class="app-content-area">
        <div class="write-journal p-0">
            <div class="write-journal-title">
                <h2>Write Journal post</h2>
                <a class="bg-transparent" href="{{ route('admin.journal.index') }}">
                    <i class="bi bi-chevron-left"></i> Back to Journal Page
                </a>
            </div>
            <form action="{{ route('admin.journal.store') }}" method="post" enctype="multipart/form-data"
                class="shadow-sm">
                @csrf
                <div class="mb-4">
                    <label for="journal_title" class="form-label">Title</label>
                    <input type="text" name="journal_title" value="{{ old('journal_title') }}"
                        class="form-control {{ $errors->has('journal_title') ? 'is-invalid' : '' }}" id="journal_title"
                        placeholder="Type your journal title...">
                    @if ($errors->has('journal_title'))
                        <div class="invalid-feedback">
                            {{ $errors->first('journal_title') }}
                        </div>
                    @endif
                </div>
                <div class="mb-4">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description" cols="30"
                        rows="10" placeholder="Leave a Description here" id="description">{{ old('description') }}</textarea>
                    @if ($errors->has('description'))
                        <div class="invalid-feedback">
                            {{ $errors->first('description') }}
                        </div>
                    @endif
                </div>

                <div class="col-md-12 d-flex flex-column mb-4">
                    <label for="journal-description" class="form-label">Tags</label>
                    <input name='tag' value="{{ old('tag') }}" id="tags"
                        class="form-control {{ $errors->has('tag') ? 'is-invalid' : '' }}" data-role="tagsinput">
                    @if ($errors->has('tag'))
                        <div class="invalid-feedback">
                            {{ $errors->first('tag') }}
                        </div>
                    @endif
                </div>

                <input type="hidden" name="type" id="journal_type">


                <!-- Input Item -->
                <div class="col-md-12 mb-4">
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
                <div class="col-12 d-flex gap-2 justify-content-end">
                    <input type="submit" class="btn btn-success text-white w-auto" id="PublicPost" value="Save" />
                    <a href="{{ route('admin.journal.index') }}" class="btn btn-danger text-white w-auto">Cancel</a>
                </div>
            </form>

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
        $("#PublicPost").on('click', function() {
            $('#journal_type').val(1);
        });



        //initialized editor
        ClassicEditor
            .create(document.querySelector('#description'), {
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
