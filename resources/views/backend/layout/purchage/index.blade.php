@extends('backend.app')
@section('title', 'List of purchase')

@push('style')

@endpush

@section('content')
    <div class="app-content-area">
        <div class="container-fluid">
            <div class="row mt-5">
                <div class="col-12">
                    {{-- <div class="text-end d-flex mx-3 justify-content-between align-items-center mb-4">
                        <h3>Quizzes</h3>
                            <a class="btn btn-primary mb-3"  href="{{route('quizzes.index')}}">
                                Create Quiz
                            </a>
                    </div> --}}
                    <div class="mb-6 card mx-3">
                        <div class="tab-content p-5" id="pills-tabContent-table">
                            <div class="tab-pane tab-example-design fade show active" id="pills-table-design"
                                role="tabpanel" aria-labelledby="pills-table-design-tab">
                                <div class="table-responsive">
                                    <table id="data-table"
                                        class="table table-striped text-center w-100 display responsive nowrap"
                                        cellspacing="0" width="100%">
                                        <thead>
                                            <tr class="table-dark">
                                                <th>User Name</th></th>
                                                <th>Course Name</th>
                                                <th>Amount</th>
                                                <th>Status</th>
                                                <th>Pdf</th>
                                            </tr>
                                        </thead>
                                        <tbody class="align-middle">
                                            <tr>
                                                <td>{{ $name }}</td>
                                                <td>{{ $coursesList }}</td>
                                                <td>{{ $price }}</td>
                                                <td>{{ $status }}</td>
                                                <td>
                                                    {{-- @dd($userId); --}}
                                                     <a href="{{ $userId ? route('invoice.download', ['purchaseId' => $userId  ]) : '#' }}" class="btn btn-success">
                                                        {{ $userId ? Download : '' }}
                                                    </a>
                                                </td>
                                            </tr> 
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
    {{-- <script>

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
                                url: "{{ route('quizzes.view') }}",
                                type: "get",
                            },
                            ajax: JSON.parse(response),
                            
                            columns: [{
                                    data: 'DT_RowIndex',
                                    name: 'DT_RowIndex',
                                    orderable: false,
                                    searchable: false
                                },
                                {
                                    data: 'total_time',
                                    name: 'quizTime',
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
        });

        
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
        
        function deleteItem(id) {
            var url = '{{ route("quizzes.destroy", ':id') }}';
                $.ajax({
                    type: "POST",
                    url: url.replace(':id', id),
                    data: {
                    _method: 'DELETE', // HTTP method to indicate a DELETE request
                    _token: $('meta[name="csrf-token"]').attr('content'), // CSRF token
                    },
                        success: function(resp) {
                            if (resp.success) {
                                $('#data-table').DataTable().ajax.reload();
                            } else {
                            setTimeout(function() {
                                location.reload();
                                    alert('Success to delete the quiz: ');
                                }, 500);
                            }
                        },
                        error: function(error) {
                                // location.reload();
                            console.error(error);
                            alert("There was an error while deleting the item.");
                        }
                })
        }
    </script> --}}
@endpush