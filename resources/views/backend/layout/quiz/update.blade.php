@extends('backend.app')

<!-- Start:Title -->
@section('title', 'Edit Quize')
<!-- End:Title -->
@push('style')
    {{-- TagInput css cdn  --}}
    <link rel="stylesheet" type="text/css"
        href="{{ asset('https://cdn.jsdelivr.net/bootstrap.tagsinput/0.8.0/bootstrap-tagsinput.css') }}">
    {{-- Dropify Css cdn  --}}
    <link rel="stylesheet" href="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css') }}" />
    <style type="text/css">
        /* tag input css  */
        .bootstrap-tagsinput {
            padding: 8px;
        }

        .bootstrap-tagsinput .tag {
            padding: .3rem;
            border-radius: 5px;
            background: #624bff;
            color: #fff;
        }

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
                        <h2>Update a Quiz</h2>
                        <a class="bg-transparent" href="{{ route('quiz.index') }}">
                            <i class="bi bi-chevron-left"></i> Back to Quiz Page
                        </a>
                    </div>
                    <!-- card -->
                    <div class="card mb-4 mx-5">
                        <!-- card body -->
                        <div class="card-body">
                            <h3 class="pt-3">Quiz</h3>
                            <form action="{{ route('quiz.update') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <input type="hidden" name="quiz_id" readonly value="{{ $quiz->id }}">
                                    <!-- Input Item -->
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label" for="title">Title</label>
                                        <input type="text" name="title" id="title"
                                            class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}"
                                            value="{{ $quiz->title }}" placeholder="Title...">
                                        @if ($errors->has('title'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('title') }}
                                            </div>
                                        @endif
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="time" class="form-label">Time</label>
                                        <select
                                            class="form-select text-capitalize {{ $errors->has('time') ? 'is-invalid' : '' }}"
                                            id="time" required="" name="time">
                                            <option selected disabled>Choose Time...</option>
                                            <option value="10" {{ $quiz->time == 10 ? 'selected' : '' }}>10 Minutes
                                            </option>
                                            <option value="15" {{ $quiz->time == 15 ? 'selected' : '' }}>15 Minutes
                                            </option>
                                            <option value="20" {{ $quiz->time == 20 ? 'selected' : '' }}>20 Minutes
                                            </option>
                                            <option value="25" {{ $quiz->time == 25 ? 'selected' : '' }}>25 Minutes
                                            </option>
                                            <option value="30" {{ $quiz->time == 30 ? 'selected' : '' }}>30 Minutes
                                            </option>
                                            <option value="35" {{ $quiz->time == 35 ? 'selected' : '' }}>35 Minutes
                                            </option>
                                            <option value="40" {{ $quiz->time == 40 ? 'selected' : '' }}>40 Minutes
                                            </option>
                                            <option value="45" {{ $quiz->time == 45 ? 'selected' : '' }}>45 Minutes
                                            </option>
                                        </select>
                                        @if ($errors->has('time'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('time') }}
                                            </div>
                                        @endif
                                    </div>
                                    <!-- Input Item -->
                                    <div class="col-md-6 mb-3">
                                        <label for="course_id" class="form-label">Course</label>
                                        <select
                                            class="form-select text-capitalize {{ $errors->has('course_id') ? 'is-invalid' : '' }}"
                                            id="course_id" required name="course_id">
                                            <option selected disabled>Choose Course...</option>
                                            @foreach ($courses as $course)
                                                <option value="{{ $course['id'] }}"
                                                    {{ $quiz->course_id == $course['id'] ? 'selected' : '' }}
                                                    class="text-capitalize">
                                                    {{ $course['course_title'] }}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('course_id'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('course_id') }}
                                            </div>
                                        @endif
                                    </div>

                                    <!--- Input Item -->
                                    <div class="col-md-6 mb-3">
                                        <label for="module_id" class="form-label">Module</label>
                                        <select
                                            class="form-select text-capitalize {{ $errors->has('module_id') ? 'is-invalid' : '' }}"
                                            id="module_id" required="" name="module_id">
                                            @foreach ($modules as $module)
                                                <option value="{{ $module['id'] }}"
                                                    {{ $quiz->course_module_id == $module['id'] ? 'selected' : '' }}
                                                    class="text-capitalize">
                                                    {{ $module['course_module_name'] }}</option>
                                            @endforeach

                                        </select>
                                        @if ($errors->has('module_id'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('module_id') }}
                                            </div>
                                        @endif
                                    </div>
                                    <div>

                                        <button type="submit" class="btn px-5 btn-primary">Update</button>
                                    </div>
                            </form>


                            <h3 class="pt-4">Questions</h3>


                            @if ($quiz->quistions != null)
                                @php
                                    $sn = 0;
                                @endphp
                                @foreach ($quiz->quistions as $quistion)
                                    @php
                                        $sn++;
                                    @endphp
                                    <div class="accordion my-5" id="moduleAccordion">
                                        <div class="accordion-item" id="accordionItem_{{ $sn }}">
                                            <h2 class="accordion-header" id="heading_{{ $sn }}">
                                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                                    data-bs-target="#collapse_{{ $sn }}" aria-expanded="true"
                                                    aria-controls="collapse_{{ $sn }}">
                                                    Question {{ $sn }}
                                                </button>
                                            </h2>
                                            <div id="collapse_{{ $sn }}" class="accordion-collapse collapse"
                                                aria-labelledby="heading_{{ $sn }}"
                                                data-bs-parent="#moduleAccordion">
                                                <div class="accordion-body">
                                                    <form action="{{ route('question.update') }}" method="POST">
                                                        @csrf
                                                        <input type="hidden" name="quiz_id" value="{{ $quiz->id }}"
                                                            readonly>
                                                        <div class="row">
                                                            <div class="col-md-6 mb-3">
                                                                <label class="form-label">Question</label>
                                                                <input type="text" name="question" class="form-control"
                                                                    value="{{ $quistion->question }}" required>
                                                            </div>
                                                            <div class="col-md-6 mb-3">

                                                                <input type="hidden" name="question_id"
                                                                    value="{{ $quistion->id }}" readonly>

                                                                {{-- Type --}}
                                                                <label for="type" class="form-label">Type</label>
                                                                <select class="form-select text-capitalize"
                                                                    id="type_{{ $sn }}"
                                                                    onchange="DisableOption({{ $sn }})" required
                                                                    name="type">
                                                                    <option selected disabled>Choose type...</option>
                                                                    <option value="1"
                                                                        {{ $quistion->type == 1 ? 'selected' : '' }}>MCQ
                                                                    </option>
                                                                    <option value="2"
                                                                        {{ $quistion->type == 2 ? 'selected' : '' }}>Fill
                                                                        in the gap</option>
                                                                </select>

                                                            </div>
                                                            <div class="col-md-6 mb-3">
                                                                {{-- Option 1 --}}
                                                                <label class="form-label">Option One</label>
                                                                <input type="text"
                                                                    value="{{ $quistion->option_one ? $quistion->option_one : '' }}"
                                                                    name="option_one" id="option_one_{{ $sn }}"
                                                                    placeholder="Option One... " class="form-control">

                                                            </div>
                                                            <div class="col-md-6 mb-3">
                                                                {{-- Option 2 --}}
                                                                <label class="form-label">Option Two</label>
                                                                <input type="text"
                                                                    value="{{ $quistion->option_two ? $quistion->option_two : '' }}"
                                                                    name="option_two" id="option_two_{{ $sn }}"
                                                                    placeholder="Option Two... " class="form-control">

                                                            </div>
                                                            <div class="col-md-6 mb-3">
                                                                {{-- Option 3 --}}
                                                                <label class="form-label">Option Three</label>
                                                                <input type="text" name="option_three"
                                                                    class="form-control"
                                                                    id="option_three_{{ $sn }}"
                                                                    placeholder="Option Three... "
                                                                    value="{{ $quistion->option_three ? $quistion->option_three : '' }}">

                                                            </div>
                                                            <div class="col-md-6 mb-3">
                                                                {{-- Option 4 --}}
                                                                <label class="form-label">Option Four</label>
                                                                <input type="text" name="option_four"
                                                                    placeholder="Option Five... " class="form-control"
                                                                    id="option_four_{{ $sn }}"
                                                                    value="{{ $quistion->option_four ? $quistion->option_four : '' }}">

                                                            </div>
                                                            <div class="col-md-12 mb-3">
                                                                {{-- Answer --}}
                                                                <label class="form-label">Answer</label>
                                                                <input type="text" name="answer" class="form-control"
                                                                    value="{{ $quistion->answer }}" required>

                                                            </div>
                                                            <div class="col-md-12 mb-3">
                                                                {{-- Note (Reach Tex) --}}
                                                                <label class="form-label" for="book_summary">
                                                                    Note (Optional)
                                                                </label>
                                                                <textarea name="note" class="form-control" id="note" cols="30" rows="10">{{ $quistion->note ? $quistion->note : '' }}</textarea>

                                                            </div>
                                                            <div>
                                                                <button type="submit" class="btn btn-primary ">
                                                                    Update
                                                                </button>
                                                                <button type="button" class="btn btn-danger"
                                                                    onclick="removeModuleItem({{ $quistion->id }},{{ $sn }})">
                                                                    Delete
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <h1 class="text-center">Question Not Found</h1>
                            @endif

                            <div class="col-12">
                                <button type="submit" class="btn btn-info text-white w-auto px-5">Update</button>
                                <a href="{{ route('quiz.index') }}" class="btn btn-danger text-white w-auto">Cancel</a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
    </div>
@endsection
<!-- Start:Script -->
@push('script')
    <!-- sweetalert -->
    <script type="text/javascript" src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <script>
        //initialized dropify
        $(document).ready(function() {
            $('.dropify').dropify();
        });

        // Desable Option Field When Select Type (Fill In the gap)
        function DisableOption(item) {
            if ($(`#type_${item}`).val() == 2) {
                $(`#option_one_${item}`).val('');
                $(`#option_one_${item}`).attr('disabled', 'disabled');
                $(`#option_two_${item}`).val('');
                $(`#option_two_${item}`).attr('disabled', 'disabled');
                $(`#option_three_${item}`).val('');
                $(`#option_three_${item}`).attr('disabled', 'disabled');
                $(`#option_four_${item}`).val('');
                $(`#option_four_${item}`).attr('disabled', 'disabled');
            }

            if ($(`#type_${item}`).val() == 1) {
                $(`#option_one_${item}`).val('');
                $(`#option_one_${item}`).removeAttr("disabled");
                $(`#option_two_${item}`).val('');
                $(`#option_two_${item}`).removeAttr("disabled");
                $(`#option_three_${item}`).val('');
                $(`#option_three_${item}`).removeAttr("disabled");
                $(`#option_four_${item}`).val('');
                $(`#option_four_${item}`).removeAttr("disabled");
            }
        }



        //module item remove function
        function removeModuleItem(id, itemmoduleIndex) {
            event.preventDefault();

            swal({
                title: `Are you sure?`,
                text: "You want to Delete This Question?.",
                buttons: true,
                infoMode: true,
            }).then((willStatusChange) => {
                if (willStatusChange) {
                    const itemToRemove = document.getElementById(`accordionItem_${itemmoduleIndex}`);
                    if (itemToRemove) {
                        itemToRemove.remove();
                    }
                    deletequestion(id);
                }
            });

        }

        function deletequestion(id) {

            var url = '{{ route('question.destroy', ':id') }}';
            $.ajax({
                type: "DELETE",
                url: url.replace(':id', id),
                success: function(resp) {
                    // Reloade DataTable
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


        $('#course_id').change(function() {
            var courseId = $(this).val();
            var url = '{{ route('course.module', ':id') }}';
            if (courseId) {

                $.ajax({
                    type: "GET",
                    url: url.replace(':id', courseId),
                    success: function(resp) {
                        console.log(resp)
                        toastr.success(resp.message);
                        $('#module_id').empty();
                        $('#module_id').append('<option value="">Select a Module</option>');
                        $.each(resp.data, function(key, value) {
                            $('#module_id').append('<option value="' + value.id +
                                '">' + value.course_module_name + '</option>');
                        });
                    }, // success end
                    error: function(error) {
                        toastr.error(error);
                        $('#module_id').empty();
                        $('#module_id').append('<option value="">Select a Module</option>');
                    } // Error
                })
            } else {
                $('#module_id').empty();
                $('#module_id').append('<option value="">Select a Module</option>');
            }
        });
    </script>
@endpush
<!-- End:Script -->
