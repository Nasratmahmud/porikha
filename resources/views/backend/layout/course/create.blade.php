@extends('backend.app')

<!-- Start:Title -->
@section('title', 'Add New Course')
<!-- End:Title -->
@push('style')
    {{-- font awesome cdn --}}
    <link rel="stylesheet"
          href="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css') }}"/>
    {{-- Dropify Css cdn --}}
    <link rel="stylesheet"
          href="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css') }}"/>
    <style type="text/css">
        /* dropify css  */
        .dropify-wrapper .dropify-message p {
            font-size: initial;
        }
        /* editor css  */
        .ck-editor__editable[role="textbox"] {
            min-height: 150px;
        }

        .select2-results { background-color: #000; }

        .select2-search input { background-color: #0000; }

       .select2-search { background-color: #0000; }

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
                        <h2>Create a Course</h2>
                        <a class="bg-transparent" href="{{ route('course.index') }}">
                            <i class="bi bi-chevron-left"></i> Back to Course Page
                        </a>
                    </div>
                    <!-- card -->
                    <div class="card mb-4 mx-5">
                        <!-- card body -->
                        <div class="card-body">
                            <form class="needs-validation" novalidate action="{{ route('course.store') }}" method="POST"
                                  enctype="multipart/form-data">
                                @csrf
                                {{-- Course Area --}}
                                <div class="row">
                                    <!-- Input Item -->
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label" for="course_title">Coure Title</label>
                                        <input type="text" name="course_title" id="course_title"
                                               class="form-control {{ $errors->has('course_title') ? 'is-invalid' : '' }}"
                                               value="{{ old('course_title') }}" required>
                                        @if ($errors->has('course_title'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('course_title') }}
                                            </div>
                                        @endif
                                    </div>
                                    <!-- Input Item -->
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label" for="course_price">Course Price </label>
                                        <input type="text" name="course_price" id="course_price"
                                               class="form-control {{ $errors->has('course_price') ? 'is-invalid' : '' }}"
                                               value="{{ old('course_price') }}" required>
                                        @if ($errors->has('course_price'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('course_price') }}
                                            </div>
                                        @endif
                                        <p class="fs-6 ps-2 pt-1 text-gray-500">If the course price is $0, the user can
                                            enroll in this
                                            course
                                            for free;
                                            otherwise, the user needs to pay.</p>
                                    </div>
                                    <!-- Input Item -->
                                    <div class="col-12 my-4">
                                        <label class="form-label" for="summary">Course Summary</label>
                                        <textarea name="summary"
                                                  class="form-control {{ $errors->has('summary') ? 'is-invalid' : '' }}"
                                                  id="summary"
                                                  cols="30" rows="10" required>{{ old('summary') }}</textarea>
                                        @if ($errors->has('summary'))
                                            <div class="invalid-feedback my-2 d-block">
                                                {{ $errors->first('summary') }}
                                            </div>
                                        @endif
                                    </div>
                                    <!-- Input Item -->
                                    <div class="col-12 mb-4">
                                        <label class="form-label" for="course_feature_image">Feature Image</label>
                                        <input type="file"
                                               class="form-control dropify {{ $errors->has('course_feature_image') ? 'is-invalid' : '' }}"
                                               name="course_feature_image" id="course_feature_image">
                                        @if ($errors->has('course_feature_image'))
                                            <div class="invalid-feedback my-2 d-block">
                                                {{ $errors->first('course_feature_image') }}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label" for="ai_name">Ai Namae</label>
                                        <input type="text" name="ai_name" id="ai_name"
                                               class="form-control {{ $errors->has('ai_name') ? 'is-invalid' : '' }}"
                                               value="{{ old('ai_name') }}" required>
                                        @if ($errors->has('ai_name'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('ai_name') }}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label" for="ai_url">Ai Url</label>
                                        <input type="text" name="ai_url" id="ai_url"
                                               class="form-control {{ $errors->has('ai_url') ? 'is-invalid' : '' }}"
                                               value="{{ old('ai_url') }}" required>
                                        @if ($errors->has('ai_url'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('ai_url') }}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="col-12 my-4">
                                        <label class="form-label" for="ai_description">Ai Description</label>
                                        <textarea name="ai_description"
                                                  class="form-control {{ $errors->has('ai_description') ? 'is-invalid' : '' }}"
                                                  id="ai_description"
                                                  cols="30" rows="10" required>{{ old('ai_description') }}</textarea>
                                        @if ($errors->has('ai_description'))
                                            <div class="invalid-feedback my-2 d-block">
                                                {{ $errors->first('ai_description') }}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="col-12 mb-4">
                                        <label class="form-label" for="ai_image">Ai Image</label>
                                        <input type="file"
                                               class="form-control dropify {{ $errors->has('ai_image') ? 'is-invalid' : '' }}"
                                               name="ai_image" id="ai_image">
                                        @if ($errors->has('ai_image'))
                                            <div class="invalid-feedback my-2 d-block">
                                                {{ $errors->first('ai_image') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <hr>
                                {{-- Module Area --}}
                                <div class="row">
                                    <div class="col-11 mb-3">
                                        <button type="button" class="btn btn-primary my-3"
                                                onclick="addModuleItem('moduleAccordion')">Add
                                            Module +
                                        </button>
                                        <div class="accordion" id="moduleAccordion">
                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="heading_1">
                                                    <button class="accordion-button" type="button"
                                                            data-bs-toggle="collapse" data-bs-target="#collapse_1"
                                                            aria-expanded="true" aria-controls="collapse_1">
                                                        Module 1
                                                    </button>
                                                </h2>
                                                <div id="collapse_1" class="accordion-collapse collapse show"
                                                     aria-labelledby="heading_1" data-bs-parent="#moduleAccordion">
                                                    <div class="accordion-body">
                                                        <input type="text" name="module_number[]" value="1">
                                                        <label class="form-label">Module Title</label>
                                                        <input type="text" name="module_titles[]" class="form-control"
                                                               required>
                                                        <div class="invalid-feedback">Module title required</div>
                                                        {{-- Module content area --}}
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <button type="button" class="btn btn-primary my-3"
                                                                        onclick="addContentItem(1, 'module_1_contentAccordion')">
                                                                    Add
                                                                    Content +
                                                                </button>
                                                            </div>
                                                            <div class="col-11">
                                                                <div class="accordion" id="module_1_contentAccordion">
                                                                    <div class="accordion-item">
                                                                        <h2 class="accordion-header"
                                                                            id="module_1_content_heading_1">
                                                                            <button class="accordion-button"
                                                                                    type="button"
                                                                                    data-bs-toggle="collapse"
                                                                                    data-bs-target="#module_1_content_collapse_1"
                                                                                    aria-expanded="true"
                                                                                    aria-controls="module_1_content_collapse_1">
                                                                                Content
                                                                            </button>
                                                                        </h2>
                                                                        <div id="module_1_content_collapse_1"
                                                                             class="accordion-collapse collapse show"
                                                                             aria-labelledby="module_1_content_heading_1"
                                                                             data-bs-parent="#module_1_contentAccordion">
                                                                            <div class="accordion-body">
                                                                                <label class="form-label">Content
                                                                                    Title</label>
                                                                                <input type="text"
                                                                                       name="module_1_content_title[]"
                                                                                       class="form-control mb-2"
                                                                                       required>
                                                                                <div class="invalid-feedback mb-2">
                                                                                    Content
                                                                                    title
                                                                                    required
                                                                                </div>
                                                                                <label class="form-label">Video
                                                                                    File</label>
                                                                                <input type="file"
                                                                                       name="module_1_video_url[]"
                                                                                       class="form-control mb-2"
                                                                                       required>
                                                                                <div class="invalid-feedback mb-2">Video
                                                                                    File
                                                                                    required
                                                                                </div>
                                                                                {{-- <label class="form-label"
                                                                                       for="course_pdf">Add PDF</label>
                                                                                <input type="file"
                                                                                       class="form-control"
                                                                                       name="module_1_course_pdf[]"
                                                                                       id="course_pdf"
                                                                                       accept="application/pdf">
                                                                                <div class="invalid-feedback">Course PDF
                                                                                    required
                                                                                </div> --}}
                                                                                    {{-- Multiple File Upload Start --}}
                                                                                        <!-- File Upload Input for PDFs, Excel, etc. -->
                                                                                        <label for="module_1_files">Additional Files (PDF, Excel, etc.)</label>
                                                                                        <input type="file" name="module_1_files[0][]" multiple class="form-control">

                                                                                    {{-- Multiple File Upload End --}}
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 mt-3">
                                    <button type="submit" class="btn btn-success text-white w-auto">Save</button>
                                    <a href="{{ route('course.index') }}" type="submit"
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
<!-- Start:Script -->
@push('script')
    {{-- Dropify Cdn --}}
    <script src="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js') }}"></script>
    <script src="{{ asset('backend/js/form-validation.js') }}"></script>
    {{-- Editor Cdn  --}}
    <script src="{{ asset('https://cdn.ckeditor.com/ckeditor5/35.1.0/classic/ckeditor.js') }}"></script>
    <script>
        //initialized dropify
        $(document).ready(function () {
            $('.dropify').dropify();
        });
        //initialized editor
        ClassicEditor
            .create(document.querySelector('#summary'), {
                removePlugins: ['CKFinderUploadAdapter', 'CKFinder', 'EasyImage', 'Image', 'ImageCaption', 'ImageStyle',
                    'ImageToolbar', 'ImageUpload', 'MediaEmbed'
                ],
            })
            .catch(error => {
                console.error(error);
            });

            //initialized editor
            ClassicEditor
                .create(document.querySelector('#ai_description'), {
                    removePlugins: ['CKFinderUploadAdapter', 'CKFinder', 'EasyImage', 'Image', 'ImageCaption', 'ImageStyle',
                        'ImageToolbar', 'ImageUpload', 'MediaEmbed'
                    ],
                })
                .catch(error => {
                    console.error(error);
                });

        let moduleIndex = 1;
        let fileIndex = 0; // Global file index

        //Module item add function
        function addModuleItem(mainDiv) {
            moduleIndex++;
            let newModuleItem = document.createElement('div');
            newModuleItem.className = 'accordion-item';
            newModuleItem.id = `accordionItem_${moduleIndex}`;

            newModuleItem.innerHTML = `
            <h2 class="accordion-header position-relative" id="heading_${moduleIndex}">
                <button class="accordion-button" type="button"
                    data-bs-toggle="collapse" data-bs-target="#collapse_${moduleIndex}"
                    aria-expanded="true" aria-controls="collapse_${moduleIndex}">
                    Module ${moduleIndex}
                </button>
                <button type="button" class="btn btn-danger btn-sm position-absolute top-0" style="left: calc(100% + 5px)" onclick="removeModuleItem(${moduleIndex})">
                    <i class="fas fa-remove"></i>
                </button>
            </h2>
            <div id="collapse_${moduleIndex}" class="accordion-collapse collapse show"
                aria-labelledby="heading_${moduleIndex}" data-bs-parent="#moduleAccordion">
                <div class="accordion-body">
                    <input type="hidden" name="module_number[]" value="${moduleIndex}">
                    <label class="form-label">Module Title</label>
                    <input type="text" name="module_titles[]" class="form-control" required>
                    <div class="invalid-feedback">Module title required</div>

                    <div class="row">
                        <div class="col-12">
                            <button type="button" class="btn btn-primary my-3"
                                onclick="addContentItem(${moduleIndex}, 'module_${moduleIndex}_contentAccordion')">Add
                                Content +</button>
                        </div>
                        <div class="col-11">
                            <div class="accordion" id="module_${moduleIndex}_contentAccordion">
                                <div class="accordion-item">
                                    <h2 class="accordion-header"
                                        id="module_${moduleIndex}_content_heading_1">
                                        <button class="accordion-button"
                                            type="button" data-bs-toggle="collapse"
                                            data-bs-target="#module_${moduleIndex}_content_collapse_1"
                                            aria-expanded="true"
                                            aria-controls="module_${moduleIndex}_content_collapse_1">
                                            Content
                                        </button>
                                    </h2>
                                    <div id="module_${moduleIndex}_content_collapse_1"
                                        class="accordion-collapse collapse show"
                                        aria-labelledby="module_${moduleIndex}_content_heading_1"
                                        data-bs-parent="#module_${moduleIndex}_contentAccordion">
                                        <div class="accordion-body">
                                            <label class="form-label">Content Title</label>
                                                <input type="text" name="module_${moduleIndex}_content_title[]" class="form-control mb-2" required>
                                                <div class="invalid-feedback mb-2">Content title required</div>
                                                <label class="form-label">Video URL</label>
                                                <input type="file" name="module_${moduleIndex}_video_url[]" class="form-control mb-2" required>
                                                <div class="invalid-feedback mb-2">Video URL required</div>

                                                   <label for="module_${moduleIndex}_files">Additional Files (PDF, Excel, etc.)</label>
                                                                                        <input type="file" name="module_${moduleIndex}_files[${fileIndex}][]" multiple class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
            `;
            document.getElementById(mainDiv).appendChild(newModuleItem);
        }

        //module item remove function
        function removeModuleItem(itemmoduleIndex) {
            const itemToRemove = document.getElementById(`accordionItem_${itemmoduleIndex}`);
            if (itemToRemove) {
                itemToRemove.remove();
            }
        }

        let ContentIndex = 1;
       // let fileIndex = 0;

        //Module Content item add function
        function addContentItem(moduleNumber, contentAreaId) {
            ContentIndex++;
            fileIndex++;

            let newContentItem = document.createElement('div');
            newContentItem.className = 'accordion-item';
            newContentItem.id = `content_item_${ContentIndex}`;

            newContentItem.innerHTML = `
                    <h2 class="accordion-header position-relative" id="module_${moduleNumber}_content_heading_${ContentIndex}">
                        <button class="accordion-button" type="button"
                            data-bs-toggle="collapse" data-bs-target="#module_${moduleNumber}_content_collapse_${ContentIndex}"
                            aria-expanded="true" aria-controls="module_${moduleNumber}_content_collapse_${ContentIndex}">
                            Content
                        </button>
                        <button type="button" class="btn btn-danger btn-sm position-absolute top-0" style="left: calc(100% + 5px)" onclick="removeContentItem(${ContentIndex})">
                            <i class="fas fa-remove"></i>
                        </button>
                    </h2>
                    <div id="module_${moduleNumber}_content_collapse_${ContentIndex}" class="accordion-collapse collapse show"
                        aria-labelledby="module_${moduleNumber}_content_heading_${ContentIndex}" data-bs-parent="#${contentAreaId}">
                        <div class="accordion-body">
                            <label class="form-label">Content Title</label>
                            <input type="text" name="module_${moduleNumber}_content_title[]" class="form-control mb-2" required>
                            <div class="invalid-feedback mb-2">Content title required</div>
                            <label class="form-label">Video URL</label>
                            <input type="file" name="module_${moduleNumber}_video_url[]" class="form-control mb-2" required>
                            <div class="invalid-feedback mb-2">Video URL required</div>
                               <label for="module_${moduleIndex}_files">Additional Files (PDF, Excel, etc.)</label>
                                                                                        <input type="file" name="module_${moduleIndex}_files[${fileIndex}][]" multiple class="form-control">
                        </div>
                    </div>
                `;
            document.getElementById(contentAreaId).appendChild(newContentItem);
        }

        //content item remove function
        function removeContentItem(itemContentIndex) {
            const itemToRemove = document.getElementById(`content_item_${itemContentIndex}`);
            if (itemToRemove) {
                itemToRemove.remove();
            }
        }
    </script>
@endpush
<!-- End:Script -->
