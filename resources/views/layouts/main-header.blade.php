<!-- main-header opened -->
<div class="main-header sticky side-header nav nav-item">
    <div class="container-fluid">
        <div class="main-header-left ">
            <div class="responsive-logo">
                <a href="{{ url('/' . ($page = 'index')) }}"><img src="{{ URL::asset('assets/img/brand/logo.png') }}"
                        class="logo-1" alt="logo"></a>
                <a href="{{ url('/' . ($page = 'index')) }}"><img
                        src="{{ URL::asset('assets/img/brand/logo-white.png') }}" class="dark-logo-1" alt="logo"></a>
                <a href="{{ url('/' . ($page = 'index')) }}"><img src="{{ URL::asset('assets/img/brand/favicon.png') }}"
                        class="logo-2" alt="logo"></a>
                <a href="{{ url('/' . ($page = 'index')) }}"><img src="{{ URL::asset('assets/img/brand/favicon.png') }}"
                        class="dark-logo-2" alt="logo"></a>
            </div>
            <div class="app-sidebar__toggle" data-toggle="sidebar">
                <a class="open-toggle" href="#"><i class="header-icon fe fe-align-left"></i></a>
                <a class="close-toggle" href="#"><i class="header-icons fe fe-x"></i></a>
            </div>

        </div>
        <div class="main-header-right">
            <ul class="nav">
                <li class="">

                </li>
            </ul>
            <div class="nav nav-item  navbar-nav-right ml-auto">
                <div class="nav-link" id="bs-example-navbar-collapse-1">

                </div>

                {{-- -------notification--------- --}}
                @can('الاشعارات')


                    <div class="dropdown nav-item main-header-notification">
                        <a class="new nav-link" href="#">
                            <svg xmlns="http://www.w3.org/2000/svg" class="header-icon-svgs" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="feather feather-bell">
                                <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
                                <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
                            </svg><span class=" pulse"></span></a>
                        <div class="dropdown-menu">
                            <div class="menu-header-content bg-primary text-right">
                                <div class="d-flex">
                                    <h6 class="dropdown-title mb-1 tx-15 text-white font-weight-semibold">الاشعارات</h6>
                                    <span class="badge badge-pill badge-warning mr-auto my-auto float-left"><a
                                            href="{{ url('user/mark_all_read') }}">تعين قراءة الكل</a></span>
                                </div>
                                <p class="dropdown-title-text subtext mb-0 text-white op-6 pb-0 tx-12 ">
                                <h6 style="color: yellow" id="notifications_count">

                                </h6>
                                </p>
                            </div>
                            <div id="unreadNotifications">

                                <div class="main-notification-list Notification-scroll">

                                    @php
                                        $user = \App\Models\User::find(Auth::user()->id);
                                    @endphp
                                    @foreach ($user->unreadNotifications as $notification)
                                        <a class="d-flex p-3 border-bottom" href="">
                                            <div class="notifyimg bg-pink">
                                                <i class="la la-file-alt text-white"></i>
                                            </div>
                                            <div class="mr-3">
                                                <h5 class="notification-label mb-1">

                                                    @if ($notification->type == 'App\Notifications\Invoice')
                                                        {{ 'تم انشاء القسم :' }}
                                                        ({{ $notification->data['section']['section_name'] }})
                                                        <br>
                                                        <div style="text-align:right">
                                                            {{ '  في توقيت :' }}{{ $notification->created_at }}</div>
                                                    @elseif ($notification->type = 'App\Notifications\ProductNotification')
                                                        {{ 'تم انشاء المنتج :' }}
                                                        ({{ $notification->data['product']['Product_name'] }})
                                                        <br>
                                                        <div style="text-align:left">
                                                            {{ '  في توقيت :' }}{{ $notification->created_at }}</div>
                                                    @endif
                                                </h5>
                                                <div class="notification-subtext"></div>
                                            </div>
                                        </a>
                                    @endforeach

                                </div>

                            </div>
                        </div>
                    </div>
                @endcan
                {{-- ---------end notifucation---------- --}}
                <div class="nav-item full-screen fullscreen-button">
                    <a class="new nav-link full-screen-link" href="#"><svg xmlns="http://www.w3.org/2000/svg"
                            class="header-icon-svgs" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="feather feather-maximize">
                            <path
                                d="M8 3H5a2 2 0 0 0-2 2v3m18 0V5a2 2 0 0 0-2-2h-3m0 18h3a2 2 0 0 0 2-2v-3M3 16v3a2 2 0 0 0 2 2h3">
                            </path>
                        </svg></a>
                </div>
                <div class="dropdown main-profile-menu nav nav-item nav-link">
                    <a class="profile-user d-flex" href=""><img alt=""
                            src="{{ URL::asset('assets/img/faces/6.jpg') }}"></a>
                    <div class="dropdown-menu">
                        <div class="main-header-profile bg-primary p-3">
                            <div class="d-flex wd-100p">
                                <div class="main-img-user"><img alt=""
                                        src="{{ URL::asset('assets/img/faces/6.jpg') }}" class=""></div>
                                <div class="mr-3 my-auto">
                                    <h6></h6><span></span>
                                </div>
                            </div>
                        </div>

                        <a class="dropdown-item" href="{{ url('user/edit_user', Auth::user()->id) }}"><i
                                class="bx bx-cog"></i> Edit Profile</a>


                        <form action="{{ url('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="dropdown-item"><i class="bx bx-log-out"></i>تسجيل
                                خروج</button>
                        </form>

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<!-- /main-header -->
