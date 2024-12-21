@extends('frontend.app')



<!-- Start:Title -->

@section('title', $course->course_title)

<!-- End:Title -->

@push('style')
    <style>
        .courses-video-modul {

            padding: 20px;

        }



        .video iframe {
            background: transparent;
            height: 520px;

        }



        @media only screen and (min-width: 361px) and (max-width: 479px) {

            .video iframe {

                height: 250px;

            }



            h6 {

                font-size: .8rem !important;

                font-weight: 500 !important;

            }

        }



        @media only screen and (min-width: 480px) and (max-width: 767px) {

            .video iframe {

                height: 350px;

            }

        }



        .course_content-list-item {

            align-items: flex-start !important;

        }



        @media only screen and (max-width:480px) {

            h3 {

                font-size: 1rem;

            }

        }

        .dash-breadcrumb-tree {
            padding: 20px 30px 0;
        }

        .courses-video,
        .courses-audio {
            padding: 20px 30px;
        }
    </style>
@endpush

<!-- Start:Content -->

@section('content')

    <div class="app-content-area">

        <!-- Dashboard :: Left -> Start -->

        <main class="dashboard-content-wrapper p-0">

            <div class="courses-section p-0">

                <!-- Dashboard Breadcrumb :: Start -->

                <section id="dash-breadcrumb" class="dash-breadcrumb-tree">

                    <div class=""></div>

                    <h3 class="dash-active-page">{{ $course->course_title }}</h3>

                    <ul class="m-0 p-0">

                        <li class="d-inline-block"><a class="bg-transparent"
                                href="{{ route('user.dashboard') }}">Dashboard</a></li>

                        <li class="d-inline-block"><i class="bi bi-chevron-right"></i></li>

                        <li class="d-inline-block">{{ $course->course_title }}</li>

                    </ul>

                </section>

                <!-- Dashboard Breadcrumb :: End -->

                <div class="courses-video">

                    <div class="d-flex justify-content-between  courses-video-section">

                        <div class="courses-video-modul">

                            {{-- Complete module percentage progress bar --}}

                            @php

                                $modulePercentage = 100 / count($course['course_modules']);

                                $module_completed = App\Models\CoursePurchase::module_compete($course->id);

                                $modulePercentage *= count($module_completed);

                            @endphp

                            <h4>How to increase your liquid cash</h4>

                            <p class="text-end mt-4" id="percentageField">{{ number_format($modulePercentage, 2) }}%</p>

                            <div class="progress mb-5" style="height: 5.78px;">

                                <div class="progress-bar" id="progressBar" role="progressbar"
                                    style="width: {{ $modulePercentage }}%;" aria-valuemin="0" aria-valuemax="100">

                                </div>

                            </div>

                            {{-- Module loop --}}
                            @forelse ($course['course_modules'] as $index => $module)

                                {{-- Check if module not completed then lock all module except first module --}}
                                @if ($index <= count($module_completed))
                                    {{-- Unlock module design  --}}
                                    <div class="mb-5 pb-5">

                                        <div class="d-flex justify-content-between ">

                                            <h6><span class="btn btn-sm btn-secondary">{{ $index + 1 }}</span>

                                                {{ $module['course_module_name'] }}</h6>

                                            <p class="d-none d-md-block">(

                                                {{ count($module['course_contents']) < 10 ? '0' . count($module['course_contents']) : count($module['course_contents']) }}

                                                )</p>

                                        </div>

                                        <hr>

                                        <div class="video-modul-list">

                                            {{-- Module contents loop --}}
                                            @forelse ($module['course_contents'] as $key => $content)
                                                @if (1 == $content['status'])
                                                    <div class="d-flex align-items-center modul-list-item">

                                                        <div class="video-list-number">

                                                            {{ $key < 10 ? '0' . ($key + 1) : $key + 1 }}</div>

                                                        <div class="w-100">



                                                            <div class="d-flex justify-content-between video-modul-name">

                                                                <p>

                                                                    {{ $content['content_title'] }}

                                                                </p>

                                                                <p>

                                                                    {{ $content['content_length'] }}

                                                                </p>

                                                            </div>

                                                            <div class="d-flex justify-content-between">

                                                                <a href="javascript:void(0)"
                                                                    class="cursor-pointer d-flex gap-2 align-items-center"
                                                                    onclick="videoPlay(this,'{{ $content['video_source'] }}')"
                                                                    data-video-src="{{ $content['video_url'] }}">

                                                                    @if (!in_array($module['id'], $module_completed))
                                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                                            version="1.1"
                                                                            xmlns:xlink="http://www.w3.org/1999/xlink"
                                                                            width="25" height="25" x="0" y="0"
                                                                            viewBox="0 0 512 512"
                                                                            style="enable-background:new 0 0 512 512"
                                                                            xml:space="preserve" class="">
                                                                            <g>
                                                                                <circle cx="256.5" cy="256"
                                                                                    r="256" fill="#2497f3"
                                                                                    transform="rotate(-45 256.472 256.066)"
                                                                                    opacity="1" data-original="#2497f3"
                                                                                    class=""></circle>
                                                                                <path fill="#ffffff" fill-rule="evenodd"
                                                                                    d="m383.55 233.228-172.85-99.79a26.3 26.3 0 0 0-39.44 22.762v199.6a26.039 26.039 0 0 0 13.14 22.77 26.067 26.067 0 0 0 26.3 0l172.85-99.8a26.3 26.3 0 0 0 0-45.54z"
                                                                                    opacity="1" data-original="#ffffff"
                                                                                    class=""></path>
                                                                            </g>
                                                                        </svg><span class="fw-bold mt-1">Video</span>
                                                                    @else
                                                                        <img style="width: 30px;"
                                                                            src="{{ asset('frontend/complete.png') }}"
                                                                            alt=""><span
                                                                            class="text-success fw-bold">Video</span>
                                                                    @endif



                                                                </a>

                                                            </div>

                                                        </div>

                                                    </div>
                                                @endif
                                            @empty
                                                <h1>NO content Found</h1>
                                            @endforelse

                                        </div>

                                        {{-- Quiz section --}}
                                        @forelse ($quiz_result as $result)
                                            {{-- If pass quiz then show this section --}}
                                            @if ($result['course_module_id'] == $module['id'] && $result['total'] >= $result['quiz']['pass_mark'])
                                                <p class="text-success">Congratulation you pass this quiz. Your score
                                                    is:
                                                    {{ $result['total'] }}/{{ count($result['quiz']['quistions']) * 2 }}
                                                </p>
                                                {{-- If fail quiz then show this section --}}
                                            @elseif($result['course_module_id'] == $module['id'] && $result['total'] < $result['quiz']['pass_mark'])
                                                <p class="text-danger">Your Fail this quiz. Your score is:
                                                    {{ $result['total'] }}/{{ count($result['quiz']['quistions']) * 2 }}
                                                </p>
                                                <a href="{{ route('course.quiz.retake', ['quizId' => $result['quiz']['id'], 'courseId' => $course->id, 'moduleId' => $module['id']]) }}"
                                                    class="btn btn-sm btn-warning">Re-take</a>
                                                {{-- If the user is not a participant in the quiz, display the quiz button. --}}
                                            @elseif($result['course_module_id'] != $module['id'])
                                                {{-- if this module quiz not found then hide this button  --}}
                                                @if (in_array($module['id'], $module_quiz_list))
                                                    <a href="{{ route('course.quiz', ['courseId' => $course->id, 'moduleId' => $module['id']]) }}"
                                                        class="btn btn-sm btn-primary">Quiz</a>
                                                @elseif(!in_array($module['id'], $module_completed))
                                                    <button id="completeBtn_{{ $module['id'] }}"
                                                        onclick="moduleCompleteAlert('{{ $course->id }}', '{{ $module['id'] }}','{{ count($course['course_modules']) }}')"
                                                        type="button" class="btn btn-sm btn-success">Module

                                                        Completed <i class="bi bi-check2-circle"></i></button>
                                                @endif
                                            @endif
                                        @empty
                                            {{-- if this module quiz not found then hide this button  --}}
                                            @if (in_array($module['id'], $module_quiz_list))
                                                <a href="{{ route('course.quiz', ['courseId' => $course->id, 'moduleId' => $module['id']]) }}"
                                                    class="btn btn-sm btn-primary">Quiz</a>
                                            @else
                                                @if (!in_array($module['id'], $module_completed))
                                                    <button id="completeBtn_{{ $module['id'] }}"
                                                        onclick="moduleCompleteAlert('{{ $course->id }}', '{{ $module['id'] }}','{{ count($course['course_modules']) }}')"
                                                        type="button" class="btn btn-sm btn-success">Module
                                                        Completed <i class="bi bi-check2-circle"></i></button>
                                                @else
                                                    <p class="text-success">
                                                        You Successfully Complete this module.</p>
                                                @endif
                                            @endif
                                        @endforelse

                                    </div>
                                @else
                                    {{-- lock module design  --}}

                                    <div class="mb-5">

                                        {{-- Module total content video length summing --}}
                                        @php
                                            $totalTime = [];
                                            foreach ($module['course_contents'] as $content) {
                                                if ($module['id'] == $content['course_module_id']) {
                                                    if (1 == $content['status']) {
                                                        $totalTime[] = $content['content_length'];
                                                    }
                                                }
                                            }
                                        @endphp

                                        <div class="course_content-list-item p-0 d-flex gap-2 justify-content-between">

                                            <div class="d-flex align-items-center gap-2">

                                                <h6 class="mb-0"><span
                                                        class="btn btn-sm btn-secondary">{{ $index + 1 }}</span>

                                                    {{ $module['course_module_name'] }}

                                                </h6>

                                            </div>

                                            <div class="course_item-time d-flex justify-content-end align-items-center"
                                                style="min-width: 95px;">

                                                <span>{{ App\Helper\Helper::addDurationsArray($totalTime) }}</span>

                                                <i class="bi bi-lock fs-5"></i>

                                            </div>

                                        </div>

                                    </div>
                                @endif

                            @empty
                                <h1>NO Module Found</h1>
                            @endforelse



                        </div>

                        <!-- video section  -->

                        <div class="video p-0" id="iframeSection">

                            <iframe id="CourseVideo" class="course-thumb-video" frameborder="0" allowfullscreen="1"
                                allow="autoplay;"
                                title="FIRST DRIVE: Rolls-Royce Spectre – 576bhp, £330k Electric Masterpiece | Top Gear"
                                width="100%" height="100%"
                                src="{{ $course->feature_video }}&amp;controls=1&amp;autoplay=1&amp;showinfo=0&amp;disablekb=1&amp;stop=0&amp;rel=0"></iframe>

                        </div>



                    </div>

                </div>

            </div>

        </main>

        <!-- Dashboard :: Left -> End -->

    </div>

@endsection

<!-- Start:Script -->

@push('script')
    <!-- sweetalert -->
    <script type="text/javascript" src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <script>
        //ajax setup

        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            }

        });

        // Video play button
        function videoPlay(button, video_source) {
            let videoSrc = button.getAttribute('data-video-src');
            if (1 == video_source) {
                document.getElementById('CourseVideo').src =
                    `${videoSrc}&amp;controls=1&amp;autoplay=1&amp;showinfo=0&amp;disablekb=1&amp;stop=0&amp;rel=0`;
            }
            if (2 == video_source) {
                document.getElementById('CourseVideo').src = `${videoSrc}`;
            }
            // Scroll to the iframe section
            const iframeSection = document.getElementById('iframeSection');
            if (iframeSection) {
                const offset = iframeSection.offsetTop - 100;
                window.scrollTo({
                    top: offset,
                    behavior: 'smooth'
                });
            }
        }


        // module complete button alert
        function moduleCompleteAlert(courseId, moduleId, totalModule) {
            event.preventDefault();
            swal({
                title: `Are you sure?`,
                text: "You want to completed this module?.",
                buttons: true,
                infoMode: true,
            }).then((willStatusChange) => {
                if (willStatusChange) {
                    moduleCompleted(courseId, moduleId, totalModule);
                }
            });
        };

        // module completed
        function moduleCompleted(courseId, moduleId, totalModule) {
            var url = '{{ route('course.status', ':id') }}';
            $.ajax({
                type: "POST",
                url: '{{ route('course.complete') }}',
                data: {
                    courseId: courseId,
                    moduleId: moduleId,
                    totalModule: totalModule,
                },
                success: function(resp) {
                    if (resp.success === true) {
                        toastr.success(resp.message);
                        window.location.reload();
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

<!-- End:Script -->
