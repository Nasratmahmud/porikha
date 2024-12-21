@php
    $user = App\Models\User::find(auth()->user()->id);
@endphp
<!-- Searchbar -->
<div class="techwave_fn_searchbar">
    <div class="search__bar">
        <input class="search__input" type="text" placeholder="Search here...">
        <img src="{{ asset('frontend/svg/search.svg') }}" alt="" class="fn__svg search__icon">
        <a class="search__closer" href="#"><img src="{{ asset('frontend/svg/close.svg') }}" alt=""
                class="fn__svg"></a>
    </div>
    <div class="search__results">
        <div class="results__title">Results</div>
        <div class="results__list">
            <ul>
                <li><a href="#">Artificial Intelligence</a></li>
                <li><a href="#">Learn about the impact of AI on the financial industry</a></li>
                <li><a href="#">Delve into the realm of AI-driven manufacturing</a></li>
                <li><a href="#">Understand the ethical implications surrounding AI</a></li>
            </ul>
        </div>
    </div>
</div>
<!-- !Searchbar -->

<!-- HEADER -->
<header class="techwave_fn_header">

    <!-- Header left: token information -->
    <div class="header__left">

    </div>
    <!-- /Header left: token information -->


    <!-- Header right: navigation bar -->
    <div class="header__right">
        <div class="fn__nav_bar">

            {{-- <!-- Search (bar item) -->
            <div class="bar__item bar__item_search">
                <a href="#" class="item_opener fn__tooltip" title="Search">
                    <img src="{{ asset('frontend/svg/search.svg') }}" alt="" class="fn__svg">
                </a>
                <div class="item_popup" data-position="right">
                    <input type="text" placeholder="Search">
                </div>
            </div>
            <!-- !Search (bar item) --> --}}

            <!-- Notification (bar item) -->
            <div class="bar__item bar__item_notification has_notification">
                <a href="#" class="item_opener fn__tooltip" title="Notifications">
                    <img src="{{ asset('frontend/svg/bell.svg') }}" alt="" class="fn__svg">
                </a>
                <div class="item_popup" data-position="right">
                    <div class="ntfc_list">
                        <ul>
                            @forelse ($user->notifications as $notification)
                                <!-- List group item -->
                                <li class="@if (!$notification->read_at) bg-light @endif"
                                    onclick="markAsRead(this,'{{ $notification->id }}','{{ $notification->data['link'] }}')">
                                    <p>{{ $notification->data['name'] }}<br><a href="{{ $notification->data['link'] }}">
                                            {{ $notification->data['message'] }}</a>
                                    </p>
                                    <span>{{ Carbon\Carbon::parse($notification->created_at)->diffForHumans() }}</span>
                                </li>
                            @empty
                                <li>
                                    <p>No notification found</p>
                                </li>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>
            <!-- !Notification (bar item) -->

            <!-- Full Screen (bar item) -->
            <div class="bar__item bar__item_fullscreen">
                <a href="#" class="item_opener fn__tooltip" title="Full Screen">
                    <img src="{{ asset('frontend/svg/fullscreen.svg') }}" alt="" class="fn__svg f_screen">
                    <img src="{{ asset('frontend/svg/smallscreen.svg') }}" alt="" class="fn__svg s_screen">
                </a>
            </div>
            <!-- !Full Screen (bar item) -->

            <!-- Site Skin (bar item) -->
            <div class="bar__item bar__item_skin">
                <a href="#" class="item_opener fn__tooltip" title="Dark/Light">
                    <img src="{{ asset('frontend/svg/sun.svg') }}" alt="" class="fn__svg light_mode">
                    <img src="{{ asset('frontend/svg/moon.svg') }}" alt="" class="fn__svg dark_mode">
                </a>
            </div>
            <!-- !Site Skin (bar item) -->

            <!-- User (bar item) -->
            <div class="bar__item bar__item_user">
                <a href="#" class="user_opener fn__tooltip" title="User Profile">
                    @if (empty(auth()->user()->user_avatar))
                        <img src="{{ asset('backend/images/avatar/user-avatar.png') }}"
                            alt="{{ auth()->user()->email }}">
                    @else
                        <img src="{{ asset('/' . auth()->user()->user_avatar) }}" alt="{{ auth()->user()->email }}">
                    @endif
                </a>
                <div class="item_popup" data-position="right">
                    <div class="user_profile">
                        <div class="user_img">
                            @if (empty(auth()->user()->user_avatar))
                                <img src="{{ asset('backend/images/avatar/user-avatar.png') }}"
                                    alt="{{ auth()->user()->email }}">
                            @else
                                <img src="{{ asset('/' . auth()->user()->user_avatar) }}"
                                    alt="{{ auth()->user()->email }}">
                            @endif
                        </div>
                        <div class="user_info">
                            <h2 class="user_name">{{ auth()->user()->name }}</h2>
                            <p><a class="user_email">{{ auth()->user()->email }}</a>
                            </p>
                        </div>
                    </div>
                    <div class="user_nav">
                        <ul>
                            <li>
                                @php
                                    $balance = App\Models\CoinBalance::where('user_id', auth()->user()->id)
                                        ->latest()
                                        ->select('total')
                                        ->first();
                                @endphp
                                <a href="#">
                                    <span class="icon"><img src="{{ asset('frontend/svg/billing.svg') }}"
                                            alt="" class="fn__svg"></span>
                                    <span class="text">Balance : ${{ $balance->total }}</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('userProfile') }}">
                                    <span class="icon"><img src="{{ asset('frontend/svg/person.svg') }}"
                                            alt="" class="fn__svg"></span>
                                    <span class="text">Profile</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('userProfile', ['type' => 'change-pass']) }}">
                                    <span class="icon"><img src="{{ asset('frontend/svg/person.svg') }}"
                                            alt="" class="fn__svg"></span>
                                    <span class="text">Change Password</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <span class="icon"><img src="{{ asset('frontend/svg/logout.svg') }}"
                                            alt="" class="fn__svg"></span>
                                    <span class="text">Log Out</span>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                        style="display: none;">
                                        @csrf
                                    </form>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- !User (bar item) -->


        </div>
    </div>
    <!-- !Header right: navigation bar -->

</header>
<!-- !HEADER -->
