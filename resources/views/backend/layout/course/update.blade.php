@extends('backend.app')

<!-- Start:Title -->
@section('title', 'Update Course')
<!-- End:Title -->
@push('style')
    {{-- font awesome cdn  --}}
    <link rel="stylesheet" href="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css') }}" />
    {{-- Dropify Css cdn  --}}
    <link rel="stylesheet" href="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css') }}" />
    <style type="text/css">
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
                        <h2>Update a Course</h2>
                        <a class="bg-transparent" href="{{ route('course.index') }}">
                            <i class="bi bi-chevron-left"></i> Back to Course Page
                        </a>
                    </div>
                    <!-- card -->
                    <div class="card mb-4 mx-5">
                        <!-- card body -->
                        <div class="card-body">
                            <form class="needs-validation" novalidate action="{{ route('course.update', $course->id) }}"
                                method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                {{-- Course Area  --}}
                                <div class="row">
                                    <!-- Input Item -->
                                    <input type="hidden" value="{{ $course->id }}" name="id">
                                    <!-- Input Item -->
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label" for="course_title">Coure Title</label>
                                        <input type="text" name="course_title" id="course_title"
                                            class="form-control {{ $errors->has('course_title') ? 'is-invalid' : '' }}"
                                            value="{{ $course->course_title }}" required>
                                        @if ($errors->has('course_title'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('course_title') }}
                                            </div>
                                        @endif
                                    </div>
                                    <!-- Input Item -->
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label" for="course_price">Course Price</label>
                                        <input type="text" name="course_price" id="course_price"
                                            class="form-control {{ $errors->has('course_price') ? 'is-invalid' : '' }}"
                                            value="{{ $course->course_price }}" required>
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
                                        <textarea name="summary" class="form-control {{ $errors->has('summary') ? 'is-invalid' : '' }}" id="summary"
                                            cols="30" rows="10" required>{!! $course->summary !!}</textarea>
                                        @if ($errors->has('summary'))
                                            <div class="invalid-feedback my-2">
                                                {{ $errors->first('summary') }}
                                            </div>
                                        @endif
                                    </div>
                                    <!-- Input Item -->
                                    <div class="col-12 mb-4">
                                        <label class="form-label" for="course_feature_image">Feature Image</label>
                                        <input type="file"
                                            class="form-control dropify {{ $errors->has('course_feature_image') ? 'is-invalid' : '' }}"
                                            name="course_feature_image" id="course_feature_image"
                                            data-default-file="{{ asset('/' . $course->course_feature_image) }}">

                                        @if ($errors->has('course_feature_image'))
                                            <div class="invalid-feedback my-2 d-block">
                                                {{ $errors->first('course_feature_image') }}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label" for="ai_name">Ai Name</label>
                                        <input type="text" name="ai_name" id="ai_name"
                                               class="form-control {{ $errors->has('ai_name') ? 'is-invalid' : '' }}"
                                               value="{{ $course->ai_name }}" required>
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
                                               value="{{ $course->ai_url }}" required>
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
                                                  cols="30" rows="10" required>{!! $course->ai_description !!}</textarea>
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
                                               name="ai_image" id="ai_image" data-default-file="{{ asset('/' . $course->ai_picture) }}" >

                                        @if ($errors->has('ai_image'))
                                            <div class= "invalid-feedback my-2 d-block">
                                                {{ $errors->first('ai_image') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                {{-- Module Area  --}}
                                <div class="row">
                                    <div class="col-11 mb-3">
                                        <button type="button" class="btn btn-primary my-3"
                                            onclick="addModuleItem('moduleAccordion')">Add
                                            Module +</button>
                                        <div class="accordion" id="moduleAccordion">
                                            @foreach ($course->course_modules as $key => $module)
                                                <div class="accordion-item"
                                                    id="editModuleAccordionItem_{{ $key }}">
                                                    <h2 class="accordion-header position-relative"
                                                        id="heading_{{ $key + 1 }}">
                                                        <button class="accordion-button collapsed" type="button"
                                                            data-bs-toggle="collapse"
                                                            data-bs-target="#collapse_{{ $key + 1 }}"
                                                            aria-expanded="false"
                                                            aria-controls="collapse_{{ $key + 1 }}">
                                                            Module {{ $key + 1 }}
                                                        </button>
                                                        @if ($key > 0)
                                                            <button type="button"
                                                                class="btn btn-danger btn-sm position-absolute top-0"
                                                                style="left: calc(100% + 5px)"
                                                                onclick="deleteItem('{{ route('module.destroy', ['course_id' => $course->id, 'module_id' => $module['id']]) }}','editModuleAccordionItem_{{ $key }}')">
                                                                <i class="fas fa-remove"></i>
                                                            </button>
                                                        @endif
                                                    </h2>
                                                    <div id="collapse_{{ $key + 1 }}"
                                                        class="accordion-collapse collapse"
                                                        aria-labelledby="heading_{{ $key + 1 }}"
                                                        data-bs-parent="#moduleAccordion">
                                                        <div class="accordion-body">
                                                            <input type="text" name="module_ids[]"
                                                                value="{{ $module['id'] }}">
                                                            <input type="text" name="module_number[]"
                                                                value="{{ $key + 1 }}">
                                                            <label class="form-label">Module Title</label>
                                                            <input type="text" name="module_titles[]"
                                                                class="form-control" required
                                                                value="{{ $module['course_module_name'] }}">
                                                            <div class="invalid-feedback">Module title required</div>
                                                            {{-- Module content area  --}}
                                                            <div class="row">
                                                                <div class="col-12">
                                                                    <button type="button" class="btn btn-primary my-3"
                                                                        onclick="addContentItem({{ $key + 1 }}, 'module_{{ $key + 1 }}_contentAccordion')">Add
                                                                        Content +</button>
                                                                </div>
                                                                <div class="col-11">
                                                                    <div class="accordion"
                                                                        id="module_{{ $key + 1 }}_contentAccordion">
                                                                        @foreach ($module['course_contents'] as $index => $content)
                                                                            <div class="accordion-item"
                                                                                id="editContentAccordionItem_{{ $key }}">
                                                                                <h2 class="accordion-header position-relative"
                                                                                    id="edit_module_{{ $key + 1 }}_content_heading_{{ $content['id'] }}">
                                                                                    <button class="accordion-button"
                                                                                        type="button"
                                                                                        data-bs-toggle="collapse"
                                                                                        data-bs-target="#edit_module_{{ $key + 1 }}_content_collapse_{{ $content['id'] }}"
                                                                                        aria-expanded="true"
                                                                                        aria-controls="edit_module_{{ $key + 1 }}_content_collapse_{{ $content['id'] }}">
                                                                                        Content
                                                                                    </button>
                                                                                    @if ($index > 0)
                                                                                        <button type="button"
                                                                                            class="btn btn-danger btn-sm position-absolute top-0"
                                                                                            style="left: calc(100% + 5px)"
                                                                                            onclick="deleteItem('{{ route('content.destroy', ['course_id' => $course->id, 'id' => $content['id']]) }}','editContentAccordionItem_{{ $key }}')">
                                                                                            <i class="fas fa-remove"></i>
                                                                                        </button>
                                                                                    @endif
                                                                                </h2>
                                                                                <div id="edit_module_{{ $key + 1 }}_content_collapse_{{ $content['id'] }}"
                                                                                    class="accordion-collapse collapse show"
                                                                                    aria-labelledby="edit_module_{{ $key + 1 }}_content_heading_{{ $content['id'] }}"
                                                                                    data-bs-parent="#module_{{ $key + 1 }}_contentAccordion">
                                                                                    <div class="accordion-body">
                                                                                        <div
                                                                                            class="form-check form-switch  mb-5">
                                                                                            <input
                                                                                                onclick="statusChange('{{ route('content.status', $content['id']) }}', this)"
                                                                                                class="form-check-input"
                                                                                                type="checkbox"
                                                                                                role="switch"
                                                                                                {{ $content['status'] == 1 ? 'checked' : '' }}
                                                                                                id="module_{{ $key + 1 }}_contentStatus_{{ $index }}">
                                                                                            <label class="form-check-label"
                                                                                                for="module_{{ $key + 1 }}contentStatus_{{ $index }}">Content
                                                                                                Status
                                                                                                Enable/Disable</label>
                                                                                        </div>
                                                                                        <input type="text"
                                                                                            name="module_{{ $key + 1 }}_content_id_list[]"
                                                                                            value="{{ $content['id'] }}">
                                                                                        <label class="form-label">Content
                                                                                            Title</label>
                                                                                        <input type="text"
                                                                                            name="module_{{ $key + 1 }}_content_title[]"
                                                                                            class="form-control mb-2"
                                                                                            required
                                                                                            value="{{ $content['content_title'] }}">
                                                                                        <div class="invalid-feedback mb-2">
                                                                                            Content
                                                                                            title
                                                                                            required</div>
                                                                                        <label class="form-label">Video
                                                                                            File</label>
                                                                                        <input type="file"
                                                                                            name="module_{{ $key + 1 }}_video_url[]"
                                                                                            class="form-control mb-2"
                                                                                            value="{{ $content['video_file'] }}">
                                                                                        <p>File:
                                                                                            {{ $content['video_file'] }}
                                                                                        </p>
                                                                                        {{-- <div class="invalid-feedback mb-2">
                                                                                            Video
                                                                                            File
                                                                                            required</div> --}}
                                                                                        <label class="form-label"
                                                                                            for="course_pdf">Add
                                                                                            PDF</label>
                                                                                        <input type="file"
                                                                                            class="form-control"
                                                                                            name="module_{{ $key + 1 }}_files[{{$content->id}}]"
                                                                                            id="course_pdf"
                                                                                            accept="application/pdf">
                                                                                        {{-- <p>{{ $content['course_pdf'] }}</p> --}}


                                                                                        <div class="form-group">
                                                                                            <label>Content ID: {{ $content->id }}</label>
                                                                                            <label>Existing Files:</label>
                                                                                            <ul>
                                                                                                @foreach ($content->files as $file)
                                                                                                    @if ($file->course_content_id == $content->id)
                                                                                                        <li>
                                                                                                            <a href="{{ asset($file->file_path) }}" target="_blank">{{ basename($file->file_path) }}</a>
                                                                                                        </li>
                                                                                                    @endif
                                                                                                @endforeach
                                                                                            </ul>
                                                                                        </div>




                                                                                        <!-- Files -->

                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        @endforeach
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 mt-3">
                                    <button type="submit" class="btn btn-info text-white w-auto">Update</button>
                                    <a href="{{ route('course.index') }}"
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
    {{-- Dropify Cdn  --}}
    <script src="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js') }}"></script>
    {{-- Bootstrap form validation script  --}}
    <script src="{{ asset('backend/js/form-validation.js') }}"></script>
    <!-- sweetalert -->
    <script type="text/javascript" src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    {{-- Editor Cdn  --}}
    <script src="{{ asset('https://cdn.ckeditor.com/ckeditor5/35.1.0/classic/ckeditor.js') }}"></script>
    <script>
        //initialized dropify
        $(document).ready(function() {
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

        let moduleIndex = "{{ count($course->course_modules) }}";
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
                    <input type="hidden" name="module_id_list[]" value="0">
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
                                            <input type="hidden" name="module_${moduleIndex}_content_id_list[]" value="0">
                                            <label class="form-label">Content Title</label>
                                            <input type="text" name="module_${moduleIndex}_content_title[]" class="form-control mb-2" required>
                                            <div class="invalid-feedback mb-2">Content title required</div>
                                            <label class="form-label">Video File</label>
                                            <input type="file" name="module_${moduleIndex}_video_url[]" class="form-control mb-2" required>
                                            <div class="invalid-feedback mb-2">Video File required</div>
                                            <label class="form-label" for="course_pdf">Add PDF</label>
                                            <input type="file" class="form-control"
                                             name="module_${moduleIndex}_files[]" id="course_pdf" accept="application/pdf">
                                            <div class="invalid-feedback mb-2">Course PDF required</div>
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
        //Module Content item add function
        function addContentItem(moduleNumber, contentAreaId) {
            ContentIndex++;

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
                            <input type="hidden" name="module_${moduleNumber}_content_id_list[]" value="0">
                            <label class="form-label">Content Title</label>
                            <input type="text" name="module_${moduleNumber}_content_title[]" class="form-control mb-2" required>
                            <div class="invalid-feedback mb-2">Content title required</div>
                            <label class="form-label">Video URL</label>
                            <input type="file" name="module_${moduleNumber}_video_url[]" class="form-control mb-2" required>
                            <div class="invalid-feedback mb-2">Video URL required</div>
                            <label class="form-label" for="course_pdf">Add PDF</label>
                            <input type="file" class="form-control"
                             name="module_${moduleNumber}_files[]" id="course_pdf" accept="application/pdf">
                            <div class="invalid-feedback mb-2">Course PDF required</div>
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

        //delete item function
        function deleteItem(url, itemId) {
            event.preventDefault();
            swal({
                title: `Are you sure you want to delete this record?`,
                text: "If you delete this, it will be gone forever.",
                buttons: true,
                dangerMode: true,
            }).then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        type: "DELETE",
                        url: url,
                        success: function(resp) {
                            console.log(resp)
                            if (resp.success === true) {
                                //remove content from frontend
                                document.getElementById(itemId).remove();
                                // show toast message
                                toastr.success(resp.message);

                            } else if (resp.errors) {
                                toastr.error(resp.errors[0]);
                            } else {
                                toastr.error(resp.message);
                            }
                        }, // success end
                        error: function(error) {
                            // location.reload();
                        } // Error
                    })
                }
            });
        };

        //Status Change function
        function statusChange(url, button) {
            event.preventDefault();
            swal({
                title: `Are you sure?`,
                text: "You want to update the status?.",
                buttons: true,
                infoMode: true,
            }).then((willStatusChange) => {
                if (willStatusChange) {
                    $.ajax({
                        type: "GET",
                        url: url,
                        success: function(resp) {
                            if (resp.success === true) {
                                button.checked = true;
                                // show toast message
                                toastr.success(resp.message);
                            } else if (resp.success === false) {
                                button.checked = false;
                                // show toast message
                                toastr.error(resp.message);
                            } else if (resp.errors) {
                                toastr.error(resp.errors[0]);
                            } else {
                                toastr.error(resp.message);
                            }
                        }, // success end
                        error: function(error) {
                            // location.reload();
                        } // Error
                    })
                }
            });
        };
    </script>
@endpush
<!-- End:Script -->
