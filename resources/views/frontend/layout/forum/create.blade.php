@extends('frontend.app')



<!-- Start:Title -->

@section('title', 'Create Forum Post')

<!-- End:Title -->

@push('style')
    {{-- Dropify Css cdn  --}}
    <link rel="stylesheet" href="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/css/nice-select.css') }} ">
    <link rel="stylesheet" href="{{ asset('frontend/css/slick.css') }}">

    <!-- Option 1: Include in HTML -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">

    {{-- Dropify Css cdn  --}}
    <link rel="stylesheet" href="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css') }}" />

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
            background: transparent !important;
            color: white;
        }

        .dropify-wrapper {
            background-color: transparent !important;
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

        ul.forum-tags li label {
            display: block;
            padding: 6px 20px;
            background: transparent;
            border: 0.5px solid #7c5fe3;
            border-radius: 4px;
            font-weight: 600;
            color: rgb(231, 231, 231) !important;
            transition: all linear 0.2s;
        }

        ul.forum-tags li input {
            display: none !important;
        }

        ul.forum-tags li input:checked+label {
            background-color: #7c5fe3;
            color: #fff !important;
        }

        .forum-tags{
            display: flex;
            align-items: center;
        }
    </style>
@endpush



<!-- Start:Content -->

@section('content')
    <!-- Dashboard :: -> Start -->
    <div class="techwave_fn_changelog_page">
        <div class="techwave_fn_models">
            <div class="techwave_fn_pagetitle">
                <h2 class="title">Write A Forum Post</h2>
            </div>

            <div class="container">
                <div class="write-journal">
                    <div class="fn_contact_form" style="margin: 50px 0">
                        <form action="{{ route('forum_post.store') }}" method="post" enctype="multipart/form-data"
                            class="contact_form" id="contact_form" autocomplete="off">
                            @csrf
                            <div class="input_list">
                                <ul>
                                    <li>
                                        <span>Title*</span><br>
                                        <input id="post_title" name="post_title" type="text" placeholder="Forum Title *"
                                            value="{{ old('post_title') }}">
                                        @if ($errors->has('post_title'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('post_title') }}
                                            </div>
                                        @endif
                                    </li>
                                    <li>
                                        <span>Post Content*</span><br>
                                        <textarea id="post_content" name="post_content" placeholder="Post Content *">
                                            {{ old('post_content') }}
                                        </textarea>
                                        @if ($errors->has('post_content'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('post_content') }}
                                            </div>
                                        @endif
                                    </li>
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
                                        <label for="category_id" class="form-label">Post Category</label>
                                        <div class="btn-slider">
                                            <ul class="forum-tags m-0 p-0">
                                                @forelse ($categorys as $category)
                                                    <li class="forum-tag-item" style="width: auto !important;">
                                                        <div class="slik--item">
                                                            <input type="radio" name="category_id"
                                                                id="{{ $category->category_slug }}" class="tag-radio"
                                                                value="{{ old($category->id) ? old($category->id) : $category->id }}">
                                                            <label for="{{ $category->category_slug }}"
                                                                class="text-decoration-none tag-label">{{ $category->category_name }}</label>
                                                        </div>
                                                    </li>
                                                @empty
                                                    <a href="{{ route('category.index') }}"
                                                        class="btn btn-sm btn-primary"><i
                                                            class="bi bi-plus-circle-dotted"></i> Add
                                                        Category</a>
                                                @endforelse
                                            </ul>
                                            @error('category_id')
                                                <span class="invalid-feedback d-block" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror

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
    <script src="{{ asset('frontend/js/jquery.nice-select.min.js') }}"></script>
    <script src="{{ asset('frontend/js/slick.min.js') }}"></script>
    {{-- Dropify Cdn  --}}
    <script src="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js') }}"></script>
    {{-- Editor Cdn  --}}
    <script src="{{ asset('https://cdn.ckeditor.com/ckeditor5/35.1.0/classic/ckeditor.js') }}"></script>

    <script>
        //initialized dropify
        $(document).ready(function() {
            $('.dropify').dropify();

            $('.forum-tags').slick({
                slidesToShow: 3,
                slidesToScroll: 1,
                dots: false,
                nextArrow: '<i class="bi bi-chevron-right tag-slide-btn tag-slide-btn-left"></i>',
                prevArrow: '<i class="bi bi-chevron-left tag-slide-btn tag-slide-btn-right"></i>',
                variableWidth: true,
                infinite: false,
                speed: 300,
                adaptiveHeight: true
            });
        });
        //initialized editor
        ClassicEditor
            .create(document.querySelector('#post_content'), {
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
