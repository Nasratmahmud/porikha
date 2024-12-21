@extends('frontend.app')
<!-- Start:Title -->
@section('title', 'Job Posts')
<!-- End:Title -->
@push('style')
    {{-- Css cdn  --}}
    <link rel="stylesheet" href="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/css/nice-select.css') }} ">
    <link rel="stylesheet" href="{{ asset('frontend/plugins/slick-slider/slick.css') }}">
    <!-- Option 1: Include in HTML -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        .bootstrap-tagsinput {
            padding: 10px;
        }

        .bootstrap-tagsinput .tag {
            padding: .3rem;
            border-radius: 5px;
            background: #0b75f1;
            color: #fff;
        }

        .techwave_fn_aichatbot_page .title {
            margin: 20px 0;
            font-size: 25px;
            font-weight: bold;
        }

        .group__list {
            list-style-type: none;
        }

        .chat__group {
            margin-top: 73px;
        }

        .chat__group h2 {
            font-size: 25px;
            font-weight: bold;
        }

        .fouram__item {
            text-decoration: none;
        }

        .chat__item {
            margin-bottom: 70px !important;
            margin-top: 20px;
        }

        .container {
            padding: 0 70px;
        }

        .font__trigger {
            right: 420px;
            margin-right: 0;
            top: 50%;
        }

        .forums__sidebar {
            width: 520px;
        }

        .fn__chatbot .author,
        .techwave_fn_user_billing .billing__plan .plan {
            position: absolute;
            left: 30px;
            top: -13px;
            display: block;
            height: 20px;
            padding: 14px 20px;
            background-color: var(--techwave-main-color);
            color: #fff;
            font-family: var(--techwave-heading-font-family);
            font-weight: 500;
            font-size: 13px;
            letter-spacing: .5px;
            text-transform: uppercase;
            line-height: 20px;
            border-radius: 10px;
        }

        .fn__chatbot .author * {
            position: relative;
            top: -10px;
        }

        .fn__chatbot .chat {
            padding: 30px 30px 30px 30px;
            position: relative;
        }


        .forum-post-info {
            display: flex;
            gap: 25px;
        }

        .time-diff {
            position: absolute;
            top: 14px;
            right: 20px;
        }

        .forum-post-info div {
            display: flex;
            gap: 10px;
            font-weight: 600;
        }

        .chat p {
            font-size: 20px;
            font-weight: bold;
        }

        .pagination {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            list-style-type: none;
            font-size: 20px;
        }

        .pagination a {
            text-decoration: none;
            padding: 4px 11px;
            color: white;
            border-radius: 5px;
        }

        .active>.page-link {
            background-color: #7c5fe3;
            padding: 4px 11px;
            color: white;
            border-radius: 5px;
        }

        .tag-active .group__item .fn__chat_link {
            background-color: #7c5fe3 !important;
            color: white;
        }

        .user-span {
            margin: 0px 0 15px 0;
            display: flex;
            gap: 17px;
            align-items: center;
        }

        .user-span img {
            width: 100px;
            height: 100px;
            object-fit: cover;
            padding: 10px;
            background-color: var(--techwave-main-color);
            border-radius: 50%;
        }

        .forum--post--container {
            display: flex;
            align-items: center;
            justify-content: space-between;
            width: 100%;
        }

        .sidebar_content {
            position: sticky;
        }

        .company-info h6 {
            margin: 0;
            font-size: 22px;
            font-weight: 700;
            margin-top: 5px;
        }

        .company-info span {
            margin-top: 5px;
            display: block;
            font-size: 15px;
        }

        .time-diff {
            font-size: 15px;
            font-weight: 600;
            top: 15px;
            right: 21px;

        }

        .job-discription {
            margin: 35px 0;
        }

        .job-discription p {
            font-size: 17px;
            color: var(--techwave-body-color);
        }

        .row {
            display: flex;
            align-items: center;
        }

        .col-md-6 {
            width: 50%;
            float: left;
        }

        .d-flex {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .d-flex svg {
            margin-top: 5px;
        }

        .job-footer-item svg {
            width: 25px;
            height: 25px;
            fill: var(--techwave-main-color);
        }

        .job-footer-item h3 {
            display: inline;
            font-size: 20px;
            font-weight: 800;
        }

        .job-footer-item span {
            font-size: 15px;
            font-weight: 400;
        }

        .col-md-10 {
            width: 80%;
            float: left;
        }

        .col-md-2 {
            width: 20%;
            float: left;
            text-align: end;
        }

        .feed__more {
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 25px 0;
        }

        .apply-button {
            background-color: var(--techwave-main-color);
            padding: 8px 20px;
            border: none;
            font-size: 17px;
            border-radius: 6px;
            font-weight: 600;
        }

        .job-favorate {
            position: absolute;
            top: 40px;
            right: 40px;
        }

        .job-favorate i {
            font-size: 25px;
        }

        .techwave_fn_interactive_list a {
            padding: 14px 20px 0;
            display: block;
            text-align: start;
        }

        .techwave_fn_interactive_list ul {
            display: block;
            padding-right: 20px;
        }

        .techwave_fn_interactive_list li {
            width: 100%;
            max-width: 100%;
        }

        .item .user-span img {
            width: 70px;
            height: 71px;
            padding: 4px;
        }

        .item .company-info h6 {
            font-size: 19px;
        }

        .item .company-info span {
            font-size: 13px;
        }

        .techwave_fn_interactive_list .desc {
            margin: 0 0 10px;
        }

        .section_home .company_info p,
        .techwave_fn_aichatbot_page .fn__title_holder {
            margin-bottom: 0px;
        }
        .forums__sidebar {
            margin-bottom: 100px;
        }
        .chat__list {
            margin-bottom: 100px;
        }
        .myapplication{
            margin-bottom: 45px !important;
        }
        .myapplication a{
            font-size: 18px;
            background-color: var(--techwave-main-color);
            padding: 10px 20px;
            text-decoration: none;
            color: white;
            -webkit-border-radius: 5px !important;
            -moz-border-radius: 5px !important;
            border-radius: 5px !important;
        }
    </style>
@endpush

<!-- Start:Content -->
@section('content')
    <div class="techwave_fn_page">
        <!-- AI Chat Bot Page -->
        <div class="techwave_fn_aichatbot_page fn__chatbot">
            <div class="chat__page">
                <div class="font__trigger">
                    <span></span>
                </div>
                <div class="fn__title_holder">
                    <div class="container" style="display: flex; align-items: center; justify-content: space-between">
                        <div class="forum--post--container">
                            <h1 class="title fn__animated_text ">Job Posts</h1>
                        </div>
                    </div>
                </div>
                <div class="container">
                    <div class="chat__list">
                        @forelse ($jobs as $job)
                            <div class="chat__item active" id="chat1">
                                <div class="chat__box your__chat">
                                    <div class="chat">
                                        <span class="user-span">
                                            <img src="{{ asset($job->company->logo) }}"" alt="">
                                            <div class="company-info">
                                                <h6> {{ $job->title }}</h6>
                                                <span>{{ $job->company->name }}</span>
                                            </div>
                                        </span>
                                        <div class="forum-post-info" style="position: relative">
                                            <div style="gap: 80px !important">
                                                <div class="post-item">
                                                    <div>
                                                        <i class="bi bi-clock-fill"></i>
                                                    </div>
                                                    <div>
                                                        @if ($job->type == '1')
                                                            {{ 'Full Time' }}
                                                        @elseif ($job->type == '2')
                                                            {{ 'Part Time' }}
                                                        @elseif ($job->type == '3')
                                                            {{ 'Contract' }}
                                                        @elseif ($job->type == '4')
                                                            {{ 'Internships' }}
                                                        @elseif ($job->type == '5')
                                                            {{ 'Temporary' }}
                                                        @else
                                                            {{ 'Remote' }}
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="post-item">
                                                    <div>
                                                        <i class="bi bi-people-fill"></i>
                                                    </div>
                                                    <div>
                                                        Vacancy: {{ $job->vacancy }}
                                                    </div>
                                                </div>
                                                <div class="post-item">
                                                    <div>
                                                        <i class="bi bi-geo-alt-fill"></i>
                                                    </div>
                                                    <div>
                                                        {{ $job->company->address }}
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="created-date"
                                                style="position: absolute; bottom: 0; right: 0; font-weight: 400"
                                                title="Deadline">
                                                {{ \Carbon\Carbon::parse($job->deadline)->format('d M Y') }}
                                            </div>
                                        </div>
                                        <div class="job-discription">
                                            <p>
                                                {!! Str::limit($job->short_description, 300, '...') !!}
                                            </p>
                                        </div>
                                        <hr>

                                        <div class="job-footer"> 
                                            <div class="row">
                                                <div class="col-md-10">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="d-flex align-items-center job-footer-item">
                                                                <div>
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                        height="16" fill="currentColor"
                                                                        class="bi bi-coin" viewBox="0 0 16 16">
                                                                        <path
                                                                            d="M5.5 9.511c.076.954.83 1.697 2.182 1.785V12h.6v-.709c1.4-.098 2.218-.846 2.218-1.932 0-.987-.626-1.496-1.745-1.76l-.473-.112V5.57c.6.068.982.396 1.074.85h1.052c-.076-.919-.864-1.638-2.126-1.716V4h-.6v.719c-1.195.117-2.01.836-2.01 1.853 0 .9.606 1.472 1.613 1.707l.397.098v2.034c-.615-.093-1.022-.43-1.114-.9zm2.177-2.166c-.59-.137-.91-.416-.91-.836 0-.47.345-.822.915-.925v1.76h-.005zm.692 1.193c.717.166 1.048.435 1.048.91 0 .542-.412.914-1.135.982V8.518z" />
                                                                        <path
                                                                            d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16" />
                                                                        <path
                                                                            d="M8 13.5a5.5 5.5 0 1 1 0-11 5.5 5.5 0 0 1 0 11m0 .5A6 6 0 1 0 8 2a6 6 0 0 0 0 12" />
                                                                    </svg>
                                                                </div>
                                                                <div>
                                                                    <h3>{{ $job->selary_range }}</h3>
                                                                    <span> / Month</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="d-flex align-items-center job-footer-item">
                                                                <div>
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                        height="16" fill="currentColor"
                                                                        class="bi bi-people-fill" viewBox="0 0 16 16">
                                                                        <path
                                                                            d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6m-5.784 6A2.24 2.24 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.3 6.3 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1zM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5" />
                                                                    </svg>
                                                                </div>
                                                                <div>
                                                                    <h3>{{$job->applyed->count()}}</h3><span> Applied</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <button class="apply-button">
                                                        <a href="{{ route('job.details', $job->slug) }}"
                                                            style="color: white; text-decoration: none">
                                                            View
                                                            Details
                                                        </a>
                                                        </button>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="time-diff">
                                        {{ $job->created_at->diffForHumans() }}
                                    </div>
                                    <div class="job-favorate" onclick="favorite({{ $job->id }}, this)">
                                        @if ($job->favorate != null && $job->favorate->job_post_id == $job->id && $job->favorate->user_id == Auth::user()->id)
                                            <i class="bi bi-bookmark-heart-fill"></i>
                                        @else
                                            <i class="bi bi-bookmark"></i>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @empty
                            <h1 class="text-danger text-center p-5 h3">No Job Found</h1>
                        @endforelse
                        @if ($jobs->nextPageUrl() || $jobs->previousPageUrl())
                            <nav>
                                <ul class="pagination">
                                    <!-- Previous Page Link -->
                                    @if ($jobs->onFirstPage())
                                        <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                                            <span class="page-link" aria-hidden="true">&lsaquo;</span>
                                        </li>
                                    @else
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $jobs->previousPageUrl() }}" rel="prev"
                                                aria-label="@lang('pagination.previous')">&lsaquo;</a>
                                        </li>
                                    @endif

                                    <!-- Pagination Elements -->
                                    @foreach ($jobs->getUrlRange(1, $jobs->lastPage()) as $page => $url)
                                        @if ($page == $jobs->currentPage())
                                            <li class="page-item active" aria-current="page"><span
                                                    class="page-link">{{ $page }}</span></li>
                                        @else
                                            <li class="page-item"><a class="page-link"
                                                    href="{{ $url }}">{{ $page }}</a></li>
                                        @endif
                                    @endforeach
                                    <!-- Next Page Link -->

                                    @if ($jobs->hasMorePages())
                                        <li class="page-item">

                                            <a class="page-link" href="{{ $jobs->nextPageUrl() }}" rel="next"
                                                aria-label="@lang('pagination.next')">&rsaquo;</a>

                                        </li>
                                    @else
                                        <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.next')">

                                            <span class="page-link" aria-hidden="true">&rsaquo;</span>

                                        </li>
                                    @endif

                                </ul>

                            </nav>
                        @endif
                    </div>
                </div>
            </div>


            {{-- Side bar --}}
            <div class="forums__sidebar">
                <div class="sidebar_content">
                    {{-- Latest jobs --}}
                    <div class="chat__group new">
                        <h2 class="group__title">Latest Jobs</h2>
                        <div class="techwave_fn_interactive_list">
                            <ul>
                                @foreach ($latestJobs as $latest)
                                    <li>
                                        <div class="item">
                                            <a href="{{ route('job.details', $latest->slug) }}">
                                                <div class="">
                                                    <span class="user-span">
                                                        <img src="{{ asset($latest->company->logo) }}" alt="">
                                                        <div class="company-info">
                                                            <h6> {{ Str::limit($latest->title, 22, '...') }}</h6>
                                                            <span>{{ $latest->company->name }}</span>
                                                        </div>
                                                    </span>
                                                </div>
                                                <div style="padding: 0; display: flex;">
                                                    <p class="desc" style="width: 85%">
                                                        {{ $latest->created_at->diffForHumans() }}</p>
                                                    <p class="arrow"
                                                        style="width: 15%; display: block; text-align: end;">
                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                            xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1"
                                                            id="Layer_1" x="0px" y="0px" viewBox="0 0 145.1 225.1"
                                                            style="enable-background:new 0 0 145.1 225.1;"
                                                            xml:space="preserve" class="fn__svg replaced-svg">
                                                            <path
                                                                d="M104.4,112.2c-10.6-9.1-21-18-31.5-27C51.1,66.5,29.3,47.8,7.4,29.1c-4.6-3.9-7.2-8.6-6.5-14.7c0.7-6.2,4-10.7,9.8-13.1  c6-2.5,11.6-1.4,16.5,2.7c8.1,6.8,16.2,13.8,24.2,20.7c28.9,24.7,57.7,49.5,86.6,74.1c5.4,4.6,8.5,10.1,6.4,17.1  c-1,3.3-3.1,6.7-5.7,9C101.5,157.1,64,189,26.6,221c-7.1,6-17,5.2-22.8-1.7c-5.9-7.1-4.9-16.7,2.5-23c31.7-27.2,63.4-54.3,95.1-81.5  C102.4,114.1,103.2,113.3,104.4,112.2z">
                                                            </path>
                                                        </svg>
                                                    </p>
                                                </div>
                                            </a>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>

                    {{-- Popular jobs --}}
                    <div class="chat__group new">
                        <h2 class="group__title">Popular Jobs</h2>
                        <div class="techwave_fn_interactive_list">
                            <ul>
                                @foreach ($popularJobs as $popular)
                                    <li>
                                        <div class="item">
                                            <a href="{{ route('job.details', $popular->slug) }}}">
                                                <div class="">
                                                    <span class="user-span">
                                                        <img src="{{ asset($popular->company->logo) }}"" alt="">
                                                        <div class="company-info">
                                                            <h6> {{ Str::limit($popular->title, 22, '...') }}</h6>
                                                            <span>{{ $popular->company->name }}</span>
                                                        </div>
                                                    </span>
                                                </div>
                                                <div style="padding: 0; display: flex;">
                                                    <p class="desc" style="width: 85%">
                                                        <i class="bi bi-eye-fill"></i> {{ $popular->views }}
                                                    </p>
                                                    <p class="arrow"
                                                        style="width: 15%; display: block; text-align: end;">
                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                            xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1"
                                                            id="Layer_1" x="0px" y="0px" viewBox="0 0 145.1 225.1"
                                                            style="enable-background:new 0 0 145.1 225.1;"
                                                            xml:space="preserve" class="fn__svg replaced-svg">
                                                            <path
                                                                d="M104.4,112.2c-10.6-9.1-21-18-31.5-27C51.1,66.5,29.3,47.8,7.4,29.1c-4.6-3.9-7.2-8.6-6.5-14.7c0.7-6.2,4-10.7,9.8-13.1  c6-2.5,11.6-1.4,16.5,2.7c8.1,6.8,16.2,13.8,24.2,20.7c28.9,24.7,57.7,49.5,86.6,74.1c5.4,4.6,8.5,10.1,6.4,17.1  c-1,3.3-3.1,6.7-5.7,9C101.5,157.1,64,189,26.6,221c-7.1,6-17,5.2-22.8-1.7c-5.9-7.1-4.9-16.7,2.5-23c31.7-27.2,63.4-54.3,95.1-81.5  C102.4,114.1,103.2,113.3,104.4,112.2z">
                                                            </path>
                                                        </svg>
                                                    </p>
                                                </div>
                                            </a>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- !AI Chat Bot Page -->

    </div>

@endsection

<!-- Start:Script -->
@push('script')
@endpush

<!-- End:Script -->
