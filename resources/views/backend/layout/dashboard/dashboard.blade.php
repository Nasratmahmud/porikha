@extends('backend.app')

@section('title', 'Dashboard')

<!-- Start:Sub Header Menu -->
@section('sub-header-menu')
    <li class="breadcrumb-item">
        <span>Dashboard</span>
    </li>
@endsection
<!-- End:Sub Header Menu -->

@push('style')
    <style>
        .card {
            box-shadow: none;
        }
    </style>
@endpush


@section('content')

    @can('super admin')
        <div class="app-content-area">
            <div class="container-fluid">
                <div class="row mt-5">
                    <div class="col-lg-12 col-md-12 col-12">
                        <!-- Page header -->
                        <div class="d-flex justify-content-between mb-5 align-items-center">
                            <h3 class="mb-0 ">Dashboard</h3>
                        </div>
                    </div>
                </div>
                <div class="row row-cols-1  row-cols-xl-4 row-cols-md-2 ">
                    <div class="col mb-5">
                        <div class="card h-100 card-lift">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="text-muted fw-semi-bold ">Courses</span>
                                    <span><svg xmlns="http://www.w3.org/2000/svg" version="1.1"
                                            xmlns:xlink="http://www.w3.org/1999/xlink" width="35" height="35" x="0" y="0"
                                            viewBox="0 0 682.667 682.667" style="enable-background:new 0 0 512 512"
                                            xml:space="preserve" class="">
                                            <g>
                                                <defs>
                                                    <clipPath id="a" clipPathUnits="userSpaceOnUse">
                                                        <path d="M0 512h512V0H0Z" fill="#0dcaf0" opacity="1"
                                                            data-original="#0dcaf0"></path>
                                                    </clipPath>
                                                </defs>
                                                <g clip-path="url(#a)" transform="matrix(1.33333 0 0 -1.33333 0 682.667)">
                                                    <path
                                                        d="M0 0h56.113c13.282 0 24.048 10.767 24.048 24.048v296.597c0 13.282-10.766 24.048-24.048 24.048h-448.904c-13.281 0-24.048-10.766-24.048-24.048V24.048C-416.839 10.767-406.072 0-392.791 0h296.598"
                                                        style="stroke-width:15;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1"
                                                        transform="translate(424.339 83.653)" fill="none" stroke="#0dcaf0"
                                                        stroke-width="15" stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-miterlimit="10" stroke-dasharray="none" stroke-opacity=""
                                                        data-original="#0dcaf0" class=""></path>
                                                    <path
                                                        d="m0 0-47.221 20.531c-6.426 2.794-6.426 11.908 0 14.702l154.678 67.252a32.069 32.069 0 0 0 25.57 0l154.678-67.252c6.426-2.794 6.426-11.908 0-14.702l-79.292-34.475"
                                                        style="stroke-width:15;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1"
                                                        transform="translate(135.758 224.11)" fill="none" stroke="#0dcaf0"
                                                        stroke-width="15" stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-miterlimit="10" stroke-dasharray="none" stroke-opacity=""
                                                        data-original="#0dcaf0" class=""></path>
                                                    <path
                                                        d="M0 0c-48.699 0-88.177-7.178-88.177-16.033v-64.129a8.016 8.016 0 0 1 8.016-8.016H80.161a8.016 8.016 0 0 1 8.016 8.016v64.129C88.177-7.178 48.699 0 0 0Z"
                                                        style="stroke-width:15;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1"
                                                        transform="translate(256 260.008)" fill="none" stroke="#0dcaf0"
                                                        stroke-width="15" stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-miterlimit="10" stroke-dasharray="none" stroke-opacity=""
                                                        data-original="#0dcaf0" class=""></path>
                                                    <path d="M0 0v-96.193"
                                                        style="stroke-width:15;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1"
                                                        transform="translate(376.242 219.927)" fill="none" stroke="#0dcaf0"
                                                        stroke-width="15" stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-miterlimit="10" stroke-dasharray="none" stroke-opacity=""
                                                        data-original="#0dcaf0" class=""></path>
                                                    <path
                                                        d="M0 0v0c-8.854 0-16.033-7.178-16.033-16.032v-24.049h32.065v24.049C16.032-7.178 8.854 0 0 0Z"
                                                        style="stroke-width:15;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1"
                                                        transform="translate(376.242 123.734)" fill="none" stroke="#0dcaf0"
                                                        stroke-width="15" stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-miterlimit="10" stroke-dasharray="none" stroke-opacity=""
                                                        data-original="#0dcaf0" class=""></path>
                                                    <path
                                                        d="M0 0c0-13.282-10.767-24.048-24.048-24.048-13.282 0-24.049 10.766-24.049 24.048 0 13.282 10.767 24.048 24.049 24.048C-10.767 24.048 0 13.282 0 0Z"
                                                        style="stroke-width:15;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1"
                                                        transform="translate(95.677 364.218)" fill="none" stroke="#0dcaf0"
                                                        stroke-width="15" stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-miterlimit="10" stroke-dasharray="none" stroke-opacity=""
                                                        data-original="#0dcaf0" class=""></path>
                                                    <path d="M0 0h96.194"
                                                        style="stroke-width:15;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1"
                                                        transform="translate(127.742 380.25)" fill="none" stroke="#0dcaf0"
                                                        stroke-width="15" stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-miterlimit="10" stroke-dasharray="none" stroke-opacity=""
                                                        data-original="#0dcaf0" class=""></path>
                                                    <path d="M0 0h48.097"
                                                        style="stroke-width:15;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1"
                                                        transform="translate(127.742 348.185)" fill="none"
                                                        stroke="#0dcaf0" stroke-width="15" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-miterlimit="10"
                                                        stroke-dasharray="none" stroke-opacity="" data-original="#0dcaf0"
                                                        class=""></path>
                                                    <path d="M0 0h176.354"
                                                        style="stroke-width:15;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1"
                                                        transform="translate(167.823 203.895)" fill="none"
                                                        stroke="#0dcaf0" stroke-width="15" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-miterlimit="10"
                                                        stroke-dasharray="none" stroke-opacity="" data-original="#0dcaf0"
                                                        class=""></path>
                                                </g>
                                            </g>
                                        </svg></span>

                                </div>
                                <div class="mt-4 mb-3 d-flex align-items-center lh-1">
                                    <h3 class="fw-bold  mb-0">{{ $course }}</h3>
                                </div>
                                <a href="{{ route('course.index') }}" class="btn-link fw-semi-bold">View</a>
                            </div>
                        </div>
                    </div>
                    <div class="col mb-5">
                        <div class="card h-100 card-lift">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="text-muted fw-semi-bold ">Forums</span>
                                    <span>
                                        <svg xmlns="http://www.w3.org/2000/svg" version="1.1"
                                            xmlns:xlink="http://www.w3.org/1999/xlink" width="35" height="35" x="0"
                                            y="0" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512"
                                            xml:space="preserve" class="">
                                            <g>
                                                <path
                                                    d="M205.02 112.343c0 5.036 2.381 14.361 18.325 20.231 8.731 3.214 20.329 4.985 32.655 4.985 23.518 0 50.98-6.604 50.98-25.216 0-25.075-18.203-45.965-42.085-50.186 10.714-3.699 18.434-13.878 18.434-25.833C283.329 21.257 271.07 9 256.002 9s-27.327 12.257-27.327 27.324c0 11.955 7.72 22.134 18.434 25.833-23.884 4.221-42.089 25.11-42.089 50.186zm37.655-76.019c0-7.347 5.979-13.324 13.327-13.324s13.327 5.977 13.327 13.324c0 7.348-5.979 13.327-13.327 13.327-7.349-.001-13.327-5.979-13.327-13.327zm13.327 39.04c20.39 0 36.978 16.588 36.978 36.979 0 4.684-14.068 11.216-36.98 11.216s-36.98-6.533-36.98-11.216c0-20.39 16.59-36.979 36.982-36.979zm8.895 352.234c10.713-3.699 18.432-13.878 18.432-25.833 0-15.066-12.259-27.324-27.327-27.324s-27.327 12.258-27.327 27.324c0 11.954 7.719 22.134 18.432 25.833-23.883 4.222-42.087 25.111-42.087 50.186 0 5.036 2.381 14.361 18.325 20.231C232.077 501.229 243.674 503 256 503c23.518 0 50.98-6.604 50.98-25.217 0-25.074-18.202-45.963-42.083-50.185zm-22.222-25.833c0-7.347 5.979-13.324 13.327-13.324s13.327 5.978 13.327 13.324c0 7.349-5.979 13.327-13.327 13.327-7.349 0-13.327-5.979-13.327-13.327zM256 489c-22.912 0-36.98-6.533-36.98-11.217 0-20.39 16.59-36.979 36.982-36.979 20.39 0 36.978 16.589 36.978 36.979 0 4.684-14.068 11.217-36.98 11.217zm204.915-244.123c10.714-3.699 18.434-13.878 18.434-25.833 0-15.066-12.259-27.324-27.327-27.324s-27.327 12.257-27.327 27.324c0 11.955 7.72 22.135 18.434 25.833-23.884 4.221-42.089 25.111-42.089 50.186 0 5.036 2.381 14.36 18.325 20.231 8.731 3.214 20.329 4.984 32.655 4.984 23.518 0 50.98-6.604 50.98-25.216 0-25.073-18.203-45.963-42.085-50.185zm-22.22-25.833c0-7.347 5.979-13.323 13.327-13.323s13.327 5.977 13.327 13.323c0 7.349-5.979 13.327-13.327 13.327-7.349 0-13.327-5.978-13.327-13.327zm13.325 87.235c-22.912 0-36.98-6.532-36.98-11.216 0-20.39 16.59-36.979 36.982-36.979 20.39 0 36.978 16.589 36.978 36.979 0 4.684-14.068 11.216-36.98 11.216zm-341.06-11.216c0-25.075-18.203-45.965-42.085-50.186 10.714-3.699 18.434-13.878 18.434-25.833 0-15.066-12.259-27.324-27.327-27.324s-27.327 12.257-27.327 27.324c0 11.955 7.72 22.135 18.434 25.833C27.205 249.099 9 269.989 9 295.063c0 5.036 2.381 14.36 18.325 20.231 8.731 3.214 20.329 4.984 32.655 4.984 23.518.001 50.98-6.602 50.98-25.215zm-64.305-76.019c0-7.347 5.979-13.323 13.327-13.323s13.327 5.977 13.327 13.323c0 7.349-5.979 13.327-13.327 13.327-7.349 0-13.327-5.978-13.327-13.327zm13.325 87.235c-22.912 0-36.98-6.532-36.98-11.216 0-20.39 16.59-36.979 36.982-36.979 20.39 0 36.978 16.589 36.978 36.979 0 4.684-14.068 11.216-36.98 11.216zM306.109 62.75a7.002 7.002 0 0 1 8.702-4.72c55.285 16.399 101.529 55.612 126.873 107.583a7 7 0 0 1-12.583 6.137c-23.629-48.455-66.738-85.012-118.271-100.298a7.001 7.001 0 0 1-4.721-8.702zM70.552 165.613C95.896 113.641 142.14 74.429 197.425 58.03a7 7 0 1 1 3.982 13.422c-51.534 15.286-94.642 51.844-118.271 100.298a6.999 6.999 0 0 1-9.36 3.223 6.999 6.999 0 0 1-3.224-9.36zm371.132 180.774c-23.643 48.482-66.325 86.54-117.103 104.416a6.98 6.98 0 0 1-2.324.399 7.004 7.004 0 0 1-6.603-4.678 7 7 0 0 1 4.278-8.927c47.335-16.664 87.125-52.146 109.168-97.348a7.002 7.002 0 0 1 12.584 6.138zM196.582 446.595a7.003 7.003 0 0 1-6.603 4.678 7.01 7.01 0 0 1-2.325-.399c-50.778-17.877-93.46-55.936-117.103-104.417a7 7 0 0 1 12.583-6.136c22.043 45.202 61.833 80.684 109.169 97.349a6.997 6.997 0 0 1 4.279 8.925zM337.26 234.962h-67.812a7 7 0 1 1 0-14h67.812a7 7 0 1 1 0 14zm-40.906-40.569a7 7 0 0 1 7-7h33.906a7 7 0 1 1 0 14h-33.906a7 7 0 0 1-7-7zm-9.902 152.359V271.33h80.485c7.842 0 14.222-6.38 14.222-14.223v-91.859c0-7.842-6.38-14.222-14.222-14.222h-17.498v-17.601a7 7 0 0 0-11.619-5.259l-26.027 22.86H239.77c-7.842 0-14.222 6.38-14.222 14.222v75.421h-80.485c-7.842 0-14.222 6.38-14.222 14.222v91.86c0 7.842 6.38 14.222 14.222 14.222h17.498v17.601a7 7 0 0 0 11.619 5.26l26.027-22.86h72.023c7.842 0 14.222-6.38 14.222-14.222zm-46.904-181.503c0-.112.11-.222.222-.222h74.661c1.7 0 3.342-.619 4.62-1.741l16.389-14.395v9.136a7 7 0 0 0 7 7h24.498c.112 0 .222.11.222.222v91.859c0 .112-.11.223-.222.223h-80.485v-2.438c0-7.842-6.38-14.222-14.222-14.222h-32.682v-75.422zm-41.979 181.725c-1.7 0-3.342.619-4.62 1.74L176.56 363.11v-9.136a7 7 0 0 0-7-7h-24.498a.236.236 0 0 1-.222-.222v-91.86c0-.112.11-.222.222-.222H272.23c.112 0 .222.109.222.222v91.86c0 .112-.11.222-.222.222zm51.984-62.937a7 7 0 0 1-7 7H174.74a7 7 0 1 1 0-14h67.812a7 7 0 0 1 7.001 7zm-33.907 33.569a7 7 0 0 1-7 7H174.74a7 7 0 1 1 0-14h33.906a7 7 0 0 1 7 7z"
                                                    fill="#0dcaf0" opacity="1" data-original="#0dcaf0" class="">
                                                </path>
                                            </g>
                                        </svg>
                                    </span>

                                </div>
                                <div class="mt-4 mb-3 d-flex align-items-center lh-1">
                                    <h3 class="fw-bold  mb-0">{{ $furam }}</h3>
                                </div>
                                <a href="{{ route('admin.furam.index') }}" class="btn-link fw-semi-bold">View</a>
                            </div>
                        </div>
                    </div>
                    <div class="col mb-5">
                        <div class="card h-100 card-lift">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="text-muted fw-semi-bold ">Guides</span>
                                    <span>
                                        <svg xmlns="http://www.w3.org/2000/svg" version="1.1"
                                            xmlns:xlink="http://www.w3.org/1999/xlink" width="35" height="35" x="0"
                                            y="0" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512"
                                            xml:space="preserve" class="">
                                            <g>
                                                <path
                                                    d="M44.682 90.808V51.214C44.682 27.071 64.253 7.5 88.396 7.5h357.326c11.927 0 21.596 9.669 21.596 21.596v364.109M44.682 437.301V125.808M351.933 481.397H185.974M118.742 481.397H88.778c-24.354 0-44.096-19.742-44.096-44.096v0c0-24.354 19.742-44.096 44.096-44.096h378.54v66.596c0 11.927-9.669 21.596-21.596 21.596h-58.789M89.531 7.5v381.423"
                                                    style="stroke-width:15;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;"
                                                    fill="none" stroke="#0dcaf0" stroke-width="15" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-miterlimit="10" data-original="#0dcaf0"
                                                    class=""></path>
                                                <path
                                                    d="m170.558 503.928-16.216-6.392a8.091 8.091 0 0 0-5.936 0l-16.216 6.392c-5.311 2.093-11.063-1.822-11.063-7.531V437.3h60.494v59.097c-.001 5.71-5.752 9.625-11.063 7.531zM100.925 437.301h100.897"
                                                    style="stroke-width:15;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;"
                                                    fill="none" stroke="#0dcaf0" stroke-width="15" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-miterlimit="10" data-original="#0dcaf0"
                                                    class=""></path>
                                                <circle cx="272.954" cy="208.48" r="70.541"
                                                    style="stroke-width:15;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;"
                                                    fill="none" stroke="#0dcaf0" stroke-width="15" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-miterlimit="10" data-original="#0dcaf0"
                                                    class=""></circle>
                                                <path d="M272.954 319.388c-61.253 0-110.908-49.655-110.908-110.908"
                                                    style="stroke-width:15;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;"
                                                    fill="none" stroke="#0dcaf0" stroke-width="15" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-miterlimit="10" data-original="#0dcaf0"
                                                    class=""></path>
                                                <ellipse cx="272.954" cy="208.48" rx="25.466" ry="70.541"
                                                    style="stroke-width:15;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;"
                                                    fill="none" stroke="#0dcaf0" stroke-width="15" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-miterlimit="10" data-original="#0dcaf0"
                                                    class=""></ellipse>
                                                <path
                                                    d="M163.882 234.308h-26.627M181.072 273.985h-31.228M237.639 313.662h-62.616M272.954 319.388c61.253 0 110.908-49.655 110.908-110.908M382.025 234.308h26.627M364.836 273.985h31.227M308.269 313.662h62.615M202.413 208.48h141.081M165.458 93.279h216.567M229.188 55.337h89.107"
                                                    style="stroke-width:15;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;"
                                                    fill="none" stroke="#0dcaf0" stroke-width="15" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-miterlimit="10" data-original="#0dcaf0"
                                                    class=""></path>
                                            </g>
                                        </svg>
                                    </span>

                                </div>
                                <div class="mt-4 mb-3 d-flex align-items-center lh-1">
                                    <h3 class="fw-bold  mb-0">{{ $guide }}</h3>
                                </div>
                                <a href="{{ route('guide.index') }}" class="btn-link fw-semi-bold">View</a>
                            </div>
                        </div>
                    </div>
                    <div class="col mb-5">
                        <div class="card h-100 card-lift">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="text-muted fw-semi-bold ">Quizzes</span>
                                    <span>
                                        <svg xmlns="http://www.w3.org/2000/svg" version="1.1"
                                            xmlns:xlink="http://www.w3.org/1999/xlink" width="35" height="35" x="0"
                                            y="0" viewBox="0 0 500 500" style="enable-background:new 0 0 512 512"
                                            xml:space="preserve" class="">
                                            <g>
                                                <path
                                                    d="M297.959 93.168a4.293 4.293 0 0 1-.365-6.06 20.796 20.796 0 0 1 15.55-6.999c11.459 0 20.781 9.322 20.781 20.78a20.791 20.791 0 0 1-13.996 19.647c-1.56.538-2.491 1.845-2.491 3.494a4.293 4.293 0 1 1-8.586 0c0-5.318 3.249-9.876 8.276-11.611a12.202 12.202 0 0 0 8.212-11.53c0-6.723-5.471-12.193-12.194-12.193-3.484 0-6.81 1.498-9.125 4.108a4.294 4.294 0 0 1-6.062.364zm15.186 40.461a4.293 4.293 0 0 0-4.293 4.293v.828a4.293 4.293 0 1 0 8.586 0v-.828a4.293 4.293 0 0 0-4.293-4.293zm-105.598 75.199c0-8.122 6.608-14.73 14.73-14.73 8.121 0 14.729 6.608 14.729 14.73s-6.608 14.73-14.729 14.73c-8.122 0-14.73-6.608-14.73-14.73zm8.587 0a6.149 6.149 0 0 0 6.143 6.143c3.387 0 6.142-2.755 6.142-6.143s-2.755-6.143-6.142-6.143-6.143 2.755-6.143 6.143zm35.107 4.294h45.371a4.293 4.293 0 1 0 0-8.586h-45.371a4.293 4.293 0 1 0 0 8.586zm-43.694 44.6c0-8.122 6.608-14.73 14.73-14.73 8.121 0 14.729 6.608 14.729 14.73s-6.608 14.73-14.729 14.73c-8.122 0-14.73-6.608-14.73-14.73zm8.587 0a6.149 6.149 0 0 0 6.143 6.143c3.387 0 6.142-2.755 6.142-6.143s-2.755-6.143-6.142-6.143-6.143 2.755-6.143 6.143zm35.107 4.294h45.371a4.293 4.293 0 1 0 0-8.586h-45.371a4.293 4.293 0 1 0 0 8.586zm-43.694 44.599c0-8.122 6.608-14.73 14.73-14.73 8.121 0 14.729 6.608 14.729 14.73s-6.608 14.73-14.729 14.73c-8.122 0-14.73-6.608-14.73-14.73zm8.587 0a6.149 6.149 0 0 0 6.143 6.143c3.387 0 6.142-2.755 6.142-6.143s-2.755-6.143-6.142-6.143-6.143 2.756-6.143 6.143zm35.107 4.294h45.371a4.293 4.293 0 1 0 0-8.586h-45.371a4.293 4.293 0 1 0 0 8.586zm209.133 74.574V404.9c0 16.643-16.571 30.182-36.94 30.182H76.566c-20.368 0-36.94-13.539-36.94-30.182v-19.417a4.293 4.293 0 0 1 4.293-4.293h46.743V205.657c0-8.822 7.177-15.999 15.999-15.999h24.313v-22.302c0-7.227 5.88-13.106 13.107-13.106h6.122v-10.537a4.29 4.29 0 0 1 1.258-3.036l52.269-52.268a4.29 4.29 0 0 1 3.036-1.258h51.266V79.44c0-8.006 7.13-14.52 15.894-14.52h74.243c8.764 0 15.894 6.514 15.894 14.52v65.449c0 8.006-7.13 14.52-15.894 14.52h-5.288v30.25h50.456c8.822 0 15.999 7.177 15.999 15.999V381.19h46.743a4.293 4.293 0 0 1 4.295 4.293zM266.62 170.451l22.204-18.627a4.296 4.296 0 0 1 2.76-1.004h56.587c3.96 0 7.307-2.717 7.307-5.934V79.439c0-3.217-3.347-5.934-7.307-5.934h-74.243c-3.96 0-7.307 2.717-7.307 5.934v91.012zm-102.412-30.378h34.011a4.914 4.914 0 0 0 4.909-4.909v-34.011zm-5.417 14.176h6.123c7.227 0 13.106 5.88 13.106 13.106v150.877a13.3 13.3 0 0 1-1.827 6.821l-15.78 27.333c2.05 3.44 5.781 5.64 9.864 5.64h152.532c6.334 0 11.486-5.153 11.486-11.486V159.408h-41.15l-25.117 21.071a6.154 6.154 0 0 1-3.954 1.431 6.241 6.241 0 0 1-2.211-.405c-2.326-.879-3.83-3.01-3.83-5.427v-80.34h-46.318v39.428c0 7.441-6.054 13.496-13.496 13.496h-39.428zm10.643 37.432h-29.872v113.2h29.872zM139.561 318.23c0 .963.196 1.694.677 2.526l14.26 24.701 14.259-24.697c.48-.833.677-1.565.677-2.527v-4.765h-29.872v4.762zm0-150.875v15.739h29.872v-15.739a4.526 4.526 0 0 0-4.52-4.52h-20.832a4.526 4.526 0 0 0-4.52 4.52zM99.249 381.19h301.502V205.657c0-4.087-3.326-7.413-7.413-7.413h-50.456v148.295c0 11.068-9.005 20.073-20.073 20.073H170.277c-7.431 0-14.201-4.149-17.669-10.577a6.23 6.23 0 0 1-3.562-2.849l-16.243-28.136c-1.23-2.128-1.828-4.36-1.828-6.821V198.244h-24.313c-4.087 0-7.413 3.326-7.413 7.413zm104.913 8.586 2.795 9.549c.816 2.786 2.849 4.516 5.308 4.516h75.47c2.459 0 4.492-1.731 5.308-4.517l2.795-9.549h-91.676zm247.625 0H304.786l-3.501 11.961c-1.872 6.395-7.317 10.691-13.549 10.691h-75.47c-6.232 0-11.677-4.297-13.549-10.691l-3.501-11.962H48.213V404.9c0 11.907 12.719 21.595 28.353 21.595h346.869c15.634 0 28.353-9.688 28.353-21.595v-15.124z"
                                                    fill="#0dcaf0" opacity="1" data-original="#0dcaf0" class="">
                                                </path>
                                            </g>
                                        </svg>
                                    </span>

                                </div>
                                <div class="mt-4 mb-3 d-flex align-items-center lh-1">
                                    <h3 class="fw-bold  mb-0">{{ $guiz }}</h3>
                                </div>
                                <a href="{{ route('quiz.index') }}" class="btn-link fw-semi-bold">View</a>
                            </div>
                        </div>
                    </div>
                    <div class="col mb-5">
                        <div class="card h-100 card-lift">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="text-muted fw-semi-bold ">Journal</span>
                                    <span>
                                        <svg xmlns="http://www.w3.org/2000/svg" version="1.1"
                                            xmlns:xlink="http://www.w3.org/1999/xlink" width="35" height="35" x="0"
                                            y="0" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512"
                                            xml:space="preserve" class="">
                                            <g>
                                                <path
                                                    d="M140.93 100.41c0-4.42 3.58-8.01 8.01-8.01H302.6c4.42 0 8.01 3.58 8.01 8.01s-3.58 8.01-8.01 8.01H148.94c-4.43-.01-8.01-3.59-8.01-8.01zm8.01 62.57H302.6c4.42 0 8.01-3.58 8.01-8.01s-3.58-8.01-8.01-8.01H148.94c-4.42 0-8.01 3.58-8.01 8.01s3.58 8.01 8.01 8.01zm0 54.57H302.6c4.42 0 8.01-3.58 8.01-8.01s-3.58-8.01-8.01-8.01H148.94c-4.42 0-8.01 3.58-8.01 8.01s3.58 8.01 8.01 8.01zm0 54.57h112.88c4.42 0 8.01-3.58 8.01-8.01s-3.58-8.01-8.01-8.01H148.94c-4.42 0-8.01 3.58-8.01 8.01s3.58 8.01 8.01 8.01zm0 54.56H238c4.42 0 8.01-3.58 8.01-8.01s-3.58-8.01-8.01-8.01h-89.06c-4.42 0-8.01 3.58-8.01 8.01s3.58 8.01 8.01 8.01zm0 54.57h76.08c4.42 0 8.01-3.58 8.01-8.01s-3.58-8.01-8.01-8.01h-76.08c-4.42 0-8.01 3.58-8.01 8.01s3.58 8.01 8.01 8.01zm333.14-205.62-74.96 74.96v191.54c0 17.11-13.92 31.03-31.03 31.03H132.04c-17.11 0-31.03-13.92-31.03-31.03v-7.36h-7.36c-17.11 0-31.03-13.92-31.03-31.02v-47.38H44.59c-11.64 0-21.1-9.47-21.1-21.1s9.47-21.1 21.1-21.1h18.04v-23.41H44.59c-11.64 0-21.1-9.47-21.1-21.1s9.47-21.1 21.1-21.1h18.04v-23.41H44.59c-11.64 0-21.1-9.47-21.1-21.1s9.47-21.1 21.1-21.1h18.04v-23.41H44.59c-11.64 0-21.1-9.47-21.1-21.1s9.47-21.1 21.1-21.1h18.04V69.91c0-17.12 13.92-31.05 31.03-31.05h244.06c17.11 0 31.03 13.93 31.03 31.05v6.87l7.84.48c17.34 1.05 30.76 14.72 30.54 31.12l-.74 52.34 13.38-13.38 17.01-17.01c8.58-8.58 22.55-8.58 31.14 0l14.17 14.17c8.58 8.58 8.58 22.55-.01 31.13zm-33.99 11.35-22.66-22.66-132.82 132.81 22.66 22.66 39.8-39.8.01-.01 38.37-38.37.01-.01zM281.48 330.92l17.99-4.28-13.71-13.71zm87.27-238.1v105.53l21.39-21.39.97-68.81c.1-7.83-6.7-14.38-15.5-14.91zM44.59 143.48h52.1c2.76 0 5.09-2.33 5.09-5.09s-2.33-5.09-5.09-5.09h-52.1c-2.76 0-5.09 2.33-5.09 5.09s2.33 5.09 5.09 5.09zm0 65.62h52.1c2.76 0 5.09-2.33 5.09-5.09s-2.33-5.09-5.09-5.09h-52.1c-2.76 0-5.09 2.33-5.09 5.09s2.33 5.09 5.09 5.09zm0 65.62h52.1c2.76 0 5.09-2.33 5.09-5.09s-2.33-5.09-5.09-5.09h-52.1c-2.76 0-5.09 2.33-5.09 5.09s2.33 5.09 5.09 5.09zm0 65.62h52.1c2.76 0 5.09-2.33 5.09-5.09 0-2.81-2.28-5.09-5.09-5.09h-52.1c-2.81 0-5.09 2.28-5.09 5.09 0 2.76 2.33 5.09 5.09 5.09zm49.07 78.41h244.06c8.28 0 15.01-6.73 15.01-15.01v-98.76l-31.8 31.8a7.992 7.992 0 0 1-3.81 2.13l-44.59 10.6c-.61.15-1.24.22-1.85.22-2.1 0-4.14-.83-5.66-2.35a8.003 8.003 0 0 1-2.13-7.51l10.6-44.59a7.992 7.992 0 0 1 2.13-3.81l77.11-77.11V69.91c0-8.29-6.73-15.04-15.01-15.04H93.66c-8.28 0-15.01 6.75-15.01 15.04v47.38h18.04c11.64 0 21.1 9.47 21.1 21.1s-9.47 21.1-21.1 21.1H78.65v23.41h18.04c11.64 0 21.1 9.47 21.1 21.1s-9.47 21.1-21.1 21.1H78.65v23.41h18.04c11.64 0 21.1 9.47 21.1 21.1s-9.47 21.1-21.1 21.1H78.65v23.41h18.04c11.64 0 21.1 9.47 21.1 21.1s-9.47 21.1-21.1 21.1H78.65v47.38c0 8.32 6.73 15.05 15.01 15.05zM391.11 266.6l-22.37 22.36v114.78c0 17.11-13.92 31.02-31.03 31.02H117.03v7.36c0 8.28 6.73 15.01 15.01 15.01H376.1c8.28 0 15.01-6.73 15.01-15.01zm79.65-110.78-14.17-14.17c-2.3-2.3-6.19-2.3-8.49 0L436.75 153l22.66 22.66 11.35-11.35c2.3-2.3 2.3-6.19 0-8.49z"
                                                    fill="#0dcaf0" opacity="1" data-original="#0dcaf0" class="">
                                                </path>
                                            </g>
                                        </svg>
                                    </span>

                                </div>
                                <div class="mt-4 mb-3 d-flex align-items-center lh-1">
                                    <h3 class="fw-bold  mb-0">{{ $journal }}</h3>
                                </div>
                                <a href="{{ route('admin.journal.index') }}" class="btn-link fw-semi-bold">View</a>
                            </div>
                        </div>
                    </div>
                    <div class="col mb-5">
                        <div class="card h-100 card-lift">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="text-muted fw-semi-bold ">Books</span>
                                    <span>
                                        <svg xmlns="http://www.w3.org/2000/svg" version="1.1"
                                            xmlns:xlink="http://www.w3.org/1999/xlink" width="35" height="35" x="0"
                                            y="0" viewBox="0 0 64 64" style="enable-background:new 0 0 512 512"
                                            xml:space="preserve" class="">
                                            <g>
                                                <path
                                                    d="m63.023 34 .017-.008a1 1 0 0 0 .971-.992.989.989 0 0 0-.989-1C62.74 31.91 62 30.693 62 28.5s.741-3.41 1.023-3.5l.014-.007a1 1 0 0 0 .08-1.986l-32.229-3.79a16.013 16.013 0 0 0-3.777 0l-23.23 2.79h-.015C1.985 22.137 1 24.831 1 27.5A7.834 7.834 0 0 0 2.2 32 7.829 7.829 0 0 0 1 36.5a8.065 8.065 0 0 0 1.1 4.358C.719 42.248 0 45.132 0 48c0 3.942 1.351 7.933 3.934 8l33.949 3.994A.918.918 0 0 0 38 60a.939.939 0 0 0 .119-.007L46 59.047V63a1 1 0 0 0 .733.964A1.022 1.022 0 0 0 47 64a1 1 0 0 0 .857-.485l2.235-3.725L52.2 62.6A1 1 0 0 0 54 62v-3.912l9.119-1.095A1 1 0 0 0 63 55c-.7 0-2-2.278-2-6 0-3.69 1.228-5.826 2-6a1.008 1.008 0 0 0 1.011-1 .99.99 0 0 0-.877-.992 1.169 1.169 0 0 0-.119-.008C62.728 40.89 62 39.676 62 37.5c0-2.2.741-3.41 1.023-3.5ZM32.287 57.321A12.384 12.384 0 0 1 31 51.21a13.239 13.239 0 0 1 1.153-5.9l3.293.387A12.639 12.639 0 0 0 34 52a13.83 13.83 0 0 0 1.1 5.652Zm-4.036-.475A12.619 12.619 0 0 1 27 50.79a12.941 12.941 0 0 1 1.186-5.941l1.87.22A16.273 16.273 0 0 0 29 51.21a16.826 16.826 0 0 0 .947 5.836Zm-16.164-1.9a13.591 13.591 0 0 1-1.067-5.7A11.863 11.863 0 0 1 12.412 43l13.563 1.593c.03 0 .057.018.087.018a.185.185 0 0 0 .023 0A16.294 16.294 0 0 0 25 50.79a16.965 16.965 0 0 0 .926 5.783Zm-3.993-.469A13.5 13.5 0 0 1 7.02 48.76a11.869 11.869 0 0 1 1.38-6.236l1.862.219a15.529 15.529 0 0 0-1.246 6.5 17.385 17.385 0 0 0 .8 5.438ZM4.022 40C3.74 39.91 3 38.693 3 36.5c0-2.174.726-3.386.992-3.494l4.737.552c.017 0 .03.013.046.015l20.114 2.36A11.906 11.906 0 0 0 28.25 40a13.254 13.254 0 0 0 .309 2.881l-1.913-.224A8.922 8.922 0 0 1 26 39a7.868 7.868 0 0 1 .2-1.775 1 1 0 1 0-1.949-.45A9.929 9.929 0 0 0 24 39a12.579 12.579 0 0 0 .435 3.4l-12.388-1.456h-.021l-3.986-.47h-.026ZM9.64 24.668l3.883.455h.01l22.22 2.619A8.946 8.946 0 0 0 35 31.5a9.578 9.578 0 0 0 .525 3.2l-21.643-2.541A12.08 12.08 0 0 1 13.5 29a14.75 14.75 0 0 1 .115-1.872 1 1 0 1 0-1.984-.256A16.749 16.749 0 0 0 11.5 29a15.174 15.174 0 0 0 .273 2.912l-2.232-.262A10.413 10.413 0 0 1 9 28a8.949 8.949 0 0 1 .64-3.332ZM38 28a.945.945 0 0 0 .118-.007l22.4-2.685A9.571 9.571 0 0 0 60 28.5a8.923 8.923 0 0 0 .757 3.765l-22.746 2.726C37.721 34.876 37 33.673 37 31.5c0-2.193.74-3.41 1-3.5Zm-7.3 15.132A10.279 10.279 0 0 1 30.25 40a8.087 8.087 0 0 1 .732-3.821l4.774.56A8.926 8.926 0 0 0 35 40.5a9.578 9.578 0 0 0 .525 3.2Zm7.314.86C37.722 43.877 37 42.674 37 40.5c0-2.193.74-3.41 1-3.5a.939.939 0 0 0 .119-.007l22.4-2.685A9.571 9.571 0 0 0 60 37.5a8.821 8.821 0 0 0 .78 3.762ZM27.348 21.2a14.053 14.053 0 0 1 3.305 0l23.88 2.808L38 25.993l-24.233-2.856h-.01l-1.269-.149ZM3.987 24l3.608.423A11.091 11.091 0 0 0 7 28a14.5 14.5 0 0 0 .373 3.389L4.022 31C3.74 30.91 3 29.693 3 27.5c0-2.158.716-3.37.987-3.495ZM4 54c-.7 0-2-2.278-2-6 0-3.7 1.278-5.966 1.985-5.995l2.274.267A15.566 15.566 0 0 0 5.02 48.76a17.326 17.326 0 0 0 .809 5.448l-1.712-.2A.908.908 0 0 0 4 54Zm46.8 3.4a.985.985 0 0 0-.852-.4 1 1 0 0 0-.8.484L48 59.39v-8.578l4-.482V59Zm3.2-1.327v-5.984l.628-.076a1 1 0 0 0-.237-1.987l-1.5.182h-.007l-6 .72c-.011 0-.02.008-.031.009l-1.246.151a1 1 0 0 0 .115 1.993.945.945 0 0 0 .118-.007l.16-.02v5.979l-8 .96-.088-.01C37.222 57.816 36 55.683 36 52c0-3.722 1.3-6 2-6a.939.939 0 0 0 .119-.007L60.1 43.358A13.819 13.819 0 0 0 59 49a12.682 12.682 0 0 0 1.439 6.3Z"
                                                    fill="#0dcaf0" opacity="1" data-original="#0dcaf0" class="">
                                                </path>
                                            </g>
                                        </svg>
                                    </span>

                                </div>
                                <div class="mt-4 mb-3 d-flex align-items-center lh-1">
                                    <h3 class="fw-bold  mb-0">{{ $books }}</h3>
                                </div>
                                <a href="{{ route('book.index') }}" class="btn-link fw-semi-bold">View</a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    @endcan

    @can('recruter dashboard')
        <div class="app-content-area">
            <div class="container-fluid">
                <div class="row mt-5">
                    <div class="col-lg-12 col-md-12 col-12">
                        <!-- Page header -->
                        <div class="d-flex justify-content-between mb-5 align-items-center">
                            <h3 class="mb-0">Recruitment</h3>
                        </div>
                    </div>
                </div>
                <div class="row row-cols-1  row-cols-xl-4 row-cols-md-2 ">
                    <div class="col mb-5">
                        <div class="card h-100 card-lift">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="text-muted fw-semi-bold">My Job Post</span>
                                    <span><svg xmlns="http://www.w3.org/2000/svg" version="1.1"
                                            xmlns:xlink="http://www.w3.org/1999/xlink" width="35" height="35" x="0"
                                            y="0" viewBox="0 0 682.667 682.667" style="enable-background:new 0 0 512 512"
                                            xml:space="preserve" class="">
                                            <g>
                                                <defs>
                                                    <clipPath id="a" clipPathUnits="userSpaceOnUse">
                                                        <path d="M0 512h512V0H0Z" fill="#0dcaf0" opacity="1"
                                                            data-original="#0dcaf0"></path>
                                                    </clipPath>
                                                </defs>
                                                <g clip-path="url(#a)" transform="matrix(1.33333 0 0 -1.33333 0 682.667)">
                                                    <path
                                                        d="M0 0h56.113c13.282 0 24.048 10.767 24.048 24.048v296.597c0 13.282-10.766 24.048-24.048 24.048h-448.904c-13.281 0-24.048-10.766-24.048-24.048V24.048C-416.839 10.767-406.072 0-392.791 0h296.598"
                                                        style="stroke-width:15;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1"
                                                        transform="translate(424.339 83.653)" fill="none" stroke="#0dcaf0"
                                                        stroke-width="15" stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-miterlimit="10" stroke-dasharray="none" stroke-opacity=""
                                                        data-original="#0dcaf0" class=""></path>
                                                    <path
                                                        d="m0 0-47.221 20.531c-6.426 2.794-6.426 11.908 0 14.702l154.678 67.252a32.069 32.069 0 0 0 25.57 0l154.678-67.252c6.426-2.794 6.426-11.908 0-14.702l-79.292-34.475"
                                                        style="stroke-width:15;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1"
                                                        transform="translate(135.758 224.11)" fill="none" stroke="#0dcaf0"
                                                        stroke-width="15" stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-miterlimit="10" stroke-dasharray="none" stroke-opacity=""
                                                        data-original="#0dcaf0" class=""></path>
                                                    <path
                                                        d="M0 0c-48.699 0-88.177-7.178-88.177-16.033v-64.129a8.016 8.016 0 0 1 8.016-8.016H80.161a8.016 8.016 0 0 1 8.016 8.016v64.129C88.177-7.178 48.699 0 0 0Z"
                                                        style="stroke-width:15;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1"
                                                        transform="translate(256 260.008)" fill="none" stroke="#0dcaf0"
                                                        stroke-width="15" stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-miterlimit="10" stroke-dasharray="none" stroke-opacity=""
                                                        data-original="#0dcaf0" class=""></path>
                                                    <path d="M0 0v-96.193"
                                                        style="stroke-width:15;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1"
                                                        transform="translate(376.242 219.927)" fill="none"
                                                        stroke="#0dcaf0" stroke-width="15" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-miterlimit="10"
                                                        stroke-dasharray="none" stroke-opacity="" data-original="#0dcaf0"
                                                        class=""></path>
                                                    <path
                                                        d="M0 0v0c-8.854 0-16.033-7.178-16.033-16.032v-24.049h32.065v24.049C16.032-7.178 8.854 0 0 0Z"
                                                        style="stroke-width:15;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1"
                                                        transform="translate(376.242 123.734)" fill="none"
                                                        stroke="#0dcaf0" stroke-width="15" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-miterlimit="10"
                                                        stroke-dasharray="none" stroke-opacity="" data-original="#0dcaf0"
                                                        class=""></path>
                                                    <path
                                                        d="M0 0c0-13.282-10.767-24.048-24.048-24.048-13.282 0-24.049 10.766-24.049 24.048 0 13.282 10.767 24.048 24.049 24.048C-10.767 24.048 0 13.282 0 0Z"
                                                        style="stroke-width:15;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1"
                                                        transform="translate(95.677 364.218)" fill="none" stroke="#0dcaf0"
                                                        stroke-width="15" stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-miterlimit="10" stroke-dasharray="none" stroke-opacity=""
                                                        data-original="#0dcaf0" class=""></path>
                                                    <path d="M0 0h96.194"
                                                        style="stroke-width:15;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1"
                                                        transform="translate(127.742 380.25)" fill="none" stroke="#0dcaf0"
                                                        stroke-width="15" stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-miterlimit="10" stroke-dasharray="none" stroke-opacity=""
                                                        data-original="#0dcaf0" class=""></path>
                                                    <path d="M0 0h48.097"
                                                        style="stroke-width:15;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1"
                                                        transform="translate(127.742 348.185)" fill="none"
                                                        stroke="#0dcaf0" stroke-width="15" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-miterlimit="10"
                                                        stroke-dasharray="none" stroke-opacity="" data-original="#0dcaf0"
                                                        class=""></path>
                                                    <path d="M0 0h176.354"
                                                        style="stroke-width:15;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1"
                                                        transform="translate(167.823 203.895)" fill="none"
                                                        stroke="#0dcaf0" stroke-width="15" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-miterlimit="10"
                                                        stroke-dasharray="none" stroke-opacity="" data-original="#0dcaf0"
                                                        class=""></path>
                                                </g>
                                            </g>
                                        </svg></span>

                                </div>
                                <div class="mt-4 mb-3 d-flex align-items-center lh-1">
                                    <h3 class="fw-bold  mb-0">{{ $myJobPost }}</h3>
                                </div>
                                <a href="{{ route('job.post.user') }}" class="btn-link fw-semi-bold">View</a>
                            </div>
                        </div>
                    </div>
                    <div class="col mb-5">
                        <div class="card h-100 card-lift">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="text-muted fw-semi-bold">Applications</span>
                                    <span><svg xmlns="http://www.w3.org/2000/svg" version="1.1"
                                            xmlns:xlink="http://www.w3.org/1999/xlink" width="35" height="35" x="0"
                                            y="0" viewBox="0 0 682.667 682.667" style="enable-background:new 0 0 512 512"
                                            xml:space="preserve" class="">
                                            <g>
                                                <defs>
                                                    <clipPath id="a" clipPathUnits="userSpaceOnUse">
                                                        <path d="M0 512h512V0H0Z" fill="#0dcaf0" opacity="1"
                                                            data-original="#0dcaf0"></path>
                                                    </clipPath>
                                                </defs>
                                                <g clip-path="url(#a)" transform="matrix(1.33333 0 0 -1.33333 0 682.667)">
                                                    <path
                                                        d="M0 0h56.113c13.282 0 24.048 10.767 24.048 24.048v296.597c0 13.282-10.766 24.048-24.048 24.048h-448.904c-13.281 0-24.048-10.766-24.048-24.048V24.048C-416.839 10.767-406.072 0-392.791 0h296.598"
                                                        style="stroke-width:15;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1"
                                                        transform="translate(424.339 83.653)" fill="none" stroke="#0dcaf0"
                                                        stroke-width="15" stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-miterlimit="10" stroke-dasharray="none" stroke-opacity=""
                                                        data-original="#0dcaf0" class=""></path>
                                                    <path
                                                        d="m0 0-47.221 20.531c-6.426 2.794-6.426 11.908 0 14.702l154.678 67.252a32.069 32.069 0 0 0 25.57 0l154.678-67.252c6.426-2.794 6.426-11.908 0-14.702l-79.292-34.475"
                                                        style="stroke-width:15;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1"
                                                        transform="translate(135.758 224.11)" fill="none" stroke="#0dcaf0"
                                                        stroke-width="15" stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-miterlimit="10" stroke-dasharray="none" stroke-opacity=""
                                                        data-original="#0dcaf0" class=""></path>
                                                    <path
                                                        d="M0 0c-48.699 0-88.177-7.178-88.177-16.033v-64.129a8.016 8.016 0 0 1 8.016-8.016H80.161a8.016 8.016 0 0 1 8.016 8.016v64.129C88.177-7.178 48.699 0 0 0Z"
                                                        style="stroke-width:15;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1"
                                                        transform="translate(256 260.008)" fill="none" stroke="#0dcaf0"
                                                        stroke-width="15" stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-miterlimit="10" stroke-dasharray="none" stroke-opacity=""
                                                        data-original="#0dcaf0" class=""></path>
                                                    <path d="M0 0v-96.193"
                                                        style="stroke-width:15;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1"
                                                        transform="translate(376.242 219.927)" fill="none"
                                                        stroke="#0dcaf0" stroke-width="15" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-miterlimit="10"
                                                        stroke-dasharray="none" stroke-opacity="" data-original="#0dcaf0"
                                                        class=""></path>
                                                    <path
                                                        d="M0 0v0c-8.854 0-16.033-7.178-16.033-16.032v-24.049h32.065v24.049C16.032-7.178 8.854 0 0 0Z"
                                                        style="stroke-width:15;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1"
                                                        transform="translate(376.242 123.734)" fill="none"
                                                        stroke="#0dcaf0" stroke-width="15" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-miterlimit="10"
                                                        stroke-dasharray="none" stroke-opacity="" data-original="#0dcaf0"
                                                        class=""></path>
                                                    <path
                                                        d="M0 0c0-13.282-10.767-24.048-24.048-24.048-13.282 0-24.049 10.766-24.049 24.048 0 13.282 10.767 24.048 24.049 24.048C-10.767 24.048 0 13.282 0 0Z"
                                                        style="stroke-width:15;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1"
                                                        transform="translate(95.677 364.218)" fill="none" stroke="#0dcaf0"
                                                        stroke-width="15" stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-miterlimit="10" stroke-dasharray="none" stroke-opacity=""
                                                        data-original="#0dcaf0" class=""></path>
                                                    <path d="M0 0h96.194"
                                                        style="stroke-width:15;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1"
                                                        transform="translate(127.742 380.25)" fill="none" stroke="#0dcaf0"
                                                        stroke-width="15" stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-miterlimit="10" stroke-dasharray="none" stroke-opacity=""
                                                        data-original="#0dcaf0" class=""></path>
                                                    <path d="M0 0h48.097"
                                                        style="stroke-width:15;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1"
                                                        transform="translate(127.742 348.185)" fill="none"
                                                        stroke="#0dcaf0" stroke-width="15" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-miterlimit="10"
                                                        stroke-dasharray="none" stroke-opacity="" data-original="#0dcaf0"
                                                        class=""></path>
                                                    <path d="M0 0h176.354"
                                                        style="stroke-width:15;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1"
                                                        transform="translate(167.823 203.895)" fill="none"
                                                        stroke="#0dcaf0" stroke-width="15" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-miterlimit="10"
                                                        stroke-dasharray="none" stroke-opacity="" data-original="#0dcaf0"
                                                        class=""></path>
                                                </g>
                                            </g>
                                        </svg></span>

                                </div>
                                <div class="mt-4 mb-3 d-flex align-items-center lh-1">
                                    <h3 class="fw-bold  mb-0">{{ $course }}</h3>
                                </div>
                                <a href="{{ route('course.index') }}" class="btn-link fw-semi-bold">View</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endcan

@endsection


<!-- Start:Script -->
@push('script')
@endpush
<!-- End:Script -->
