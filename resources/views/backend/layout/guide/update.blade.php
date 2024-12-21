@extends('backend.app')

<!-- Start:Title -->
@section('title', 'Update Guide')
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
                        <h2>Update Guide</h2>
                        <a class="bg-transparent" href="{{ route('guide.index') }}">
                            <i class="bi bi-chevron-left"></i> Back to Guide Page
                        </a>
                    </div>
                    <!-- card -->
                    <div class="card mb-4 mx-5">
                        <!-- card body -->
                        <div class="card-body">
                            <form action="{{ route('guide.update') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <!-- Input Item -->
                                    <input type="hidden" value="{{ $guide->id }}" name="id">
                                    <!-- Input Item -->
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label" for="guide_name">Guide Name</label>
                                        <input type="text" name="guide_name" id="guide_name"
                                            class="form-control {{ $errors->has('guide_name') ? 'is-invalid' : '' }}"
                                            value="{{ $guide->guide_name }}">
                                        @if ($errors->has('guide_name'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('guide_name') }}
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
                                                    {{ $guide->category_id == $category['id'] ? 'selected' : '' }}
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
                                    <div class="col-md-4 d-flex flex-column mb-3">
                                        <label class="form-label" for="tags">Tags</label>
                                        <input name='tag' value="{{ $guide->tag }}" id="tags"
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
                                        <label class="form-label" for="guide_description">Guide Description</label>
                                        <textarea name="guide_description" class="form-control {{ $errors->has('guide_description') ? 'is-invalid' : '' }}"
                                            id="guide_description" cols="30" rows="10">{!! $guide->guide_description !!}</textarea>
                                        @if ($errors->has('guide_description'))
                                            <div class="invalid-feedback my-2">
                                                {{ $errors->first('guide_description') }}
                                            </div>
                                        @endif
                                    </div>
                                    <!-- Input Item -->
                                    <div class="col-12 mb-4">
                                        <label class="form-label" for="feature_image">Feature Image</label>
                                        <input type="file"
                                            class="form-control dropify {{ $errors->has('feature_image') ? 'is-invalid' : '' }}"
                                            name="feature_image" id="feature_image"
                                            data-default-file="{{ asset('/' . $guide->feature_image) }}">

                                        @if ($errors->has('feature_image'))
                                            <div class="invalid-feedback my-2 d-block">
                                                {{ $errors->first('feature_image') }}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-info text-white w-auto">Update</button>
                                        <a href="{{ route('guide.index') }}"
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
            .create(document.querySelector('#guide_description'), {
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
