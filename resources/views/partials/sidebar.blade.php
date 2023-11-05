<div class="sidebar-main sidebar-menu-one sidebar-expand-md sidebar-color">
    <div class="mobile-sidebar-header d-md-none">
        <div class="header-logo">
            <a href="{{ route('dashboard') }}"><img src="{{ asset('logo.svg') }}" width="150" alt="logo"></a>
        </div>
    </div>
    <div class="sidebar-menu-content">
        <ul class="nav nav-sidebar-menu sidebar-toggle-view">
            <li class="nav-item ">
                <a href="{{ route('dashboard') }}" class="nav-link @yield('menu0_a1')"><i
                        class="fa fa-dashboard"></i><span>{{ __('Dashboard') }}</span></a>
            </li>
            <li class="nav-item sidebar-nav-item @yield('active1')">
                <a href="#" class="nav-link"><i
                        class="icofont icofont-calculations "></i><span>{{ __('offers.offers') }}</span></a>
                <ul class="nav sub-group-menu " style="display: @yield('menu1')">
                    @can('offer-list')
                        <li class="nav-item">
                            <a href="{{ route('offer.index') }}" class="nav-link @yield('menu1_a1')"><i
                                    class="fa fa-angle-right"></i>{{ __('All Offer') }}</a>
                        </li>
                    @endcan
                    @can('reason-list')
                        <li class="nav-item">
                            <a href="{{ route('offer.reason.index') }}" class="nav-link @yield('menu1_a2')"><i
                                    class="fa fa-angle-right"></i>{{ __('Reason') }}</a>
                        </li>
                    @endcan

                    @can('reason-list')
                        <li class="nav-item">
                            <a href="{{ route('order.offer.index') }}" class="nav-link @yield('menu1_a4')"><i
                                    class="fa fa-angle-right"></i>{{ __('Orders') }}</a>
                        </li>
                    @endcan

                    @can('duration-list')
                        <li class="nav-item">
                            <a href="{{ route('offer.duration.index') }}" class="nav-link @yield('menu1_a3')"><i
                                    class="fa fa-angle-right"></i>{{ __('Duration') }}</a>
                        </li>
                    @endcan

                </ul>
            </li>
            @can('ads-list')
                <li class="nav-item sidebar-nav-item @yield('active5')">
                    <a href="#" class="nav-link"><i class="fa fa-volume-up"
                            aria-hidden="true"></i><span>{{ __('Ads') }}</span></a>
                    <ul class="nav sub-group-menu " style="display: @yield('menu5')">
                        <li class="nav-item">
                            <a href="{{ route('ads.index') }}" class="nav-link @yield('menu5_a1')"><i
                                    class="fa fa-angle-right"></i>{{ __('All Ads') }}</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('places.index') }}" class="nav-link @yield('menu5_a2')"><i
                                    class="fa fa-angle-right"></i>{{ __('places') }}</a>
                        </li>
                    </ul>
                </li>
            @endcan
            <li class="nav-item ">
                <a href="{{ route('notification.index') }}" class="nav-link @yield('menu12_a1')"><i
                        class="fa fa-dashboard"></i><span>{{ __('Notification') }}</span></a>
            </li>
            @can('location-list')
                <li class="nav-item sidebar-nav-item @yield('active2')">
                    <a href="#" class="nav-link"><i
                            class="icofont icofont-earth"></i><span>{{ __('Localition') }}</span></a>
                    <ul class="nav sub-group-menu " style="display: @yield('menu2')">
                        <li class="nav-item">
                            <a href="{{ route('location.countries.index') }}" class="nav-link @yield('menu2_a1')"><i
                                    class="fa fa-angle-right"></i>{{ __('Countries') }}</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('location.cities.index') }}" class="nav-link @yield('menu2_a2')"><i
                                    class="fa fa-angle-right"></i>{{ __('Cities') }}</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('location.regions.index') }}" class="nav-link @yield('menu2_a3')"><i
                                    class="fa fa-angle-right"></i>{{ __('Regions') }}</a>
                        </li>
                    </ul>
                </li>
            @endcan
            <li class="nav-item sidebar-nav-item @yield('active12')">
                <a href="#" class="nav-link"><img src="{{ asset('static/icons/services-icon.svg') }}"
                        width="" alt="" srcset=""><span
                        style="margin-left: 12px">{{ __('Services') }}</span></a>
                <ul class="nav sub-group-menu " style="display: @yield('menu12')">
                    <li class="nav-item">
                        <a href="{{ route('services.service.index') }}" class="nav-link @yield('menu12_a1')"><i
                                class="fa fa-angle-right"></i>{{ __('Services') }}</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('services.section.index') }}" class="nav-link @yield('menu12_a2')"><i
                                class="fa fa-angle-right"></i>{{ __('Sections') }}</a>
                    </li>

                </ul>
            </li>
            @can('category-list')
                <li class="nav-item sidebar-nav-item @yield('active3')">
                    <a href="#" class="nav-link"><i class="fa fa-th-large"
                            aria-hidden="true"></i><span>{{ __('Categories') }}</span></a>
                    <ul class="nav sub-group-menu " style="display: @yield('menu3')">
                        <li class="nav-item">
                            <a href="{{ route('category.sector.index') }}" class="nav-link @yield('menu3_a1')"><i
                                    class="fa fa-angle-right"></i>{{ __('Sectors') }}</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('category.sub_sector.index') }}" class="nav-link @yield('menu3_a2')"><i
                                    class="fa fa-angle-right"></i>{{ __('Sub Sectors') }}</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('category.activity.index') }}" class="nav-link @yield('menu3_a3')"><i
                                    class="fa fa-angle-right"></i>{{ __('Activities') }}</a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('category.speciality.index') }}" class="nav-link @yield('menu3_a4')"><i
                                    class="fa fa-angle-right"></i>{{ __('Specialities') }}</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('category.season.index') }}" class="nav-link @yield('menu3_a5')"><i
                                    class="fa fa-angle-right"></i>{{ __('Seasons') }}</a>
                        </li>
                    </ul>
                </li>
            @endcan

            @can('customer-list')
                <li class="nav-item ">
                    <a href=" {{ route('customer.index') }}" class="nav-link @yield('menu4_a1')"><i
                            class="icofont icofont-business-man-alt-2"></i><span>{{ __('Customer') }}</span></a>
                </li>
            @endcan
            @if (!auth()->user()->hasAnyRole(['seller-list', 'company-list']))
                <li class="nav-item sidebar-nav-item @yield('active6')">
                    <a href="#" class="nav-link"><img src="{{ asset('static/icons/sellers.svg') }}"
                            width="" alt="" srcset=""><span
                            style="margin-left: 12px">{{ __('Seller') }}</span></a>
                    <ul class="nav sub-group-menu " style="display: @yield('menu6')">
                        @can('seller-list')
                            <li class="nav-item">
                                <a href="{{ route('seller.index') }}" class="nav-link @yield('menu6_a1')"><i
                                        class="fa fa-angle-right"></i>{{ __('All Sellers') }}</a>
                            </li>
                        @endcan
                        {{-- @can('company-list')
                            <li class="nav-item">
                                <a href="{{ route('commercialActivity.index') }}" class="nav-link @yield('menu6_a2')"><i
                                        class="fa fa-angle-right"></i>{{ __('Commercial Activities') }}</a>
                            </li>
                        @endcan --}}

                    </ul>
                </li>
            @endif

            @can('package-list')
                <li class="nav-item ">
                    <a href=" {{ route('package.index') }}" class="nav-link @yield('menu7_a1')">
                        <i class="feather icon-box"></i>
                        <span>{{ __('Packages') }}</span></a>
                </li>
            @endcan
            <li class="nav-item sidebar-nav-item @yield('active10')">
                <a href="#" class="nav-link"><i class="fa fa-money"
                        aria-hidden="true"></i><span>{{ __('Payments') }}</span></a>
                <ul class="nav sub-group-menu " style="display: @yield('menu10')">
                    {{--                    @can('user-list') --}}
                    <li class="nav-item ">
                        <a href="{{ route('payment.transaction.index') }}" class="nav-link @yield('menu10_a1')"><i
                                class="fa fa-angle-right"></i>{{ __('Transactions') }}</a>
                    </li>
                    {{--                    @endcan --}}
                    {{--                    @can('role-list', Model::class) --}}
                    <li class="nav-item ">
                        <a href="{{ route('payment.methods.index') }}" class="nav-link @yield('menu10_a2')"><i
                                class="fa fa-angle-right"></i>{{ __('Payment methods') }}</a>
                    </li>
                    {{--                    @endcan --}}

                </ul>
            </li>

            <li class="nav-item ">
                <a href=" {{ route('contact.index') }}" class="nav-link @yield('menu11_a1')"><i
                        class="icofont icofont-support"></i><span>{{ __('Contacts') }}</span></a>
            </li>

            <li class="nav-item sidebar-nav-item @yield('active9')">
                <a href="#" class="nav-link"><i
                        class="feather icon-sliders"></i><span>{{ __('Settings') }}</span></a>
                <ul class="nav sub-group-menu " style="display: @yield('menu9')">
                    <li class="nav-item ">
                        <a href="{{ route('settings.index') }}" class="nav-link @yield('menu9_a3')"><i
                                class="fa fa-angle-right"></i>{{ __('Settings') }}</a>
                    </li>
                    @can('user-list')
                        <li class="nav-item ">
                            <a href="{{ route('user.index') }}" class="nav-link @yield('menu9_a1')"><i
                                    class="fa fa-angle-right"></i>{{ __('Users') }}</a>
                        </li>
                    @endcan
                    @can('role-list', Model::class)
                        <li class="nav-item ">
                            <a href="{{ route('role.index') }}" class="nav-link @yield('menu9_a2')"><i
                                    class="fa fa-angle-right"></i>{{ __('Roles') }}</a>
                        </li>
                    @endcan

                </ul>
            </li>
        </ul>
    </div>
</div>
