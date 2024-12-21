@extends('backend.app')

<!-- Title -->
@section('title', 'List of Course Module')

{{-- Main Content --}}
@section('content')

    <div class="app-content-area">
        <div class="container-fluid">
            <!-- row -->
            <div class="row mt-5">
                <div class="col-12">
                    <div class="text-end">
                        <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal"
                            data-bs-target="#addModal">Add Module</button>
                    </div>
                    <div class="mb-6 card">
                        <!-- Tab content -->
                        <div class="tab-content p-5 mx-md-5" id="pills-tabContent-table">
                            <div class="tab-pane tab-example-design fade show active" id="pills-table-design"
                                role="tabpanel" aria-labelledby="pills-table-design-tab">
                                <!-- Basic table -->
                                <div class="table-responsive">
                                    <table id="data-table"
                                        class="table table-bordered text-center w-100 display responsive nowrap"
                                        cellspacing="0" width="100%">
                                        <thead class="table-light">
                                            <tr>
                                                <th>SL#</th>
                                                <th>Module Name</th>
                                                <th>Course</th>
                                                <th>Slug</th>
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
            <form id="addOrUpdateForm" class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalTitle">Add New Module</h5>
                    <button type="button" class="btn-close" onclick="modalCloseFunction()" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="update_id" value="0">
                    {{-- Module name input  --}}
                    <label class="form-label" for="course_module_name">Course Module Name</label>
                    <input type="text" name="course_module_name" id="course_module_name" class="form-control">
                    {{-- Course select  --}}
                    <label for="course_id" class="form-label">Select Course</label>
                    <select class="form-select text-capitalize {{ $errors->has('course_id') ? 'is-invalid' : '' }}"
                        id="course_id" required="" name="course_id">
                        <option selected disabled value="0">Choose...</option>
                        @foreach ($courses as $course)
                            <option value="{{ $course['id'] }}" {{ old('course_id') == $course['id'] ? 'selected' : '' }}
                                class="text-capitalize">
                                {{ $course['course_title'] }}</option>
                        @endforeach
                    </select>
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
                        url: "{{ route('courseModule.index') }}",
                        type: "get",
                    },

                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex',
                            orderable: false,
                            searchable: false
                        },
                        {
                            data: 'course_module_name',
                            name: 'course_module_name',
                            orderable: true,
                            searchable: true
                        },
                        {
                            data: 'course_title',
                            name: 'course_title',
                            orderable: true,
                            searchable: true
                        },
                        {
                            data: 'course_module_slug',
                            name: 'course_module_slug',
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
            var url = '{{ route('courseModule.edit', ':id') }}';
            $.ajax({
                type: "GET",
                url: url.replace(':id', id),
                success: function(resp) {
                    // Reloade DataTable
                    $('#data-table').DataTable().ajax.reload();
                    if (resp.success === true) {
                        document.getElementById('update_id').value = resp.data['id'];
                        document.getElementById('course_module_name').value = resp.data['course_module_name'];
                        document.getElementById('modalSubmitBtn').innerHTML = 'Update';
                        document.getElementById('addModalTitle').innerHTML = 'Update Module';
                        //existing course selected attribute add
                        document.querySelectorAll('#course_id option').forEach(option => {
                            if (option['value'] == resp.data['course_id']) {
                                option.selected = true;
                            }
                        });
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
            document.getElementById('addOrUpdateForm').reset();
            document.getElementById('modalSubmitBtn').innerHTML = 'Save Changes';
            document.getElementById('addModalTitle').innerHTML = 'Add New Module';
            $('#addModal').modal('hide');
        }

        // Add Or Update
        function addOrUpdate() {
            let id = document.getElementById('update_id');
            let course_module_name = document.getElementById('course_module_name');
            let course_id = document.getElementById('course_id');
            $.ajax({
                type: "POST",
                url: '{{ route('courseModule.addUpdate') }}',
                data: {
                    id: id.value,
                    course_module_name: course_module_name.value,
                    course_id: course_id.value,
                },
                success: function(resp) {
                    // Reloade DataTable
                    $('#data-table').DataTable().ajax.reload();
                    if (resp.success === true) {
                        modalCloseFunction();
                        toastr.success(resp.message);
                    } else if (resp.success === false) {
                        toastr.error(resp.message);
                    }
                }, // success end
                error: function(error) {
                    toastr.error('Something went wrong');
                } // Error
            })
        }

        document.getElementById('addOrUpdateForm').addEventListener('submit', (e) => {
            e.preventDefault();
            addOrUpdate();
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
            var url = '{{ route('courseModule.status', ':id') }}';
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
            var url = '{{ route('courseModule.destroy', ':id') }}';
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
