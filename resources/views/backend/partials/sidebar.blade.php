<div class="app-menu">
    <!-- Sidebar -->

    <div class="navbar-vertical navbar nav-dashboard">
        <div class="h-100" data-simplebar>
            <!-- Brand logo -->
            <a class="navbar-brand" href="{{ route('home') }}">
                @php($setting = \App\Models\Setting::first())

                @if (!empty($setting->logo))
                    <img src="{{ asset($setting->logo) }}" alt="CertifyHub">
                @else
                    {{-- <img src="{{ asset('backend/images/logo/Logo - The Certify Hub - White.jpg') }}"
                        alt="CertifyHub" width="230px"> --}}
                        <img src="{{ asset('backend/images/logo/Logo - The Certify Hub - White.jpg') }}"
                                alt="CertifyHub"
                                style="max-width: 100%; height: auto;">
                @endif
            </a>
            <!-- Navbar nav -->
            <ul class="navbar-nav flex-column" id="sideNavbar">

                {{-- Dashboard --}}
                <li class="nav-item">
                    <a class="nav-link has-arrow @if (request()->routeIs('home')) active @endif"
                        href="{{ route('home') }}">
                        <i class="nav-icon me-2 bi bi-house"></i>
                        Dashboard
                    </a>
                </li>

                {{-- @can('journal menu')

                    <li class="nav-item">
                        <a class="nav-link has-arrow @if (request()->routeIs('admin.journal*')) active @endif"
                            href="{{ route('admin.journal.index') }}">
                            <i class="nav-icon me-2 bi bi-journal"></i>
                            Journals
                        </a>
                    </li>
                @endcan --}}

                {{-- @can('forum menu')

                    <li class="nav-item">
                        <a class="nav-link has-arrow @if (request()->routeIs('admin.furam*')) active @endif"
                            href="{{ route('admin.furam.index') }}">
                            <i class="nav-icon me-2 bi bi-bookmarks"></i>
                            Forums
                        </a>
                    </li>
                @endcan --}}

                {{-- @can('category menu')

                    <li class="nav-item">
                        <a class="nav-link has-arrow @if (request()->routeIs('category*')) active @endif"
                            href="{{ route('category.index') }}">
                            <i class="nav-icon me-2 bi bi-grid-1x2-fill"></i>
                            Categories
                        </a>
                    </li>
                @endcan --}}
                {{-- @can('super admin')
                <li class="nav-item">
                    <a class="nav-link has-arrow @if (request()->routeIs('job.post')) active @endif"
                        href="{{ route('job.post') }}">
                        <i class="nav-icon me-2 bi bi-grid-1x2-fill"></i>
                        Job Posts
                    </a>
                </li>
                @endcan --}}
                {{-- @can('jobpost menu')
                    <li class="nav-item">
                        <a class="nav-link has-arrow @if (request()->routeIs('job.post.user')) active @endif"
                            href="{{ route('job.post.user') }}">
                            <i class="nav-icon me-2 bi bi-grid-1x2-fill"></i>
                            My Job Post
                        </a>
                    </li>
                @endcan --}}

                {{-- @can('bundle menu')

                    <li class="nav-item">
                        <a class="nav-link has-arrow @if (request()->routeIs('bundle*')) active @endif"
                            href="{{ route('bundle.index') }}">
                            <i class="nav-icon me-2 bi bi-box-seam"></i>
                            Bundles
                        </a>
                    </li>
                @endcan --}}

                @can('course menu')
                    {{-- Course --}}
                    <li class="nav-item">
                        <a class="nav-link has-arrow @if (request()->routeIs('course.*')) active @endif"
                            href="{{ route('course.index') }}">
                            <i class="nav-icon me-2 bi bi-postcard"></i>
                            Courses
                        </a>
                    </li>
                @endcan
                <li class="nav-item">
                    <a class="nav-link has-arrow @if (request()->routeIs('question.category.*')) active @endif"
                        href="{{ route('question.category.index') }}">
                        <i class="nav-icon me-2 bi bi-postcard"></i>
                        Question Category
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link has-arrow @if (request()->routeIs('questions.*')) active @endif"
                        href="{{ route('questions.index') }}">
                        <i class="nav-icon me-2 bi bi-postcard"></i>
                        Question
                    </a>
                </li>
                @can('quiz menu')
                    <li class="nav-item">
                        <a class="nav-link has-arrow @if (request()->routeIs('quizzes.*')) active @endif"
                            href="{{ route('quizzes.view') }}">
                            <i class="nav-icon me-2 bi bi-palette2"></i>
                            Quizzes
                        </a>
                    </li>
                @endcan
                {{-- <li class="nav-item">
                    <a class="nav-link has-arrow @if (request()->routeIs('purchases.*')) active @endif"
                        href="{{ route('purchases.index') }}">
                        <i class="nav-icon me-2 bi bi-postcard"></i>
                        Purchase
                    </a>
                </li> --}}
                {{-- @can('promo code menu')

                    <li class="nav-item">
                        <a class="nav-link has-arrow @if (request()->routeIs('promoCode.*')) active @endif"
                            href="{{ route('promoCode.index') }}">
                            <i class="nav-icon me-2 bi bi-patch-check-fill"></i>
                            Promo Code
                        </a>
                    </li>
                @endcan
                @can('book menu')

                    <li class="nav-item">
                        <a class="nav-link has-arrow @if (request()->routeIs('book.*')) active @endif"
                            href="{{ route('book.index') }}">
                            <i class="nav-icon me-2 bi bi-book"></i>
                            Books
                        </a>
                    </li>
                @endcan
                @can('guide menu')

                    <li class="nav-item">
                        <a class="nav-link has-arrow @if (request()->routeIs('guide.*')) active @endif"
                            href="{{ route('guide.index') }}">
                            <i class="nav-icon me-2 bi bi-broadcast"></i>
                            Guides
                        </a>
                    </li>
                @endcan --}}

                <!-- Setting Module -->
                <li class="nav-item">
                    <div class="navbar-heading">Settings</div>
                </li>
                <!-- Setting item -->
                <li class="nav-item">
                    <a href="javascript:void(0)"
                        class="nav-link has-arrow @if (request()->routeIs([
                                'setting*',
                                'user.profile*',
                                'user.password*',
                                'social.media',
                                'stripe.setting',
                                'pusher.setting',
                                'mail.setting',
                                'dynamic_page.create',
                                'dynamic_page.edit',
                            ])) active @else collapsed @endif"
                        data-bs-toggle="collapse" data-bs-target="#navDashboard"
                        aria-expanded="{{ request()->is(['setting*', 'user.profile*', 'user.password*']) ? 'true' : 'false' }}"
                        aria-controls="navDashboard">
                        <i class="nav-icon me-2 bi bi-gear-fill"></i>
                        Setting
                    </a>
                    <div id="navDashboard" class="collapse @if (request()->routeIs([
                            'setting*',
                            'user.profile*',
                            'user.password*',
                            'social.media',
                            'stripe.setting',
                            'pusher.setting',
                            'mail.setting',
                            'dynamic_page.create',
                            'dynamic_page.edit',
                        ])) show @endif"
                        data-bs-parent="#sideNavbar">
                        <ul class="nav flex-column list-group ">
                            @can('system setting')
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->is(['setting*']) ? 'active' : '' }}"
                                        href="{{ route('setting') }}">
                                        <i class="nav-icon me-2 bi bi-gear-fill"></i> System Setting
                                    </a>
                                </li>
                            @endcan
                            <li class="nav-item">
                                <a class="nav-link @if (request()->routeIs([
                                        'user.profile',
                                        'user.password',
                                        'stripe.setting',
                                        'pusher.setting',
                                        'mail.setting',
                                        'dynamic_page.create',
                                        'dynamic_page.edit',
                                    ])) active @endif"
                                    href="{{ route('user.profile') }}">
                                    <i class="nav-icon me-2 bi bi-person-video3"></i>
                                    Profile Setting
                                </a>
                            </li>
                            @can('social setting')
                                <li class="nav-item">
                                    <a class="nav-link @if (request()->routeIs('social.media')) active @endif"
                                        href="{{ route('social.media') }}">
                                        <i class="nav-icon me-2 bi bi-disc"></i>
                                        Social Media Setting
                                    </a>
                                </li>
                            @endcan

                        </ul>
                    </div>
                </li>
                @can('permission menu')
                    <!-- Role And Permission item -->
                    <li class="nav-item">
                        {{-- <a href="javascript:void(0)"
                            class="nav-link has-arrow @if (request()->routeIs('user.permission.*')) active @else collapsed @endif"
                            data-bs-toggle="collapse" data-bs-target="#navRolePermission"
                            aria-expanded="{{ request()->is('user.permission.*') ? 'true' : 'false' }}"
                            aria-controls="navRolePermission">
                            <i class="nav-icon me-2 bi bi-diagram-3"></i>
                            User Permissions
                        </a> --}}
                        <div id="navRolePermission" class="mt-4 collapse @if (request()->routeIs('user.permission.*')) show @endif"
                            data-bs-parent="#sideNavbar">
                            <ul class="nav flex-column list-group ">
                                <li class="nav-item">
                                    <a class="nav-link @if (request()->routeIs(['user.permission.*'])) active @endif"
                                        href="{{ route('user.permission.index') }}">
                                        <i class="nav-icon me-2 bi bi-shield"></i> Assign Permission
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                @endcan




            </ul>
        </div>
    </div>

</div>
