@extends('frontend.app')
<!-- Start:Title -->
@section('title', "$journal->journal_title")
<!-- End:Title -->
@push('style')
    <script src="{{ asset('backend/libs/toastr/toastr.css') }}"></script>
    <style>
        .author {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 6px;
            margin-top: 10px;
        }

        .author span {
            font-size: 17px;
            font-weight: 600;
        }

        .image-wrapper {
            text-align: center;
        }

        .guide-details img {
            width: 100%;
            max-width: 100%;
            border-radius: 5px;
        }

        .category-wrapper {
            margin-top: 23px
        }

        .category-wrapper span {
            background-color: #7c5fe3;
            display: inline-block;
            margin-right: 5px;
            color: white;
            padding: 3px 26px;
            border-radius: 20px;
            font-size: 15px;
            text-transform: capitalize;
        }

        .section_right h4 {
            color: #7c5fe3;
            font-weight: 600;
        }

        .icon img {
            height: 50px;
            object-fit: cover;
            border-radius: 50%;
        }

        .techwave_fn_interactive_list.modern a {
            padding: 10px 28px;
        }

        .techwave_fn_interactive_list.modern .title {
            font-size: 16px;
        }

        .guide-create {
            text-align: start;
            font-size: 12px;
        }

        .techwave_fn_interactive_list.modern .icon {
            min-width: 50px;
            width: 50px;
            height: 50px;
        }

        .recent-guide {
            margin-bottom: 40px;
        }

        .section_home .section_left {
            padding: 93px 40px 80px;
            border-right: 1px solid var(--techwave-border-color);
            width: 100%;
        }

        .parent{
            justify-content: center;
            align-items: center;
        }

        .btn-gradient{
            background: linear-gradient(transparent, transparent) padding-box, linear-gradient(to right, hsla(11,80%,45%,1), #d40cdfdb) border-box;
        }

        .section_home .section_right {
            padding: 66px 40px;
        }

        .section_home .section_left {
            padding: 50px 40px 80px;
        }

        .techwave_fn_title_holder .title {
            text-align: start;
            padding: 0 34px;
            font-weight: 600;
        }
        .author {
            justify-content: flex-start;
            padding: 0 34px;
        }
    </style>
@endpush



<!-- Start:Content -->

@section('content')


    <div class="techwave_fn_home">
        <div class="section_home">
            <div class="section_left">
                <!-- Title Shortcode -->
                <div class="techwave_fn_title_holder">
                    <h1 class="title fn__animated_text">{{ $journal->journal_title }}</h1>
                    <span class="author">
                        <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink"
                             width="20" height="20" x="0" y="0" viewBox="0 0 469.336 469.336"
                             style="enable-background:new 0 0 512 512" xml:space="preserve" class="">
                            <g>
                                <path
                                    d="M459.95 137.237 331.971 9.089c-12.063-12.12-33.219-12.11-45.26-.01l-42.656 42.713c-6.052 6.039-9.385 14.091-9.385 22.665s3.333 16.626 9.375 22.655l127.99 128.159c6.031 6.06 14.073 9.398 22.635 9.398s16.604-3.338 22.625-9.387l42.656-42.713c6.052-6.039 9.385-14.092 9.385-22.665 0-8.575-3.334-16.628-9.386-22.667zM235.127 118.543c-3.5-3.51-8.938-4.135-13.115-1.552-31.146 19.094-79.938 41.854-135.521 41.854-4.76 0-8.948 3.156-10.26 7.74L.408 431.97a10.678 10.678 0 0 0 4.979 12.198c4.26 2.406 9.656 1.646 13.031-1.948l126.885-134.344c4.26-4.521 6.271-10.885 5.51-17.469-1.469-12.875 4.427-24.615 15.76-31.396 9.958-5.938 23.177-5.646 32.979.698 8.49 5.531 13.74 13.979 14.76 23.781 1.01 9.656-2.344 19.125-9.198 25.979-6.865 6.865-16.365 10.125-26.219 9.031-6.719-.792-12.885 1.229-17.427 5.531L27.117 450.918a10.674 10.674 0 0 0-1.948 13.031 10.668 10.668 0 0 0 9.271 5.385c.969 0 1.958-.135 2.927-.406l265.385-75.823a10.676 10.676 0 0 0 7.74-10.26c0-55.583 22.76-104.375 41.854-135.521a10.669 10.669 0 0 0-1.552-13.115L235.127 118.543z"
                                    fill="#7c5fe3" opacity="1" data-original="#000000" class=""></path>
                            </g>
                        </svg>
                        <span>{{ $journal->user->name }}</span>
                    </span>
                </div>


                <!-- Guide Details -->
                <div class="container guide-details">
                    <div class="image-wrapper">
                        <img src="{{ asset($journal->journal_featured_image) }}" alt="">
                    </div>
                    @if ($journal->user_id == auth()->user()->id)
                        <div class="parent">
                            <a href="{{ route('journal.edit', ['id' => $journal->id]) }}" class="btn-gradient-fill">
                                <i class="bi bi-pencil-square"></i>
                                Edit Journal
                            </a>
                            <button onclick="showDeleteConfirm({{ $journal->id }})" class="btn-gradient">
                                <i class="bi bi-trash-fill"></i> Delete Journal</button>
                        </div>
                    @endif
                    <hr style="margin: 20px 0;">
                    <h4>Abstract:</h4>
                    <hr style="margin: 20px 0;">
                    <div class="description-wrapper">
                        <p>
                            {!! $journal->description !!}
                        </p>
                    </div>

                </div>
                <!-- !Guide Details -->

            </div>
            <div class="section_right">
                <div class="recent-guide">
                    <h4 class="fn__animated_text ">Recent Guides</h4>
                    <div class="techwave_fn_interactive_list modern">
                        <ul>
                            @foreach ($journals as $journal)
                                <li>
                                    <div class="item">
                                        <a href="{{ route('single.journal', ['slug' => $journal->journal_slug]) }}">
                                            <span class="icon">
                                                <img src="{{ asset($journal->journal_featured_image) }}" alt="">
                                            </span>
                                            <div>

                                                <h2 class="title">{{ Str::limit($journal->journal_title, 30, '...') }}</h2>
                                                <div class="guide-create">
                                                    {{ Carbon\Carbon::parse($journal->created_at)->format('Y-m-d') }}
                                                </div>
                                            </div>

                                            <span class="arrow"><svg xmlns="http://www.w3.org/2000/svg"
                                                                     xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Layer_1"
                                                                     x="0px" y="0px" viewBox="0 0 145.1 225.1"
                                                                     style="enable-background:new 0 0 145.1 225.1;" xml:space="preserve"
                                                                     class="fn__svg replaced-svg">
                                                    <path
                                                        d="M104.4,112.2c-10.6-9.1-21-18-31.5-27C51.1,66.5,29.3,47.8,7.4,29.1c-4.6-3.9-7.2-8.6-6.5-14.7c0.7-6.2,4-10.7,9.8-13.1  c6-2.5,11.6-1.4,16.5,2.7c8.1,6.8,16.2,13.8,24.2,20.7c28.9,24.7,57.7,49.5,86.6,74.1c5.4,4.6,8.5,10.1,6.4,17.1  c-1,3.3-3.1,6.7-5.7,9C101.5,157.1,64,189,26.6,221c-7.1,6-17,5.2-22.8-1.7c-5.9-7.1-4.9-16.7,2.5-23c31.7-27.2,63.4-54.3,95.1-81.5  C102.4,114.1,103.2,113.3,104.4,112.2z">
                                                    </path>
                                                </svg></span>
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






@endsection

<!-- Start:Script -->

@push('script')
    <!-- sweetalert -->

    <script type="text/javascript" src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <script src="{{ asset('backend/libs/toastr/toastr.js') }}"></script>

    <script>
        // delete Confirm

        function showDeleteConfirm(id) {

            event.preventDefault();

            swal({

                title: `Are you sure you want to delete this record?`,

                text: "If you delete this, it will be gone forever.",

                buttons: true,

                dangerMode: true,

            }).then((willDelete) => {

                if (willDelete) {

                    deleteItem(id);

                }

            });

        };



        // Delete Button

        function deleteItem(id) {

            var url = '{{ route('journal.destroy', ':id') }}';

            $.ajax({

                type: "DELETE",

                url: url.replace(':id', id),

                success: function(resp) {

                    // Reloade DataTable

                    if (resp.success === true) {



                        // show toast message

                        toastr.success(resp.message);

                        window.setTimeout(function() {

                            window.location.href = "{{ route('journal.index') }}";

                        }, 2000);



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
