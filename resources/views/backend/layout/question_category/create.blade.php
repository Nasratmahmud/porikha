@extends('backend.app')

<!-- Start:Title -->
@section('title', 'Add New Question')
<!-- End:Title -->
@push('style')
    {{-- font awesome cdn --}}
    <link rel="stylesheet"
          href="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css') }}"/>
    {{-- Dropify Css cdn --}}
    <link rel="stylesheet"
          href="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css') }}"/>

          <!-- Add these in the <head> section of your layout file -->


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
                        <h2>Create a Question</h2>
                        <a class="bg-transparent" href="{{ route('question.category.index') }}">
                            {{-- <i class="bi bi-chevron-left"></i> Back to Course Page --}}
                        </a>
                    </div>
                    <!-- card -->
                    <div class="card mb-4 mx-5">
                        <!-- card body -->
                        <div class="card-body">
                            <form class="needs-validation" novalidate action="{{ route('question.category.store') }}" method="POST"
                                  enctype="multipart/form-data">
                                @csrf
                                {{-- Course Area --}}
                                <div class="row">
                                    <!-- Input Item -->
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label" for="question_title">Question Category Name</label>
                                        <input type="text" name="question_title"
                                               class="form-control {{ $errors->has('question_title') ? 'is-invalid' : '' }}"
                                               value="{{ old('question_title') }}" required>
                                                @if ($errors->has('question_title'))
                                                    <div class="invalid-feedback">
                                                        {{ $errors->first('question_title') }}
                                                    </div>
                                                @endif
                                    </div>
                                </div>
                                <hr>
                                <div class="col-12 mt-3">
                                    <button type="submit" class="btn btn-success text-white w-auto">Save</button>
                                    <a href="{{ route('question.category.index') }}" type="submit"
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

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

    <script>
        toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": false,
        "progressBar": true,
        "positionClass": "toast-top-right",  // Custom position
        "preventDuplicates": true,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",  // 5 seconds
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    };
    </script>
    {{-- <script>
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

        let moduleIndex = 1;

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
                                                                                        <input type="file" name="module_${moduleIndex}_files[]" multiple class="form-control">
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
                            <label class="form-label">Content Title</label>
                            <input type="text" name="module_${moduleNumber}_content_title[]" class="form-control mb-2" required>
                            <div class="invalid-feedback mb-2">Content title required</div>
                            <label class="form-label">Video URL</label>
                            <input type="file" name="module_${moduleNumber}_video_url[]" class="form-control mb-2" required>
                            <div class="invalid-feedback mb-2">Video URL required</div>
                               <label for="module_${moduleIndex}_files">Additional Files (PDF, Excel, etc.)</label>
                                                                                        <input type="file" name="module_${moduleNumber}_files[]" multiple class="form-control">
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
    </script> --}}
@endpush
<!-- End:Script -->