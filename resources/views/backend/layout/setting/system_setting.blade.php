@extends('backend.app')

<!-- Start:Title -->
@section('title', 'System Setting')
<!-- End:Title -->

@push('style')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css"
        integrity="sha512-EZSUkJWTjzDlspOoPSpUFR0o0Xy7jdzW//6qhUkoZ9c4StFkVsp9fbbd0O06p9ELS3H486m4wmrCELjza4JEog=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        .dropify-wrapper .dropify-message p {
            font-size: initial;
        }

        .ck-editor__editable[role="textbox"] {
            min-height: 150px;
        }
    </style>
@endpush



<!-- Start:Content -->
@section('content')
    <div class="app-content-area">
        <div class="container-fluid">
            <div class="row mx-2">
                <div class="col-lg-12 col-md-12 col-12">
                    <!-- Page header -->
                    <div class="mb-5">
                        <h3 class="mb-0 ">System Setting</h3>
                        <a class="bg-transparent" href="{{ route('home') }}">
                            <i class="bi bi-chevron-left"></i> Back to Dashboard
                        </a>
                    </div>
                </div>
            </div>
            <!-- row -->
            <div class="row mx-2">
                <div class="col-lg-12 col-12">
                    <!-- card -->
                    <div class="card mb-4">
                        <!-- card body -->
                        <div class="card-body">

                            <form action="{{ route('setting.update') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <!-- Title input -->
                                    <div class="mb-3">
                                        <label class="form-label">Title</label>
                                        <input type="text" name="title" id="title" class="form-control"
                                            value="{{ empty($setting->title) ? 'Accounting System' : $setting->title }}">
                                        @error('title')
                                            <span class="text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <!-- Title logo -->
                                    <div class="col-12 col-md-12 col-lg-6 mb-3">
                                        <label class="form-label">Logo (Only image are allowed)</label>
                                        @if (empty($setting->logo))
                                            <input type="file" class="form-control dropify"
                                                data-default-file="{{ asset('uploads/setting/default/logo.png') }}"
                                                name="logo" id="logo">
                                        @else
                                            <input type="file" class="form-control dropify"
                                                data-default-file="{{ asset('/' . $setting->logo) }}" name="logo"
                                                id="logo">
                                        @endif

                                        @error('logo')
                                            <span class="text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <!-- Title Favicon -->
                                    <div class="col-12 col-md-12 col-lg-6 mb-3">
                                        <label class="form-label">Favicon (Only image are allowed, size: 33 x 33)</label>
                                        @if (empty($setting->favicon))
                                            <input type="file" class="form-control dropify"
                                                data-default-file="{{ asset('uploads/setting/favicon.png') }}"
                                                name="favicon" id="favicon">
                                        @else
                                            <input type="file" class="form-control dropify"
                                                data-default-file="{{ asset('/' . $setting->favicon) }}" name="favicon"
                                                id="favicon">
                                        @endif

                                        @error('favicon')
                                            <span class="text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <!-- Title Address -->
                                    <div class="mb-3">
                                        <label class="form-label">Address</label>
                                        <input type="text" name="address" id="address" class="form-control"
                                            value="{{ empty($setting->address) ? '26985 Brighton Lane, Lake Forest, CA 92630' : $setting->address }}">
                                        @error('address')
                                            <span class="text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <!-- Title Description -->
                                    <div class="mb-3">
                                        <label class="form-label">Description</label>
                                        <textarea name="description" class="form-control" id="description" cols="30" rows="10">
                                               @if (empty($setting->description))
Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.
@else
{{ $setting->description }}
@endif
                                           </textarea>
                                        @error('description')
                                            <span class="text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <button type="submit" class="btn btn-success text-white w-auto">
                                            Update
                                        </button>
                                        <a href="{{ route('home') }}" type="submit"
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
<!-- End:Content -->

<!-- Start:Script -->
@push('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"
        integrity="sha512-8QFTrG0oeOiyWo/VM9Y8kgxdlCryqhIxVeRpWSezdRRAvarxVtwLnGroJgnVW9/XBRduxO/z1GblzPrMQoeuew=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="https://cdn.ckeditor.com/ckeditor5/35.1.0/classic/ckeditor.js"></script>

    <script>
        $(document).ready(function() {
            $('.dropify').dropify();
        });

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
