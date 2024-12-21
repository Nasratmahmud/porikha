@extends('backend.app')

<!-- Title -->
@section('title', 'List of Category')

{{-- Main Content --}}
@section('content')

    <div class="app-content-area">
        <div class="container-fluid">
            <!-- row -->
            <div class="row mt-5">
                <div class="col-12">
                    <div class="text-end d-flex mx-3 justify-content-between align-items-center mb-4">
                        <h3>Categories</h3>
                        @can('create category')
                            <a class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addModal">
                                Add Category
                            </a>
                        @endcan
                    </div>
                    <div class="mb-6 card mx-3">
                        <!-- Tab content -->
                        <div class="tab-content p-5" id="pills-tabContent-table">
                            <div class="tab-pane tab-example-design fade show active" id="pills-table-design"
                                role="tabpanel" aria-labelledby="pills-table-design-tab">
                                <!-- Basic table -->
                                <div class="table-responsive">
                                    <table id="data-table"
                                        class="table table-striped text-center w-100 display responsive nowrap"
                                        cellspacing="0" width="100%">
                                        <thead>
                                            <tr class="table-dark">
                                                <th>SL#</th>
                                                <th>Image</th>
                                                <th>Name</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <tbody>
                                    </table>
                                </div>
                                <!-- Basic table -->
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    {{-- Add modal --}}
    <!-- Modal -->
    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <form id="addOrUpdateForm" class="modal-content" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalTitle">Add New Category</h5>
                    <button type="button" class="btn-close" onclick="modalCloseFunction()" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="update_id" value="0" name="id">
                    <div class="mb-3">
                        <label class="form-label">Category Name</label>
                        <input type="text" name="category_name" id="category_name" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Category Image</label>
                        <input type="file" name="category_image" id="category_image" class="form-control"
                            oninput="imagePreview.src=window.URL.createObjectURL(this.files[0])">
                    </div>
                    <img src="{{ asset('backend/images/no-image.jpg') }}" id="imagePreview" height="70" width="70">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" onclick="modalCloseFunction()">Close</button>
                    <button type="submit" class="btn btn-primary" id="modalSubmitBtn">Save
                        changes</button>
                </div>
            </form>
        </div>
    </div>
@endsection
{{-- Add Script --}}
@push('script')
    <script type="text/javascript" src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

    <!-- sweetalert -->
    <script type="text/javascript" src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"
        type="text/javascript"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"
        type="text/javascript"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"
        type="text/javascript"></script>
    <script>
        $(document).ready(function() {
            var searchable = [];
            var selectable = [];
            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                }
            });
            if (!$.fn.DataTable.isDataTable('#data-table')) {
                let dTable = $('#data-table').DataTable({
                    order: [],
                    lengthMenu: [
                        [25, 50, 100, 200, 500, -1],
                        [25, 50, 100, 200, 500, "All"]
                    ],
                    processing: true,
                    responsive: true,
                    serverSide: true,

                    language: {
                        processing: `<div class="text-center">
                            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                            <span class="visually-hidden">Loading...</span>
                          </div>
                            </div>`
                    },

                    scroller: {
                        loadingIndicator: false
                    },
                    pagingType: "full_numbers",
                    dom: "<'row justify-content-between table-topbar'<'col-md-2 col-sm-4 px-0'l><'col-md-2 col-sm-4 px-0'f>>tipr",
                    ajax: {
                        url: "{{ route('category.index') }}",
                        type: "get",
                    },

                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex',
                            orderable: false,
                            searchable: false
                        },
                        {
                            data: 'category_image',
                            name: 'category_image',
                            orderable: true,
                            searchable: true
                        },
                        {
                            data: 'category_name',
                            name: 'category_name',
                            orderable: true,
                            searchable: true
                        },
                        {
                            data: 'status',
                            name: 'status',
                            orderable: true,
                            searchable: true
                        },
                        {
                            data: 'action',
                            name: 'action',
                            orderable: false,
                            searchable: false
                        },

                    ],
                });

                dTable.buttons().container().appendTo('#file_exports');

                new DataTable('#example', {
                    responsive: true
                });
            }

            //Prevent Bootstrap Modal from disappearing when clicking outside or pressing escape?
            $('#addModal').modal({
                backdrop: 'static',
                keyboard: false
            })
        });

        // Edit data modal show
        function showEditModalWithData(id) {
            event.preventDefault();
            var url = '{{ route('category.edit', ':id') }}';
            $.ajax({
                type: "GET",
                url: url.replace(':id', id),
                success: function(resp) {
                    // Reloade DataTable
                    $('#data-table').DataTable().ajax.reload();
                    if (resp.success === true) {
                        document.getElementById('update_id').value = resp.data['id'];
                        document.getElementById('category_name').value = resp.data['category_name'];
                        document.getElementById('imagePreview').src = resp.data['category_image'] != null ? resp
                            .data['category_image'] : "{{ asset('backend/images/no-image.jpg') }}";
                        document.getElementById('modalSubmitBtn').innerHTML = 'Update';
                        document.getElementById('addModalTitle').innerHTML = 'Update Category';
                        $('#addModal').modal('show');
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
        };

        //modal close function
        function modalCloseFunction() {
            document.getElementById('update_id').value = 0;
            document.getElementById('imagePreview').src = "{{ asset('backend/images/no-image.jpg') }}";
            document.getElementById('addOrUpdateForm').reset();
            document.getElementById('modalSubmitBtn').innerHTML = 'Save Changes';
            document.getElementById('addModalTitle').innerHTML = 'Add New Category';
            $('#addModal').modal('hide');
        }

        // Add Or Update Category
        function addOrUpdateCategory() {
            let addOrUpdateForm = document.getElementById('addOrUpdateForm');

            const data = new FormData(addOrUpdateForm);
            const id = data.get("id");
            const category_name = data.get("category_name");
            const category_image = data.get("category_image");
            if (category_name.length == 0) {
                toastr.info("Name is required");
            } else if (category_image.size > 1 * 1024 * 1024) {
                toastr.info("You can upload a maximum of 1 MB image.");
            } else if (category_image.size != 0 && !['image/jpeg', 'image/png', 'image/svg+xml', 'image/gif', ].includes(
                    category_image
                    .type)) {
                toastr.info("You can upload only jpg,png,gif & svg image.");
            } else {
                $.ajax({
                    type: "POST",
                    url: '{{ route('category.addUpdate') }}',
                    data: data,
                    processData: false,
                    contentType: false,
                    success: function(resp) {
                        // Reloade DataTable
                        $('#data-table').DataTable().ajax.reload();
                        if (resp.success === true) {
                            modalCloseFunction();
                            toastr.success(resp.message);
                        } else if (resp.success === false) {
                            toastr.error(resp.data.category_name[0]);
                        }
                    }, // success end
                    error: function(error) {
                        toastr.error('Something went wrong');
                    } // Error
                })
            }
        }
        document.getElementById('addOrUpdateForm').addEventListener('submit', (e) => {
            e.preventDefault();
            addOrUpdateCategory();
        });

        // Status Change Confirm Alert
        function showStatusChangeAlert(id) {
            event.preventDefault();
            swal({
                title: `Are you sure?`,
                text: "You want to update the status?.",
                buttons: true,
                infoMode: true,
            }).then((willStatusChange) => {
                if (willStatusChange) {
                    statusChange(id);
                }
            });
        };

        // Status Change
        function statusChange(id) {
            var url = '{{ route('category.status', ':id') }}';
            $.ajax({
                type: "GET",
                url: url.replace(':id', id),
                success: function(resp) {
                    // Reloade DataTable
                    $('#data-table').DataTable().ajax.reload();
                    if (resp.success === true) {
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
        // delete Confirm
        function showDeleteConfirm(id) {
            event.preventDefault();
            swal({
                title: `Are you sure you want to delete this record?`,
                text: "If you delete this, it will be gone forever.",
                buttons: true,
                dangerMode: true,
            }).then((willDelete) => {
                if (willDelete) {
                    deleteItem(id);
                }
            });
        };

        // Delete Button
        function deleteItem(id) {
            var url = '{{ route('category.destroy', ':id') }}';
            $.ajax({
                type: "DELETE",
                url: url.replace(':id', id),
                success: function(resp) {
                    // Reloade DataTable
                    $('#data-table').DataTable().ajax.reload();
                    if (resp.success === true) {


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
    </script>
@endpush
