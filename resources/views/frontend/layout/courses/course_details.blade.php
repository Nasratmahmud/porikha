@extends('frontend.app')
<!-- Title -->
@section('title', $course->course_title)
@push('style')
    <style>
        .section_home .section_right {
            padding: 0;
        }

        .section_home .section_left {
            padding-top: 24px;
        }

        #CourseVideo {
            height: 500px;
        }

        @media screen and (max-width:768px) {
            #CourseVideo {
                height: 320px;
            }
        }

        .techwave_fn_interactive_list .item:hover {
            border-color: transparent;
        }

        .techwave_fn_interactive_list li {
            margin-bottom: 10px;
        }

        .module_total_duration {
            color: var(--techwave-heading-color);
        }

        .content-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
        }

        .content-item:last-child {
            margin-bottom: 0;
        }

        .content-item div {
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .content-item div p {
            margin-bottom: 0;
        }

        .techwave_fn_button {
            margin-top: 16px;
        }

        .techwave_fn_button,
        .techwave_fn_button:after {
            border-radius: 12px;
        }
    </style>
@endpush

{{-- Main Content --}}
@section('content')
    {{-- Complete module percentage progress bar --}}
    @php
        $modulePercentage = 100 / count($course['course_modules']);
        $module_completed = App\Models\CoursePurchase::module_compete($course->id);
        $modulePercentage *= count($module_completed);
    @endphp
    <div class="techwave_fn_home">
        <div class="section_home">
            <div class="section_left">
                <!-- Title Shortcode -->
                <div class="techwave_fn_title_holder">
                    <h1 class="title">{{ $course->course_title }}</h1>
                </div>
                <!-- !Title Shortcode -->

                <!-- Video Player -->
                <div class="">
                    {{-- <video autoplay="true" controls="true" controlslist="nodownload" id="CourseVideo"
                        src="https://s3.envato.com/h264-video-previews/b31b8c01-5ef8-4eff-97ea-757548e2a694/7704904.mp4"
                        style="width: 100%"></video> --}}

                    <iframe id="CourseVideo" class="course-thumb-video" frameborder="0" allowfullscreen="1" allow="autoplay;"
                        title=""
                        width="100%" height="100%"
                        src="{{ $course->feature_video }}"></iframe>
                        {{-- src="{{ $course->feature_video }}&amp;controls=1&amp;autoplay=1&amp;showinfo=0&amp;disablekb=1&amp;stop=0&amp;rel=0"></iframe> --}}
                    <div style="margin-top: 24px;">
                        {!! $course->summary !!}
                    </div>
                </div>
                <!-- Video Player -->

            </div>
            <div class="section_right">
                <div class="faq">
                    <div class="container small">
                        <h4>Your Progress</h4>
                        <div class="progress">
                            <div class="progress-done"
                                data-done="{{ $modulePercentage <= 0 ? '5' : number_format($modulePercentage, 2) }}">
                                {{ $modulePercentage <= 0 ? '0' : number_format($modulePercentage, 2) }}%
                            </div>
                        </div>
                        <!-- Accordion Shortcode -->
                        <div class="techwave_fn_accordion" data-type="accordion">
                            {{-- Module loop --}}
                            @forelse ($course['course_modules'] as $index => $module)
                                {{-- Check if module not completed then lock all module except first module --}}
                                @if ($index <= count($module_completed))
                                    {{-- Unlock module design  --}}
                                    <!-- accordion item -->
                                    <div class="acc__item {{ $index == count($module_completed) ? 'opened' : '' }}">
                                        <div class="acc__header">
                                            <h2 class="acc__title">{{ $index + 1 }}:
                                                {{ Str::limit($module['course_module_name'], 32, '...') }}
                                            </h2>
                                            <div style="display: flex;gap:24px;align-items:center;">
                                                <span>({{ count($module['course_contents']) < 10 ? '0' . count($module['course_contents']) : count($module['course_contents']) }})</span>
                                                <div class="acc__icon"></div>
                                            </div>

                                        </div>
                                        <div class="acc__content" style="display: none;">
                                            <div class="course-contents">
                                                {{-- Module contents loop --}}
                                                @forelse ($module['course_contents'] as $key => $content)
                                                    @if (1 == $content['status'])
                                                        <div class="content-item">
                                                            <div>
                                                                @if (!in_array($module['id'], $module_completed))
                                                                    <svg xmlns="http://www.w3.org/2000/svg" version="1.1"
                                                                        xmlns:xlink="http://www.w3.org/1999/xlink"
                                                                        width="20" height="20" x="0" y="0"
                                                                        viewBox="0 0 511.375 511.375"
                                                                        style="enable-background:new 0 0 512 512"
                                                                        xml:space="preserve" class="">
                                                                        <g>
                                                                            <path fill="#7c5fe3"
                                                                                d="m511.375 255.688-57.89-64.273 9.064-86.046-84.651-17.92-43.18-75.012-79.03 35.321-10.667 207.93 10.667 207.929 79.031 35.321 43.179-75.011 84.651-17.921-9.064-86.046z"
                                                                                opacity="1" data-original="#7c5fe3"
                                                                                class=""></path>
                                                                            <path fill="#6b4fcf"
                                                                                d="m176.656 12.437-43.179 75.012-84.651 17.921 9.064 86.045L0 255.688l57.89 64.272-9.064 86.046 84.651 17.921 43.18 75.011 79.031-35.321V47.758z"
                                                                                opacity="1" data-original="#6b4fcf"
                                                                                class=""></path>
                                                                            <path fill="#f7f0eb"
                                                                                d="m362.878 199.702-22.381-19.977-84.809 95.016-10.667 23.613 10.667 21.439z"
                                                                                opacity="1" data-original="#f7f0eb">
                                                                            </path>
                                                                            <path fill="#fffbf5"
                                                                                d="m166.56 233.095-21.212 21.213 89.185 89.186 21.155-23.701v-45.052l-22.393 25.088z"
                                                                                opacity="1" data-original="#fffbf5">
                                                                            </path>
                                                                        </g>
                                                                    </svg>
                                                                @else
                                                                    <svg xmlns="http://www.w3.org/2000/svg" version="1.1"
                                                                        xmlns:xlink="http://www.w3.org/1999/xlink"
                                                                        width="20" height="20" x="0" y="0"
                                                                        viewBox="0 0 511.375 511.375"
                                                                        style="enable-background:new 0 0 512 512"
                                                                        xml:space="preserve" class="">
                                                                        <g>
                                                                            <path fill="#0ed678"
                                                                                d="m511.375 255.688-57.89-64.273 9.064-86.046-84.651-17.92-43.18-75.012-79.03 35.321-10.667 207.93 10.667 207.929 79.031 35.321 43.179-75.011 84.651-17.921-9.064-86.046z"
                                                                                opacity="1" data-original="#0ed678"
                                                                                class=""></path>
                                                                            <path fill="#04eb84"
                                                                                d="m176.656 12.437-43.179 75.012-84.651 17.921 9.064 86.045L0 255.688l57.89 64.272-9.064 86.046 84.651 17.921 43.18 75.011 79.031-35.321V47.758z"
                                                                                opacity="1" data-original="#04eb84"
                                                                                class=""></path>
                                                                            <path fill="#f7f0eb"
                                                                                d="m362.878 199.702-22.381-19.977-84.809 95.016-10.667 23.613 10.667 21.439z"
                                                                                opacity="1" data-original="#f7f0eb">
                                                                            </path>
                                                                            <path fill="#fffbf5"
                                                                                d="m166.56 233.095-21.212 21.213 89.185 89.186 21.155-23.701v-45.052l-22.393 25.088z"
                                                                                opacity="1" data-original="#fffbf5">
                                                                            </path>
                                                                        </g>
                                                                    </svg>
                                                                @endif
                                                                <a href="javascript:void(0)" style="text-decoration: none;"
                                                                    onclick="videoPlay(this,'{{ $content['video_source'] }}')"
                                                                    data-video-src="{{ $content['video_url'] }}">
                                                                    <p
                                                                        style="margin-bottom: 0;color:var(--techwave-heading-color);">
                                                                        {{ $key + 1 }}
                                                                        {{ Str::limit($content['content_title'], 30, '...') }}
                                                                    </p>
                                                                </a>
                                                            </div>
                                                            <p
                                                                style="margin-bottom: 0;color: var(--techwave-heading-color);">
                                                                {{ $content['content_length'] }}
                                                            </p>
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
                                                    <p style="color: rgb(4, 235, 132); margin-top:16px;font-weight:500;">
                                                        Congratulation you
                                                        pass this quiz.
                                                        Your score
                                                        is:
                                                        {{ $result['total'] }} out of
                                                        {{ count($result['quiz']['quistions']) * 2 }}
                                                    </p>
                                                    {{-- If fail quiz then show this section --}}
                                                @elseif($result['course_module_id'] == $module['id'] && $result['total'] < $result['quiz']['pass_mark'])
                                                    <p style="color:rgb(174, 0, 0); margin-top:16px;font-weight:500;">Your
                                                        Fail this quiz.
                                                        Your score
                                                        is:
                                                        {{ $result['total'] }} out of
                                                        {{ count($result['quiz']['quistions']) * 2 }}
                                                    </p>
                                                    <a href="{{ route('course.quiz.retake', ['quizId' => $result['quiz']['id'], 'courseId' => $course->id, 'moduleId' => $module['id']]) }}"
                                                        class="techwave_fn_button warning">Re-take</a>
                                                    {{-- If the user is not a participant in the quiz, display the quiz button. --}}
                                                @elseif($result['course_module_id'] != $module['id'])
                                                    {{-- if this module quiz not found then hide this button  --}}
                                                    @if (in_array($module['id'], $module_quiz_list))
                                                        <a href="{{ route('course.quiz', ['courseId' => $course->id, 'moduleId' => $module['id']]) }}"
                                                            class="techwave_fn_button">Quiz</a>
                                                    @elseif(!in_array($module['id'], $module_completed))
                                                        <a href="javascript:void(0)" id="completeBtn_{{ $module['id'] }}"
                                                            onclick="moduleCompleteAlert('{{ $course->id }}', '{{ $module['id'] }}','{{ count($course['course_modules']) }}')"
                                                            class="techwave_fn_button success">Module Completed </a>
                                                    @endif
                                                @endif
                                            @empty
                                                {{-- if this module quiz not found then hide this button  --}}
                                                @if (in_array($module['id'], $module_quiz_list))
                                                    <a href="{{ route('course.quiz', ['courseId' => $course->id, 'moduleId' => $module['id']]) }}"
                                                        class="techwave_fn_button">Quiz</a>
                                                @else
                                                    @if (!in_array($module['id'], $module_completed))
                                                        <a href="javascript:void(0)" id="completeBtn_{{ $module['id'] }}"
                                                            onclick="moduleCompleteAlert('{{ $course->id }}', '{{ $module['id'] }}','{{ count($course['course_modules']) }}')"
                                                            class="techwave_fn_button success">Module
                                                            Completed</a>
                                                    @else
                                                        <p
                                                            style="color: rgb(4, 235, 132); margin-top:16px;font-weight:500;">
                                                            You Successfully Complete this module.</p>
                                                    @endif
                                                @endif
                                            @endforelse
                                        </div>
                                    </div>
                                @else
                                    {{-- lock module design  --}}
                                    <!-- accordion item -->
                                    <div class="techwave_fn_interactive_list modern">
                                        <ul>
                                            <li>
                                                <div class="item">
                                                    <a href="#"
                                                        style="display: flex;align-items:center;justify-content:space-between;padding: 26px 30px;">
                                                        <h2 class="title">{{ $index + 1 }}:
                                                            {{ Str::limit($module['course_module_name'], 32, '...') }}</h2>
                                                        <div
                                                            style="display: flex;align-items:center;justify-content:space-between;gap:5px;">
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
                                                            <span
                                                                class="module_total_duration">{{ App\Helper\Helper::addDurationsArray($totalTime) }}</span>
                                                            <svg xmlns="http://www.w3.org/2000/svg" version="1.1"
                                                                xmlns:xlink="http://www.w3.org/1999/xlink" width="24"
                                                                height="24" x="0" y="0" viewBox="0 0 32 32"
                                                                style="enable-background:new 0 0 512 512;margin-top:-5px;"
                                                                xml:space="preserve">
                                                                <g>
                                                                    <path
                                                                        d="M23.15 11.27H11.29V8.75a4.754 4.754 0 0 1 9.13-1.85c.22.51.8.75 1.31.53.51-.21.75-.8.53-1.31A6.746 6.746 0 0 0 16.04 2c-3.72 0-6.75 3.03-6.75 6.75v2.52h-.44c-2.21 0-4 1.79-4 4V26c0 2.21 1.79 4 4 4h14.3c2.21 0 4-1.79 4-4V15.27c0-2.2-1.79-4-4-4zm2 14.73c0 1.1-.9 2-2 2H8.85c-1.1 0-2-.9-2-2V15.27c0-1.1.9-2 2-2h14.3c1.1 0 2 .9 2 2zm-7.35-5.65c0 .62-.32 1.18-.8 1.5v2.45c0 .55-.45 1-1 1s-1-.45-1-1v-2.45c-.48-.32-.8-.88-.8-1.5a1.799 1.799 0 1 1 3.6 0z"
                                                                        fill="var(--techwave-heading-color)"
                                                                        opacity="1"
                                                                        data-original="var(--techwave-heading-color)">
                                                                    </path>
                                                                </g>
                                                            </svg>
                                                        </div>


                                                    </a>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                @endif
                            @empty
                                <h1>NO Module Found</h1>
                            @endforelse

                        </div>
                        <!-- !Accordion Shortcode -->

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <!-- sweetalert -->
    <script type="text/javascript" src="{{ asset('https://unpkg.com/sweetalert/dist/sweetalert.min.js') }}"></script>
    <script>
        //progress bar
        const progress = document.querySelector('.progress-done');
        progress.style.width = progress.getAttribute('data-done') + '%';
        progress.style.opacity = 1;

        // Video play button
        function videoPlay(button, video_source) {
            let videoSrc = button.getAttribute('data-video-src');
            console.log(videoSrc);
            if (1 == video_source) {
                document.getElementById('CourseVideo').src =
                    `${videoSrc}`;
            }
            if (2 == video_source) {
                document.getElementById('CourseVideo').src = `${videoSrc}`;
            }else{
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
