@extends('backend.app')

<!-- Title -->
@section('title', 'List of Quiz')

@push('style')

    .dataTables_filter 
    {
        text-align: right;
    }

    .dataTables_filter input 
    {
        text-align: right;
    }
@endpush

{{-- Main Content --}}
@section('content')
    <div class="app-content-area">
        <div class="container-fluid">
            <!-- row -->
            <div class="row mt-5">
                <div class="col-12">
                    <div class="text-end d-flex mx-3 justify-content-between align-items-center mb-4">
                        {{-- <h3>Categories</h3>
                            <a class="btn btn-primary mb-3"  href="{{route('questions.create')}}">
                                Add Question
                            </a> --}}
                    </div>
                    <div class="mb-6 card mx-3">
                        <div class="tab-content p-5" id="pills-tabContent-table">
                            <div class="tab-pane tab-example-design fade show active" id="pills-table-design" role="tabpanel" aria-labelledby="pills-table-design-tab">
                                <div class="row">
                                    <div class="form-group mb-3 col-3">
                                        <div class="">
                                            <label class="form-label" for="quizTitle">Quiz Title</label>
                                            <input type="text" name="quizTitle" id="quiz-title"
                                                class="form-control {{ $errors->has('quizTitle') ? 'is-invalid' : '' }}"
                                                value="{{$quizzes->title }}" required>
                                            @if ($errors->has('quizTitle'))
                                                <div class="invalid-feedback">
                                                    {{ $errors->first('quizTitle') }}
                                                </div>
                                            @endif
                                        </div>
                                        {{-- <label for="quiz-dropdown" class="mb-3 form-label">Quiz Title</label>
                                        <select id="quiz-dropdown" name="quizTitle" class="form-control">
                                            <option value="" hidden>Select One Quiz</option>
                                            @foreach ($quizzes as $quiz)
                                                <option value="{{$quiz->id}}">{{$quiz->title}}</option>
                                            @endforeach
                                        </select> --}}
                                    </div>
                                    <div class="form-group mb-3 col-3">
                                        <label for="quizTime" class="mb-3 form-label">Quiz Time</label>
                                        <input type="number" name="quizTime" id="quizTime" class="form-control" placeholder="Only Minutes" value="{{$quizzes->total_time }}">
                                    </div>
                                    <div class="form-group mb-3 col-3">
                                        <label for="course-dropdown" class="mb-3 form-label">Course Title</label>
                                        <select id="course-dropdown" name="quizCourse" class="form-control">
                                            <option value="" hidden>Select One Course</option>
                                            @foreach ($courses as $course)
                                            <option value="{{ $course->id }}" {{ $quizzes->course_id == $course->id ? 'selected' : '' }}>{{ $course->course_title }} </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    {{-- <div class="form-group mb-3 col-3" >
                                        <label for="category-dropdown" class="mb-3 form-label">Category Search</label>
                                        <select class="js-example-basic-multiple form-control" id="category-dropdown" name="quizCategory[]" multiple>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div> --}}
                                </div>
                                <div class="table-responsive">
                                    <table id="data-table" class="table table-striped text-center w-100 display responsive nowrap" cellspacing="0" width="100%">
                                        <thead>
                                            <tr class="table-dark">
                                                <th><input type="checkbox" id="select-all"></th>
                                                {{-- <td>
                                                    <input type="checkbox" class="select-row" data-id="{{ $question->id }}" 
                                                        @if(in_array($question->id, $quiz->questions->pluck('id')->toArray())) checked @endif>
                                                </td> --}}
                                                <th>SL#</th>
                                                <th>Question Title</th>
                                                <th>Question Category</th>
                                                <th>Correct Answer</th>
                                                {{-- <th>Action</th> --}}
                                            </tr>
                                        </thead>
                                        <tbody class="align-middle">
                                        </tbody>
                                    </table>
                                </div>
                                <button id="submitSelected" class="btn btn-primary">Update Quiz</button>
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
    <script>
        // delete Confirm
        // function showDeleteConfirm(id) {
        //     event.preventDefault();
        //     swal({
        //         title: `Are you sure you want to delete this record?`,
        //         text: "If you delete this, it will be gone forever.",
        //         buttons: true,
        //         dangerMode: true,
        //     }).then((willDelete) => {
        //         if (willDelete) {
        //             deleteItem(id);
        //         }
        //     });
        // };

        // Delete Button
        // function deleteItem(id) {
        //     var url = '{{ route("questions.destroy", ':id') }}';
        //     $.ajax({
        //         type: "POST",
        //         url: url.replace(':id', id),
        //         success: function(resp) {
        //             // Reloade DataTable
        //             $('#data-table').DataTable().ajax.reload();
        //             if (resp.success === true) {
        //                 setTimeout(function() {
        //                     location.reload(); // Reload the page after 1.5 seconds
        //                 }, 1500);

        //                 // show toast message
        //                 toastr.success(resp.message);
                        

        //             } else if (resp.errors) {
        //                 toastr.error(resp.errors[0]);
        //             } else {
        //                 toastr.error(resp.message);
        //             }
        //         }, // success end
        //         error: function(error) {
        //             // location.reload();
        //         } // Error
        //     })
        // }
    </script>
    
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {
            $('.js-example-basic-multiple').select2();
        });
    </script>


    <script>
        $(document).ready(function(id) {
        var selectedQuestions = @json($selectedQuestions);
        var dTable = $('#data-table').DataTable({
            order: [],
            processing: true,
            responsive: true,
            serverSide: true,
            ajax: {
                url: '{{ route("quizzes.edit", $quizzes->id) }}', 
                type: "GET",
                data: function(d) {
                            var selectedCategories = $('#category-dropdown').val();
                            d.category = selectedCategories;
                        }
            },
            columns: [
                {
                    searchable: false,
                    data: null,
                    orderable: false,
                    render: function(data, type, row) {
                        var isChecked = selectedQuestions.includes(row.id) ? 'checked' : '';
                        return `
                            <td>
                                <input type="checkbox" class="select-row" data-id="${row.id}" ${isChecked}>
                            </td>
                        `;
                    }
                },
                { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                { data: 'question_text', name: 'question_text' },
                { data: 'category', name: 'category' },
                { data: 'is_correct', name: 'is_correct' },
                // { data: 'action', name: 'action', orderable: false, searchable: false },
            ]
        });
        
        $('#select-all').on('click', function() {
            var isChecked = this.checked;
            $('#data-table input.select-row').each(function() {
                this.checked = isChecked;
            });
        });

        $('#submitSelected').on('click', function() {
            var quizTitle = $('#quiz-title').val();
            var quizTime = $('#quizTime').val(); 
            var selectedCourse = $('#course-dropdown').val();
            var selectedRows = [];
                $('#data-table input.select-row:checked').each(function() {
                        selectedRows.push($(this).data('id')); 
                    });
                    if (!quizTitle || !selectedCourse || !quizTime || selectedRows.length === 0) {
                        alert("Please fill in all fields and select at least one question.");
                        return;
                    }
                        $.ajax({
                            url: "{{ route('quizzes.update',$quizzes->id) }}",  
                            method: "POST",
                            data: {
                                quiz_title: quizTitle,
                                time: quizTime,
                                course_id: selectedCourse,
                                question_ids: selectedRows,
                                _token: $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function(response) {
                                toastr.success('Quiz updated successfully!');
                                setTimeout(function() {
                                    // location.reload();
                                    window.location.href = '{{ route("quizzes.view") }}';
                                }, 500); 
                                console.log(response);
                            },
                            error: function(xhr) {
                                if (xhr.status === 422) {
                                    var errors = xhr.responseJSON.errors;
                                    var errorMessages = '';
                                    $.each(errors, function(field, messages) {
                                        errorMessages += messages.join(', ') + '\n';
                                    });
                                    alert('Validation errors: \n' + errorMessages);
                                } else {
                                    toastr.success('An error occurred while submitting the data.!');
                                }
                                console.log(xhr.responseText);
                            }
                        });
                    });
            $('#category-dropdown').on('change', function() {
            dTable.ajax.reload();
            });
        });
    </script>

@endpush