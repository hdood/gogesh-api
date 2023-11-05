<style>
    .card-body {
        direction: rtl;
        text-align: start
    }

    .dropdown {
        text-align: end
    }

    .dropdown-menu {
        direction: ltr;
    }

    .dropdown-item {
        text-align: right !important;
    }

    .dropdown-menu .dropdown-item i {
        margin-left: 14px;
        margin-right: 0;
        width: 22px;
    }

    .breadcrumbs-area {
        text-align: start;
    }

    .breadcrumbs-area ul li::before {
        display: none
    }

    .breadcrumbs-area ul li:not(:last-child)::after {
        content: "\f107";
        font-family: FontAwesome;
        position: absolute;
        font-size: 10px;
        font-weight: 600;
        left: -10px;
        top: 50%;
        z-index: 5;
        color: #f6ae01;
        -webkit-transform: translateY(-50%) rotate(90deg) !important;
        -moz-transform: translateY(-50%) rotate(90deg) !important;
        -ms-transform: translateY(-50%) rotate(90deg) !important;
        -o-transform: translateY(-50%) rotate(90deg) !important;
        transform: translateY(-50%) rotate(90deg) !important;
    }

    .breadcrumbs-area ul li {
        display: inline-block;
        color: #f6ae01;
        font-size: 16px;
        position: relative;
        margin-left: 15px;
        padding-left: 10px;
    }

    .form-check {

        direction: ltr;
    }

    .single-info-details .item-img {
        margin-left: 40px;
        margin-right: 0;
    }

    .mesaage {}

    .sidebar-menu-one .sidebar-menu-content .nav-sidebar-menu>.nav-item>.nav-link {
        text-align: start
    }

    .card-body .heading-layout1 {
        display: contents;
    }

    .sidebar-menu-one .sidebar-menu-content .nav-sidebar-menu .sidebar-nav-item>.nav-link:after {
        left: 22px;
        right: auto;
        transform: translateY(-50%) rotate(87deg)
    }

    .sidebar-menu-one .sidebar-menu-content .nav-sidebar-menu .nav-item.active .nav-link:after {
        transform: translateY(-50%) rotate(0deg);
    }

    .sidebar-menu-one .sidebar-menu-content .nav-sidebar-menu>.nav-item>.nav-link i:before {
        color: #ffffff;
        font-size: 18px;
        margin-right: 0;
        margin-left: 15px;
    }

    .sidebar-menu-one .sidebar-menu-content .nav-sidebar-menu>.nav-item>.nav-link img {
        margin-right: 0;
        margin-left: 15px;
    }

    .sidebar-menu-one .sidebar-menu-content .nav-sidebar-menu>.nav-item .sub-group-menu>.nav-item .nav-link {
        text-align: initial
    }

    .sidebar-menu-one .sidebar-menu-content .nav-sidebar-menu>.nav-item .sub-group-menu>.nav-item .nav-link i {
        margin-right: auto;
        margin-left: 10px;
        transform: rotate(-180deg)
    }

    .nav-bar-header-one .header-logo {
        padding-right: 10px;
    }

    .header-main-menu .navbar-nav .header-admin .navbar-nav-link .admin-title {
        text-align: left;
        padding-left: 26px;
    }

    .header-main-menu .navbar-nav .header-admin .dropdown-menu .item-header:after {
        content: "";
        height: 0;
        width: 0;
        border-bottom: 10px solid #ffa001;
        border-left: 8px solid transparent;
        border-right: 8px solid transparent;
        position: absolute;
        top: -8px;
        left: 14px;
    }

    .header-main-menu .navbar-nav .header-message .dropdown-menu .item-header:after {
        content: "";
        height: 0;
        width: 0;
        border-bottom: 10px solid #021934;
        border-left: 8px solid transparent;
        border-right: 8px solid transparent;
        position: absolute;
        top: -8px;
        left: 14px;
    }

    .header-main-menu .navbar-nav .header-language .navbar-nav-link:after {
        content: "\f107";
        font-family: FontAwesome;
        font-weight: 600;
        font-size: 14px;
        border: none;
        position: absolute;
        top: 0;
        left: 0px;
        right: auto;
    }
</style>
