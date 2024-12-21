@extends('frontend.app')
<!-- Start:Title -->
@section('title', 'Forum Post')
<!-- End:Title -->
@push('style')
    {{-- Css cdn  --}}
    <link rel="stylesheet" href="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/css/nice-select.css') }} ">
    <link rel="stylesheet" href="{{ asset('frontend/plugins/slick-slider/slick.css') }}">
    <!-- Option 1: Include in HTML -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
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
        }

        .forum-post-info {
            display: flex;
            gap: 25px;
        }

        .forum-post-info div {
            display: flex;
            gap: 5px;
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
            margin: 10px 0 15px 0;
            display: flex;
            gap: 10px;
            align-items: center;
        }

        .user-span img {
            border-radius: 50%;
        }

        .forum--post--container {
            display: flex;
            align-items: center;
            justify-content: space-between;
            width: 100%;
        }

        .sidebar_content{
            position: sticky;
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
                            <h1 class="title fn__animated_text ">Forum Posts</h1>
                            <div>
                                <a href="{{ route('forum_post.create') }}" class="btn-gradient-fill">
                                    <div style="display: flex;align-items: center;gap: 5px;">
                                        <i class="bi bi-pencil-square"></i>
                                        Create Forum
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container">
                    <div class="chat__list">
                        @forelse ($forumPosts as $forumPost)
                            <a href="{{ route('forum_post.detail', $forumPost->post_slug) }}" class="fouram__item">
                                <div class="chat__item active" id="chat1">
                                    <div class="chat__box your__chat">
                                        <div class="author ">
                                            <span>{{ $forumPost->category->category_name }}</span>
                                        </div>
                                        <div class="chat">
                                            <span class="user-span">
                                                <img src="{{ $forumPost->user->user_avatar != null ? asset($forumPost->user->user_avatar) : asset('assets/images/user.png') }}"
                                                    style="width: 50px" alt="">
                                                {{ $forumPost->user->name }}
                                            </span>
                                            <p>{{ $forumPost->post_title }}</p>

                                            <div class="forum-post-info">
                                                <div class="">
                                                    <div>
                                                        <i class="bi bi-chat-left-dots ms-0"></i>
                                                    </div>
                                                    <div style="margin-top: 4px;">
                                                        {{ $forumPost->comments()->count() }} Answer
                                                    </div>
                                                </div>
                                                <div class="">
                                                    <div>
                                                        <i class="bi bi-hand-thumbs-up"></i>
                                                    </div>
                                                    <div style="margin-top: 4px;">
                                                        {{ $forumPost->votes }} Votes
                                                    </div>
                                                </div>
                                                <div class="">
                                                    <div>
                                                        <i class="bi bi-eye"></i>
                                                    </div>
                                                    <div style="margin-top: 4px;">
                                                        {{ $forumPost->views }} Views
                                                    </div>
                                                </div>
                                                <div class="">
                                                    <div>
                                                        <i class="bi bi-clock"></i>
                                                    </div>
                                                    <div style="margin-top: 4px;">
                                                        {{ \Carbon\Carbon::parse($forumPost->created_at)->format('g.iA, jS M Y') }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </a>
                        @empty
                            <h1 class="text-danger text-center p-5 h3">No Forum Found</h1>
                        @endforelse
                        @if ($forumPosts->nextPageUrl() || $forumPosts->previousPageUrl())
                            <nav>
                                <ul class="pagination">
                                    <!-- Previous Page Link -->
                                    @if ($forumPosts->onFirstPage())
                                        <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                                            <span class="page-link" aria-hidden="true">&lsaquo;</span>
                                        </li>
                                    @else
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $forumPosts->previousPageUrl() }}" rel="prev"
                                                aria-label="@lang('pagination.previous')">&lsaquo;</a>
                                        </li>
                                    @endif

                                    <!-- Pagination Elements -->
                                    @foreach ($forumPosts->getUrlRange(1, $forumPosts->lastPage()) as $page => $url)
                                        @if ($page == $forumPosts->currentPage())
                                            <li class="page-item active" aria-current="page"><span
                                                    class="page-link">{{ $page }}</span></li>
                                        @else
                                            <li class="page-item"><a class="page-link"
                                                    href="{{ $url }}">{{ $page }}</a></li>
                                        @endif
                                    @endforeach
                                    <!-- Next Page Link -->

                                    @if ($forumPosts->hasMorePages())
                                        <li class="page-item">

                                            <a class="page-link" href="{{ $forumPosts->nextPageUrl() }}" rel="next"
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
                    <div class="chat__group new">
                        <h2 class="group__title">Popular Forums</h2>
                        <ul class="group__list">
                            @foreach ($popularForums as $popularForum)
                                <a href="{{ route('forum_post.detail', $popularForum->post_slug) }}" class=""
                                    style="text-decoration: none;">
                                    <li class="group__item">
                                        <div class="fn__chat_link">
                                            <span
                                                class="text">{{ Str::limit($popularForum->post_title, 25, '...') }}</span>
                                            <span class="options">
                                                <button class="trigger"><span></span></button>
                                            </span>
                                        </div>
                                    </li>
                                </a>
                            @endforeach
                        </ul>
                    </div>

                    <div class="chat__group new">
                        <h2 class="group__title">Popular Categories</h2>
                        <ul class="group__list">
                            @foreach ($popularCategorys as $category)
                                @php($category = \App\Models\Category::where('id', $category->category_id)->first())
                                @if ($selectedCategory !== null)
                                    <a href="{{ route('forum_post.category.post', encrypt($category->id)) }}"
                                        class="{{ $selectedCategory == $category->id ? 'tag-active' : '' }}"
                                        style="text-decoration: none;">
                                        <li class="group__item">
                                            <div class="fn__chat_link">
                                                <span class="text">{{ $category->category_name }}</span>
                                                <span class="options">
                                                    <button class="trigger"><span></span></button>
                                                </span>
                                            </div>
                                        </li>
                                    </a>
                                @else
                                    <a href="{{ route('forum_post.category.post', encrypt($category->id)) }}"
                                        style="text-decoration: none;" class="tag-active">
                                        <li class="group__item">
                                            <div class="fn__chat_link">
                                                <span class="text">{{ $category->category_name }}</span>
                                                <span class="options">
                                                    <button class="trigger"><span></span></button>
                                                </span>
                                            </div>
                                        </li>
                                    </a>
                                @endif
                            @endforeach
                        </ul>
                    </div>


                    <div class="chat__group new">
                        <h2 class="group__title">All Categories</h2>
                        <ul class="group__list">
                            @foreach ($categorys as $category)
                                @if ($selectedCategory !== null)
                                    <a href="{{ route('forum_post.category.post', encrypt($category->id)) }}"
                                        class="{{ $selectedCategory == $category->id ? 'tag-active' : '' }}"
                                        style="text-decoration: none;">
                                        <li class="group__item">
                                            <div class="fn__chat_link">
                                                <span class="text">{{ $category->category_name }}</span>
                                                <span class="options">
                                                    <button class="trigger"><span></span></button>
                                                </span>
                                            </div>
                                        </li>
                                    </a>
                                @else
                                    <a href="{{ route('forum_post.category.post', encrypt($category->id)) }}"
                                        style="text-decoration: none;" class="tag-active">
                                        <li class="group__item">
                                            <div class="fn__chat_link">
                                                <span class="text">{{ $category->category_name }}</span>
                                                <span class="options">
                                                    <button class="trigger"><span></span></button>
                                                </span>
                                            </div>
                                        </li>
                                    </a>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>

        </div>
        <!-- !AI Chat Bot Page -->

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
    </script>
@endpush

<!-- End:Script -->
