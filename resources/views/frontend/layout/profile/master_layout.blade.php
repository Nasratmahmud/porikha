@extends('frontend.app')



<!-- Start:Title -->

@section('title', 'User Profile')

<!-- End:Title -->

@push('style')
    <!-- Add these lines to include pdf.js -->

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />

    <style>
        .app-content-area {

            padding: 80px 30px 20px;

        }



        .cover--img img {

            height: 250px;

        }



        @media only screen and (min-width: 361px) and (max-width: 479px) {

            .cover--img img {

                height: 150px;

            }

        }



        .journal-card img,

        .course-card img {

            width: 100%;

            height: 250px;

            object-fit: cover;

        }



        .books-collection {

            margin: 0 -10px !important;

        }
    </style>
@endpush



<!-- Start:Content -->

@section('content')

    <div class="app-content-area">

        <div class="user--profile">

            <div class="profile--page--wrapper">

                <!-- Dashboard :: user profile -> Start -->

                <section class="user--profile--area">

                    <div class="profile--box shadow">

                        <!-- Cover area -->

                        <div class="cover--area position-relative">



                            <div class="cover--img">

                                <img class="w-100 object-fit-fill"
                                    src="{{ !empty(auth()->user()->cover_image) ? asset(auth()->user()->cover_image) : asset('frontend/images/cover.png') }}"
                                    alt="img" id="coverPicturePreview" style="border-radius: 10px 10px 0 0;">

                            </div>

                            <!-- cover edit start -->

                            <div class="cover--edit--wrapper">

                                <div class="cover--edit--inner">

                                    <div class="cover--edit">

                                        <!-- cover edit dropdown toggle -->

                                        <label for="cover_image" class="cover--dropdown--toggle bg-primary">

                                            <i class="bi bi-camera"></i>

                                        </label>

                                        <form method="POST" action="{{ route('userCover.update') }}" class="d-none"
                                            id="coverPicUpdateForm" enctype="multipart/form-data">

                                            @csrf

                                            <input type="file" name="cover_image" id="cover_image"
                                                oninput="onChangeSaveCover(event)">

                                        </form>

                                    </div>

                                </div>

                            </div>

                        </div>

                        <!-- Profile area -->

                        <div class="profile--pic--wrapper">

                            <div class="profile--pic">

                                <img id="avatarPreview"
                                    src="{{ !empty(auth()->user()->user_avatar) ? asset(auth()->user()->user_avatar) : asset('backend/images/avatar/user-avatar.png') }}"
                                    alt="{{ auth()->user()->name }}">

                            </div>

                            <div class="user--name--area">

                                <h3>{{ auth()->user()->name }}</h3>

                                <p>{{ '@' . auth()->user()->username }}</p>

                            </div>

                        </div>

                        <!-- nav area -->

                        <ul class="profile--nav">

                            <li>

                                <a class="{{ request()->query('type') == 'journal' ? 'active' : '' }}"
                                    href="{{ route('userProfile', ['type' => 'journal']) }}">Post</a>

                            </li>

                            <li>

                                <a class="{{ request()->query('type') == 'course' ? 'active' : '' }}"
                                    href="{{ route('userProfile', ['type' => 'course']) }}">Course</a>

                            </li>

                            <li>

                                <a class="{{ request()->query('type') == 'bundles' ? 'active' : '' }}"
                                    href="{{ route('userProfile', ['type' => 'bundles']) }}">Bundles</a>

                            </li>
                            <li>

                                <a class="{{ request()->query('type') == 'books' ? 'active' : '' }}"
                                    href="{{ route('userProfile', ['type' => 'books']) }}">Books</a>

                            </li>

                            <li>

                                <a class="{{ request()->query('type') == 'profile' || request()->query('type') == '' ? 'active' : '' }}"
                                    href="{{ route('userProfile', ['type' => 'profile']) }}">Edit Profile</a>

                            </li>

                        </ul>

                    </div>

                </section>

                <!-- Dashboard :: user profile -> End -->



                <!-- Dashboard :: user Post -> Start -->

                @yield('tab_section')

            </div>

        </div>

    </div>

@endsection

<!-- Start:Script -->

@push('script')
    <script>
        function onChangeSaveCover(event) {

            const file = event.target.files[0];

            const coverPicturePreview = document.getElementById('coverPicturePreview');



            if (file) {

                coverPicturePreview.src = window.URL.createObjectURL(file);

                document.getElementById('coverPicUpdateForm').submit();

            } else {

                toastr.error("Image upload Failed");

            }

        }

        //favorite book
        function bookFavorite(button, book_id) {
            $.ajax({
                type: "POST",
                url: '{{ route('books.favorite') }}',
                data: {
                    book_id: book_id,
                },
                success: function(resp) {
                    if (resp.success === true && resp.type == 'remove') {
                        document.getElementById(`book_${book_id}`).remove();
                        if (0 == document.querySelectorAll('.book').length) {
                            document.getElementById('book_collection').innerHTML =
                                '<h1 class="text-danger text-center h3">You haven\'t favorited a book yet</h1>';
                        }

                    } else if (resp.errors) {
                        toastr.error(resp.errors[0]);
                    } else {
                        toastr.error(resp.message);
                    }
                },
                error: function(error) {
                    toastr.error("Something went wrong");
                }
            })
        }
        //favorite bundle
        function bundleFavorite(button, bundle_id) {
            $.ajax({
                type: "POST",
                url: '{{ route('bundle.favorite') }}',
                data: {
                    bundle_id: bundle_id,
                },
                success: function(resp) {
                    if (resp.success === true && resp.type == 'remove') {
                        document.getElementById(`bundle_${bundle_id}`).remove();
                        if (0 == document.querySelectorAll('.bundle').length) {
                            document.getElementById('bundle_collection').innerHTML =
                                '<h1 class="text-danger text-center h3">You haven\'t favorited a bundle yet</h1>';
                        }

                    } else if (resp.errors) {
                        toastr.error(resp.errors[0]);
                    } else {
                        toastr.error(resp.message);
                    }
                },
                error: function(error) {
                    toastr.error("Something went wrong");
                }
            })
        }
    </script>
@endpush

<!-- End:Script -->
