<div class="app-menu">

    <!-- Sidebar -->



    <div class="navbar-vertical navbar nav-dashboard">

        <div class="h-100" data-simplebar>

            <!-- Brand logo -->

            <a class="navbar-brand" href="{{ route('root.page') }}">

                @php($setting = \App\Models\Setting::first())



                @if (!empty($setting->logo))
                    <img src="{{ asset($setting->logo) }}" class="img-fluid" alt="User Dashboard">
                @else
                    <img src="{{ asset('backend/images/logo/logo.png') }}" alt="User Dashboard">
                @endif

            </a>

            <!-- Navbar nav -->

            <ul class="navbar-nav flex-column" id="sideNavbar">

                <!-- Nav item -->

                <li class="nav-item">

                    <a class="nav-link has-arrow @if (request()->routeIs('user.dashboard')) active @endif"
                        href="{{ route('user.dashboard') }}">

                        <i class="nav-icon me-2 bi bi-house"></i> Dashboard

                    </a>

                </li>

                <!-- Journals Section -->

                <li class="nav-item">

                    <a class="nav-link has-arrow @if (request()->routeIs(['journal.*', 'single.journal', 'my.journal.index'])) active @endif"
                        href="{{ route('journal.index') }}">

                        <i class="nav-icon me-2 bi bi-journal"></i>

                        Journals

                    </a>

                </li>



                <!-- Guidances Section -->

                <li class="nav-item">

                    <a class="nav-link has-arrow @if (request()->routeIs(['guidances', 'guidances.single'])) active @endif"
                        href="{{ route('guidances') }}">

                        <i class="nav-icon me-2 bi bi-broadcast"></i> Guides

                    </a>

                </li>





                <!-- Furms Section -->

                <li class="nav-item">

                    <a class="nav-link has-arrow @if (request()->routeIs(['forum_post', 'forum_post.*'])) active @endif"
                        href="{{ route('forum_post') }}">

                        <i class="nav-icon me-2 bi bi-bookmarks"></i>

                        Forum Posts

                    </a>

                </li>



                <!-- Nav item -->

                <li class="nav-item">

                    <a class="nav-link has-arrow @if (request()->routeIs(['course.collection', 'course.enrollment'])) active @endif"
                        href="{{ route('course.collection') }}">

                        <i class="nav-icon me-2 bi bi-postcard"></i> Courses

                    </a>

                </li>

                <!-- Nav item -->

                <li class="nav-item">

                    <a class="nav-link has-arrow @if (request()->routeIs('book.collection')) active @endif"
                        href="{{ route('book.collection') }}">

                        <i class="nav-icon me-2 bi bi-book"></i> Books

                    </a>

                </li>

                <!-- Nav item -->

                <li class="nav-item">

                    <a class="nav-link has-arrow @if (request()->routeIs(['bundle.page', 'single.bundle'])) active @endif"
                        href="{{ route('bundle.page') }}">

                        <i class="nav-icon me-2 bi bi-box-seam"></i> Bundles

                    </a>

                </li>

                <!-- Nav item -->

                <li class="nav-item">

                    <a class="nav-link has-arrow @if (request()->routeIs('insight.index')) active @endif"
                        href="{{ route('insight.index') }}">

                        <i class="nav-icon me-2 bi bi-bounding-box-circles"></i> Insights

                    </a>

                </li>

                <!-- Nav item -->

                <li class="nav-item">

                    <a class="nav-link has-arrow @if (Request::is('chatify*')) active @endif"
                        href="{{ url('/chatify') }}">

                        <i class="nav-icon me-2 bi bi-chat-left"></i> Chat

                    </a>

                </li>

                <!-- Nav item -->

                <li class="nav-item">

                    <a class="nav-link has-arrow @if (request()->routeIs('userProfile')) active @endif"
                        href="{{ route('userProfile', ['type' => 'profile']) }}">

                        <i class="nav-icon me-2 bi bi-person-video3"></i> Profile

                    </a>

                </li>

            </ul>

        </div>

    </div>



</div>
