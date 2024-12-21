@extends('backend.app')

<!-- Start:Title -->
@section('title', 'View Job Post Details')
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
                        <h2>Edit Job Post</h2>
                        <a class="bg-transparent" href="{{ route('job.post.user') }}">
                            <i class="bi bi-chevron-left"></i> Back to Job Post Page
                        </a>
                    </div>
                    <!-- card -->
                    <div class="card mb-4 mx-5">
                        <!-- card body -->
                        <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label" for="title">Title</label>
                                        <input type="text" name="title" id="title" placeholder="Job Title"
                                            class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}"
                                            value="{{ $jobpost->title }}" readonly>
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
                                            value="{{ $jobpost->deadline }}" readonly>
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
                                            value="{{ $jobpost->vacancy }}" readonly>
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
                                            value="{{ $jobpost->position }}" readonly>
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
                                            value="{{ $jobpost->selary_range }}" readonly>
                                        @if ($errors->has('selary_range'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('selary_range') }}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label" for="type">Type</label>
                                        <select name="type" id=""
                                            class="form-select {{ $errors->has('type') ? 'is-invalid' : '' }}" >
                                            <option value="1" {{ $jobpost->type == 1 ? 'selected' : ''}} >Full Time</option>
                                            <option value="2" {{ $jobpost->type == 2 ? 'selected' : ''}}>Part-time</option>
                                            <option value="3" {{ $jobpost->type == 3 ? 'selected' : ''}}>Contract</option>
                                            <option value="4"  {{ $jobpost->type == 4 ? 'selected' : ''}}>Internships</option>
                                            <option value="5" {{ $jobpost->type == 5 ? 'selected' : ''}}>Temporary</option>
                                            <option value="6" {{ $jobpost->type == 6 ? 'selected' : ''}}>Remote</option>
                                        </select>
                                        @if ($errors->has('type'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('type') }}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="col-12 my-4">
                                        <label class="form-label" for="short_description">Short Discription</label>
                                        <textarea readonly name="short_description" placeholder="Short Description"
                                            class="form-control {{ $errors->has('short_description') ? 'is-invalid' : '' }}" id="short_description" cols="30"
                                            rows="5">{{ $jobpost->short_description }}</textarea>
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
                                            rows="10" readonly>{{ $jobpost->description }}</textarea>
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
                                            value="{{ $jobpost->company->name }}" readonly>
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
                                            value="{{ $jobpost->company->address }}" readonly>
                                        @if ($errors->has('address'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('address') }}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label" for="website">Website</label>
                                        <input type="text" name="website" id="website" readonly placeholder="website"
                                            class="form-control {{ $errors->has('website') ? 'is-invalid' : '' }}"
                                            value="{{ $jobpost->company->website }}">
                                    </div>
                                    <div class="col-12 mb-4">
                                        <label class="form-label d-block" for="logo">Company logo</label>
                                        <img src="{{ asset($jobpost->company->logo) }}" width="300" class="img-fluid" alt="">
                                    </div>

                                    <div class="col-12 my-4">
                                        <label class="form-label" for="about">Company About</label>
                                        <textarea name="about" placeholder="Company About"
                                            class="form-control {{ $errors->has('about') ? 'is-invalid' : '' }}" id="about" cols="30"
                                            rows="10" readonly>{{ $jobpost->company->about }}</textarea>
                                        @if ($errors->has('about'))
                                            <div class="invalid-feedback my-2">
                                                {{ $errors->first('about') }}
                                            </div>
                                        @endif
                                    </div>

                                    <div class="col-12">
                                        <a href="{{ route('job.post') }}" type="submit"
                                            class="btn btn-danger text-white w-auto">Go Back</a>
                                    </div>
                                </div>
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
    </script>
@endpush
<!-- End:Script -->
