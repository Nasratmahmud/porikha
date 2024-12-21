@extends('backend.app')

<!-- Title -->
@section('title', 'Write a furam')

<!-- End:Title -->
@push('style')
    {{-- Dropify Css cdn  --}}
    <link rel="stylesheet" href="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/css/nice-select.css') }} ">
    <link rel="stylesheet" href="{{ asset('frontend/plugins/slick-slider/slick.css') }}">

    {{-- Dropify Css cdn  --}}
    <link rel="stylesheet" href="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css') }}" />

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

        ul.forum-tags li label {
            display: block;
            padding: 6px 20px;
            background: rgba(240, 247, 254, 0.6);
            border: 0.5px solid #e4e4e7;
            border-radius: 4px;
            font-weight: 600;
            color: var(--brand-900) !important;
            transition: all linear 0.2s;
        }

        ul.forum-tags li input {
            display: none;
        }

        ul.forum-tags li input:checked+label {
            background-color: #0963CD;
            color: #fff !important;
        }

        .ck.ck-reset.ck-editor {
            height: 300px !important;
        }

        .ck.ck-content.ck-editor__editable {
            height: 262px !important;
        }
    </style>
@endpush

{{-- Main Content --}}
@section('content')

    <div class="app-content-area">
        <main class="dashboard-content-wrapper">
            <div class="write-journal p-0">
                <div class="write-journal-title">
                    <h2>Write forum post</h2>
                    <a class="bg-transparent" href="{{ route('admin.furam.index') }}">
                        <i class="bi bi-chevron-left"></i> Back to Forum Page
                    </a>
                </div>
                <form action="{{ route('admin.furam.store') }}" method="post" enctype="multipart/form-data"
                    class="shadow-sm">
                    @csrf
                    <div class="mb-4">
                        <label for="post_title" class="form-label">Title</label>
                        <input type="text" class="form-control @error('post_title') is-invalid @enderror"
                            value="{{ old('post_title') }}" id="post_title" placeholder="Type your post title..."
                            name="post_title">
                        @error('post_title')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                    </div>
                    <div class="mb-4">
                        <label for="post_content" class="form-label">Content</label>
                        <textarea class="form-control @error('post_content') is-invalid @enderror" name="post_content"
                            placeholder="Leave a post content here" id="post_content">{{ old('post_content') }}</textarea>
                        @error('post_content')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                    </div>


                    <div class="mb-4">
                        <label for="feature_image" class="form-label">Post Image</label>
                        <input type="file"
                            class="form-control dropify {{ $errors->has('future_image') ? 'is-invalid' : '' }}"
                            name="feature_image" id="feature_image">
                        @error('feature_image')
                            <span class="invalid-feedback d-block" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="write-forum-post-category-wrapper">
                        <label for="category_id" class="form-label">Post Category</label>
                        <div class="btn-slider">
                            <ul class="forum-tags m-0 p-0">
                                @forelse ($categorys as $category)
                                    <li class="forum-tag-item">
                                        <input type="radio" name="category_id" id="{{ $category->category_slug }}"
                                            class="tag-radio"
                                            value="{{ old($category->id) ? old($category->id) : $category->id }}">
                                        <label for="{{ $category->category_slug }}"
                                            class="text-decoration-none tag-label">{{ $category->category_name }}</label>
                                    </li>
                                @empty
                                    <a href="{{ route('category.index') }}" class="btn btn-sm btn-primary"><i
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

                    </div>
                    <div class="col-12 d-flex gap-2 justify-content-end">
                        <input type="submit" class="btn btn-success text-white w-auto"value="Post Now" />
                        <a href="{{ route('admin.furam.index') }}" type="submit"
                            class="btn btn-danger text-white w-auto">Cancel</a>
                    </div>

                </form>

            </div>
        </main>
    </div>

@endsection
{{-- Add Script --}}
@push('script')
    <script src="{{ asset('frontend/js/jquery.nice-select.min.js') }}"></script>
    <script src="{{ asset('frontend/plugins/slick-slider/slick.min.js') }}"></script>

    {{-- Dropify Cdn  --}}
    <script src="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js') }}"></script>
    {{-- Editor Cdn  --}}
    <script src="{{ asset('https://cdn.ckeditor.com/ckeditor5/35.1.0/classic/ckeditor.js') }}"></script>

    <script>
        jQuery(document).ready(function($) {
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
        })
    </script>

    <script>
        //initialized dropify
        $(document).ready(function() {
            $('.dropify').dropify();
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
