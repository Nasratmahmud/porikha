@extends('backend.app')

<!-- Start:Title -->
@section('title', 'Update Bundle')
<!-- End:Title -->
@push('style')
    {{-- font awesome cdn --}}
    <link rel="stylesheet" href="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css') }}" />
    {{-- Dropify Css cdn --}}
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
                        <h2>Update Bundle</h2>
                        <a class="bg-transparent" href="{{ route('bundle.index') }}">
                            <i class="bi bi-chevron-left"></i> Back to Bundle Page
                        </a>
                    </div>
                    <!-- card -->
                    <div class="card mb-4 mx-5">
                        <!-- card body -->
                        <div class="card-body">
                            <form class="needs-validation" novalidate action="{{ route('bundle.update') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                {{-- Course Area --}}
                                <div class="row">
                                    <!-- Input Item -->
                                    <div class="col-md-6 mb-3">
                                        <input type="hidden" value="{{ $bundle->id }}" name="id">
                                        <label class="form-label" for="title">Title</label>
                                        <input type="text" name="title" id="title"
                                            class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}"
                                            value="{{ $bundle->title }}" required>
                                        @if ($errors->has('title'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('title') }}
                                            </div>
                                        @endif
                                    </div>
                                    <!-- Input Item -->
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label" for="sub_title">Sub Title</label>
                                        <input type="text" name="sub_title" id="sub_title"
                                            class="form-control {{ $errors->has('sub_title') ? 'is-invalid' : '' }}"
                                            value="{{ $bundle->sub_title }}" required>
                                        @if ($errors->has('sub_title'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('sub_title') }}
                                            </div>
                                        @endif
                                    </div>
                                    <!-- Input Item -->
                                    <div class="col-12 mb-4">
                                        <label class="form-label" for="feature_image">Feature Image</label>
                                        <input type="file"
                                            class="form-control dropify {{ $errors->has('feature_image') ? 'is-invalid' : '' }}"
                                            name="feature_image" id="feature_image"
                                            data-default-file="{{ asset('/' . $bundle->feature_image) }}">

                                        @if ($errors->has('feature_image'))
                                            <div class="invalid-feedback my-2 d-block">
                                                {{ $errors->first('feature_image') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <hr>
                                {{-- Module Area --}}
                                <div class="row">
                                    <div class="col-11 mb-3">
                                        <button type="button" class="btn btn-primary my-3"
                                            onclick="addItem('bundleAccordion')">Add Bundle Item +</button>
                                        <div class="accordion" id="bundleAccordion">
                                            @foreach ($bundle->bundle_items as $key => $bundle_items)
                                                <div class="accordion-item" id="edit_{{ $key }}_accordion-item">
                                                    <h2 class="accordion-header position-relative"
                                                        id="heading_edit_{{ $key }}">
                                                        <button class="accordion-button collapsed" type="button"
                                                            data-bs-toggle="collapse"
                                                            data-bs-target="#collapse_edit_{{ $key }}"
                                                            aria-expanded="false"
                                                            aria-controls="collapse_edit_{{ $key }}">
                                                            Item {{ $key + 1 }}
                                                        </button>
                                                        @if ($key > 0)
                                                            <button type="button"
                                                                class="btn btn-danger btn-sm position-absolute top-0"
                                                                style="left: calc(100% + 5px)"
                                                                onclick="deleteItem('{{ route('bundle.item.destroy', $bundle_items['id']) }}','{{ 'edit_' . $key . '_accordion-item' }}')">
                                                                <i class="fas fa-remove"></i>
                                                            </button>
                                                        @endif
                                                    </h2>
                                                    <div id="collapse_edit_{{ $key }}"
                                                        class="accordion-collapse collapse"
                                                        aria-labelledby="heading_edit_{{ $key }}"
                                                        data-bs-parent="#moduleAccordion">
                                                        <div class="accordion-body">
                                                            <input type="hidden" name="item_number[]"
                                                                value="{{ $key + 1 }}">
                                                            <div class="row">
                                                                <!-- Title -->
                                                                <div class="col-md-4 mb-3">
                                                                    <input type="hidden"
                                                                        name="item_{{ $key + 1 }}_id"
                                                                        value="{{ $bundle_items['id'] }}">
                                                                    <label class="form-label"
                                                                        for="item_{{ $key + 1 }}_title">Title</label>
                                                                    <input type="text"
                                                                        name="item_{{ $key + 1 }}_title"
                                                                        class="form-control"
                                                                        id="item_{{ $key + 1 }}_title"
                                                                        value="{{ $bundle_items['title'] }}" required>
                                                                </div>
                                                                <!-- Type -->
                                                                <div class="col-md-4 mb-3">
                                                                    <label for="item_{{ $key + 1 }}_type"
                                                                        class="form-label">Type</label>
                                                                    <select
                                                                        onchange="selectItem(this,'select_{{ $key + 1 }}_item',{{ $key + 1 }})"
                                                                        class="form-select text-capitalize"
                                                                        id="item_{{ $key + 1 }}_type" required
                                                                        name="item_{{ $key + 1 }}_type">
                                                                        <option disabled value="">Choose...
                                                                        </option>
                                                                        <option value="1"
                                                                            {{ $bundle_items['type'] == 1 ? 'selected' : '' }}
                                                                            class="text-capitalize">
                                                                            Journal
                                                                        </option>
                                                                        <option value="2"
                                                                            {{ $bundle_items['type'] == 2 ? 'selected' : '' }}
                                                                            class="text-capitalize">
                                                                            Course
                                                                        </option>
                                                                        <option value="3"
                                                                            {{ $bundle_items['type'] == 3 ? 'selected' : '' }}
                                                                            class="text-capitalize">
                                                                            Book
                                                                        </option>
                                                                        <option value="4"
                                                                            {{ $bundle_items['type'] == 4 ? 'selected' : '' }}
                                                                            class="text-capitalize">
                                                                            Content
                                                                        </option>
                                                                    </select>
                                                                </div>
                                                                <!-- Select Item -->
                                                                <div class="col-md-4 mb-3">
                                                                    <label for="select_{{ $key + 1 }}_item"
                                                                        class="form-label">Select
                                                                        Item</label>
                                                                    <select class="form-select text-capitalize"
                                                                        id="select_{{ $key + 1 }}_item" required
                                                                        name="select_{{ $key + 1 }}_item">
                                                                        <option disabled value="">
                                                                            Choose...</option>
                                                                        @if ($bundle_items['type'] == 1)
                                                                            @foreach ($journals as $journal)
                                                                                <option
                                                                                    {{ $bundle_items['journal_id'] == $journal['id'] ? 'selected' : '' }}
                                                                                    value="{{ $journal['id'] }}"
                                                                                    class="text-capitalize">
                                                                                    {{ $journal['journal_title'] }}
                                                                                </option>
                                                                            @endforeach
                                                                        @elseif ($bundle_items['type'] == 2)
                                                                            @foreach ($courses as $course)
                                                                                <option
                                                                                    {{ $bundle_items['course_id'] == $course['id'] ? 'selected' : '' }}
                                                                                    value="{{ $course['id'] }}"
                                                                                    class="text-capitalize">
                                                                                    {{ $course['course_title'] }}
                                                                                </option>
                                                                            @endforeach
                                                                        @elseif ($bundle_items['type'] == 3)
                                                                            @foreach ($books as $book)
                                                                                <option
                                                                                    {{ $bundle_items['book_id'] == $book['id'] ? 'selected' : '' }}
                                                                                    value="{{ $book['id'] }}"
                                                                                    class="text-capitalize">
                                                                                    {{ $book['book_name'] }}
                                                                                </option>
                                                                            @endforeach
                                                                        @else
                                                                            <option selected disabled value="content">
                                                                                content</option>
                                                                        @endif
                                                                        {{-- <option selected disabled value="">Choose...
                                                                        </option> --}}
                                                                    </select>
                                                                </div>
                                                                <!-- Sub Description -->
                                                                <div class="col-12 mb-3 @if ($bundle_items['type'] != 4) d-none @endif"
                                                                    id="item_{{ $key + 1 }}_sub_des_div">
                                                                    <label class="form-label"
                                                                        for="item_{{ $key + 1 }}_sub_description">Sub
                                                                        Description</label>
                                                                    <textarea name="item_{{ $key + 1 }}_sub_description" class="form-control"
                                                                        id="item_{{ $key + 1 }}_sub_description" rows="5">{{ $bundle_items['sub_description'] }}</textarea>
                                                                </div>
                                                                <!-- Description -->
                                                                <div class="col-12 mb-3 @if ($bundle_items['type'] != 4) d-none @endif"
                                                                    id="item_{{ $key + 1 }}_des_div">
                                                                    <label class="form-label"
                                                                        for="item_{{ $key + 1 }}_description">Description</label>
                                                                    <textarea name="item_{{ $key + 1 }}_description" class="form-control description"
                                                                        id="item_{{ $key + 1 }}_description" cols="30" rows="10">{{ $bundle_items['description'] }}</textarea>
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
                                    <a href="{{ route('bundle.index') }}"
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
    <script src="{{ asset('backend/js/form-validation.js') }}"></script>
    {{-- Dropify Cdn --}}
    <script src="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js') }}"></script>
    <!-- sweetalert -->
    <script type="text/javascript" src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    {{-- Editor Cdn  --}}
    <script src="{{ asset('https://cdn.ckeditor.com/ckeditor5/35.1.0/classic/ckeditor.js') }}"></script>
    <script>
        //initialized dropify
        $(document).ready(function() {
            $('.dropify').dropify();
        });
        //initialized editor for existing item
        document.querySelectorAll('.description').forEach(element => {
            ClassicEditor.create(element, {
                    removePlugins: ['CKFinderUploadAdapter', 'CKFinder', 'EasyImage', 'Image', 'ImageCaption',
                        'ImageStyle',
                        'ImageToolbar', 'ImageUpload', 'MediaEmbed'
                    ],
                })
                .catch(error => {
                    console.error(error);
                });
        });
        //for new item
        function initializedEditor(id) {
            ClassicEditor.create(document.querySelector(`#${id}`), {
                    removePlugins: ['CKFinderUploadAdapter', 'CKFinder', 'EasyImage', 'Image', 'ImageCaption',
                        'ImageStyle',
                        'ImageToolbar', 'ImageUpload', 'MediaEmbed'
                    ],
                })
                .catch(error => {
                    console.error(error);
                });
        }

        let itemIntex = "{{ count($bundle->bundle_items) }}";
        //item add function
        function addItem(mainDiv) {
            itemIntex++;
            let newItem = document.createElement('div');
            newItem.className = 'accordion-item';
            newItem.id = `accordionItem_${itemIntex}`;

            newItem.innerHTML = `
            <h2 class="accordion-header position-relative" id="heading_${itemIntex}">
                <button class="accordion-button" type="button"
                    data-bs-toggle="collapse" data-bs-target="#collapse_${itemIntex}"
                    aria-expanded="true" aria-controls="collapse_${itemIntex}">
                    Item ${itemIntex}
                </button>
                <button type="button" class="btn btn-danger btn-sm position-absolute top-0" style="left: calc(100% + 5px)" onclick="removItem(${itemIntex})">
                    <i class="fas fa-remove"></i>
                </button>
            </h2>
            <div id="collapse_${itemIntex}" class="accordion-collapse collapse show"
                aria-labelledby="heading_${itemIntex}" data-bs-parent="#moduleAccordion">
                <div class="accordion-body">
                    <input type="hidden" name="item_number[]" value="${itemIntex}">
                    <div class="row">
                        <!-- Title -->
                        <div class="col-md-4 mb-3">
                            <input type="hidden" name="item_${itemIntex}_id" value="0">
                            <label for="item_${itemIntex}_title" class="form-label">Title</label>
                            <input type="text" name="item_${itemIntex}_title"
                                class="form-control" id="item_${itemIntex}_title" required>
                        </div>
                        <!-- Type -->
                        <div class="col-md-4 mb-3">
                            <label for="item_${itemIntex}_type" class="form-label">Type</label>
                            <select class="form-select text-capitalize" id="item_${itemIntex}_type"
                                required name="item_${itemIntex}_type" onchange="selectItem(this, '${"select_"+itemIntex+"_item"}',${itemIntex})">
                                <option selected disabled value="">Choose...
                                </option>
                                <option value="1" class="text-capitalize">Journal
                                </option>
                                <option value="2" class="text-capitalize">Course
                                </option>
                                <option value="3" class="text-capitalize">Book
                                </option>
                                <option value="4" class="text-capitalize">Content
                                </option>
                            </select>
                        </div>
                        <!-- Select Item -->
                        <div class="col-md-4 mb-3">
                            <label for="select_${itemIntex}_item" class="form-label">Select Item</label>
                            <select disabled class="form-select text-capitalize" id="select_${itemIntex}_item"
                                required name="select_${itemIntex}_item">
                                <option selected disabled value="">Choose...</option>
                            </select>
                        </div>
                        <!-- Sub Description -->
                        <div class="col-12 mb-3 d-none" id="item_${itemIntex}_sub_des_div">
                            <label class="form-label" for="item_${itemIntex}_sub_description">Sub
                                Description</label>
                            <textarea name="item_${itemIntex}_sub_description" class="form-control" id="item_${itemIntex}_sub_description" rows="5"></textarea>
                        </div>
                        <!-- Description -->
                        <div class="col-12 mb-3 d-none" id="item_${itemIntex}_des_div">
                            <label class="form-label"
                                for="item_${itemIntex}_description">Description</label>
                            <textarea name="item_${itemIntex}_description" class="form-control" id="item_${itemIntex}_description" cols="30" rows="10"></textarea>
                        </div>
                    </div>
                </div>
            </div>`;
            document.getElementById(mainDiv).appendChild(newItem);
            initializedEditor(`item_${itemIntex}_description`);
        }

        //item remove function
        function removItem(itemIntex) {
            const itemToRemove = document.getElementById(`accordionItem_${itemIntex}`);
            if (itemToRemove) {
                itemToRemove.remove();
            }
        }

        //
        // Select item
        function selectItem(button, selectTagId, contentNumber) {
            let mainSelectTag = document.getElementById(selectTagId);
            let sub_des = document.getElementById(`item_${contentNumber}_sub_des_div`);
            let des = document.getElementById(`item_${contentNumber}_des_div`);

            let type = button.value;
            let url = '{{ route('bundle.select.item', ':type') }}';
            $.ajax({
                type: "GET",
                url: url.replace(':type', type),
                success: function(resp) {
                    sub_des.classList.add('d-none');
                    des.classList.add('d-none');

                    if (resp.success === true) {
                        mainSelectTag.disabled = false;
                        if (resp.type == 'journal') {
                            mainSelectTag.innerHTML = '<option selected disabled value="">Choose...</option>';
                            resp.data.forEach(item => {
                                mainSelectTag.innerHTML +=
                                    `<option value="${item['id']}" class="text-capitalize">${item['journal_title']}</option>`
                            });
                        } else if (resp.type == 'course') {
                            mainSelectTag.innerHTML = '<option selected disabled value="">Choose...</option>';
                            resp.data.forEach(item => {
                                mainSelectTag.innerHTML +=
                                    `<option value="${item['id']}" class="text-capitalize">${item['course_title']}</option>`
                            });
                        } else if (resp.type == 'book') {
                            mainSelectTag.innerHTML = '<option selected disabled value="">Choose...</option>';
                            resp.data.forEach(item => {
                                mainSelectTag.innerHTML +=
                                    `<option value="${item['id']}" class="text-capitalize">${item['book_name']}</option>`
                            });
                        } else {
                            sub_des.classList.remove('d-none');
                            des.classList.remove('d-none');

                            mainSelectTag.disabled = true;
                            mainSelectTag.innerHTML =
                                '<option selected disabled value="content">content</option>';
                        }
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
    </script>
@endpush
<!-- End:Script -->
