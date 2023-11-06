<div class="navbar navbar-expand-md header-menu-one bg-light"
    @if (app()->getlocale() == 'ar') style="
    direction: rtl;
    padding: 0.5rem 0rem !important;
    " @endif>
    <div class="nav-bar-header-one">
        <div class="header-logo">
            <a href="">
                <img src="{{ asset('logo.svg') }}" width="150" alt="logo">
            </a>
        </div>
        <div class="toggle-button sidebar-toggle">
            <button type="button" class="item-link">
                <span class="btn-icon-wrap">
                    <span></span>
                    <span></span>
                    <span></span>
                </span>
            </button>
        </div>
    </div>
    <div class="d-md-none mobile-nav-bar">
        <button class="navbar-toggler pulse-animation" type="button" data-toggle="collapse"
            data-target="#mobile-navbar" aria-expanded="false">
            <i class="far fa-arrow-alt-circle-down"></i>
        </button>
        <button type="button" class="navbar-toggler sidebar-toggle-mobile">
            <i class="fas fa-bars"></i>
        </button>
    </div>
    <div class="header-main-menu collapse navbar-collapse position-relative" id="mobile-navbar">
        <div class="search-bar position-absolute p-5 text-right" dir="rtl">
            <h1>{{ __('Search Bar') }}</h1>
            <table class="table table1 display data-table text-nowrap  no-footer" role="grid">

                <tbody>

                </tbody>
            </table>

        </div>
        <ul class="navbar-nav">
            <li class="navbar-item header-search-bar">
                <div class="input-group stylish-input-group">
                    <span class="input-group-addon">
                        <button type="submit">
                            <lord-icon src="https://cdn.lordicon.com/xfftupfv.json" trigger="hover"
                                colors="primary:#b9bbb4" style="width:32px;height:32px">
                            </lord-icon>
                        </button>
                    </span>
                    <input type="text" id="search_input" class="form-control"
                        placeholder="{{ __('Find Somthing') }} . . .">
                </div>
            </li>
        </ul>
        <ul class="navbar-nav">
            <li class="navbar-item dropdown header-admin">
                <a class="navbar-nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                    aria-expanded="false">
                    <div class="admin-title">
                        <h5 class="item-title">{{ __('Sector') }}</h5>
                        <span>{{ auth()->user()->name }}</span>
                    </div>
                    <div class="admin-img">
                        <img src="{{ asset('static/img/admin.jpg') }}" alt="Admin">
                    </div>
                </a>
                <div
                    class="dropdown-menu  @if (app()->getLocale() == 'ar') dropdown-menu-left @else dropdown-menu-right @endif">
                    <div class="item-header">
                        <h6 class="item-title">{{ __('Sector') }}</h6>
                    </div>
                    <div class="item-content">
                        <ul class="settings-list">
                            <li><a href=""><i
                                        class="icofont icofont-business-man"></i>{{ __('My information') }}</a></li>
                            {{-- <li><a href="#"><i
                                        class="flaticon-chat-comment-oval-speech-bubble-with-text-lines"></i>Message</a>
                            </li>
                             --}}

                            <li><a href="{{ route('auth.logout') }}"><i class="icon-logout"></i>{{ __('Log Out') }}</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </li>
            <li class="navbar-item dropdown header-message">

                {{-- * TODO : uncomment this to have messages notifications   --}}

                {{-- <a class="navbar-nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                    aria-expanded="false">
                    <i class="far fa-envelope"></i>
                    <div class="item-title d-md-none text-16 mg-l-10">Message</div>
                    <span id="count-message">{{ count($new_contacts) }}</span>
                </a> --}}

                <div
                    class="dropdown-menu @if (app()->getLocale() == 'ar') dropdown-menu-left @else dropdown-menu-right @endif">
                    <div class="item-header">
                        <h6 class="item-title">Messages</h6>
                    </div>
                    <div class="item-content" id="notification-message">
                        @foreach ($new_contacts as $contact)
                            <div class="media">
                                <div class="item-img bg-skyblue author-online">
                                    <img style="width: 50px;height: 50px;" src="{{ asset($contact->account->image) }}"
                                        alt="img">
                                </div>
                                <div class="media-body space-sm">
                                    <div class="item-title">
                                        <a href="{{ route('contact.index') }}">
                                            <span
                                                class="item-name">{{ $contact->account->firstname . ' ' . $contact->account->lastname }}</span>
                                            <span class="item-time">{{ $contact->created_at->format('h:i') }}</span>
                                        </a>
                                    </div>
                                    <p>{{ $contact->subject }}</p>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
            </li>
            {{-- <li class="navbar-item dropdown header-notification">
                <a class="navbar-nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                    aria-expanded="false">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-bell" viewBox="0 0 16 16">
                        <path
                            d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2zM8 1.918l-.797.161A4.002 4.002 0 0 0 4 6c0 .628-.134 2.197-.459 3.742-.16.767-.376 1.566-.663 2.258h10.244c-.287-.692-.502-1.49-.663-2.258C12.134 8.197 12 6.628 12 6a4.002 4.002 0 0 0-3.203-3.92L8 1.917zM14.22 12c.223.447.481.801.78 1H1c.299-.199.557-.553.78-1C2.68 10.2 3 6.88 3 6c0-2.42 1.72-4.44 4.005-4.901a1 1 0 1 1 1.99 0A5.002 5.002 0 0 1 13 6c0 .88.32 4.2 1.22 6z" />
                    </svg>
                    <div class="item-title d-md-none text-16 mg-l-10">Notification</div>
                    <span>8</span>
                </a>

                <div class="dropdown-menu dropdown-menu-right">
                    <div class="item-header">
                        <h6 class="item-title">03 Notifiacations</h6>
                    </div>
                    <div class="item-content">
                        <div class="media">
                            <div class="item-icon bg-skyblue">
                                <i class="fas fa-check"></i>
                            </div>
                            <div class="media-body space-sm">
                                <div class="post-title">Complete Today Task</div>
                                <span>1 Mins ago</span>
                            </div>
                        </div>
                        <div class="media">
                            <div class="item-icon bg-orange">
                                <i class="fas fa-calendar-alt"></i>
                            </div>
                            <div class="media-body space-sm">
                                <div class="post-title">Director Metting</div>
                                <span>20 Mins ago</span>
                            </div>
                        </div>
                        <div class="media">
                            <div class="item-icon bg-violet-blue">
                                <i class="fas fa-cogs"></i>
                            </div>
                            <div class="media-body space-sm">
                                <div class="post-title">Update Password</div>
                                <span>45 Mins ago</span>
                            </div>
                        </div>
                    </div>
                </div>
            </li> --}}
            <li class="navbar-item dropdown header-language">
                <a class="navbar-nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                    aria-expanded="false"><i class="fas fa-globe-americas"></i></a>
                <div
                    class="dropdown-menu @if (app()->getLocale() == 'ar') dropdown-menu-left @else dropdown-menu-right @endif">
                    <a class="dropdown-item d-flex justify-content-around"
                        href="{{ route('localization', ['locale' => 'ar']) }}"><span>{{ __('Arabic') }}</span> <img
                            src="{{ asset('static/img/KW.svg') }}" alt="" srcset="" width="20"></a>
                    <a class="dropdown-item d-flex justify-content-around"
                        href="{{ route('localization', ['locale' => 'en']) }}"><span>{{ __('English') }}</span> <img
                            src="{{ asset('static/img/US.svg') }}" alt="" srcset=""
                            width="20"></a>
                </div>

            </li>
        </ul>
    </div>
</div>
