@extends('frontend.app')



<!-- Start:Title -->

@section('title', 'Forum Post')

<!-- End:Title -->

@push('style')
    {{-- Css cdn  --}}
    <link rel="stylesheet" href="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/css/nice-select.css') }} ">
    <link rel="stylesheet" href="{{ asset('frontend/plugins/slick-slider/slick.css') }}">

    <style>
        /*TechWeav Dashboard CSS*/
        .techwave_fn_pagetitle{
            padding: 34px 0px;
        }

        #doc_introduction{
            padding: 34px 0px;
        }

        .user_profile img{
            width: 50px;
            height: auto;
        }

        .forum-content {
            padding: 16px 0px;
        }


        .forum-post-other-info{
           border-top: 1px solid #312e37;
           border-bottom: 1px solid #312e37;
           padding: 20px 0px;
           margin: 30px 0px;
        }

        .fn__select_model .fn__icon_button{
            width: auto;
            height: auto;
            background-color: transparent;
        }

        .fn__select_model .fn__icon_button{
            position: absolute;
            top: 50%;
            margin-top: -24px;
            right: 0;
            padding: 10px 16px;
        }

        .fn__icon_button .forum-post-info{
            display: flex;
            gap: 24px;
        }

        .forum-post-info_item{
            display: flex;
            flex-direction: row;
            align-items: center;
            gap: 11px;
            border-left: 1px solid #c0bcca26;
            padding: 0px 10px 0px 10px;
            background-color: #0000;
            border-top: 0px;
            border-bottom: 0px;
            border-radius: 0px;
        }

        #doc_introduction .forum-post-featured_image{
            width: 100%;
            max-width: 100%;
            height: auto;
        }

        .group__list__content h1,
        .group__list__content h2,
        .group__list__content h3,
        .group__list__content h4,
        .group__list__content h5,
        .group__list__content h6,
        .group__list__content p,
        .group__list__content a{
            font-size: 14px;
            padding: 0px;
            margin: 0px;
            line-height: 22px;
        }

        .group__list{
            margin: 30px 30px 30px 0px;
        }

        .group__list li{
             list-style: none;
         }

        .group__item:hover{
            background-color: #8768f8;
            border-radius: 4px;
        }

        .group__item:hover  .text{
            color: #fff !important ;
        }

        .group__item:hover > .group__list__content p{
            color: #fff;
        }

        .fn__chat_link{
            height: auto;
            padding: 10px 40px 10px 20px;
        }

        .fn__chat_link h5{
            margin-bottom: 0px;
        }




        /*forum-comment*/
        .bootstrap-tagsinput {

            padding: 10px;

        }



        .bootstrap-tagsinput .tag {

            padding: .3rem;

            border-radius: 5px;

            background: #0b75f1;

            color: #fff;

        }



        ul.forum-tags li label {

            display: block;

            padding: 6px 20px;

            background: rgba(240, 247, 254, 0.6);

            border: 0.5px solid #e4e4e7;

            border-radius: 4px;

            font-weight: 600;

            color: var(--brand-900) !important;

            transition: all linear 0.2s;

        }



        ul.forum-tags li input {

            display: none;

        }



        ul.forum-tags li input:checked+label {

            background-color: #0963CD;

            color: #fff !important;

        }



        .ck.ck-reset.ck-editor {

            height: 300px !important;

        }



        .ck.ck-content.ck-editor__editable {

            height: 262px !important;

        }



        .max-w-2xl.mx-auto.px-4 {

            padding: 0 !important;

        }



        .py-2.px-4.mb-4.bg-white.rounded-lg.rounded-t-lg.border.border-gray-200.dark\:bg-gray-800.dark\:border-gray-700,

        .py-2.px-4.mb-4.bg-white.rounded-lg.rounded-t-lg.border.border-gray-200.dark\:bg-gray-800.dark\:border-gray-700 {

            padding: 0 !important;

            border: none !important;

        }



        p.inline-flex.items-center.mr-3.text-sm.text-gray-900.dark\:text-white {

            align-items: flex-start;

            display: flex;

            gap: 1rem;

            color: #0963CD !important;

        }



        label.sr-only {

            font-size: 1rem;

            color: var(--dashui-heading-color, inherit) !important;

            text-transform: capitalize;

        }



        textarea#comment,

        textarea#reply-comment {

            margin-top: 1rem;

            border-radius: 8px;

            background-color: var(--dashui-white);

            width: 100%;

            padding: 1rem !important;

        }



        button.inline-flex.items-center.py-2\.5.px-4.text-xs.font-medium.text-center.text-white.bg-primary-700.rounded-lg.focus\:ring-4.focus\:ring-primary-200.dark\:focus\:ring-primary-900.hover\:bg-primary-800 {

            background: #0b75f1 !important;

            border: none;

            padding: 0.5rem 0.5rem;

            font-weight: 500;

        }



        img.mr-2.w-6.h-6.rounded-full {

            border-radius: 50%;

            width: 50px;

        }



        footer.flex.justify-between.items-center.mb-1 {

            display: flex;

            justify-content: space-between;

            height: 100px;

            margin-bottom: -30px !important;

        }



        article.p-6.mb-1.text-base.bg-white.rounded-lg.dark\:bg-gray-900 {

            padding: 1rem !important;

            margin-bottom: 4rem !important;

            box-shadow: 0 0.125rem .5rem rgba(71, 85, 105, .15) !important;

        }



        article.p-1.mb-1.ml-1.lg\:ml-12.border-t.border-gray-200.dark\:border-gray-700.dark\:bg-gray-900 {

            margin-left: 2rem !important;

        }



        article.p-6.mb-1.text-base.bg-white.rounded-lg.dark\:bg-gray-900 div.relative {

            text-align: end;

        }



        article.p-6.mb-1.text-base.bg-white.rounded-lg.dark\:bg-gray-900 div.flex.items-center {

            display: flex;

            gap: 1rem;

            align-items: flex-start;

        }



        /* Action button section  */

        button.inline-flex.items-center.p-2.text-sm.font-medium.text-center.text-gray-400.bg-white.rounded-lg.hover\:bg-gray-100.focus\:ring-4.focus\:outline-none.focus\:ring-gray-50.dark\:bg-gray-900.dark\:hover\:bg-gray-700.dark\:focus\:ring-gray-600 {

            border: none !important;

            width: 40px;

            padding: 0 !important;

            transform: rotate(90deg);

            margin-bottom: 5px;

            margin-right: -15px;



        }



        button.inline-flex.items-center.p-2.text-sm.font-medium.text-center.text-gray-400.bg-white.rounded-lg.hover\:bg-gray-100.focus\:ring-4.focus\:outline-none.focus\:ring-gray-50.dark\:bg-gray-900.dark\:hover\:bg-gray-700.dark\:focus\:ring-gray-600 svg {

            width: 50% !important;

            color: #0b75f1 !important;

        }



        .absolute.z-10.top-full.right-0.mt-1.w-36.bg-white.rounded.divide-y.divide-gray-100.shadow.dark\:bg-gray-700.dark\:divide-gray-600 {}



        ul.py-1.text-sm.text-gray-700.dark\:text-gray-200 {

            display: flex;

            flex-direction: column;

            gap: .2rem;

            padding: 0.5rem 0.5rem 0 1rem;

        }



        ul.py-1.text-sm.text-gray-700.dark\:text-gray-200 button {

            border: none !important;

            padding: 0 !important;

            background: transparent !important;

        }



        ul.py-1.text-sm.text-gray-700.dark\:text-gray-200 li:nth-child(1) button {

            color: #45cffd !important;

        }



        ul.py-1.text-sm.text-gray-700.dark\:text-gray-200 li:nth-child(2) button {

            color: #dc3545 !important;

        }



        /* Like and replay section  */

        button.flex.items-center.text-sm.text-gray-500.hover\:underline.dark\:text-gray-400,

        button.inline-flex.space-x-2.text-gray-400.hover\:text-gray-500.focus\:outline-none.focus\:ring-0,

        button.inline-flex.space-x-2.text-green-400.hover\:text-green-500.focus\:outline-none.focus\:ring-0 {

            display: flex;

            align-items: center;

            width: auto;

            gap: 0.2rem;

            border: none;

            background: transparent;

        }



        button.flex.items-center.text-sm.text-gray-500.hover\:underline.dark\:text-gray-400 svg.mr-1.w-4.h-4 {

            width: 16px;

        }



        /* no likes button css  */

        time,

        button.inline-flex.space-x-2.text-gray-400.hover\:text-gray-500.focus\:outline-none.focus\:ring-0 span.font-medium.text-gray-900 {

            color: #94a3b8 !important;

        }



        /* like button css  */

        button.inline-flex.space-x-2.text-green-400.hover\:text-green-500.focus\:outline-none.focus\:ring-0,

        button.inline-flex.space-x-2.text-green-400.hover\:text-green-500.focus\:outline-none.focus\:ring-0 span.font-medium.text-gray-900 {

            color: #0b75f1 !important;

            font-weight: 600;

        }

        .text-gray-900,
        [data-theme=dark] .text-white {
            color: var(--dashui-heading-color, inherit) !important;
        }


        .forum-details-post section.bg-white,
        .forum-details-post form>div.bg-white {
            background-color: transparent !important;
        }

        .forum-details {
            padding: 0 30px;
        }

        .dash-breadcrumb-tree {
            padding: 20px 30px 0 !important;
        }

        @media only screen and (max-width: 650px) {
            .dash-breadcrumb-tree {
                padding: 20px 30px 0;
            }
        }

        


    </style>
@endpush



<!-- Start:Content -->

@section('content')



    <div class="techwave_fn_home">
        <div class="section_home">
            <div class="section_left">
                <div class="techwave_fn_pagetitle">
                    <h2 class="title">{{ $forumPost->post_title }}</h2>
                </div>

                <div id="doc_introduction">

                    <img class="forum-post-featured_image" src="{{ asset($forumPost->feature_image) }}">

                    <div class="forum-post-other-info">
                        <div class="fn__select_model">
                            <div class="model_open">
                                <img class="user_img" src="{{ $forumPost->user->user_avatar == null ? asset('backend/images/avatar/user-avatar.png') : asset($forumPost->user->user_avatar) }}" alt="">
                                <div class="author">
                                    <h3 class="title">{{ $forumPost->user->name }}</h3>
                                    <h4 class="subtitle">Date : {{ \Carbon\Carbon::parse($forumPost->created_at)->format('g.iA, jS M Y') }}</h4>
                                </div>

                                <div class="fn__icon_button">
                                    <div class="forum-post-info">
                                        <div class="forum-post-info_item">
                                            <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="20" height="20" x="0" y="0" viewBox="0 0 100 100" style="enable-background:new 0 0 512 512" xml:space="preserve" class=""><g><path d="M69.789 22.74H17.56c-4.144 0-7.515 3.371-7.515 7.515v35.979c0 4.144 3.371 7.515 7.515 7.515h8.408l-4.15 14.204a1.6 1.6 0 0 0 2.51 1.714L44.937 73.75h24.851c4.144 0 7.515-3.371 7.515-7.515v-35.98c.001-4.144-3.37-7.515-7.514-7.515zm4.319 43.494a4.324 4.324 0 0 1-4.319 4.319H44.393c-.353 0-.697.117-.976.333L26.264 84.133l3.37-11.534a1.598 1.598 0 0 0-1.535-2.046H17.56a4.324 4.324 0 0 1-4.319-4.319V30.255a4.324 4.324 0 0 1 4.319-4.318h52.229a4.324 4.324 0 0 1 4.319 4.318z" fill="#c0bcca" opacity="1" data-original="#000000" class=""></path><path d="M82.438 10h-52.23c-4.145 0-7.518 3.372-7.518 7.518v.422a1.597 1.597 0 1 0 3.196 0v-.422a4.326 4.326 0 0 1 4.321-4.321h52.23a4.326 4.326 0 0 1 4.321 4.321v35.979c0 2.375-1.939 4.308-4.321 4.308h-.332a1.597 1.597 0 1 0 0 3.196h.332c4.145 0 7.518-3.367 7.518-7.505V17.518c0-4.146-3.372-7.518-7.517-7.518z" fill="#c0bcca" opacity="1" data-original="#000000" class=""></path></g></svg>
                                            <div style="margin-top: 4px;">
                                                1 Answer
                                            </div>
                                        </div>
                                    </div>
                                        @if (empty($like))
                                            <button class="forum-post-info_item forum-post_vote" onclick="likeForum({{ $forumPost->id }})">
                                                <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="20" height="20" x="0" y="0" viewBox="0 0 478.2 478.2" style="enable-background:new 0 0 512 512" xml:space="preserve" class=""><g><path d="M457.575 325.1c9.8-12.5 14.5-25.9 13.9-39.7-.6-15.2-7.4-27.1-13-34.4 6.5-16.2 9-41.7-12.7-61.5-15.9-14.5-42.9-21-80.3-19.2-26.3 1.2-48.3 6.1-49.2 6.3h-.1c-5 .9-10.3 2-15.7 3.2-.4-6.4.7-22.3 12.5-58.1 14-42.6 13.2-75.2-2.6-97-16.6-22.9-43.1-24.7-50.9-24.7-7.5 0-14.4 3.1-19.3 8.8-11.1 12.9-9.8 36.7-8.4 47.7-13.2 35.4-50.2 122.2-81.5 146.3-.6.4-1.1.9-1.6 1.4-9.2 9.7-15.4 20.2-19.6 29.4-5.9-3.2-12.6-5-19.8-5h-61c-23 0-41.6 18.7-41.6 41.6v162.5c0 23 18.7 41.6 41.6 41.6h61c8.9 0 17.2-2.8 24-7.6l23.5 2.8c3.6.5 67.6 8.6 133.3 7.3 11.9.9 23.1 1.4 33.5 1.4 17.9 0 33.5-1.4 46.5-4.2 30.6-6.5 51.5-19.5 62.1-38.6 8.1-14.6 8.1-29.1 6.8-38.3 19.9-18 23.4-37.9 22.7-51.9-.4-8.1-2.2-15-4.1-20.1zm-409.3 122.2c-8.1 0-14.6-6.6-14.6-14.6V270.1c0-8.1 6.6-14.6 14.6-14.6h61c8.1 0 14.6 6.6 14.6 14.6v162.5c0 8.1-6.6 14.6-14.6 14.6h-61v.1zm383.7-133.9c-4.2 4.4-5 11.1-1.8 16.3 0 .1 4.1 7.1 4.6 16.7.7 13.1-5.6 24.7-18.8 34.6-4.7 3.6-6.6 9.8-4.6 15.4 0 .1 4.3 13.3-2.7 25.8-6.7 12-21.6 20.6-44.2 25.4-18.1 3.9-42.7 4.6-72.9 2.2h-1.4c-64.3 1.4-129.3-7-130-7.1h-.1l-10.1-1.2c.6-2.8.9-5.8.9-8.8V270.1c0-4.3-.7-8.5-1.9-12.4 1.8-6.7 6.8-21.6 18.6-34.3 44.9-35.6 88.8-155.7 90.7-160.9.8-2.1 1-4.4.6-6.7-1.7-11.2-1.1-24.9 1.3-29 5.3.1 19.6 1.6 28.2 13.5 10.2 14.1 9.8 39.3-1.2 72.7-16.8 50.9-18.2 77.7-4.9 89.5 6.6 5.9 15.4 6.2 21.8 3.9 6.1-1.4 11.9-2.6 17.4-3.5.4-.1.9-.2 1.3-.3 30.7-6.7 85.7-10.8 104.8 6.6 16.2 14.8 4.7 34.4 3.4 36.5-3.7 5.6-2.6 12.9 2.4 17.4.1.1 10.6 10 11.1 23.3.4 8.9-3.8 18-12.5 27z" fill="#c0bcca" opacity="1" data-original="#000000" class=""></path></g></svg>
                                                <div style="margin-top: 4px;">
                                                    {{ $forumPost->votes }} Votes
                                                </div>
                                            </button>
                                        @else
                                            <button class="forum-post-info_item forum-post_vote" onclick="likeForum({{ $forumPost->id }})">
                                                <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="20" height="20" x="0" y="0" viewBox="0 0 511.999 511.999" style="enable-background:new 0 0 512 512" xml:space="preserve" class=""><g><path d="M15.34 224.948c-8.365 0-15.146 6.782-15.146 15.146v222.458c0 8.365 6.782 15.146 15.146 15.146h91.253v-252.75H15.34zM511.805 308.587c0-19.227-10.331-36.087-25.733-45.321a52.504 52.504 0 0 0 9.362-29.985c0-29.113-23.686-52.799-52.799-52.799H331.177c3.416-15.48 8.088-38.709 11.341-63.026 8.466-63.281 2.68-98.376-18.207-110.445-13.022-7.523-27.062-9.049-39.534-4.301-9.635 3.67-22.647 12.693-30.062 34.838l-29.294 76.701c-14.851 36.677-60.33 75.182-88.535 96.473V484.4C189.16 502.716 243.708 512 299.358 512h121.446c29.113 0 52.799-23.686 52.799-52.799a52.481 52.481 0 0 0-7.93-27.804c17.601-8.572 29.759-26.646 29.759-47.503a52.504 52.504 0 0 0-9.362-29.985c15.404-9.234 25.735-26.095 25.735-45.322z" fill="#c0bcca" opacity="1" data-original="#000000" class=""></path></g></svg>
                                                <div style="margin-top: 4px;">
                                                    {{ $forumPost->votes }} Votes
                                                </div>
                                            </button>
                                        @endif
                                        <div class="forum-post-info_item">
                                            <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="20" height="20" x="0" y="0" viewBox="0 0 511.999 511.999" style="enable-background:new 0 0 512 512" xml:space="preserve" class=""><g><path d="M508.745 246.041c-4.574-6.257-113.557-153.206-252.748-153.206S7.818 239.784 3.249 246.035a16.896 16.896 0 0 0 0 19.923c4.569 6.257 113.557 153.206 252.748 153.206s248.174-146.95 252.748-153.201a16.875 16.875 0 0 0 0-19.922zM255.997 385.406c-102.529 0-191.33-97.533-217.617-129.418 26.253-31.913 114.868-129.395 217.617-129.395 102.524 0 191.319 97.516 217.617 129.418-26.253 31.912-114.868 129.395-217.617 129.395z" fill="#c0bcca" opacity="1" data-original="#000000" class=""></path><path d="M255.997 154.725c-55.842 0-101.275 45.433-101.275 101.275s45.433 101.275 101.275 101.275S357.272 311.842 357.272 256s-45.433-101.275-101.275-101.275zm0 168.791c-37.23 0-67.516-30.287-67.516-67.516s30.287-67.516 67.516-67.516 67.516 30.287 67.516 67.516-30.286 67.516-67.516 67.516z" fill="#c0bcca" opacity="1" data-original="#000000" class=""></path></g></svg>
                                            <div style="margin-top: 4px;">
                                                37 Views
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                <div class="forum-content">
                        {!! $forumPost->post_content !!}
                    </div>

                <div class="forum-content forum-comment">
                        <livewire:comments :model="$forumPost" />
                    </div>




            </div>
            <div class="section_right">




                <div class="sidebar_content">
                    <div class="chat__group new">
                        <h4 class="group__title">Popular Forums</h4>

                        <ul class="group__list">
                            @foreach ($forumRelatedPosts as $forumRelatedPost)
                                <a href="{{ route('forum_post.detail', $forumRelatedPost->post_slug) }}" class=""
                                   style="text-decoration: none;">
                                    <li class="group__item">
                                        <div class="fn__chat_link">
                                            <div class="text">
                                                <h5 class="text">{{ Str::limit($forumRelatedPost->post_title, 28, '...') }}</h5>
                                                <div class="group__list__content text">{!! Str::limit($forumRelatedPost->post_content, 100, '...') !!}</div>
                                            </div>
                                            <span class="options">
                                                <button class="trigger"><span></span></button>
                                            </span>
                                        </div>
                                    </li>
                                </a>
                            @endforeach
                        </ul>

                        <h4 class="group__title">Popular Categories</h4>
                        <ul class="group__list">
                            @foreach ($popularCategorys as $popularCategory)

                                @php($categoryItem = \App\Models\Category::where('id', $popularCategory->category_id)->first())
                                <a href="{{ route('forum_post.category.post', encrypt($categoryItem->id)) }}" style="text-decoration: none;" class="tag-active">
                                    <li class="group__item">
                                        <div class="fn__chat_link">
                                            <span class="text">{{ $categoryItem->category_name }}</span>
                                            <span class="options">
                                                <button class="trigger"><span></span></button>
                                            </span>
                                        </div>
                                    </li>
                                </a>

                            @endforeach
                        </ul>

                        <h2 class="group__title">Trending topics</h2>
                        <ul class="group__list">
                            @foreach ($popularForums as $popularForum)
                                <a href="{{ route('forum_post.detail', $popularForum->post_slug) }}" class=""
                                   style="text-decoration: none;">
                                    <li class="group__item">
                                        <div class="fn__chat_link">
                                            <div class="text">
                                                <h5 class="text">{{ Str::limit($popularForum->post_title, 28, '...') }}</h5>
                                                <div class="group__list__content text">{!! Str::limit($popularForum->post_content, 100, '...') !!}</div>
                                            </div>
                                            <span class="options">
                                                <button class="trigger"><span></span></button>
                                            </span>
                                        </div>
                                    </li>
                                </a>
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
    <script src="{{ asset('frontend/js/jquery.nice-select.min.js') }}"></script>

    <script src="{{ asset('frontend/plugins/slick-slider/slick.min.js') }}"></script>



    <script>
        jQuery(document).ready(function($) {

            $('.forum-tags').slick({

                slidesToShow: 3,

                slidesToScroll: 1,

                dots: false,

                nextArrow: '<i class="bi bi-chevron-right tag-slide-btn tag-slide-btn-left"></i>',

                prevArrow: '<i class="bi bi-chevron-left tag-slide-btn tag-slide-btn-right"></i>',

                variableWidth: true,

                infinite: false,

                speed: 300,

                adaptiveHeight: true

            });

        })



        function likeForum(furam_id) {

            var url = '{{ route('like.furam', ':id') }}';
            var voteValue = <?php echo json_encode($forumPost->votes); ?>;
            var afterMyVote = voteValue + 1;


            $.ajax({
                type: "GET",
                url: url.replace(':id', furam_id),
                success: function(resp) {
                    if (resp.success === true) {
                        $('.forum-post_vote').html(
                            '<svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="20" height="20" x="0" y="0" viewBox="0 0 511.999 511.999" style="enable-background:new 0 0 512 512" xml:space="preserve" class=""><g><path d="M15.34 224.948c-8.365 0-15.146 6.782-15.146 15.146v222.458c0 8.365 6.782 15.146 15.146 15.146h91.253v-252.75H15.34zM511.805 308.587c0-19.227-10.331-36.087-25.733-45.321a52.504 52.504 0 0 0 9.362-29.985c0-29.113-23.686-52.799-52.799-52.799H331.177c3.416-15.48 8.088-38.709 11.341-63.026 8.466-63.281 2.68-98.376-18.207-110.445-13.022-7.523-27.062-9.049-39.534-4.301-9.635 3.67-22.647 12.693-30.062 34.838l-29.294 76.701c-14.851 36.677-60.33 75.182-88.535 96.473V484.4C189.16 502.716 243.708 512 299.358 512h121.446c29.113 0 52.799-23.686 52.799-52.799a52.481 52.481 0 0 0-7.93-27.804c17.601-8.572 29.759-26.646 29.759-47.503a52.504 52.504 0 0 0-9.362-29.985c15.404-9.234 25.735-26.095 25.735-45.322z" fill="#c0bcca" opacity="1" data-original="#000000" class=""></path></g></svg>' +
                            '<div style="margin-top: 4px;">'+ afterMyVote +' Votes</div>'
                        );
                        toastr.success(resp.message);

                    } else if (resp.success === false) {
                        $('.forum-post_vote').html(
                            '<svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="20" height="20" x="0" y="0" viewBox="0 0 478.2 478.2" style="enable-background:new 0 0 512 512" xml:space="preserve" class=""><g><path d="M457.575 325.1c9.8-12.5 14.5-25.9 13.9-39.7-.6-15.2-7.4-27.1-13-34.4 6.5-16.2 9-41.7-12.7-61.5-15.9-14.5-42.9-21-80.3-19.2-26.3 1.2-48.3 6.1-49.2 6.3h-.1c-5 .9-10.3 2-15.7 3.2-.4-6.4.7-22.3 12.5-58.1 14-42.6 13.2-75.2-2.6-97-16.6-22.9-43.1-24.7-50.9-24.7-7.5 0-14.4 3.1-19.3 8.8-11.1 12.9-9.8 36.7-8.4 47.7-13.2 35.4-50.2 122.2-81.5 146.3-.6.4-1.1.9-1.6 1.4-9.2 9.7-15.4 20.2-19.6 29.4-5.9-3.2-12.6-5-19.8-5h-61c-23 0-41.6 18.7-41.6 41.6v162.5c0 23 18.7 41.6 41.6 41.6h61c8.9 0 17.2-2.8 24-7.6l23.5 2.8c3.6.5 67.6 8.6 133.3 7.3 11.9.9 23.1 1.4 33.5 1.4 17.9 0 33.5-1.4 46.5-4.2 30.6-6.5 51.5-19.5 62.1-38.6 8.1-14.6 8.1-29.1 6.8-38.3 19.9-18 23.4-37.9 22.7-51.9-.4-8.1-2.2-15-4.1-20.1zm-409.3 122.2c-8.1 0-14.6-6.6-14.6-14.6V270.1c0-8.1 6.6-14.6 14.6-14.6h61c8.1 0 14.6 6.6 14.6 14.6v162.5c0 8.1-6.6 14.6-14.6 14.6h-61v.1zm383.7-133.9c-4.2 4.4-5 11.1-1.8 16.3 0 .1 4.1 7.1 4.6 16.7.7 13.1-5.6 24.7-18.8 34.6-4.7 3.6-6.6 9.8-4.6 15.4 0 .1 4.3 13.3-2.7 25.8-6.7 12-21.6 20.6-44.2 25.4-18.1 3.9-42.7 4.6-72.9 2.2h-1.4c-64.3 1.4-129.3-7-130-7.1h-.1l-10.1-1.2c.6-2.8.9-5.8.9-8.8V270.1c0-4.3-.7-8.5-1.9-12.4 1.8-6.7 6.8-21.6 18.6-34.3 44.9-35.6 88.8-155.7 90.7-160.9.8-2.1 1-4.4.6-6.7-1.7-11.2-1.1-24.9 1.3-29 5.3.1 19.6 1.6 28.2 13.5 10.2 14.1 9.8 39.3-1.2 72.7-16.8 50.9-18.2 77.7-4.9 89.5 6.6 5.9 15.4 6.2 21.8 3.9 6.1-1.4 11.9-2.6 17.4-3.5.4-.1.9-.2 1.3-.3 30.7-6.7 85.7-10.8 104.8 6.6 16.2 14.8 4.7 34.4 3.4 36.5-3.7 5.6-2.6 12.9 2.4 17.4.1.1 10.6 10 11.1 23.3.4 8.9-3.8 18-12.5 27z" fill="#c0bcca" opacity="1" data-original="#000000" class=""></path></g></svg>\n' +
                            '<div style="margin-top: 4px;">'+ voteValue +' Votes </div>'
                        )
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

            })

        }
    </script>
@endpush

<!-- End:Script -->
