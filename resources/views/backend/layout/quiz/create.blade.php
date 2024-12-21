@extends('backend.app')

<!-- Start:Title -->
@section('title', 'Add New Quize')
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
                        <h2>Create a Quiz</h2>
                        <a class="bg-transparent" href="{{ route('quiz.index') }}">
                            <i class="bi bi-chevron-left"></i> Back to Quiz Page
                        </a>
                    </div>
                    <!-- card -->
                    <div class="card mb-4 mx-5">
                        <!-- card body -->
                        <div class="card-body">
                            <form action="{{ route('quiz.store') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <!-- Input Item -->
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label" for="title">Title</label>
                                        <input type="text" name="title" id="title"
                                            class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}"
                                            value="{{ old('title') }}" placeholder="Title...">
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
                                            <option value="10">10 Minutes</option>
                                            <option value="15">15 Minutes</option>
                                            <option value="20">20 Minutes</option>
                                            <option value="25">25 Minutes</option>
                                            <option value="30">30 Minutes</option>
                                            <option value="35">35 Minutes</option>
                                            <option value="40">40 Minutes</option>
                                            <option value="45">45 Minutes</option>
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
                                            id="course_id" required="" name="course_id">
                                            <option selected disabled>Choose Course...</option>
                                            @foreach ($courses as $course)
                                                <option value="{{ $course['id'] }}"
                                                    {{ old('course_id') == $course['id'] ? 'selected' : '' }}
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
                                            <option selected disabled>Choose Module...</option>

                                        </select>
                                        @if ($errors->has('module_id'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('module_id') }}
                                            </div>
                                        @endif
                                    </div>


                                    <div class="accordion my-5" id="moduleAccordion">
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="heading_1">
                                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                                    data-bs-target="#collapse_1" aria-expanded="true"
                                                    aria-controls="collapse_1">
                                                    Question 1
                                                </button>
                                            </h2>
                                            <div id="collapse_1" class="accordion-collapse collapse show"
                                                aria-labelledby="heading_1" data-bs-parent="#moduleAccordion">
                                                <div class="accordion-body">
                                                    <div class="row">
                                                        <div class="col-md-6 mb-3">
                                                            <label class="form-label">Question</label>
                                                            <input type="text" name="question[]" class="form-control"
                                                                placeholder="Question...." required>
                                                            <div class="invalid-feedback">Question Title Required</div>
                                                        </div>
                                                        <div class="col-md-6 mb-3">
                                                            {{-- Type --}}
                                                            <label for="type" class="form-label">Type</label>
                                                            <select class="form-select text-capitalize" id="type_1"
                                                                onchange="DisableOption(1)" required name="type[]">
                                                                <option selected disabled>Choose type...</option>
                                                                <option value="1">MCQ</option>
                                                                <option value="2">Fill in the gap</option>
                                                            </select>

                                                        </div>
                                                        <div class="col-md-6 mb-3">
                                                            {{-- Option 1 --}}
                                                            <label class="form-label">Option One</label>
                                                            <input type="text" placeholder="Option One...."
                                                                name="option_one[]" id="option_one_1"
                                                                class="form-control">

                                                        </div>
                                                        <div class="col-md-6 mb-3">
                                                            {{-- Option 2 --}}
                                                            <label class="form-label">Option Two</label>
                                                            <input type="text" name="option_two[]"
                                                                class="form-control" id="option_two_1"
                                                                placeholder="Option Two....">

                                                        </div>
                                                        <div class="col-md-6 mb-3">
                                                            {{-- Option 3 --}}
                                                            <label class="form-label">Option Three</label>
                                                            <input type="text" name="option_three[]"
                                                                id="option_three_1" class="form-control"
                                                                placeholder="Option Three....">

                                                        </div>
                                                        <div class="col-md-6 mb-3">
                                                            {{-- Option 4 --}}
                                                            <label class="form-label">Option Four</label>
                                                            <input type="text" name="option_four[]" id="option_four_1"
                                                                class="form-control" placeholder="Option Four....">

                                                        </div>
                                                        <div class="col-md-12 mb-3">
                                                            {{-- Answer --}}
                                                            <label class="form-label">Answer</label>
                                                            <input type="text" name="answer[]" class="form-control"
                                                                placeholder="Answer...." required>

                                                        </div>
                                                        <div class="col-md-12 mb-3">
                                                            {{-- Note (Reach Tex) --}}
                                                            <label class="form-label" for="book_summary">
                                                                Note (Optional)
                                                            </label>
                                                            <textarea name="note[]" placeholder="Note Write Here...." class="form-control" id="note" cols="30"
                                                                rows="10">{{ old('note') }}</textarea>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>



                                    <div class="col-12">
                                        <button type="submit"
                                            class="btn btn-success text-white w-auto px-5">Save</button>
                                        <button type="button" onclick="addModuleItem()" id="addQuestion"
                                            class="btn btn-primary text-white w-auto px-5">Add Question</button>
                                    </div>
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
    {{-- TagInput cdn  --}}
    <script src="{{ asset('https://cdn.jsdelivr.net/bootstrap.tagsinput/0.8.0/bootstrap-tagsinput.min.js') }}"></script>
    {{-- Dropify Cdn  --}}
    <script src="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js') }}"></script>
    {{-- Editor Cdn  --}}
    <script src="{{ asset('https://cdn.ckeditor.com/ckeditor5/35.1.0/classic/ckeditor.js') }}"></script>
    <script>
        //initialized dropify
        $(document).ready(function() {
            $('.dropify').dropify();
        });



        let moduleIndex = 1;
        //Module item add function
        function addModuleItem() {
            moduleIndex++;
            let newModuleItem = document.createElement('div');
            newModuleItem.className = 'accordion-item';
            newModuleItem.id = `accordionItem_${moduleIndex}`;

            newModuleItem.innerHTML = `
            <h2 class="accordion-header" id="heading_${moduleIndex}">
                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                    data-bs-target="#collapse_${moduleIndex}" aria-expanded="true"
                    aria-controls="collapse_${moduleIndex}">
                    Question ${moduleIndex}
                    
                </button>
            </h2>
            <div id="collapse_${moduleIndex}" class="accordion-collapse collapse show"
                aria-labelledby="heading_${moduleIndex}" data-bs-parent="#moduleAccordion">
                <div class="accordion-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Question</label>
                            <input type="text" name="question[]" class="form-control"
                                placeholder="Question" required>
                            <div class="invalid-feedback">Question Title Required</div>
                        </div>
                        <div class="col-md-6 mb-3">
                            {{-- Type --}}
                            <label for="type" class="form-label">Type</label>
                            <select
                                class="form-select text-capitalize"
                                id="type_${moduleIndex}" required name="type[]" onchange="DisableOption(${moduleIndex})">
                                <option selected disabled>Choose type...</option>
                                <option value="1">MCQ</option>
                                <option value="2">Fill in the gap</option>
                            </select>
                            
                        </div>
                        <div class="col-md-6 mb-3">
                            {{-- Option 1 --}}
                            <label class="form-label">Option One</label>
                            <input type="text" id="option_one_${moduleIndex}" name="option_one[]" class="form-control"
                                placeholder="Option One...." >
                            
                        </div>
                        <div class="col-md-6 mb-3">
                            {{-- Option 2 --}}
                            <label class="form-label">Option Two</label>
                            <input type="text" id="option_two_${moduleIndex}" name="option_two[]"
                                class="form-control" placeholder="Option Two...."
                                >
                            
                        </div>
                        <div class="col-md-6 mb-3">
                            {{-- Option 3 --}}
                            <label class="form-label">Option Three</label>
                            <input type="text" id="option_three_${moduleIndex}" name="option_three[]"
                                class="form-control" placeholder="Option Three...."
                                >
                            
                        </div>
                        <div class="col-md-6 mb-3">
                            {{-- Option 4 --}}
                            <label class="form-label">Option Four</label>
                            <input type="text" id="option_four_${moduleIndex}" name="option_four[]"
                                class="form-control" placeholder="Option Four...."
                                >
                            
                        </div>
                        <div class="col-md-12 mb-3">
                            {{-- Answer --}}
                            <label class="form-label">Answer</label>
                            <input type="text" name="answer[]" class="form-control"
                                placeholder="Answer..." required>
                            
                        </div>
                        <div class="col-md-12 mb-3">
                            {{-- Note (Reach Tex) --}}
                            <label class="form-label" for="book_summary">
                                Note (Optional)
                            </label>
                            <textarea name="note[]"  class="form-control"
                                id="note${moduleIndex}" cols="30" rows="10">{{ old('note') }}</textarea>
                            
                        </div>
                        <div>
                            <button type="button" class="btn btn-danger btn-sm"  onclick="removeModuleItem(${moduleIndex})">
                                Remove
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            
            `;

            document.getElementById('moduleAccordion').appendChild(newModuleItem);
        }

        //module item remove function
        function removeModuleItem(itemmoduleIndex) {
            const itemToRemove = document.getElementById(`accordionItem_${itemmoduleIndex}`);
            if (itemToRemove) {
                itemToRemove.remove();
            }
        }

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
