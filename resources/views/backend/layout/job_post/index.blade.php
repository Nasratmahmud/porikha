@extends('backend.app')

<!-- Title -->
@section('title', 'List of Job Posts')

{{-- Main Content --}}
@section('content')

    <div class="app-content-area">
        <div class="container-fluid">
            <!-- row -->
            <div class="row mt-5">
                <div class="col-12">
                    <div class="text-end d-flex mx-3 justify-content-between align-items-center mb-4">
                        <h3>Job Posts</h3>
                    </div>
                    <div class="mb-6 card mx-3">
                        <!-- Tab content -->
                        <div class="tab-content p-5" id="pills-tabContent-table">
                            <div class="tab-pane tab-example-design fade show active" id="pills-table-design" role="tabpanel"
                                aria-labelledby="pills-table-design-tab">
                                <!-- Basic table -->
                                <div class="table-responsive">
                                    <table id="data-table"
                                        class="table table-striped text-center w-100 display responsive nowrap"
                                        cellspacing="0" width="100%">
                                        <thead>
                                            <tr class="table-dark">
                                                <th>SL#</th>
                                                <th>Title</th>
                                                <th>Company</th>
                                                <th>Logo</th>
                                                <th>Position</th>
                                                <th>Deadline</th>
                                                <th>Type</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody class="align-middle">
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
    <div class="modal fade" id="rejectedModal" tabindex="-1" role="dialog" aria-labelledby="addModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <form id="addUserForm" class="modal-content" action="{{route('reject.reson')}}" method="POST">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalTitle">Reject Reason</h5>
                </div>
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="user_id" readonly id="user_id_input">
                    <input type="hidden" name="job_id" readonly id="job_id_input">
                    <div>
                        <label class="form-label" for="username">Reason</label>
                        <textarea name="reson" class="form-control" id="" cols="30" rows="10"></textarea>
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
                        url: "{{ route('job.post') }}",
                        type: "get",
                    },

                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex',
                            orderable: false,
                            searchable: false
                        },
                        {
                            data: 'title',
                            name: 'title',
                            orderable: true,
                            searchable: true
                        },
                        {
                            data: 'company.name',
                            name: 'company.name',
                            orderable: true,
                            searchable: true
                        },
                        {
                            data: 'logo',
                            name: 'logo',
                            orderable: true,
                            searchable: true
                        },
                        {
                            data: 'position',
                            name: 'position',
                            orderable: true,
                            searchable: true
                        },

                        {
                            data: 'deadline',
                            name: 'deadline',
                            orderable: true,
                            searchable: true
                        },
                        {
                            data: 'type',
                            name: 'type',
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
                            orderable: true,
                            searchable: true
                        },
                    ],
                });

                dTable.buttons().container().appendTo('#file_exports');

                new DataTable('#example', {
                    responsive: true
                });
            }
        });

        // Status Change Confirm Alert
        function showStatusChangeAlert(id, status) {
            event.preventDefault();
            swal({
                title: `Are you sure?`,
                text: "You want to update the status?.",
                buttons: true,
                infoMode: true,
            }).then((willStatusChange) => {
                if (willStatusChange) {
                    statusChange(id, status);
                }
            });
        };

        // Status Change
        function statusChange(id, status) {
            $.ajax({
                type: "post",
                url: '{{ route('job.post.status', ['id' => ':id']) }}'.replace(':id', id),
                data: {
                    "_token": "{{ csrf_token() }}",
                    "id": id,
                    "status": status.value
                },
                success: function(resp) {
                    // Reload DataTable
                    $('#data-table').DataTable().ajax.reload();
                    if (resp.success === true) {
                        // show toast message
                        toastr.success(resp.message);
                        if (resp.data.status == 3) {
                            $("#user_id_input").val(resp.data.user_id);
                            $("#job_id_input").val(resp.data.id);
                            $('#rejectedModal').modal('show');
                        }
                    } else if (resp.errors) {
                        toastr.error(resp.errors[0]);
                    } else {
                        toastr.error(resp.message);
                    }
                },
                error: function(error) {
                    // Handle error
                }
            });

        }
    </script>
@endpush
