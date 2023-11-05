@extends('layout')
@section('menu0_a1', 'menu-active')
@section('style')
    <style>
        .dashboard-content-one {
            font-weight: bold
        }
    </style>
@endsection
@section('content')
    <!-- Breadcubs Area Start Here -->

    <div class="breadcrumbs-area">
        <h3>{{ __('Dashboard') }}</h3>
        <ul>
            <li>
                <a href="">{{ __('home') }}</a>
            </li>
        </ul>
    </div>
    <!-- Breadcubs Area End Here -->
    <!-- Dashboard summery Start Here -->
    <div class="row gutters-20">
        <div class="col-xl-3 col-sm-6 col-12">
            <div class="dashboard-summery-one mg-b-20">
                <div class="row align-items-center bg-light" id="click" data-url="">
                    <div class="col-6">
                        <div class="item-icon bg-light-green d-flex justify-content-center align-items-center">
                            <i class="icofont icofont-group-students text-green"></i>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="item-content">
                            <div class="item-title">{{ __('Users') }}</div>
                            <div class="item-number"><span class="counter" data-num="{{ $users }}"></span></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 col-12">
            <div class="dashboard-summery-one mg-b-20">
                <div class="row align-items-center bg-light" id="click" data-url="">
                    <div class="col-6">
                        <div class="item-icon bg-light-blue d-flex justify-content-center align-items-center">
                            <i class="icofont icofont-users-alt-2 text-blue"></i>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="item-content">
                            <div class="item-title">{{ __('Customers') }}</div>
                            <div class="item-number"><span class="counter" data-num="{{ $customers }}"></span></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 col-12">
            <div class="dashboard-summery-one mg-b-20">
                <div class="row align-items-center bg-light" id="click" data-url="">
                    <div class="col-6">
                        <div class="item-icon bg-light-yellow d-flex justify-content-center align-items-center">
                            <i class="icon-people text-orange"></i>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="item-content">
                            <div class="item-title">{{ __('Sellers') }}</div>
                            <div class="item-number"><span class="counter" data-num="{{ $sellers }}"></span></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 col-12">
            <div class="dashboard-summery-one mg-b-20">
                <div class="row align-items-center">
                    <div class="col-6">
                        <div class="item-icon bg-light-red d-flex justify-content-center align-items-center">
                            <i class="fa fa-money text-red"></i>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="item-content">
                            <div class="item-title">{{ __('earnings') }}</div>
                            <div class="item-number"><span>دج </span><span class="counter" data-num=""></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Dashboard summery End Here -->
    <!-- Dashboard Content Start Here -->
    <div class="row gutters-20">
        <div class="col-12 col-xl-8 col-8-xxxl">
            <div class="card dashboard-card-one pd-b-20">
                <div class="card-body">
                    <div class="heading-layout1">
                        <div class="item-title">
                            <h3>{{ __('earnings') }}</h3>
                        </div>
                    </div>
                    <div class="earning-report">
                        <div class="item-content">
                            <div class="single-item pseudo-bg-blue">
                                <h4>{{ __('Total Collections') }}</h4>
                                <span></span>
                            </div>
                            <div class="single-item pseudo-bg-red">
                                <h4>{{ __('Fees Collection') }}</h4>
                                <span></span>
                            </div>
                        </div>
                        <div class="">
                            <a class="date-dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                                aria-expanded="false">
                                @switch(date('m'))
                                    @case(1)
                                        {{ __('January') }}
                                    @break

                                    @case(2)
                                        {{ __('February') }}
                                    @break

                                    @case(3)
                                        {{ __('March') }}
                                    @break

                                    @case(4)
                                        {{ __('April') }}
                                    @break

                                    @case(5)
                                        {{ __('May') }}
                                    @break

                                    @case(6)
                                        {{ __('June') }}
                                    @break

                                    @case(7)
                                        {{ __('July') }}
                                    @break

                                    @case(8)
                                        {{ __('August') }}
                                    @break

                                    @case(9)
                                        {{ __('September') }}
                                    @break

                                    @case(10)
                                        {{ __('October') }}
                                    @break

                                    @case(11)
                                        {{ __('November') }}
                                    @break

                                    @case(12)
                                        {{ __('December') }}
                                    @break

                                    @default
                                @endswitch,{{ date('Y') }}</a>

                        </div>
                    </div>
                    <div class="earning-chart-wrap">

                        <canvas id="earning-line-chart" width="467" height="287"
                            style="display: block; height: 320px; width: 519px;" class="chartjs-render-monitor"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-xl-4 col-4-xxxl">
            <div class="card dashboard-card-three pd-b-20">
                <div class="card-body">
                    <div class="heading-layout1">
                        <div class="item-title">
                            <h3>{{ __('Accounts') }}</h3>
                        </div>

                    </div>
                    <div class="doughnut-chart-wrap">
                        <div class="chartjs-size-monitor"
                            style="position: absolute; inset: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;">
                            <div class="chartjs-size-monitor-expand"
                                style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
                                <div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div>
                            </div>
                            <div class="chartjs-size-monitor-shrink"
                                style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
                                <div style="position:absolute;width:200%;height:200%;left:0; top:0"></div>
                            </div>
                        </div>
                        <canvas id="student-doughnut-chart" data-seller="{{ $sellers }}" data-customer="{{ $customers }}" width="197" height="269"
                            style="display: block; height: 300px; width: 220px;" class="chartjs-render-monitor"></canvas>
                    </div>
                    <div class="student-report">
                        <div class="student-count pseudo-bg-blue">
                            <h4 class="item-title">{{ __('Customer') }}</h4>
                            <div class="item-number">{{ $customers }}</div>
                        </div>
                        <div class="student-count pseudo-bg-yellow">
                            <h4 class="item-title">{{ __('Seller') }}</h4>
                            <div class="item-number">{{ $sellers }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- <div class="col-12 col-xl-6 col-4-xxxl">
        <div class="card dashboard-card-four pd-b-20">
            <div class="card-body">
                <div class="heading-layout1">
                    <div class="item-title">
                        <h3>Event Calender</h3>
                    </div>
                    <div class="dropdown">
                        <a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">...</a>

                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="#"><i class="fas fa-times text-orange-red"></i>Close</a>
                            <a class="dropdown-item" href="#"><i class="fas fa-cogs text-dark-pastel-green"></i>Edit</a>
                            <a class="dropdown-item" href="#"><i class="fas fa-redo-alt text-orange-peel"></i>Refresh</a>
                        </div>
                    </div>
                </div>
                <div class="calender-wrap">
                    <div id="fc-calender" class="fc-calender fc fc-unthemed fc-ltr"><div class="fc-toolbar fc-header-toolbar"><div class="fc-left"><h2>April 2023</h2></div><div class="fc-right"><div class="fc-button-group"><button type="button" class="fc-prev-button fc-button fc-state-default fc-corner-left" aria-label="prev"><span class="fc-icon fc-icon-left-single-arrow"></span></button><button type="button" class="fc-next-button fc-button fc-state-default fc-corner-right" aria-label="next"><span class="fc-icon fc-icon-right-single-arrow"></span></button></div></div><div class="fc-center"><div class="fc-button-group"><button type="button" class="fc-basicDay-button fc-button fc-state-default fc-corner-left">day</button><button type="button" class="fc-basicWeek-button fc-button fc-state-default">week</button><button type="button" class="fc-month-button fc-button fc-state-default fc-corner-right fc-state-active">month</button></div></div><div class="fc-clear"></div></div><div class="fc-view-container" style=""><div class="fc-view fc-month-view fc-basic-view" style=""><table class=""><thead class="fc-head"><tr><td class="fc-head-container fc-widget-header"><div class="fc-row fc-widget-header"><table class=""><thead><tr><th class="fc-day-header fc-widget-header fc-sun"><span>Sun</span></th><th class="fc-day-header fc-widget-header fc-mon"><span>Mon</span></th><th class="fc-day-header fc-widget-header fc-tue"><span>Tue</span></th><th class="fc-day-header fc-widget-header fc-wed"><span>Wed</span></th><th class="fc-day-header fc-widget-header fc-thu"><span>Thu</span></th><th class="fc-day-header fc-widget-header fc-fri"><span>Fri</span></th><th class="fc-day-header fc-widget-header fc-sat"><span>Sat</span></th></tr></thead></table></div></td></tr></thead><tbody class="fc-body"><tr><td class="fc-widget-content"><div class="fc-scroller fc-day-grid-container" style="overflow: hidden; height: 128.104px;"><div class="fc-day-grid fc-unselectable"><div class="fc-row fc-week fc-widget-content fc-rigid"><div class="fc-bg"><table class=""><tbody><tr><td class="fc-day fc-widget-content fc-sun fc-other-month fc-past" data-date="2023-03-26"></td><td class="fc-day fc-widget-content fc-mon fc-other-month fc-past" data-date="2023-03-27"></td><td class="fc-day fc-widget-content fc-tue fc-other-month fc-past" data-date="2023-03-28"></td><td class="fc-day fc-widget-content fc-wed fc-other-month fc-past" data-date="2023-03-29"></td><td class="fc-day fc-widget-content fc-thu fc-other-month fc-past" data-date="2023-03-30"></td><td class="fc-day fc-widget-content fc-fri fc-other-month fc-past" data-date="2023-03-31"></td><td class="fc-day fc-widget-content fc-sat fc-past" data-date="2023-04-01"></td></tr></tbody></table></div><div class="fc-content-skeleton"><table><thead><tr><td class="fc-day-top fc-sun fc-other-month fc-past" data-date="2023-03-26"><a class="fc-day-number" data-goto="{&quot;date&quot;:&quot;2023-03-26&quot;,&quot;type&quot;:&quot;day&quot;}">26</a></td><td class="fc-day-top fc-mon fc-other-month fc-past" data-date="2023-03-27"><a class="fc-day-number" data-goto="{&quot;date&quot;:&quot;2023-03-27&quot;,&quot;type&quot;:&quot;day&quot;}">27</a></td><td class="fc-day-top fc-tue fc-other-month fc-past" data-date="2023-03-28"><a class="fc-day-number" data-goto="{&quot;date&quot;:&quot;2023-03-28&quot;,&quot;type&quot;:&quot;day&quot;}">28</a></td><td class="fc-day-top fc-wed fc-other-month fc-past" data-date="2023-03-29"><a class="fc-day-number" data-goto="{&quot;date&quot;:&quot;2023-03-29&quot;,&quot;type&quot;:&quot;day&quot;}">29</a></td><td class="fc-day-top fc-thu fc-other-month fc-past" data-date="2023-03-30"><a class="fc-day-number" data-goto="{&quot;date&quot;:&quot;2023-03-30&quot;,&quot;type&quot;:&quot;day&quot;}">30</a></td><td class="fc-day-top fc-fri fc-other-month fc-past" data-date="2023-03-31"><a class="fc-day-number" data-goto="{&quot;date&quot;:&quot;2023-03-31&quot;,&quot;type&quot;:&quot;day&quot;}">31</a></td><td class="fc-day-top fc-sat fc-past" data-date="2023-04-01"><a class="fc-day-number" data-goto="{&quot;date&quot;:&quot;2023-04-01&quot;,&quot;type&quot;:&quot;day&quot;}">1</a></td></tr></thead><tbody><tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr></tbody></table></div></div><div class="fc-row fc-week fc-widget-content fc-rigid"><div class="fc-bg"><table class=""><tbody><tr><td class="fc-day fc-widget-content fc-sun fc-past" data-date="2023-04-02"></td><td class="fc-day fc-widget-content fc-mon fc-past" data-date="2023-04-03"></td><td class="fc-day fc-widget-content fc-tue fc-past" data-date="2023-04-04"></td><td class="fc-day fc-widget-content fc-wed fc-past" data-date="2023-04-05"></td><td class="fc-day fc-widget-content fc-thu fc-past" data-date="2023-04-06"></td><td class="fc-day fc-widget-content fc-fri fc-past" data-date="2023-04-07"></td><td class="fc-day fc-widget-content fc-sat fc-past" data-date="2023-04-08"></td></tr></tbody></table></div><div class="fc-content-skeleton"><table><thead><tr><td class="fc-day-top fc-sun fc-past" data-date="2023-04-02"><a class="fc-day-number" data-goto="{&quot;date&quot;:&quot;2023-04-02&quot;,&quot;type&quot;:&quot;day&quot;}">2</a></td><td class="fc-day-top fc-mon fc-past" data-date="2023-04-03"><a class="fc-day-number" data-goto="{&quot;date&quot;:&quot;2023-04-03&quot;,&quot;type&quot;:&quot;day&quot;}">3</a></td><td class="fc-day-top fc-tue fc-past" data-date="2023-04-04"><a class="fc-day-number" data-goto="{&quot;date&quot;:&quot;2023-04-04&quot;,&quot;type&quot;:&quot;day&quot;}">4</a></td><td class="fc-day-top fc-wed fc-past" data-date="2023-04-05"><a class="fc-day-number" data-goto="{&quot;date&quot;:&quot;2023-04-05&quot;,&quot;type&quot;:&quot;day&quot;}">5</a></td><td class="fc-day-top fc-thu fc-past" data-date="2023-04-06"><a class="fc-day-number" data-goto="{&quot;date&quot;:&quot;2023-04-06&quot;,&quot;type&quot;:&quot;day&quot;}">6</a></td><td class="fc-day-top fc-fri fc-past" data-date="2023-04-07"><a class="fc-day-number" data-goto="{&quot;date&quot;:&quot;2023-04-07&quot;,&quot;type&quot;:&quot;day&quot;}">7</a></td><td class="fc-day-top fc-sat fc-past" data-date="2023-04-08"><a class="fc-day-number" data-goto="{&quot;date&quot;:&quot;2023-04-08&quot;,&quot;type&quot;:&quot;day&quot;}">8</a></td></tr></thead><tbody><tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr></tbody></table></div></div><div class="fc-row fc-week fc-widget-content fc-rigid"><div class="fc-bg"><table class=""><tbody><tr><td class="fc-day fc-widget-content fc-sun fc-past" data-date="2023-04-09"></td><td class="fc-day fc-widget-content fc-mon fc-past" data-date="2023-04-10"></td><td class="fc-day fc-widget-content fc-tue fc-today " data-date="2023-04-11"></td><td class="fc-day fc-widget-content fc-wed fc-future" data-date="2023-04-12"></td><td class="fc-day fc-widget-content fc-thu fc-future" data-date="2023-04-13"></td><td class="fc-day fc-widget-content fc-fri fc-future" data-date="2023-04-14"></td><td class="fc-day fc-widget-content fc-sat fc-future" data-date="2023-04-15"></td></tr></tbody></table></div><div class="fc-content-skeleton"><table><thead><tr><td class="fc-day-top fc-sun fc-past" data-date="2023-04-09"><a class="fc-day-number" data-goto="{&quot;date&quot;:&quot;2023-04-09&quot;,&quot;type&quot;:&quot;day&quot;}">9</a></td><td class="fc-day-top fc-mon fc-past" data-date="2023-04-10"><a class="fc-day-number" data-goto="{&quot;date&quot;:&quot;2023-04-10&quot;,&quot;type&quot;:&quot;day&quot;}">10</a></td><td class="fc-day-top fc-tue fc-today " data-date="2023-04-11"><a class="fc-day-number" data-goto="{&quot;date&quot;:&quot;2023-04-11&quot;,&quot;type&quot;:&quot;day&quot;}">11</a></td><td class="fc-day-top fc-wed fc-future" data-date="2023-04-12"><a class="fc-day-number" data-goto="{&quot;date&quot;:&quot;2023-04-12&quot;,&quot;type&quot;:&quot;day&quot;}">12</a></td><td class="fc-day-top fc-thu fc-future" data-date="2023-04-13"><a class="fc-day-number" data-goto="{&quot;date&quot;:&quot;2023-04-13&quot;,&quot;type&quot;:&quot;day&quot;}">13</a></td><td class="fc-day-top fc-fri fc-future" data-date="2023-04-14"><a class="fc-day-number" data-goto="{&quot;date&quot;:&quot;2023-04-14&quot;,&quot;type&quot;:&quot;day&quot;}">14</a></td><td class="fc-day-top fc-sat fc-future" data-date="2023-04-15"><a class="fc-day-number" data-goto="{&quot;date&quot;:&quot;2023-04-15&quot;,&quot;type&quot;:&quot;day&quot;}">15</a></td></tr></thead><tbody><tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr></tbody></table></div></div><div class="fc-row fc-week fc-widget-content fc-rigid"><div class="fc-bg"><table class=""><tbody><tr><td class="fc-day fc-widget-content fc-sun fc-future" data-date="2023-04-16"></td><td class="fc-day fc-widget-content fc-mon fc-future" data-date="2023-04-17"></td><td class="fc-day fc-widget-content fc-tue fc-future" data-date="2023-04-18"></td><td class="fc-day fc-widget-content fc-wed fc-future" data-date="2023-04-19"></td><td class="fc-day fc-widget-content fc-thu fc-future" data-date="2023-04-20"></td><td class="fc-day fc-widget-content fc-fri fc-future" data-date="2023-04-21"></td><td class="fc-day fc-widget-content fc-sat fc-future" data-date="2023-04-22"></td></tr></tbody></table></div><div class="fc-content-skeleton"><table><thead><tr><td class="fc-day-top fc-sun fc-future" data-date="2023-04-16"><a class="fc-day-number" data-goto="{&quot;date&quot;:&quot;2023-04-16&quot;,&quot;type&quot;:&quot;day&quot;}">16</a></td><td class="fc-day-top fc-mon fc-future" data-date="2023-04-17"><a class="fc-day-number" data-goto="{&quot;date&quot;:&quot;2023-04-17&quot;,&quot;type&quot;:&quot;day&quot;}">17</a></td><td class="fc-day-top fc-tue fc-future" data-date="2023-04-18"><a class="fc-day-number" data-goto="{&quot;date&quot;:&quot;2023-04-18&quot;,&quot;type&quot;:&quot;day&quot;}">18</a></td><td class="fc-day-top fc-wed fc-future" data-date="2023-04-19"><a class="fc-day-number" data-goto="{&quot;date&quot;:&quot;2023-04-19&quot;,&quot;type&quot;:&quot;day&quot;}">19</a></td><td class="fc-day-top fc-thu fc-future" data-date="2023-04-20"><a class="fc-day-number" data-goto="{&quot;date&quot;:&quot;2023-04-20&quot;,&quot;type&quot;:&quot;day&quot;}">20</a></td><td class="fc-day-top fc-fri fc-future" data-date="2023-04-21"><a class="fc-day-number" data-goto="{&quot;date&quot;:&quot;2023-04-21&quot;,&quot;type&quot;:&quot;day&quot;}">21</a></td><td class="fc-day-top fc-sat fc-future" data-date="2023-04-22"><a class="fc-day-number" data-goto="{&quot;date&quot;:&quot;2023-04-22&quot;,&quot;type&quot;:&quot;day&quot;}">22</a></td></tr></thead><tbody><tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr></tbody></table></div></div><div class="fc-row fc-week fc-widget-content fc-rigid"><div class="fc-bg"><table class=""><tbody><tr><td class="fc-day fc-widget-content fc-sun fc-future" data-date="2023-04-23"></td><td class="fc-day fc-widget-content fc-mon fc-future" data-date="2023-04-24"></td><td class="fc-day fc-widget-content fc-tue fc-future" data-date="2023-04-25"></td><td class="fc-day fc-widget-content fc-wed fc-future" data-date="2023-04-26"></td><td class="fc-day fc-widget-content fc-thu fc-future" data-date="2023-04-27"></td><td class="fc-day fc-widget-content fc-fri fc-future" data-date="2023-04-28"></td><td class="fc-day fc-widget-content fc-sat fc-future" data-date="2023-04-29"></td></tr></tbody></table></div><div class="fc-content-skeleton"><table><thead><tr><td class="fc-day-top fc-sun fc-future" data-date="2023-04-23"><a class="fc-day-number" data-goto="{&quot;date&quot;:&quot;2023-04-23&quot;,&quot;type&quot;:&quot;day&quot;}">23</a></td><td class="fc-day-top fc-mon fc-future" data-date="2023-04-24"><a class="fc-day-number" data-goto="{&quot;date&quot;:&quot;2023-04-24&quot;,&quot;type&quot;:&quot;day&quot;}">24</a></td><td class="fc-day-top fc-tue fc-future" data-date="2023-04-25"><a class="fc-day-number" data-goto="{&quot;date&quot;:&quot;2023-04-25&quot;,&quot;type&quot;:&quot;day&quot;}">25</a></td><td class="fc-day-top fc-wed fc-future" data-date="2023-04-26"><a class="fc-day-number" data-goto="{&quot;date&quot;:&quot;2023-04-26&quot;,&quot;type&quot;:&quot;day&quot;}">26</a></td><td class="fc-day-top fc-thu fc-future" data-date="2023-04-27"><a class="fc-day-number" data-goto="{&quot;date&quot;:&quot;2023-04-27&quot;,&quot;type&quot;:&quot;day&quot;}">27</a></td><td class="fc-day-top fc-fri fc-future" data-date="2023-04-28"><a class="fc-day-number" data-goto="{&quot;date&quot;:&quot;2023-04-28&quot;,&quot;type&quot;:&quot;day&quot;}">28</a></td><td class="fc-day-top fc-sat fc-future" data-date="2023-04-29"><a class="fc-day-number" data-goto="{&quot;date&quot;:&quot;2023-04-29&quot;,&quot;type&quot;:&quot;day&quot;}">29</a></td></tr></thead><tbody><tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr></tbody></table></div></div><div class="fc-row fc-week fc-widget-content fc-rigid"><div class="fc-bg"><table class=""><tbody><tr><td class="fc-day fc-widget-content fc-sun fc-future" data-date="2023-04-30"></td><td class="fc-day fc-widget-content fc-mon fc-other-month fc-future" data-date="2023-05-01"></td><td class="fc-day fc-widget-content fc-tue fc-other-month fc-future" data-date="2023-05-02"></td><td class="fc-day fc-widget-content fc-wed fc-other-month fc-future" data-date="2023-05-03"></td><td class="fc-day fc-widget-content fc-thu fc-other-month fc-future" data-date="2023-05-04"></td><td class="fc-day fc-widget-content fc-fri fc-other-month fc-future" data-date="2023-05-05"></td><td class="fc-day fc-widget-content fc-sat fc-other-month fc-future" data-date="2023-05-06"></td></tr></tbody></table></div><div class="fc-content-skeleton"><table><thead><tr><td class="fc-day-top fc-sun fc-future" data-date="2023-04-30"><a class="fc-day-number" data-goto="{&quot;date&quot;:&quot;2023-04-30&quot;,&quot;type&quot;:&quot;day&quot;}">30</a></td><td class="fc-day-top fc-mon fc-other-month fc-future" data-date="2023-05-01"><a class="fc-day-number" data-goto="{&quot;date&quot;:&quot;2023-05-01&quot;,&quot;type&quot;:&quot;day&quot;}">1</a></td><td class="fc-day-top fc-tue fc-other-month fc-future" data-date="2023-05-02"><a class="fc-day-number" data-goto="{&quot;date&quot;:&quot;2023-05-02&quot;,&quot;type&quot;:&quot;day&quot;}">2</a></td><td class="fc-day-top fc-wed fc-other-month fc-future" data-date="2023-05-03"><a class="fc-day-number" data-goto="{&quot;date&quot;:&quot;2023-05-03&quot;,&quot;type&quot;:&quot;day&quot;}">3</a></td><td class="fc-day-top fc-thu fc-other-month fc-future" data-date="2023-05-04"><a class="fc-day-number" data-goto="{&quot;date&quot;:&quot;2023-05-04&quot;,&quot;type&quot;:&quot;day&quot;}">4</a></td><td class="fc-day-top fc-fri fc-other-month fc-future" data-date="2023-05-05"><a class="fc-day-number" data-goto="{&quot;date&quot;:&quot;2023-05-05&quot;,&quot;type&quot;:&quot;day&quot;}">5</a></td><td class="fc-day-top fc-sat fc-other-month fc-future" data-date="2023-05-06"><a class="fc-day-number" data-goto="{&quot;date&quot;:&quot;2023-05-06&quot;,&quot;type&quot;:&quot;day&quot;}">6</a></td></tr></thead><tbody><tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr></tbody></table></div></div></div></div></td></tr></tbody></table></div></div></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6 col-xl-6 col-4-xxxl">
        <div class="card dashboard-card-five pd-b-20">
            <div class="card-body pd-b-14">
                <div class="heading-layout1">
                    <div class="item-title">
                        <h3>Website Traffic</h3>
                    </div>
                    <div class="dropdown">
                        <a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">...</a>

                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="#"><i class="fas fa-times text-orange-red"></i>Close</a>
                            <a class="dropdown-item" href="#"><i class="fas fa-cogs text-dark-pastel-green"></i>Edit</a>
                            <a class="dropdown-item" href="#"><i class="fas fa-redo-alt text-orange-peel"></i>Refresh</a>
                        </div>
                    </div>
                </div>
                <h6 class="traffic-title">Unique Visitors</h6>
                <div class="traffic-number">2,590</div>
                <div class="traffic-bar">
                    <div class="direct" data-toggle="tooltip" data-placement="top" title="" data-original-title="Direct">
                    </div>
                    <div class="search" data-toggle="tooltip" data-placement="top" title="" data-original-title="Search">
                    </div>
                    <div class="referrals" data-toggle="tooltip" data-placement="top" title="" data-original-title="Referrals">
                    </div>
                    <div class="social" data-toggle="tooltip" data-placement="top" title="" data-original-title="Social">
                    </div>
                </div>
                <div class="traffic-table table-responsive">
                    <table class="table">
                        <tbody>
                            <tr>
                                <td class="t-title pseudo-bg-Aquamarine">Direct</td>
                                <td>12,890</td>
                                <td>50%</td>
                            </tr>
                            <tr>
                                <td class="t-title pseudo-bg-blue">Search</td>
                                <td>7,245</td>
                                <td>27%</td>
                            </tr>
                            <tr>
                                <td class="t-title pseudo-bg-yellow">Referrals</td>
                                <td>4,256</td>
                                <td>8%</td>
                            </tr>
                            <tr>
                                <td class="t-title pseudo-bg-red">Social</td>
                                <td>500</td>
                                <td>7%</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6 col-xl-6 col-4-xxxl">
        <div class="card dashboard-card-six pd-b-20">
            <div class="card-body">
                <div class="heading-layout1 mg-b-17">
                    <div class="item-title">
                        <h3>Notice Board</h3>
                    </div>
                    <div class="dropdown">
                        <a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">...</a>

                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="#"><i class="fas fa-times text-orange-red"></i>Close</a>
                            <a class="dropdown-item" href="#"><i class="fas fa-cogs text-dark-pastel-green"></i>Edit</a>
                            <a class="dropdown-item" href="#"><i class="fas fa-redo-alt text-orange-peel"></i>Refresh</a>
                        </div>
                    </div>
                </div>
                <div class="notice-box-wrap">
                    <div class="notice-list">
                        <div class="post-date bg-skyblue">16 June, 2019</div>
                        <h6 class="notice-title"><a href="#">Great School manag mene esom text of the
                                printing.</a></h6>
                        <div class="entry-meta"> Jennyfar Lopez / <span>5 min ago</span></div>
                    </div>
                    <div class="notice-list">
                        <div class="post-date bg-yellow">16 June, 2019</div>
                        <h6 class="notice-title"><a href="#">Great School manag printing.</a></h6>
                        <div class="entry-meta"> Jennyfar Lopez / <span>5 min ago</span></div>
                    </div>
                    <div class="notice-list">
                        <div class="post-date bg-pink">16 June, 2019</div>
                        <h6 class="notice-title"><a href="#">Great School manag meneesom.</a></h6>
                        <div class="entry-meta"> Jennyfar Lopez / <span>5 min ago</span></div>
                    </div>
                    <div class="notice-list">
                        <div class="post-date bg-skyblue">16 June, 2019</div>
                        <h6 class="notice-title"><a href="#">Great School manag mene esom text of the
                                printing.</a></h6>
                        <div class="entry-meta"> Jennyfar Lopez / <span>5 min ago</span></div>
                    </div>
                    <div class="notice-list">
                        <div class="post-date bg-yellow">16 June, 2019</div>
                        <h6 class="notice-title"><a href="#">Great School manag printing.</a></h6>
                        <div class="entry-meta"> Jennyfar Lopez / <span>5 min ago</span></div>
                    </div>
                    <div class="notice-list">
                        <div class="post-date bg-pink">16 June, 2019</div>
                        <h6 class="notice-title"><a href="#">Great School manag meneesom.</a></h6>
                        <div class="entry-meta"> Jennyfar Lopez / <span>5 min ago</span></div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    </div>
    <!-- Dashboard Content End Here -->
    <!-- Social Media Start Here -->
    {{-- <div class="row gutters-20">
    <div class="col-lg-3 col-sm-6 col-12">
        <div class="card dashboard-card-seven">
            <div class="social-media bg-fb hover-fb">
                <div class="media media-none--lg">
                    <div class="social-icon">
                        <i class="fab fa-facebook-f"></i>
                    </div>
                    <div class="media-body space-sm">
                        <h6 class="item-title">Like us on facebook</h6>
                    </div>
                </div>
                <div class="social-like">30,000</div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-sm-6 col-12">
        <div class="card dashboard-card-seven">
            <div class="social-media bg-twitter hover-twitter">
                <div class="media media-none--lg">
                        <div class="social-icon">
                        <i class="fab fa-twitter"></i>
                        </div>
                        <div class="media-body space-sm">
                            <h6 class="item-title">Follow us on twitter</h6>
                        </div>
                </div>
                <div class="social-like">1,11,000</div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-sm-6 col-12">
        <div class="card dashboard-card-seven">
            <div class="social-media bg-gplus hover-gplus">
                <div class="media media-none--lg">
                    <div class="social-icon">
                        <i class="fab fa-google-plus-g"></i>
                    </div>
                    <div class="media-body space-sm">
                        <h6 class="item-title">Follow us on googleplus</h6>
                    </div>
                </div>
                <div class="social-like">19,000</div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-sm-6 col-12">
        <div class="card dashboard-card-seven">
            <div class="social-media bg-linkedin hover-linked">
                <div class="media media-none--lg">
                    <div class="social-icon">
                    <i class="fab fa-linkedin-in"></i>
                    </div>
                    <div class="media-body space-sm">
                        <h6 class="item-title">Follow us on linked</h6>
                    </div>
                </div>
                <div class="social-like">45,000</div>
            </div>
        </div>
    </div>
</div> --}}
    <!-- Social Media End Here -->
@endsection


