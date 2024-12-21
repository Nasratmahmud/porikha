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

    {{-- Dropify Css cdn  --}}
    <link rel="stylesheet" href="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css') }}" />
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
            width: 70%;
            float: left;
        }

        .col-md-2 {
            width: 30%;
            float: left;
        }

        .feed__more {
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 25px 0;
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

        .fn__chatbot .your__chat .chat {
            background-color: transparent;
        }

        .job-cover {
            height: 250px;
            width: 100%;
            background-size: cover;
            background-position: top;
            background-repeat: no-repeat;
            border-radius: 10px;
        }

        .job-details {
            margin-left: 60px;
        }

        .company-logo {
            margin-top: -84px;
            margin-bottom: 20px;
            width: 150px;
            height: 150px;
            background-color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            overflow: hidden;
            padding: 20px;
        }

        .company-logo img {
            width: 100%;
        }

        .job-details h3 {
            font-size: 30px;
            font-weight: 700;
            margin: 0;
            margin-bottom: 5px;
        }

        .job-details p {
            font-size: 20px;
            font-weight: 500;
            margin: 0;
            margin-bottom: 15px;
        }

        .job-details span {
            font-size: 18px;
            font-weight: 400;
            color: var(--techwave-body-color);
        }

        .apply-button {
            background-color: var(--techwave-main-color);
            padding: 11px 36px;
            border: none;
            font-size: 20px;
            border-radius: 6px;
            font-weight: 600;
            margin-right: 7px;
            color: white;
        }

        .job-info .apply-wrapper {
            display: flex;
            align-items: center;
            justify-content: flex-end;
        }

        .apply-wrapper i {
            margin-right: 20px;
            font-size: 40px;
            padding-top: 5px;
        }

        .job-requirement {
            margin-top: 60px;
            margin-left: 60px;
        }

        .chat__group {
            margin-top: 0px;
        }

        a {
            text-decoration: none !important;
        }

        .job-requirement h4 {
            font-weight: 600;
            font-size: 22px;
        }

        .techwave_fn_interactive_list ul {
            padding-right: 0px;
        }

        .additional-info {
            margin: 20px 0;
            background-color: var(--techwave-some-a-bg-color);
            padding: 30px 20px 20px;
            border-radius: 10px;
        }

        .additional-info p {
            margin: 0;
            color: var(--techwave-body-color);
            font-size: 18px;
            font-weight: 500;
            margin-top: 10px;
        }

        .additional-info h4 {
            margin: 0;
        }

        .info-item {
            margin-top: 20px;
        }

        .info-item .item .info-item .row {
            display: flex;
            align-items: center;
        }

        .info-item .item .info-item .row .col-md-2 {
            display: flex;
            align-items: center;
            text-align: start !important;
        }

        .info-item .col-md-10 {
            width: 80% !important;
            float: left;
        }

        .info-item .col-md-2 {
            width: 20% !important;
            float: left;
        }

        .info-item .item {
            margin: 20px 0;
        }

        .info-item .item h6 {
            margin: 0;
            font-size: 18px;
            font-weight: 500;
            margin-top: 10px;
        }

        .info-item .item span {
            color: var(--techwave-body-color);
            font-size: 15px;
        }

        .icon-wrapper {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background-color: var(--techwave-main-color);
            color: white;
            font-size: 23px;
        }

        .icon-wrapper i {
            margin-top: 5px;

        }

        .chat__group {
            background-color: var(--techwave-some-a-bg-color);
            border-radius: 10px;
            padding: 30px 20px 20px;
        }

        .job-facilities {
            margin-top: 60px;
        }

        .facility-wrapper ul {
            padding-right: 0px;
            list-style: none;
        }

        .facility-wrapper ul li {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .facility-wrapper ul li span {
            background-color: var(--techwave-some-a-bg-color);
            padding: 2px 5px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .facility-wrapper ul li i {
            color: var(--techwave-main-color);
            font-size: 25px;
            font-weight: 600;
        }

        .company-wrapper {
            margin-top: 60px;
        }

        .company-wrapper h4 {
            font-weight: 600;
            font-size: 22px;
        }

        .company-breadcump img {
            width: 100px;
            height: 100px;
            object-fit: cover;
        }

        .company-breadcump .row {
            gap: 40px;
            align-items: center;
        }

        .company-breadcump .content h6 {
            font-size: 20px;
            font-weight: 600;
            margin: 0;
        }

        .company-breadcump .content span {
            font-size: 14px;
            color: var(--techwave-body-color);
        }

        .company-about-wrapper p {
            font-size: 16px;
            color: var(--techwave-body-color);
        }

        /* Modal Css */
        .modal {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: var(--techwave-some-a-bg-color);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
            z-index: 999;
            width: 50%;
        }

        .overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 998;
        }

        .modal-content {
            position: relative;
        }

        .modal-content .close {
            position: absolute;
            top: 10px;
            right: 10px;
            cursor: pointer;
            font-size: 30px;
            padding: 20px;
        }

        .modal-content .content {
            padding: 40px 60px;
        }

        .modal-content .content h5 {
            font-size: 25px;
            font-weight: 600;
        }

        .col-md-6 {
            width: 50%;
            float: left;
        }

        .form-group label {
            font-weight: 600;
        }

        .form-control {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ced4da;
            border-radius: 6px !important;
            box-sizing: border-box;
            margin: 8px 0 20px 0;
        }

        /* dropify css  */
        .dropify-wrapper .dropify-message p {
            font-size: initial;
        }

        .btn-danger {
            background-color: #b54646;
            padding: 11px 36px;
            border: none;
            font-size: 18px;
            border-radius: 6px;
            font-weight: 600;
            margin-right: 7px;
            color: white;
        }

        .btn-primary {
            background-color: var(--techwave-main-color);
            padding: 11px 36px;
            border: none;
            font-size: 18px;
            border-radius: 6px;
            font-weight: 600;
            margin-right: 7px;
            color: white;
        }
    </style>
@endpush

<!-- Start:Content -->
@section('content')
    <div class="techwave_fn_page">
        <div class="techwave_fn_aichatbot_page fn__chatbot">
            <div class="chat__page">
                <div class="container">
                    <div class="chat__list">
                        <div class="chat__item active" id="chat1">
                            <div class="chat__box your__chat">
                                <div class="chat">
                                    <div class="job-cover"
                                        style="background-image: url({{ asset('frontend/img/job-cover.jpg') }});">
                                    </div>

                                    <div class="job-details">
                                        <div class="company-logo">
                                            <img src="{{ asset($job->company->logo) }}" alt="">
                                        </div>
                                        <div class="job-info">
                                            <div class="row">
                                                <div class="col-md-10">
                                                    <h3>{{ $job->title }}</h3>
                                                    <p>{{ $job->company->name }}</p>
                                                    <span>{{ $job->company->address }} <i class="bi bi-dot"></i>
                                                        {{ $job->created_at->diffForHumans() }}</span>
                                                </div>
                                                <div class="col-md-2 apply-wrapper">
                                                    <div onclick="favorite({{ $job->id }}, this)">
                                                        @if ($job->favorate != null && $job->favorate->job_post_id == $job->id && $job->favorate->user_id == Auth::user()->id)
                                                            <i class="bi bi-bookmark-heart-fill"></i>
                                                        @else
                                                            <i class="bi bi-bookmark"></i>
                                                        @endif
                                                    </div>
                                                    <button class="apply-button" id="openModal">

                                                        Apply
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="job-requirement">
                                        <div class="row" style="align-items: flex-start">
                                            <div class="col-md-10">
                                                <h4>Job Description</h4>
                                                <p>{!! $job->description !!}</p>

                                                <div class="job-facilities">
                                                    <div class="facility-title">
                                                        <h4>Job Facilities:</h4>
                                                    </div>
                                                    <div class="facility-wrapper">
                                                        <ul>
                                                            @foreach ($job->facilities as $facility)
                                                                <li>
                                                                    <span>
                                                                        <i class="bi bi-check-all"></i>
                                                                    </span>
                                                                    {{ $facility->facility }}
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                </div>

                                                <div class="company-wrapper">
                                                    <div class="company-title">
                                                        <h4>About Company</h4>
                                                    </div>
                                                    <div class="company-breadcump">
                                                        <div class="row">
                                                            <div class="">
                                                                <img src="{{ asset($job->company->logo) }}" alt="">
                                                            </div>
                                                            <div>
                                                                <div class="content">
                                                                    <h6>{{ $job->company->name }}</h6>
                                                                    <span>{{ $job->company->address }}</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="company-about-wrapper">
                                                            <p>{!! $job->company->about !!}</p>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="col-md-2 job-sidebar" style="text-align: start">
                                                {{-- Selary Section --}}
                                                <div class="additional-info">
                                                    <h4>${{ $job->selary_range }}</h4>
                                                    <p>Salary Range</p>

                                                    <div class="info-item">
                                                        <div class="item">
                                                            <div class="row">
                                                                <div class="col-md-2">
                                                                    <div class="icon-wrapper">
                                                                        <i class="bi bi-briefcase-fill"></i>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-10">
                                                                    <div class="content">
                                                                        <h6>
                                                                            {{ $job->company->name }}
                                                                        </h6>
                                                                        <span>
                                                                            Institute name
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="item">
                                                            <div class="row">
                                                                <div class="col-md-2">
                                                                    <div class="icon-wrapper">
                                                                        <i class="bi bi-reception-4"></i>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-10">
                                                                    <div class="content">
                                                                        <h6>
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
                                                                        </h6>
                                                                        <span>
                                                                            Employment type
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="item">
                                                            <div class="row">
                                                                <div class="col-md-2">
                                                                    <div class="icon-wrapper">
                                                                        <i class="bi bi-people-fill"></i>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-10">
                                                                    <div class="content">
                                                                        <h6>
                                                                            {{ $job->vacancy }}
                                                                        </h6>
                                                                        <span>
                                                                            Vacancy
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="item">
                                                            <div class="row">
                                                                <div class="col-md-2">
                                                                    <div class="icon-wrapper">
                                                                        <i class="bi bi-clock"></i>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-10">
                                                                    <div class="content">
                                                                        <h6>
                                                                            {{ \Carbon\Carbon::parse($job->deadline)->format('d M Y') }}
                                                                        </h6>
                                                                        <span>
                                                                            Official Deadline
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="item">
                                                            <div class="row">
                                                                <div class="col-md-2">
                                                                    <div class="icon-wrapper">
                                                                        <i class="bi bi-person-lines-fill"></i>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-10">
                                                                    <div class="content">
                                                                        <h6>
                                                                            {{ $job->user->email }}
                                                                        </h6>
                                                                        <span>
                                                                            Contact Email
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
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
                                                                        <a
                                                                            href="{{ route('job.details', $popular->slug) }}">
                                                                            <div class="">
                                                                                <span class="user-span">
                                                                                    <img src="{{ asset($popular->company->logo) }}""
                                                                                        alt="">
                                                                                    <div class="company-info">
                                                                                        <h6> {{ Str::limit($popular->title, 22, '...') }}
                                                                                        </h6>
                                                                                        <span>{{ $popular->company->name }}</span>
                                                                                    </div>
                                                                                </span>
                                                                            </div>
                                                                            <div style="padding: 0; display: flex;">
                                                                                <p class="desc" style="width: 85%">
                                                                                    <i class="bi bi-eye-fill"></i>
                                                                                    {{ $popular->views }}
                                                                                </p>
                                                                                <p class="arrow"
                                                                                    style="width: 15%; display: block; text-align: end;">
                                                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                                                        xmlns:xlink="http://www.w3.org/1999/xlink"
                                                                                        version="1.1" id="Layer_1"
                                                                                        x="0px" y="0px"
                                                                                        viewBox="0 0 145.1 225.1"
                                                                                        style="enable-background:new 0 0 145.1 225.1;"
                                                                                        xml:space="preserve"
                                                                                        class="fn__svg replaced-svg">
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
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Apply Modal --}}
    <div class="overlay" id="overlay"></div>

    <div class="modal" id="modal">
        <div class="modal-content">
            <div class="close">
                <i id="closeModal" class="bi bi-x-circle"></i>
            </div>

            <div class="content">
                <h5>
                    Application Form
                </h5>
                <form action="{{ route('job.application') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="job_id" value="{{ $job->id }}">
                    <div class="form-group">
                        <label for="expect_selary">Expect Salary:</label>
                        <input type="text" name="expect_selary" id="expect_selary" class="form-control"
                            placeholder="55,000">
                    </div>
                    <div class="form-group">
                        <label for="cover_latter">Cover Letter:</label>
                        <textarea name="cover_latter" name="cover_latter" id="cover_latter" cols="30" rows="3"
                            class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="resume">Upload Resume:</label>
                        <input type="file" class="form-control dropify" name="resume" id="resume">
                    </div>
                    <div class="form-group">
                        <label for="experience">Experience:</label>
                        <input type="text" name="experience" id="experience" class="form-control" placeholder="5">
                    </div>
                    <div class="form-group">
                        <label for="present_address">Present Address:</label>
                        <textarea name="present_address" name="present_address" id="present_address" cols="30" rows="2"
                            class="form-control"></textarea>
                    </div>

                    <button type="button" class="btn-danger" id="overlay">Close</button>
                    <button type="submit" class="btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>

    @if ($errors->any())
    <script>
        window.onload = function() {
            var errorMessages = @json($errors->all());
            errorMessages.forEach(function(message) {
                toastr.error(message);
            });
        };
    </script>
@endif


@endsection

<!-- Start:Script -->
@push('script')
    {{-- Dropify Cdn  --}}
    <script src="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('.dropify').dropify();
        });

        function favorite(job_id, element) {
            var btn = $(element); // Convert the DOM element to a jQuery object
            // send ajax request
            var url = '{{ route('favorite.job', ':id') }}';
            $.ajax({
                type: "GET",
                url: url.replace(':id', job_id),
                success: function(resp) {
                    if (resp.success === true) {
                        toastr.success(resp.message);
                        btn.find('i').removeClass('bi-bookmark');
                        btn.find('i').addClass('bi-bookmark-heart-fill');
                    } else if (resp.success === false) {
                        btn.find('i').removeClass('bi-bookmark-heart-fill');
                        btn.find('i').addClass('bi-bookmark');
                        toastr.error(resp.message);
                    } else if (resp.errors) {
                        toastr.error(resp.errors[0]);
                    } else {
                        toastr.error(resp.message);
                    }
                }, // success end
                error: function(error) {
                    // location.reload();
                } // Error
            });
        }

        $(document).ready(function() {
            $("#openModal").click(function() {
                $('html').css("overflow", "hidden");
                $("#overlay").fadeIn(300);
                $("#modal").fadeIn(300);
            });

            $("#closeModal, #overlay").click(function() {
                $('html').css("overflow", "auto");
                $("#overlay").fadeOut(300);
                $("#modal").fadeOut(300);
            });
        });
    </script>
@endpush

<!-- End:Script -->
