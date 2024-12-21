@extends('backend.app')

<!-- Start:Title -->
@section('title', 'Create a Job Post')
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
                        <h2>Create a Job Post</h2>
                        <a class="bg-transparent" href="{{ route('job.post.user') }}">
                            <i class="bi bi-chevron-left"></i> Back to Job Post Page
                        </a>
                    </div>
                    <!-- card -->
                    <div class="card mb-4 mx-5">
                        <!-- card body -->
                        <div class="card-body">
                            <form action="{{ route('job.post.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label" for="title">Title</label>
                                        <input type="text" name="title" id="title" placeholder="Job Title"
                                            class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}"
                                            value="{{ old('title') }}">
                                        @if ($errors->has('title'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('title') }}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label" for="deadline">Deadline</label>
                                        <input type="date" name="deadline" id="deadline"
                                            class="form-control {{ $errors->has('deadline') ? 'is-invalid' : '' }}"
                                            value="{{ old('deadline') }}">
                                        @if ($errors->has('deadline'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('deadline') }}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label" for="vacancy">Vacancy</label>
                                        <input type="number" name="vacancy" id="vacancy" placeholder="Number Of Vacancy"
                                            class="form-control {{ $errors->has('vacancy') ? 'is-invalid' : '' }}"
                                            value="{{ old('vacancy') }}">
                                        @if ($errors->has('vacancy'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('vacancy') }}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label" for="position">Position</label>
                                        <input type="text" name="position" id="position" placeholder="Position"
                                            class="form-control {{ $errors->has('position') ? 'is-invalid' : '' }}"
                                            value="{{ old('position') }}">
                                        @if ($errors->has('position'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('position') }}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label" for="selary_range">Salary Range</label>
                                        <input type="text" name="selary_range" id="selary_range"
                                            placeholder="20,000 - 30,000"
                                            class="form-control {{ $errors->has('selary_range') ? 'is-invalid' : '' }}"
                                            value="{{ old('selary_range') }}">
                                        @if ($errors->has('selary_range'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('selary_range') }}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label" for="type">Type</label>
                                        <select name="type" id=""
                                            class="form-select {{ $errors->has('type') ? 'is-invalid' : '' }}"
                                            value="{{ old('type') }}">
                                            <option value="1" selected>Full Time</option>
                                            <option value="2">Part-time</option>
                                            <option value="3">Contract</option>
                                            <option value="4">Internships</option>
                                            <option value="5">Temporary</option>
                                            <option value="6">Remote</option>
                                        </select>
                                        @if ($errors->has('type'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('type') }}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="col-12 my-4">
                                        <label class="form-label" for="short_description">Short Discription</label>
                                        <textarea name="short_description" placeholder="Short Description"
                                            class="form-control {{ $errors->has('short_description') ? 'is-invalid' : '' }}" id="short_description" cols="30"
                                            rows="5">{{ old('short_description') }}</textarea>
                                        @if ($errors->has('short_description'))
                                            <div class="invalid-feedback my-2">
                                                {{ $errors->first('short_description') }}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="col-12 my-4">
                                        <label class="form-label" for="description">Job Description</label>
                                        <textarea name="description" placeholder="Job Description"
                                            class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" id="description" cols="30"
                                            rows="10">{{ old('description') }}</textarea>
                                        @if ($errors->has('description'))
                                            <div class="invalid-feedback my-2">
                                                {{ $errors->first('description') }}
                                            </div>
                                        @endif
                                    </div>
                                    <h3 class="mt-4">
                                        Company Imformation
                                    </h3>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label" for="institute_name">Institute Name</label>
                                        <input type="text" name="institute_name" id="institute_name"
                                            placeholder="Institute Name"
                                            class="form-control {{ $errors->has('institute_name') ? 'is-invalid' : '' }}"
                                            value="{{ old('institute_name') }}">
                                        @if ($errors->has('institute_name'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('institute_name') }}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label" for="address">Address</label>
                                        <input type="text" name="address" id="address" placeholder="Address"
                                            class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}"
                                            value="{{ old('address') }}">
                                        @if ($errors->has('address'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('address') }}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label" for="website">Website</label>
                                        <input type="text" name="website" id="website" placeholder="website"
                                            class="form-control {{ $errors->has('website') ? 'is-invalid' : '' }}"
                                            value="{{ old('website') }}">
                                        @if ($errors->has('website'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('website') }}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="col-12 mb-4">
                                        <label class="form-label" for="logo">Company logo</label>
                                        <input type="file"
                                            class="form-control dropify {{ $errors->has('logo') ? 'is-invalid' : '' }}"
                                            name="logo" id="logo">

                                        @if ($errors->has('logo'))
                                            <div class="invalid-feedback my-2 d-block">
                                                {{ $errors->first('logo') }}
                                            </div>
                                        @endif
                                    </div>

                                    <div class="col-12 my-4">
                                        <label class="form-label" for="about">Company About</label>
                                        <textarea name="about" placeholder="Company About"
                                            class="form-control {{ $errors->has('about') ? 'is-invalid' : '' }}" id="about" cols="30"
                                            rows="10">{{ old('about') }}</textarea>
                                        @if ($errors->has('about'))
                                            <div class="invalid-feedback my-2">
                                                {{ $errors->first('about') }}
                                            </div>
                                        @endif
                                    </div>

                                    <div class="col-12 mb-4">
                                        <button class="btn btn-info px-5" onclick="addItem()" type="button">Add
                                            Facilities <i class="bi bi-patch-plus"></i></button>
                                    </div>


                                    <div id="facilitiesWrapper" class="row mb-5">
                                        <label for="">Facilities</label>

                                        @if ($errors->has('facilities'))
                                            <div class="invalid-feedback my-2 d-block">
                                                {{ $errors->first('facilities') }}
                                            </div>
                                        @endif
                                    </div>

                                    <div class="col-12">
                                        <button type="submit" class="btn btn-success text-white w-auto">Save</button>
                                        <a href="{{ route('job.post.user') }}" type="submit"
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
            .create(document.querySelector('#description'), {
                removePlugins: ['CKFinderUploadAdapter', 'CKFinder', 'EasyImage', 'Image', 'ImageCaption', 'ImageStyle',
                    'ImageToolbar', 'ImageUpload', 'MediaEmbed'
                ],
            })
            .catch(error => {
                console.error(error);
            });

        //initialized editor
        ClassicEditor
            .create(document.querySelector('#about'), {
                removePlugins: ['CKFinderUploadAdapter', 'CKFinder', 'EasyImage', 'Image', 'ImageCaption', 'ImageStyle',
                    'ImageToolbar', 'ImageUpload', 'MediaEmbed'
                ],
            })
            .catch(error => {
                console.error(error);
            });

        function addItem() {
            $('#facilitiesWrapper').append(`<div class="col-md-4 mb-3">
                                            <input type="text" name="facilities[]" id="facilities" placeholder="Facility"
                                                class="form-control">
                                        </div>`)
        }
    </script>
@endpush
<!-- End:Script -->
