@extends('frontend.app')
<!-- Title -->
@section('title', 'Profile')
<style>
    .courses__item {
        background-color: var(--techwave-site-bg-color);
        -webkit-border-radius: 10px;
        -moz-border-radius: 10px;
        -o-border-radius: 10px;
        -ms-border-radius: 10px;
        border-radius: 10px;
        padding: 24px;
        border: 1px solid #B5B5C3;
        transition: all 0.2s ease-out 0s;
    }

    .courses__item:hover {
        filter: drop-shadow(10px 10px 0px var(--techwave-some-a-bg-color));
    }


    .courses__item-thumb {
        width: 300px;
    }

    .courses__item-thumb img {
        width: 100%;
        height: 190px;
        object-fit: cover;
        border-radius: 10px;
    }

    .courses__item-meta {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 10px 20px;
        margin: 0 0 15px;
        flex-wrap: wrap;
    }

    .courses__item-meta li {
        list-style: none;
    }

    .courses__item-bottom {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .courses__item-bottom .price {
        color: var(--techwave-main-color);
        font-weight: 600;
        margin-bottom: 0;
    }

    .card {
        position: relative;
        width: 300px;
        height: 390px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 25px;
        font-weight: bold;
        border-radius: 15px;
        cursor: pointer;
        background-position: center center;
        background-repeat: no-repeat;
        background-size: cover;
        font-family: "Heebo", sans-serif;
        text-decoration: none;
    }

    .card::before,
    .card::after {
        position: absolute;
        content: "";
        width: 20%;
        height: 20%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        font-weight: bold;
        background-color: #7c5fe3;
        transition: all 0.5s;
        color: white;
    }

    .card::before {
        top: 0;
        right: 0;
        border-radius: 0 15px 0 100%;
    }

    .card::after {
        bottom: 0;
        left: 0;
        border-radius: 0 100% 0 15px;
        text-align: center;
    }

    .card:hover::before,
    .card:hover:after {
        width: 100%;
        height: 100%;
        border-radius: 15px;
        transition: all 0.5s;
    }

    .techwave_fn_changelog {
        display: flex;
        gap: 30px;
        flex-flow: wrap;
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

    .techwave_fn_pagetitle {
        border-bottom: 0px;
    }

    .card h6 {
        text-align: center;
        font-size: 15px;
    }

    .add-card:hover:after {
        content: 'ADD NEW 👍';
    }
</style>

{{-- Main Content --}}
@section('content')
    <div class="techwave_fn_user_profile_page">
        <!-- Page Title -->
        <div class="techwave_fn_pagetitle">
            <h2 class="title">User Profile</h2>
        </div>
        <!-- !Page Title -->

        <div class="container small">
            <div class="techwave_fn_user_profile">

                <div class="user__profile">
                    <div class="user_avatar">
                        <img src="{{ !empty(auth()->user()->user_avatar) ? asset('/' . auth()->user()->user_avatar) : asset('backend/images/avatar/user-avatar.png') }}"
                            alt="">
                    </div>
                    <div class="user_details">
                        <ul>
                            <li>
                                <div class="item">
                                    <h4 class="subtitle">Name</h4>
                                    <h3 class="title">{{ auth()->user()->name }}</h3>
                                </div>
                            </li>
                            <li>
                                <div class="item">
                                    <h4 class="subtitle">Username</h4>
                                    <h3 class="title">{{ '@' . auth()->user()->username }}</h3>
                                </div>
                            </li>
                            <li>
                                <div class="item">
                                    <h4 class="subtitle">Email Address</h4>
                                    <h3 class="title">{{ auth()->user()->email }}</h3>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <a href="{{ route('userProfile', ['type' => 'edit-profile']) }}" class="user_edit fn__icon_button">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1"
                            id="Layer_1" x="0px" y="0px" viewBox="0 0 437.4 458.5"
                            style="enable-background:new 0 0 437.4 458.5;" xml:space="preserve"
                            class="fn__svg replaced-svg">
                            <g>
                                <path
                                    d="M218.8,457.5c-10.7,0-21.5,0.8-32.1-0.2c-28.2-2.6-50.2-25.9-50.8-54.3c-0.3-16.4-14.8-21.5-26.3-15.2   c-26.8,14.7-59.8,5-75.5-21.2c-9.2-15.3-18.1-30.8-26.8-46.4c-14.8-26.7-6.2-59.8,19.4-76.2c13.3-8.5,13.4-21.2,0.1-29.7   C0.9,197.8-7.6,164.7,7.4,137.8C16,122.4,24.8,107,33.9,91.9c15.8-26.4,48.9-36.1,75.9-21.2c10.9,6,25.6,1.4,26-15.2   c0.7-29.4,23-52.7,53.1-54.6c20.9-1.3,41.9-1.1,62.8,0.4c26.7,1.8,48.6,25.9,49.9,52.6c0.1,1.3,0.1,2.6,0.2,3.9   c1,13,12.6,19.5,24.2,13.4c10.9-5.8,22.4-8.4,34.7-6.9c18.2,2.3,32.5,11.1,42.1,26.7c9.6,15.6,18.7,31.5,27.5,47.6   c14.6,26.6,6,59.3-19.7,75.7c-4.7,3-8.7,6.4-9.6,12.2c-1.1,7.6,2.2,13.1,8.6,17.1c14.6,9,23.6,22,26.7,38.9   c2.3,12.9,0.7,25.3-5.7,36.8c-9.1,16.3-18.2,32.6-28,48.5c-15.8,25.7-48.6,34.2-75.6,20c-6.5-3.4-12.6-4.1-18.8,0.2   c-5,3.5-6.3,8.7-6.6,14.5c-1.2,27.3-19.6,49.6-46.5,54.3c-11.9,2.1-24.3,1.3-36.4,1.8C218.8,458.2,218.8,457.8,218.8,457.5z    M395.9,294.1c-0.4-8.4-4.1-12.8-9.7-16.3c-36.2-23-36-74.2,0.2-97.3c10.2-6.5,12-14.2,5.9-24.8c-7.6-13.2-15.2-26.4-22.8-39.6   c-6.4-11.1-13.9-13.4-25.2-7.5c-12.4,6.5-25.5,8.4-39.2,5.3c-25.7-5.9-43.6-27.5-44.7-53.9c-0.5-12-6.4-17.8-18.4-17.8   c-15.9,0-31.8,0-47.8,0c-10.5,0-16.6,5.9-17.3,16.3c-0.2,2.9-0.2,5.9-0.7,8.7c-7.1,39.5-48.3,59.5-84.1,41   c-9.9-5.1-18-2.9-23.5,6.7c-8.1,13.9-16.1,27.8-24.1,41.7c-5.5,9.6-3.4,17.7,6,23.7c36.8,23.5,36.9,74.4,0.2,97.8   c-9.9,6.3-11.7,14.2-5.8,24.5c7.7,13.4,15.4,26.7,23.1,40.1c6.2,10.8,13.6,12.5,24.9,7.6c7.4-3.3,15.6-6.2,23.6-6.6   c33.2-1.8,58.7,22.3,60.4,55.8c0.6,11.1,6.7,17.1,17.6,17.1c16.1,0,32.2,0,48.2,0c10.8,0,16.9-5.9,17.6-16.6   c0.3-4.5,0.6-9.1,1.7-13.5c9.1-35.9,49.2-53.5,82.4-36.3c10.8,5.6,18.5,3.5,24.5-7c7.9-13.6,15.8-27.2,23.6-40.9   C394.3,299.2,395.2,295.8,395.9,294.1z">
                                </path>
                                <path
                                    d="M215.6,333.1c-58.3-2.7-103.4-50.7-100.8-107.3c2.6-57.9,50.7-103.1,107-100.6c58.1,2.5,103.5,50.8,100.8,107.3   C320,290.5,271.8,335.7,215.6,333.1z M156.3,228.8c-0.1,34.4,27.6,62.6,61.9,62.8c34.4,0.2,62.7-27.6,62.9-61.8   c0.2-34.7-27.6-62.9-62.1-63C184.5,166.7,156.5,194.5,156.3,228.8z">
                                </path>
                            </g>
                        </svg>
                    </a>
                </div>

            </div>
        </div>
        <div class="techwave_fn_models">

            <div class="fn__tabs">
                <div class="container">
                    <div class="tab_in">
                        <a href="#tab1" class="active">Books</a>
                        <a href="#tab2">Course</a>
                        <a href="#tab3">Bundles</a>
                        <a href="#tab4">Post</a>
                    </div>
                </div>
            </div>

            <div class="container">
                <!-- models content -->
                <div class="models__content">
                    <div class="models__results">
                        <div class="fn__preloader">
                            <div class="icon"></div>
                            <div class="text">Loading</div>
                        </div>
                        <div class="fn__tabs_content">
                            <div id="tab1" class="tab__item active">
                                <ul class="fn__gallery_items" id="fn__gallery_items"
                                    style="position: relative; height: 989.188px;">
                                    @forelse ($books as $book)
                                        <!-- #1 gallery item -->
                                        <li class="fn__gallery_item book" id="book_{{ $book['book']['id'] }}">
                                            <div class="item">
                                                <div class="img">
                                                    <img src="{{ asset($book['book']['feature_image']) }}"
                                                        alt="{{ $book['book']['book_name'] }}">
                                                </div>
                                                <div class="fn__selectable_item">
                                                    <span class="icon">
                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                            xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1"
                                                            id="Layer_1" x="0px" y="0px" viewBox="0 0 408.8 294.1"
                                                            style="enable-background:new 0 0 408.8 294.1;"
                                                            xml:space="preserve" class="fn__svg replaced-svg">
                                                            <g>
                                                                <path
                                                                    d="M408.8,36.8c-2,10.1-8.3,17.4-15.4,24.5C319.6,135,245.8,208.8,172.1,282.6c-10,10-21.5,14.3-35.1,9.5   c-5-1.7-9.9-4.9-13.6-8.6C85.6,246.1,48.1,208.6,10.6,171c-15.1-15.2-13.9-37,2.6-49.9c12.8-10,30.9-8.2,43.7,4.6   c28.9,28.9,57.8,57.8,86.6,86.7c1.1,1.1,1.8,2.6,3.4,4.9c1.7-2.3,2.4-3.6,3.4-4.6c67.1-67.1,134.2-134.2,201.2-201.3   c9.7-9.7,21-13.8,34.5-9.6c11.8,3.7,18.8,12,21.9,23.8c0.2,0.9,0.5,1.7,0.8,2.6C408.8,31,408.8,33.9,408.8,36.8z">
                                                                </path>
                                                            </g>
                                                        </svg>
                                                    </span>
                                                </div>
                                                <div class="item__info">
                                                    <div class="info__header">
                                                        <div class="user__info">
                                                            <h3 class="author_name">
                                                                {{ Str::limit($book['book']['book_name'], 30, '...') }}
                                                            </h3>
                                                        </div>
                                                        <a href="#" class="fn__like no_border has__like"
                                                            data-id="{{ $book['book']['id'] }}" data-type="book">
                                                            <span
                                                                class="count">{{ App\Models\Book::favCount($book['book']['id']) }}</span>
                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1"
                                                                id="Layer_1" x="0px" y="0px" viewBox="0 0 409 346.2"
                                                                style="enable-background:new 0 0 409 346.2;"
                                                                xml:space="preserve"
                                                                class="fn__svg empty__like replaced-svg">
                                                                <g>
                                                                    <path
                                                                        d="M409,126.1c-1.6,8.9-2.7,17.8-4.8,26.6c-4.3,18.3-12.8,34.9-23.3,50.4c-20.3,30.1-46.6,54.5-74.7,77   c-29.3,23.4-60.5,43.8-92.4,63.3c-6.1,3.7-12.3,3.8-18.4,0c-42.2-25.7-83.2-53.2-119.7-86.6C54,237,34.3,215.4,19.9,189.5   C-0.6,152.7-6.6,114.1,8.1,74C21.8,36.8,47.6,11.6,86.8,2.9c35.3-7.9,67.4,0.3,94.4,24.9c8.7,7.9,15.9,17.4,24,26.4   c1.6-2.2,3.6-5,5.7-7.8c9.5-12.7,20.7-23.5,34.4-31.6c18.6-11,38.7-15.6,60.3-14.3c23,1.4,43.5,9.3,61.2,24.1   c20.6,17.2,33.1,39.2,38.9,65.2c1.4,6.4,2.2,13,3.3,19.6C409,114.9,409,120.5,409,126.1z M376.8,123.9c1-28.3-8.5-53-25.6-70.5   c-24.9-25.3-67.6-28.4-95.8-7.1c-16.9,12.8-27.8,29.8-35.4,49.2c-3,7.6-8.8,12.1-15.7,12c-6.9-0.1-12.4-4.5-15.3-12   c-5.5-14.3-13.2-27.2-23.5-38.6c-20.9-23.3-54.2-31.3-83.1-19.5C56.9,47.9,42.1,67.7,35.3,93.9c-7.7,29.8-0.9,57.4,14.4,83.3   c13.8,23.4,32.4,42.7,52.6,60.7c30.8,27.4,64.9,50.4,99.7,72.2c1.8,1.2,3.1,1.2,5,0c27.5-17.2,54.5-35.2,79.9-55.5   c24.2-19.4,46.9-40.2,64.9-65.6C366.3,168.4,376.3,146.1,376.8,123.9z">
                                                                    </path>
                                                                </g>
                                                            </svg>
                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                viewBox="0 -28 512.00002 512"
                                                                class="fn__svg full__like replaced-svg">
                                                                <path
                                                                    d="m471.382812 44.578125c-26.503906-28.746094-62.871093-44.578125-102.410156-44.578125-29.554687 0-56.621094 9.34375-80.449218 27.769531-12.023438 9.300781-22.917969 20.679688-32.523438 33.960938-9.601562-13.277344-20.5-24.660157-32.527344-33.960938-23.824218-18.425781-50.890625-27.769531-80.445312-27.769531-39.539063 0-75.910156 15.832031-102.414063 44.578125-26.1875 28.410156-40.613281 67.222656-40.613281 109.292969 0 43.300781 16.136719 82.9375 50.78125 124.742187 30.992188 37.394531 75.535156 75.355469 127.117188 119.3125 17.613281 15.011719 37.578124 32.027344 58.308593 50.152344 5.476563 4.796875 12.503907 7.4375 19.792969 7.4375 7.285156 0 14.316406-2.640625 19.785156-7.429687 20.730469-18.128907 40.707032-35.152344 58.328125-50.171876 51.574219-43.949218 96.117188-81.90625 127.109375-119.304687 34.644532-41.800781 50.777344-81.4375 50.777344-124.742187 0-42.066407-14.425781-80.878907-40.617188-109.289063zm0 0">
                                                                </path>
                                                            </svg>
                                                        </a>
                                                    </div>
                                                    <p class="desc">{!! Str::limit($book['book']['book_summary'], 40, '...') !!}</p>
                                                    <a href="{{ route('book.singlePage', $book['book']['id']) }}"
                                                        class="filter__trending enabled btn-gradient-fill has__icon small__border">
                                                        <span>Read</span>
                                                    </a>
                                                </div>
                                            </div>
                                        </li>
                                        <!-- !#1 gallery item -->
                                    @empty
                                        <h1 style="text-align: center;width:100%;">You have not liked any books yet.</h1>
                                    @endforelse
                                </ul>
                            </div>
                            <div id="tab2" class="tab__item">
                                <div
                                    style="display:flex;gap:24px;flex-wrap:wrap;justify-content:{{ count($purchaseCourses) <= 2 ? 'flex-start' : 'center' }};">
                                    @forelse ($purchaseCourses as $purchase)
                                        <div class="courses__item shine__animate-item">
                                            <div class="courses__item-thumb">
                                                <a href="{{ route('course.enrollment', $purchase['course']['id']) }}"
                                                    class="shine__animate-link">
                                                    <img src="{{ asset($purchase['course']['course_feature_image']) }}"
                                                        alt="{{ $purchase['course']['course_title'] }}">
                                                </a>
                                            </div>
                                            <div class="courses__item-content">
                                                <ul class="courses__item-meta">
                                                    <li style="display: flex;align-items:center;gap:5px;margin-top:8px;">
                                                        <svg xmlns="http://www.w3.org/2000/svg" version="1.1"
                                                            xmlns:xlink="http://www.w3.org/1999/xlink" width="16"
                                                            height="16" x="0" y="0" viewBox="0 0 682.667 682.667"
                                                            style="enable-background:new 0 0 512 512" xml:space="preserve"
                                                            class="">
                                                            <g>
                                                                <defs>
                                                                    <clipPath id="a"
                                                                        clipPathUnits="userSpaceOnUse">
                                                                        <path d="M0 512h512V0H0Z"
                                                                            fill="var(--techwave-body-color)"
                                                                            opacity="1"
                                                                            data-original="var(--techwave-body-color)">
                                                                        </path>
                                                                    </clipPath>
                                                                </defs>
                                                                <g clip-path="url(#a)"
                                                                    transform="matrix(1.33333 0 0 -1.33333 0 682.667)">
                                                                    <path
                                                                        d="M0 0c40.404-43.855 65.081-102.422 65.081-166.753 0-135.955-110.214-246.168-246.168-246.168-135.955 0-246.169 110.213-246.169 246.168S-317.042 79.415-181.087 79.415a248.69 248.69 0 0 0 30.018-1.812"
                                                                        style="stroke-width:20;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1"
                                                                        transform="translate(437.087 422.753)"
                                                                        fill="none" stroke="var(--techwave-body-color)"
                                                                        stroke-width="20" stroke-linecap="round"
                                                                        stroke-linejoin="round" stroke-miterlimit="10"
                                                                        stroke-dasharray="none" stroke-opacity=""
                                                                        data-original="var(--techwave-body-color)"
                                                                        class=""></path>
                                                                    <path
                                                                        d="M0 0c69.932 44.079 163.466 35.661 224.382-25.256 70.685-70.685 70.685-185.287 0-255.972-70.684-70.685-185.287-70.685-255.972 0-61.007 61.006-69.36 154.727-25.06 224.692"
                                                                        style="stroke-width:20;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1"
                                                                        transform="translate(159.604 409.242)"
                                                                        fill="none" stroke="var(--techwave-body-color)"
                                                                        stroke-width="20" stroke-linecap="round"
                                                                        stroke-linejoin="round" stroke-miterlimit="10"
                                                                        stroke-dasharray="none" stroke-opacity=""
                                                                        data-original="var(--techwave-body-color)"
                                                                        class=""></path>
                                                                    <path d="M0 0v38h38"
                                                                        style="stroke-width:20;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1"
                                                                        transform="translate(435.333 386.167)"
                                                                        fill="none" stroke="var(--techwave-body-color)"
                                                                        stroke-width="20" stroke-linecap="round"
                                                                        stroke-linejoin="round" stroke-miterlimit="10"
                                                                        stroke-dasharray="none" stroke-opacity=""
                                                                        data-original="var(--techwave-body-color)"
                                                                        class=""></path>
                                                                    <path
                                                                        d="M0 0c0-13.503 10.947-24.45 24.45-24.45S48.9-13.503 48.9 0 37.953 24.45 24.45 24.45 0 13.503 0 0Z"
                                                                        style="stroke-width:20;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1"
                                                                        transform="translate(231.55 256)" fill="none"
                                                                        stroke="var(--techwave-body-color)"
                                                                        stroke-width="20" stroke-linecap="round"
                                                                        stroke-linejoin="round" stroke-miterlimit="10"
                                                                        stroke-dasharray="none" stroke-opacity=""
                                                                        data-original="var(--techwave-body-color)"
                                                                        class=""></path>
                                                                    <path d="M0 0h-12.333"
                                                                        style="stroke-width:20;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1"
                                                                        transform="translate(398.333 255.837)"
                                                                        fill="none" stroke="var(--techwave-body-color)"
                                                                        stroke-width="20" stroke-linecap="round"
                                                                        stroke-linejoin="round" stroke-miterlimit="10"
                                                                        stroke-dasharray="none" stroke-opacity=""
                                                                        data-original="var(--techwave-body-color)"
                                                                        class=""></path>
                                                                    <path d="M0 0h12.333"
                                                                        style="stroke-width:20;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1"
                                                                        transform="translate(113.667 256.163)"
                                                                        fill="none" stroke="var(--techwave-body-color)"
                                                                        stroke-width="20" stroke-linecap="round"
                                                                        stroke-linejoin="round" stroke-miterlimit="10"
                                                                        stroke-dasharray="none" stroke-opacity=""
                                                                        data-original="var(--techwave-body-color)"
                                                                        class=""></path>
                                                                    <path d="M0 0v-12.333"
                                                                        style="stroke-width:20;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1"
                                                                        transform="translate(256.163 398.333)"
                                                                        fill="none" stroke="var(--techwave-body-color)"
                                                                        stroke-width="20" stroke-linecap="round"
                                                                        stroke-linejoin="round" stroke-miterlimit="10"
                                                                        stroke-dasharray="none" stroke-opacity=""
                                                                        data-original="var(--techwave-body-color)"
                                                                        class=""></path>
                                                                    <path d="M0 0v12.333"
                                                                        style="stroke-width:20;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1"
                                                                        transform="translate(255.837 113.667)"
                                                                        fill="none" stroke="var(--techwave-body-color)"
                                                                        stroke-width="20" stroke-linecap="round"
                                                                        stroke-linejoin="round" stroke-miterlimit="10"
                                                                        stroke-dasharray="none" stroke-opacity=""
                                                                        data-original="var(--techwave-body-color)"
                                                                        class=""></path>
                                                                    <path d="m0 0-39.907 39.907"
                                                                        style="stroke-width:20;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1"
                                                                        transform="translate(238.711 273.289)"
                                                                        fill="none" stroke="var(--techwave-body-color)"
                                                                        stroke-width="20" stroke-linecap="round"
                                                                        stroke-linejoin="round" stroke-miterlimit="10"
                                                                        stroke-dasharray="none" stroke-opacity=""
                                                                        data-original="var(--techwave-body-color)"
                                                                        class=""></path>
                                                                    <path d="m0 0 74.398 74.398"
                                                                        style="stroke-width:20;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1"
                                                                        transform="translate(273.289 273.289)"
                                                                        fill="none" stroke="var(--techwave-body-color)"
                                                                        stroke-width="20" stroke-linecap="round"
                                                                        stroke-linejoin="round" stroke-miterlimit="10"
                                                                        stroke-dasharray="none" stroke-opacity=""
                                                                        data-original="var(--techwave-body-color)"
                                                                        class=""></path>
                                                                    <path d="M0 0v0"
                                                                        style="stroke-width:20;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1"
                                                                        transform="translate(128.014 383.986)"
                                                                        fill="none" stroke="var(--techwave-body-color)"
                                                                        stroke-width="20" stroke-linecap="round"
                                                                        stroke-linejoin="round" stroke-miterlimit="10"
                                                                        stroke-dasharray="none" stroke-opacity=""
                                                                        data-original="var(--techwave-body-color)"
                                                                        class=""></path>
                                                                    <path d="M0 0v0"
                                                                        style="stroke-width:20;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1"
                                                                        transform="translate(325.275 492.286)"
                                                                        fill="none" stroke="var(--techwave-body-color)"
                                                                        stroke-width="20" stroke-linecap="round"
                                                                        stroke-linejoin="round" stroke-miterlimit="10"
                                                                        stroke-dasharray="none" stroke-opacity=""
                                                                        data-original="var(--techwave-body-color)"
                                                                        class=""></path>
                                                                </g>
                                                            </g>
                                                        </svg> {{ $purchase['course']['duration'] }}
                                                    </li>
                                                </ul>
                                                <h5 class="title"><a
                                                        href="{{ route('course.enrollment', $purchase['course']['id']) }}">{{ Str::limit($purchase['course']['course_title'], 20, '...') }}</a>
                                                </h5>
                                                <div class="courses__item-bottom">
                                                    <div class="button">
                                                        <a href="{{ Str::limit($purchase['course']['course_title'], 20, '...') }}"
                                                            class="btn-gradient-fill success">Learning</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                        <h1 style="text-align: center;width:100%;">You have not purchased any courses yet
                                        </h1>
                                    @endforelse
                                </div>
                            </div>
                            <div id="tab3" class="tab__item">
                                <div style="display:flex;gap:24px;flex-wrap:wrap;justify-content:{{ count($purchaseCourses) <= 2 ? 'flex-start' : 'center' }};"
                                    id="bundleArea">
                                    @forelse ($favBundle as $fav)
                                        <div class="courses__item shine__animate-item bundle"
                                            id="bundle_{{ $fav['bundle']['id'] }}">
                                            <div class="courses__item-thumb">
                                                <a href="{{ route('single.bundle', $fav['bundle']['id']) }}"
                                                    class="shine__animate-link">
                                                    <img src="{{ asset($fav['bundle']['feature_image']) }}"
                                                        alt="{{ $fav['bundle']['title'] }}">
                                                </a>
                                            </div>
                                            <a href="#" class="fn__like has__like"
                                                data-id="{{ $fav['bundle']['id'] }}" data-type="bundle">
                                                <span
                                                    class="count">{{ App\Models\Bundle::favCount($fav['bundle']['id']) }}</span>
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1"
                                                    id="Layer_1" x="0px" y="0px" viewBox="0 0 409 346.2"
                                                    style="enable-background:new 0 0 409 346.2;" xml:space="preserve"
                                                    class="fn__svg empty__like replaced-svg">
                                                    <g>
                                                        <path
                                                            d="M409,126.1c-1.6,8.9-2.7,17.8-4.8,26.6c-4.3,18.3-12.8,34.9-23.3,50.4c-20.3,30.1-46.6,54.5-74.7,77   c-29.3,23.4-60.5,43.8-92.4,63.3c-6.1,3.7-12.3,3.8-18.4,0c-42.2-25.7-83.2-53.2-119.7-86.6C54,237,34.3,215.4,19.9,189.5   C-0.6,152.7-6.6,114.1,8.1,74C21.8,36.8,47.6,11.6,86.8,2.9c35.3-7.9,67.4,0.3,94.4,24.9c8.7,7.9,15.9,17.4,24,26.4   c1.6-2.2,3.6-5,5.7-7.8c9.5-12.7,20.7-23.5,34.4-31.6c18.6-11,38.7-15.6,60.3-14.3c23,1.4,43.5,9.3,61.2,24.1   c20.6,17.2,33.1,39.2,38.9,65.2c1.4,6.4,2.2,13,3.3,19.6C409,114.9,409,120.5,409,126.1z M376.8,123.9c1-28.3-8.5-53-25.6-70.5   c-24.9-25.3-67.6-28.4-95.8-7.1c-16.9,12.8-27.8,29.8-35.4,49.2c-3,7.6-8.8,12.1-15.7,12c-6.9-0.1-12.4-4.5-15.3-12   c-5.5-14.3-13.2-27.2-23.5-38.6c-20.9-23.3-54.2-31.3-83.1-19.5C56.9,47.9,42.1,67.7,35.3,93.9c-7.7,29.8-0.9,57.4,14.4,83.3   c13.8,23.4,32.4,42.7,52.6,60.7c30.8,27.4,64.9,50.4,99.7,72.2c1.8,1.2,3.1,1.2,5,0c27.5-17.2,54.5-35.2,79.9-55.5   c24.2-19.4,46.9-40.2,64.9-65.6C366.3,168.4,376.3,146.1,376.8,123.9z">
                                                        </path>
                                                    </g>
                                                </svg>
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -28 512.00002 512"
                                                    class="fn__svg full__like replaced-svg">
                                                    <path
                                                        d="m471.382812 44.578125c-26.503906-28.746094-62.871093-44.578125-102.410156-44.578125-29.554687 0-56.621094 9.34375-80.449218 27.769531-12.023438 9.300781-22.917969 20.679688-32.523438 33.960938-9.601562-13.277344-20.5-24.660157-32.527344-33.960938-23.824218-18.425781-50.890625-27.769531-80.445312-27.769531-39.539063 0-75.910156 15.832031-102.414063 44.578125-26.1875 28.410156-40.613281 67.222656-40.613281 109.292969 0 43.300781 16.136719 82.9375 50.78125 124.742187 30.992188 37.394531 75.535156 75.355469 127.117188 119.3125 17.613281 15.011719 37.578124 32.027344 58.308593 50.152344 5.476563 4.796875 12.503907 7.4375 19.792969 7.4375 7.285156 0 14.316406-2.640625 19.785156-7.429687 20.730469-18.128907 40.707032-35.152344 58.328125-50.171876 51.574219-43.949218 96.117188-81.90625 127.109375-119.304687 34.644532-41.800781 50.777344-81.4375 50.777344-124.742187 0-42.066407-14.425781-80.878907-40.617188-109.289063zm0 0">
                                                    </path>
                                                </svg>
                                            </a>
                                            <div class="courses__item-content">
                                                <h5 class="title" style="margin-top: 16px;"><a
                                                        href="{{ route('single.bundle', $fav['bundle']['id']) }}">{{ Str::limit($fav['bundle']['title'], 20, '...') }}</a>
                                                </h5>
                                                <div class="courses__item-bottom">
                                                    <div class="button">
                                                        <a href="{{ route('single.bundle', $fav['bundle']['id']) }}"
                                                            class="btn-gradient-fill">See
                                                            Bundle</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                        <h1 style="text-align: center;width:100%;">You have not liked any bundle yet</h1>
                                    @endforelse
                                </div>
                            </div>
                            <div id="tab4" class="tab__item">
                                <!-- Journal item -->
                                @forelse ($myJournal as $journal)
                                    @if ($journal->journal_type == '1')
                                        <a href="{{ route('single.journal', ['slug' => $journal->journal_slug]) }}">
                                            <div class="card"
                                                style="background-image: url('{{ asset($journal->journal_featured_image) }}');">
                                                <style>
                                                    .card:hover:after {
                                                        content: 'Read More 👉';
                                                    }
                                                </style>
                                            </div>
                                        </a>
                                    @elseif($journal->journal_type == '2' && $journal->user_id == auth()->user()->id)
                                        <a href="{{ route('single.journal', ['slug' => $journal->journal_slug]) }}">
                                            <div class="card"
                                                style="background-image: url('{{ asset($journal->journal_featured_image) }}');">
                                                <style>
                                                    .card:hover:after {
                                                        content: 'Read More 👉';
                                                    }
                                                </style>
                                            </div>
                                        </a>
                                    @endif

                                @empty
                                    <h1 class="" style="margin: 50px 0">No Journal Found</h1>
                                @endforelse
                            </div>
                        </div>

                    </div>
                </div>
                <!-- !models content -->
            </div>



        </div>

    </div>
@endsection
@push('script')
    <script>
        //dislike system
        $(document).on("click", ".fn__like", function(event) {
            event.preventDefault();

            var button = $(this);
            var id = button.data("id");
            var type = button.data("type");
            var countElement = button.find(".count");

            //book dislike
            if ('book' == type) {
                $.ajax({
                    type: "POST",
                    url: "/book/favorite",
                    data: {
                        book_id: id,
                    },
                    success: function(resp) {
                        if (resp.success === true && resp.type === "remove") {
                            document.getElementById(`book_${id}`).remove();
                            if (0 == document.querySelectorAll('.book').length) {
                                document.getElementById('fn__gallery_items').innerHTML =
                                    '<h1 style="text-align: center;width:100%;">You have not liked any books yet.</h1>';
                            }
                        } else if (resp.errors) {
                            toastr.error(resp.errors[0]);
                        } else {
                            toastr.error(resp.message);
                        }
                    },
                    error: function(error) {
                        toastr.error("Something went wrong");
                    },
                });
            }
            //bundle dislike
            if ('bundle' == type) {
                $.ajax({
                    type: "POST",
                    url: "/bundles/favorite",
                    data: {
                        bundle_id: id,
                    },
                    success: function(resp) {
                        if (resp.success === true && resp.type === "remove") {
                            document.getElementById(`bundle_${id}`).remove();
                            if (0 == document.querySelectorAll('.bundle').length) {
                                document.getElementById('bundleArea').innerHTML =
                                    '<h1 style="text-align: center;width:100%;">You have not liked any bundle yet< /h1>';
                            }
                        } else if (resp.errors) {
                            toastr.error(resp.errors[0]);
                        } else {
                            toastr.error(resp.message);
                        }
                    },
                    error: function(error) {
                        toastr.error("Something went wrong");
                    },
                });
            }

            return false; // Prevent the default action of the click event
        });
    </script>
@endpush
