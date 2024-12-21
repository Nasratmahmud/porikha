@extends('backend.app')

<!-- Title -->
@section('title', 'List of User Permissions')

{{-- Main Content --}}
@section('content')

    <div class="app-content-area">
        <div class="container-fluid">
            <!-- row -->
            <div class="row mt-5">
                <div class="col-12">
                    <div class="text-end d-flex px-3 justify-content-between align-items-center mb-4">
                        <h3 class="text-primary">All User</h3>
                        <a class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addModal">
                            Add User
                        </a>
                    </div>
                    <div class="mb-6 card">
                        <!-- Tab content -->
                        <div class="tab-content p-5 mx-md-5" id="pills-tabContent-table">
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
                                                <th>Name</th>
                                                <th>Permissions</th>
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
    <!-- Modal -->
    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <form id="addUserForm" class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalTitle">Add User</h5>
                    <button type="button" class="btn-close" onclick="modalCloseFunction()" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div>
                        <label class="form-label" for="username">Username</label>
                        <input type="text" name="username" id="username" class="form-control" required>
                    </div>
                    <div>
                        <label class="form-label" for="name">Name</label>
                        <input type="text" name="name" id="name" class="form-control" required>
                    </div>
                    <div>
                        <label class="form-label" for="email">Email</label>
                        <input type="email" name="email" id="email" class="form-control" required>
                    </div>
                    <div>
                        <label class="form-label" for="password">Password</label>
                        <input type="password" name="password" id="password" class="form-control" required>
                    </div>
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
                        url: "{{ route('user.permission.index') }}",
                        type: "get",
                    },

                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex',
                            orderable: false,
                            searchable: false
                        },
                        {
                            data: 'name',
                            name: 'name',
                            orderable: true,
                            searchable: true
                        },
                        {
                            data: 'permissions',
                            name: 'permissions',
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
        //modal close function
        function modalCloseFunction() {
            document.getElementById('addUserForm').reset();
            document.getElementById('modalSubmitBtn').innerHTML = 'Save Changes';
            document.getElementById('addModalTitle').innerHTML = 'Add User';
            $('#addModal').modal('hide');
        }
        // Add Or Update
        function addNewUser() {
            let username = document.getElementById('username').value;
            let name = document.getElementById('name').value;
            let email = document.getElementById('email').value;
            let password = document.getElementById('password').value;
            console.log(name, username, email, password)
            $.ajax({
                type: "POST",
                url: '{{ route('admin.dashboard.user') }}',
                data: {
                    username: username,
                    name: name,
                    email: email,
                    password: password,
                },
                success: function(resp) {
                    // Reloade DataTable
                    $('#data-table').DataTable().ajax.reload();
                    if (resp.success === true) {
                        modalCloseFunction();
                        toastr.success(resp.message);
                    } else if (resp.success === false) {
                        if (resp.data.email) {
                            toastr.error(resp.data.email);
                        } else if (resp.data.password) {
                            toastr.error(resp.data.password);
                        } else {
                            toastr.error(resp.message);
                        }
                    }
                }, // success end
                error: function(error) {
                    toastr.error('Something went wrong');
                } // Error
            })
        }
        document.getElementById('addUserForm').addEventListener('submit', (e) => {
            e.preventDefault();
            addNewUser();
        });
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
            var url = '{{ route('destroy.dashboard.user', ':id') }}';
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
