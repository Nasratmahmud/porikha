@extends('frontend.app')



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
            background: #0b75f1;
            color: #fff;
        }

        .bootstrap-tagsinput {
            background-color: transparent;
        }

        /* dropify css  */
        .dropify-wrapper .dropify-message p {
            font-size: initial;
        }

        .invalid-feedback {
            color: #dc3545;
        }

        .bootstrap-tagsinput {
            width: 100%;
        }

        .input_list ul li {
            margin-bottom: 20px !important;
        }

        .ck.ck-editor__main>.ck-editor__editable {
            background: transparent;
        }

        .dropify-wrapper {
            background-color: transparent;
        }

        .w-journal-btn button {
            font-size: 18px;
            padding: 8px 20px;
            border-radius: 10px;
            overflow: hidden;
            border: none;
        }

        .w-journal-btn button a {
            text-decoration: none;
        }

        .bg-danger {
            background-color: #dc3545;
        }

        .text-white {
            color: white !important;
        }

        .btn-primary {
            background-color: #7c5fe3;
        }

        .container {
            padding: 0;
            margin-bottom: 69px;
        }
    </style>
@endpush



<!-- Start:Content -->

@section('content')


    <!-- Dashboard :: -> Start -->
    <div class="techwave_fn_changelog_page">
        <div class="techwave_fn_models">
            <div class="techwave_fn_pagetitle">
                <h2 class="title">Write A Journal</h2>
            </div>


            <div class="container">
                <div class="write-journal">
                    <div class="fn_contact_form" style="margin: 50px 0">
                        <form action="{{ route('journal.store') }}" method="post" enctype="multipart/form-data"
                            class="contact_form" id="contact_form" autocomplete="off">
                            @csrf
                            <div class="input_list">
                                <ul>
                                    <li>
                                        <span>Title*</span><br>
                                        <input id="journal_title" name="journal_title" type="text"
                                            placeholder="Journal Title *" value="{{ old('journal_title') }}">
                                        @if ($errors->has('journal_title'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('journal_title') }}
                                            </div>
                                        @endif
                                    </li>
                                    <li>
                                        <span>Description*</span><br>
                                        <textarea id="description" name="description" placeholder="Description *">
                                            {{ old('description') }}
                                        </textarea>
                                        @if ($errors->has('description'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('description') }}
                                            </div>
                                        @endif
                                    </li>
                                    <li>
                                        <span>Tags*</span><br>
                                        <input name='tag' value="{{ old('tag') }}" id="tags"
                                            class="{{ $errors->has('tag') ? 'is-invalid' : '' }}" data-role="tagsinput">
                                        @if ($errors->has('tag'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('tag') }}
                                            </div>
                                        @endif
                                    </li>
                                    <input type="hidden" name="type" id="journal_type">

                                    <li>
                                        <span class="form-label" for="feature_image">Feature Image</span>
                                        <input type="file"
                                            class="form-control dropify {{ $errors->has('feature_image') ? 'is-invalid' : '' }}"
                                            name="feature_image"
                                            data-default-file="{{ asset('frontend/img/models/1.jpg') }}"
                                            id="feature_image">
                                        @if ($errors->has('feature_image'))
                                            <div class="invalid-feedback my-2 d-block">
                                                {{ $errors->first('feature_image') }}
                                            </div>
                                        @endif
                                    </li>

                                    <li>
                                        <div class="w-journal-btn">
                                            <button class="bg-danger" type="button"><a class="text-white"
                                                    href="{{ route('journal.index') }}">Cancel</a></button>
                                            <button type="submit" class="" id="PrivatePost">Post As Private</button>
                                            <button type="submit" class="btn-primary" id="PublicPost">Post As
                                                Public</button>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </form>
                    </div>



                </div>
            </div>
        </div>
    </div>
    <!-- Dashboard :: -> End -->

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

        $("#PrivatePost").on('click', function() {
            $('#journal_type').val(2);
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
