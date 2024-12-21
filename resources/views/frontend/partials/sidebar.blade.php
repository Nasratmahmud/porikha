<!-- LEFT PANEL -->
<div class="techwave_fn_leftpanel">

    <div class="mobile_extra_closer"></div>

    <!-- logo (left panel) -->
    <div class="leftpanel_logo">
        <a href="{{ route('root.page') }}" class="fn_logo" style="text-decoration: none;">
            @php($setting = \App\Models\Setting::first())
            @if (!empty($setting->logo))
                <span class="full_logo">
                    <img src="{{ asset($setting->logo) }}" height="40" alt="" class="desktop_logo">
                    <img src="{{ asset($setting->logo) }}" height="40" alt="" class="retina_logo">
                    <b style="font-size:24px;text-transform:capitalize;">
                        {{ $setting->title }}
                    </b>
                </span>
                <span class="short_logo">
                    <img src="{{ asset($setting->logo) }}" height="40" alt="" class="desktop_logo">
                    <img src="{{ asset($setting->logo) }}" height="40" alt="" class="retina_logo">
                </span>
            @else
                <span class="full_logo">
                    <img src="{{ asset('frontend/img/logo-desktop-full.png') }}" alt="" class="desktop_logo">
                    <img src="{{ asset('frontend/img/logo-retina-full.png') }}" alt="" class="retina_logo">
                </span>
                <span class="short_logo">
                    <img src="{{ asset('frontend/img/logo-desktop-mini.png') }}" alt="" class="desktop_logo">
                    <img src="{{ asset('frontend/img/logo-retina-mini.png') }}" alt="" class="retina_logo">
                </span>
            @endif
        </a>
        <a href="#" class="fn__closer fn__icon_button desktop_closer">
            <img src="{{ asset('frontend/svg/arrow.svg') }}" alt="" class="fn__svg">
        </a>
        <a href="#" class="fn__closer fn__icon_button mobile_closer">
            <img src="{{ asset('frontend/svg/arrow.svg') }}" alt="" class="fn__svg">
        </a>
    </div>
    <!-- !logo (left panel) -->

    <!-- content (left panel) -->
    <div class="leftpanel_content">

        <!-- #1 navigation group -->
        <div class="nav_group">
            <h2 class="group__title">Start Here</h2>
            <ul class="group__list">
                <li>
                    <a href="{{ route('user.dashboard') }}"
                        class="fn__tooltip @if (request()->routeIs('user.dashboard')) active @endif menu__item"
                        data-position="right" title="Home">
                        <span class="icon"><img src="{{ asset('frontend/svg/home.svg') }}" alt=""
                                class="fn__svg"></span>
                        <span class="text">Home</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('journal.index') }}"
                        class="fn__tooltip menu__item @if (request()->routeIs(['journal.*', 'single.journal', 'my.journal.index'])) active @endif"
                        data-position="right" title="Journals">
                        <span class="icon"><img src="{{ asset('frontend/svg/community.svg') }}" alt=""
                                class="fn__svg"></span>
                        <span class="text">Journals</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('guidances') }}"
                        class="fn__tooltip menu__item @if (request()->routeIs(['guidances', 'guidances.single'])) active @endif"
                        data-position="right" title="Guides">
                        <span class="icon"><img src="{{ asset('frontend/svg/community.svg') }}" alt=""
                                class="fn__svg"></span>
                        <span class="text">Guides</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('forum_post') }}"
                        class="fn__tooltip menu__item @if (request()->routeIs(['forum_post', 'forum_post.*'])) active @endif"
                        data-position="right" title="Forum Posts">
                        <span class="icon"><img src="{{ asset('frontend/svg/community.svg') }}" alt=""
                                class="fn__svg"></span>
                        <span class="text">Forum Posts</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('course.collection') }}"
                        class="fn__tooltip menu__item @if (request()->routeIs(['course.collection', 'course.enrollment'])) active @endif"
                        data-position="right" title="Courses">
                        <span class="icon"><img src="{{ asset('frontend/svg/cube.svg') }}" alt=""
                                class="fn__svg"></span>
                        <span class="text">Courses</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('jobs') }}"
                        class="fn__tooltip menu__item @if (request()->routeIs(['jobs'])) active @endif"
                        data-position="right" title="Courses">
                        <span class="icon"><img src="{{ asset('frontend/svg/cube.svg') }}" alt=""
                                class="fn__svg"></span>
                        <span class="text">Job Board</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('book.collection') }}"
                        class="fn__tooltip menu__item @if (request()->routeIs('book.collection')) active @endif"
                        data-position="right" title="Books">
                        <span class="icon"><img src="{{ asset('frontend/svg/cube.svg') }}" alt=""
                                class="fn__svg"></span>
                        <span class="text">Books</span>
                    </a>
                </li>
                {{-- <li>
                    <a href="{{ route('bundle.page') }}"
                        class="fn__tooltip menu__item @if (request()->routeIs(['bundle.page', 'single.bundle'])) active @endif"
                        data-position="right" title="Bundles">
                        <span class="icon"><img src="{{ asset('frontend/svg/cube.svg') }}" alt=""
                                class="fn__svg"></span>
                        <span class="text">Bundles</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('insight.index') }}"
                        class="fn__tooltip menu__item @if (request()->routeIs('insight.index')) active @endif"
                        data-position="right" title="Insights">
                        <span class="icon"><img src="{{ asset('frontend/svg/cube.svg') }}" alt=""
                                class="fn__svg"></span>
                        <span class="text">Insights</span>
                    </a>
                </li> --}}
                <li>
                    <a href="{{ url('/chatify') }}"
                        class="fn__tooltip menu__item @if (request()->routeIs('chatify*')) active @endif"
                        data-position="right" title="Chat">
                        <span class="icon"><img src="{{ asset('frontend/svg/cube.svg') }}" alt=""
                                class="fn__svg"></span>
                        <span class="text">Chat</span>
                    </a>
                </li>
            </ul>
        </div>
        <!-- !#1 navigation group -->

        <!-- #2 navigation group -->
        <div class="nav_group">
            <h2 class="group__title">User Tools</h2>
            <ul class="group__list">
                <li>
                    <a href="{{ route('userProfile') }}"
                        class="fn__tooltip menu__item @if (request()->routeIs('userProfile')) active @endif"
                        data-position="right" title="Profile">
                        <span class="icon"><img src="{{ asset('frontend/svg/person.svg') }}" alt=""
                                class="fn__svg"></span>
                        <span class="text">Profile</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form-sidebar').submit();"
                        class="fn__tooltip menu__item" data-position="right" title="Log Out">
                        <span class="icon"><img src="{{ asset('frontend/svg/logout.svg') }}" alt=""
                                class="fn__svg"></span>
                        <span class="text">Log Out</span>
                        <form id="logout-form-sidebar" action="{{ route('logout') }}" method="POST"
                            style="display: none;">
                            @csrf
                        </form>
                    </a>
                </li>
            </ul>
        </div>
        <!-- !#2 navigation group -->

        {{-- <!-- #3 navigation group -->
        <div class="nav_group">
            <h2 class="group__title">Extra</h2>
            <ul class="group__list">
                <li>
                    <a href="personal-feed.html" class="fn__tooltip menu__item" data-position="right"
                        title="Personal Feed">
                        <span class="icon"><img src="{{ asset('frontend/svg/person.svg') }}" alt=""
                                class="fn__svg"></span>
                        <span class="text">Personal Feed<span class="count">48</span></span>
                    </a>
                </li>
                <li>
                    <a href="image-generation.html" class="fn__tooltip menu__item" data-position="right"
                        title="Image Generation">
                        <span class="icon"><img src="{{ asset('frontend/svg/image.svg') }}" alt=""
                                class="fn__svg"></span>
                        <span class="text">Image Generation</span>
                    </a>
                </li>
                <li>
                    <a href="ai-chat-bot.html" class="fn__tooltip menu__item" data-position="right"
                        title="AI Chat Bot">
                        <span class="icon"><img src="{{ asset('frontend/svg/chat.svg') }}" alt=""
                                class="fn__svg"></span>
                        <span class="text">AI Chat Bot</span>
                    </a>
                </li>
                <li>
                    <a href="pricing.html" class="fn__tooltip menu__item" data-position="right" title="Pricing">
                        <span class="icon"><img src="{{ asset('frontend/svg/dollar.svg') }}" alt=""
                                class="fn__svg"></span>
                        <span class="text">Pricing</span>
                    </a>
                </li>
                <li class="menu-item-has-children">
                    <a href="video-generation.html" class="fn__tooltip menu__item" title="FAQ &amp; Help"
                        data-position="right">
                        <span class="icon"><img src="{{ asset('frontend/svg/question.svg') }}" alt=""
                                class="fn__svg"></span>
                        <span class="text">FAQ &amp; Help</span>
                        <span class="trigger"><img src="{{ asset('frontend/svg/arrow.svg') }}" alt=""
                                class="fn__svg"></span>
                    </a>
                    <ul class="sub-menu">
                        <li>
                            <a href="documentation.html"><span class="text">Documentation</span></a>
                        </li>
                        <li>
                            <a href="faq.html"><span class="text">FAQ</span></a>
                        </li>
                        <li>
                            <a href="changelog.html"><span class="text">Changelog<span
                                        class="fn__sup">(4.1.2)</span></span></a>
                        </li>
                        <li>
                            <a href="contact.html"><span class="text">Contact Us</span></a>
                        </li>
                        <li>
                            <a href="index-2.html"><span class="text">Home #2</span></a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="sign-in.html" class="fn__tooltip menu__item" data-position="right" title="Log Out">
                        <span class="icon"><img src="{{ asset('frontend/svg/logout.svg') }}" alt=""
                                class="fn__svg"></span>
                        <span class="text">Log Out</span>
                    </a>
                </li>
            </ul>
        </div>
        <!-- !#3 navigation group --> --}}


    </div>
    <!-- !content (left panel) -->

</div>
<!-- !LEFT PANEL -->
