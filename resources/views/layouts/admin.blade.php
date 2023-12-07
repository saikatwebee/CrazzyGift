<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ asset('vendors/feather/feather.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/ti-icons/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/css/vendor.bundle.base.css') }}">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="{{ asset('vendors/datatables.net-bs4/dataTables.bootstrap4.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('externalScript/select.dataTables.min.css') }}">

    <!-- Include DataTables Buttons CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.bootstrap4.min.css">

    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="{{ asset('css/vertical-layout-light/style.css') }}">
    <!-- endinject -->
    <!-- <link rel="shortcut icon" href="{{ asset('img/favicon.png') }}" /> -->
    <link rel="shortcut icon" href="{{ asset('images/favicon.png') }}" type="image/x-icon">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.7.28/sweetalert2.min.css"
        integrity="sha512-IScV5kvJo+TIPbxENerxZcEpu9VrLUGh1qYWv6Z9aylhxWE4k4Fch3CHl0IYYmN+jrnWQBPlpoTVoWfSMakoKA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" />

    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/css/bootstrap-select.min.css">

    <!-- Datepicker -->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

    {{-- <script src="https://cdn.tiny.cloud/1/dsmlskmdv56114go17dzrwjgk03ftocsu46si42b69k2w4cq/tinymce/5/tinymce.min.js"
        referrerpolicy="origin"></script> --}}

    {{-- <script src="https://cdn.tiny.cloud/1/dsmlskmdv56114go17dzrwjgk03ftocsu46si42b69k2w4cq/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script> --}}
    <script src="https://cdn.tiny.cloud/1/dsmlskmdv56114go17dzrwjgk03ftocsu46si42b69k2w4cq/tinymce/6/tinymce.min.js"
        referrerpolicy="origin"></script>



    <style>
        .tooltipHover:hover {
            cursor: pointer;
        }

        .fa-pen-to-square:hover {
            cursor: pointer;
        }

        .fa-toggle-on:hover {
            cursor: pointer;
        }

        .fa-toggle-off:hover {
            cursor: pointer;
        }

        .fa-power-off:hover {
            cursor: pointer;
        }

        .fa-delete-left:hover {
            cursor: pointer;
        }

        .fa-trash:hover {
            cursor: pointer;
        }

        .fa-eye:hover {
            cursor: pointer;
        }


        .ribbon {
            width: 150px;
            height: 150px;
            overflow: hidden;
            position: absolute;
        }

        .ribbon-cancelled::before,
        .ribbon-cancelled::after {
            position: absolute;
            z-index: -1;
            content: '';
            display: block;
            border: 5px solid #fc665b;
        }

        .ribbon-cancelled span {
            position: absolute;
            display: block;
            width: 225px;
            padding: 15px 0;
            background-color: #fb483a;
            box-shadow: 0 5px 10px rgba(0, 0, 0, .1);
            color: #fff;
            font-size: 16px;
            font-weight: 600;
            text-shadow: 0 1px 1px rgba(0, 0, 0, .2);
            text-align: center;
        }

        .ribbon-processing::before,
        .ribbon-processing::after {
            position: absolute;
            z-index: -1;
            content: '';
            display: block;
            border: 5px solid #c4a646;
        }

        .ribbon-processing span {
            position: absolute;
            display: block;
            width: 225px;
            padding: 15px 0;
            background-color: #d4ae35;
            box-shadow: 0 5px 10px rgba(0, 0, 0, .1);
            color: #fff;
            font-size: 16px;
            font-weight: 600;
            text-shadow: 0 1px 1px rgba(0, 0, 0, .2);
            text-align: center;
        }

        .ribbon-delivered::before,
        .ribbon-delivered::after {
            position: absolute;
            z-index: -1;
            content: '';
            display: block;
            border: 5px solid #5cb05f;
        }

        .ribbon-delivered span {
            position: absolute;
            display: block;
            width: 225px;
            padding: 15px 0;
            background-color: #4caf50;
            box-shadow: 0 5px 10px rgba(0, 0, 0, .1);
            color: #fff;
            font-size: 16px;
            font-weight: 600;
            text-shadow: 0 1px 1px rgba(0, 0, 0, .2);
            text-align: center;
        }

        /* top right*/
        .ribbon-box {
            position: relative;
        }


        #altImagesContainer img {
            width: 65px;
            margin: 5px;
            height: 65px;
            border-radius: 10px !important;
        }


        .ribbon-top-right {
            top: -7px;
            right: -7px;
        }

        .ribbon-top-right::before,
        .ribbon-top-right::after {
            border-top-color: transparent;
            border-right-color: transparent;
        }

        .ribbon-top-right::before {
            top: 0;
            left: 0;
        }

        .ribbon-top-right::after {
            bottom: 0;
            right: 0;
        }

        .ribbon-top-right span {
            left: -25px;
            top: 30px;
            transform: rotate(45deg);
        }


        #deliveredMsg {
            font-family: 'DM Sans';
            font-weight: 900;
            font-size: 15px;
            line-height: 20px;
            color: #00AD30;
        }


        /* toaster custom css added */
        .toast-success {
            background-color: #198754 !important;
            z-index: 1000000;
        }

        .toast-error {
            background-color: #fb483a !important;
            z-index: 1000000;
        }

        .buttons-csv {
            border-radius: 4px;
            background: #004a8c;
            color: #ffff;
            border: 1px solid transparent;
            width: 25%;
            font-size: 16px;
        }

        .buttons-print {
            border-radius: 4px;
            background: #fb483a;
            color: #ffff;
            border: 1px solid transparent;
            width: 25%;
            font-size: 16px;
        }

        .buttons-pdf {
            border-radius: 4px;
            background: #00b0e4;
            color: #ffff;
            border: 1px solid transparent;
            width: 25%;
            font-size: 16px;
        }




        /* Loader container */
        .loader-container {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
        }

        .order-para {
            font-size: 16px;
            font-weight: 600;
        }

        /* Loader icon */
        .loader {
            font-size: 48px;
            /* Adjust the font size as needed */
            color: #004a8c;
            /* Change the icon color */
        }


        .ordersImage {
            width: 40%;
            height: auto;
            border-radius: 10px;

            margin: 2px;
        }

        .productContent {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 5vh;
        }

        .flex-item {
            margin: 4px;
            padding: 3px;
        }

        .orderTrack {
            position: relative;
        }

        .orderTrackBar {
            position: absolute;
            top: 50%;
            left: 0;
            right: 0;
            height: 4px;
            background-color: #00AD30;
            transform: translateY(-50%);
        }

        .orderTrackPoints {
            list-style: none;
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin: 20px 0 0 0;
            padding: 0;
        }

        .orderTrackPoints li {
            position: relative;
            width: 20%;
            text-align: center;
        }

        .active {
            display: block;
        }

        .tracking-item {
            font-family: 'DM Sans';
            font-style: normal;
            font-weight: 900;
            font-size: 12px;
            line-height: 22px;
            color: #004A8C;
        }

        .orderTrackPoints li.active:before {
            content: '\2713';
            position: absolute;
            top: 33%;
            left: 50%;
            transform: translateX(-50%);
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background-color: #00AD30;
            color: #fff;
            line-height: 20px;
            font-size: 12px;
            padding: 6px;
            z-index: 1;
        }

        .orderTrackPoints li.active:after {
            content: '';
            position: absolute;
            top: 50%;
            left: -50%;
            transform: translateY(-50%);
            width: 0;
            height: 0;
        }

        .orderTrackPoints li:not(.active):before {
            content: '';
            position: absolute;
            top: 33%;
            left: 50%;
            transform: translateX(-50%);
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background-color: #00AD30;
            color: #fff;
            line-height: 20px;
            font-size: 12px;
            padding: 6px;
            z-index: 1;
        }

        .orderTrackPoints li:not(.active):after {
            content: '';
            position: absolute;
            top: 50%;
            left: -50%;
            transform: translateY(-50%);
            width: 0;
            height: 0;
        }

        .orderTrackPoints li:not(:last-child):after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 100%;
            height: 4px;
            background-color: #00AD30;
        }

        .orderTrackPoints li:last-child:after {
            display: none;
        }

        .orderTrackPoints li.outForDelivery:before {
            content: '\2713';
            position: absolute;
            top: 33%;
            left: 50%;
            transform: translateX(-50%);
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background-color: #00AD30;
            color: #fff;
            line-height: 20px;
            font-size: 12px;
            padding: 6px;
            z-index: 1;
        }

        .orderTrackPoints li.outForDelivery:after {
            content: '';
            position: absolute;
            top: 50%;
            left: -50%;
            transform: translateY(-50%);
            width: 0;
            height: 0;
            z-index: 1;
        }

        .orderTrackPoints li small {
            font-family: 'DM Sans';
            font-style: normal;
            font-weight: 500;
            font-size: 10px;
            line-height: 16px;
            color: #555;
        }

        .banner-hearder-card:hover {
            cursor: pointer;
        }

        .slider-hearder-card:hover {
            cursor: pointer;
        }

        #active small {
            font-family: 'DM Sans';
            font-style: normal;
            font-weight: 700;
            font-size: 12px;
            line-height: 16px;
            color: #222;
        }

        #deliveredStatus {
            font-family: 'DM Sans';
            font-style: normal;
            font-weight: 900;
            font-size: 14px;
            line-height: 18px;
            text-align: center;
            color: #00AD30;
        }

        #deliveredStatus small {
            font-family: 'DM Sans';
            font-style: normal;
            font-weight: 400;
            font-size: 12px;
            line-height: 16px;
            text-align: center;
            color: #00AD30;
        }

        .sidebar .nav.sub-menu {

            padding: 0.25rem 0 1rem 2rem !important;

        }

        .nav_item {
            width: 50%;
            border-radius: 5px;
        }

        .nav_link.active {
            font-weight: 600 !important;
            background: #4B49AC !important;
            color: #ffffff !important;
        }

        .bootstrap-select:not([class*=col-]):not([class*=form-control]):not(.input-group-btn) {
            width: 100% !important;
        }

        .bootstrap-select .dropdown-toggle:focus,
        .bootstrap-select>select.mobile-device:focus+.dropdown-toggle {
            outline: thin dotted #333 !important;
            outline: none !important;
            outline-offset: -2px;
        }

        .show>.btn-light.dropdown-toggle {

            background-color: #ffffff !important;


        }

        .btn-light {
            border: 1px solid #CED4DA !important;
            border-radius: 4px !important;
            background-color: #ffffff;
            border-color: #ccc;
            background-color: #ffffff;
            padding: 15px;
        }

        .btn-light:hover {

            background-color: #ffffff !important;
        }

        .uploadFile {
            width: 100%;
            background-color: white;
            border: 1px solid #CED4DA;
            color: grey;
            font-size: 16px;
            line-height: 23px;
            overflow: hidden;
            padding: 12px;
            position: relative;
            resize: none;
            border-radius: 4px;
        }

        [type="file"] {
            cursor: pointer !important;
            display: block;
            font-size: 999px;
            filter: alpha(opacity=0);
            min-height: 100%;
            min-width: 100%;
            opacity: 0;
            position: absolute;
            right: 0px;
            text-align: right;
            top: 0px;
            z-index: 1;
        }

        .profilebox-item {
            margin: 5px;
            padding: 4px;
        }

        .panel-active {
            background: #4B49AC;
            display: flex;
            justify-content: center;
            align-items: center;
            border-radius: 20px;
            color: #fff !important;
            font-weight: 600;
        }

        .tab {
            display: none;
        }

        .panel-inactive {
            background: #ffffff;
            display: flex;
            justify-content: center;
            align-items: center;
            border-radius: 20px;
            font-weight: 600;

        }

        .panel-active h4 {
            color: #ffffff !important;
            margin-bottom: 4px !important;
        }

        .panel-dective h4 {
            color: #555555 !important;
            margin-bottom: 4px !important;
        }

        .profile-picture {
            width: 130px;
            height: 130px;
            border: 5px solid #004a8c;
            border-radius: 50%;
            overflow: hidden;
            position: relative;
            margin: auto;
        }

        .profile-picture2 {
            display: flex;
            justify-content: center;
            align-items: center
        }

        .profile-picture img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: opacity 0.3s ease-in-out;
        }

        .boxp {
            font-size: 18px;
            font-weight: 500;
        }
    </style>

</head>

<body>
    <div class="container-scroller">

        <!-- Loader -->
        <div class="loader-container">
            <div id="overlay" class="overlay"></div>

            <i class="fas fa-spinner fa-spin loader"></i>
        </div>


        <!-- partial:partials/_navbar.html -->

        @include('common.adminHeader') <!-- Include your header -->
        <!-- partial -->


        <div class="container-fluid page-body-wrapper">
            <!-- partial:partials/_settings-panel.html -->
            <div class="theme-setting-wrapper">
                {{-- <div id="settings-trigger"><i class="ti-settings"></i></div> --}}
                <div id="theme-settings" class="settings-panel">
                    <i class="settings-close ti-close"></i>
                    <p class="settings-heading">SIDEBAR SKINS</p>
                    <div class="sidebar-bg-options selected" id="sidebar-light-theme">
                        <div class="img-ss rounded-circle bg-light border mr-3"></div>Light
                    </div>
                    <div class="sidebar-bg-options" id="sidebar-dark-theme">
                        <div class="img-ss rounded-circle bg-dark border mr-3"></div>Dark
                    </div>
                    <p class="settings-heading mt-2">HEADER SKINS</p>
                    <div class="color-tiles mx-0 px-4">
                        <div class="tiles success"></div>
                        <div class="tiles warning"></div>
                        <div class="tiles danger"></div>
                        <div class="tiles info"></div>
                        <div class="tiles dark"></div>
                        <div class="tiles default"></div>
                    </div>
                </div>
            </div>
            <div id="right-sidebar" class="settings-panel">
                <i class="settings-close ti-close"></i>
                <ul class="nav nav-tabs border-top" id="setting-panel" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="todo-tab" data-toggle="tab" href="#todo-section" role="tab"
                            aria-controls="todo-section" aria-expanded="true">TO DO LIST</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="chats-tab" data-toggle="tab" href="#chats-section" role="tab"
                            aria-controls="chats-section">CHATS</a>
                    </li>
                </ul>
                <div class="tab-content" id="setting-content">
                    <div class="tab-pane fade show active scroll-wrapper" id="todo-section" role="tabpanel"
                        aria-labelledby="todo-section">
                        <div class="add-items d-flex px-3 mb-0">
                            <form class="form w-100">
                                <div class="form-group d-flex">
                                    <input type="text" class="form-control todo-list-input"
                                        placeholder="Add To-do">
                                    <button type="submit" class="add btn btn-primary todo-list-add-btn"
                                        id="add-task">Add</button>
                                </div>
                            </form>
                        </div>
                        <div class="list-wrapper px-3">
                            <ul class="d-flex flex-column-reverse todo-list">
                                <li>
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input class="checkbox" type="checkbox">
                                            Team review meeting at 3.00 PM
                                        </label>
                                    </div>
                                    <i class="remove ti-close"></i>
                                </li>
                                <li>
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input class="checkbox" type="checkbox">
                                            Prepare for presentation
                                        </label>
                                    </div>
                                    <i class="remove ti-close"></i>
                                </li>
                                <li>
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input class="checkbox" type="checkbox">
                                            Resolve all the low priority tickets due today
                                        </label>
                                    </div>
                                    <i class="remove ti-close"></i>
                                </li>
                                <li class="completed">
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input class="checkbox" type="checkbox" checked>
                                            Schedule meeting for next week
                                        </label>
                                    </div>
                                    <i class="remove ti-close"></i>
                                </li>
                                <li class="completed">
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input class="checkbox" type="checkbox" checked>
                                            Project review
                                        </label>
                                    </div>
                                    <i class="remove ti-close"></i>
                                </li>
                            </ul>
                        </div>
                        <h4 class="px-3 text-muted mt-5 font-weight-light mb-0">Events</h4>
                        <div class="events pt-4 px-3">
                            <div class="wrapper d-flex mb-2">
                                <i class="ti-control-record text-primary mr-2"></i>
                                <span>MAY 11 2023</span>
                            </div>
                            <p class="mb-0 font-weight-thin text-gray">Creating component page build a js</p>
                            <p class="text-gray mb-0">The total number of sessions</p>
                        </div>
                        <div class="events pt-4 px-3">
                            <div class="wrapper d-flex mb-2">
                                <i class="ti-control-record text-primary mr-2"></i>
                                <span>MAY 7 2023</span>
                            </div>
                            <p class="mb-0 font-weight-thin text-gray">Meeting with Alisa</p>
                            <p class="text-gray mb-0 ">Call Sarah Graves</p>
                        </div>
                    </div>
                    <!-- To do section tab ends -->
                    <div class="tab-pane fade" id="chats-section" role="tabpanel" aria-labelledby="chats-section">
                        <div class="d-flex align-items-center justify-content-between border-bottom">
                            <p class="settings-heading border-top-0 mb-3 pl-3 pt-0 border-bottom-0 pb-0">Friends</p>
                            <small
                                class="settings-heading border-top-0 mb-3 pt-0 border-bottom-0 pb-0 pr-3 font-weight-normal">See
                                All</small>
                        </div>
                        <ul class="chat-list">
                            <li class="list active">
                                <div class="profile"><img src="{{ asset('img/faces/face1.jpg') }}"
                                        alt="image"><span class="online"></span></div>
                                <div class="info">
                                    <p>Thomas Douglas</p>
                                    <p>Available</p>
                                </div>
                                <small class="text-muted my-auto">19 min</small>
                            </li>
                            <li class="list">
                                <div class="profile"><img src="{{ asset('img/faces/face2.jpg') }}"
                                        alt="image"><span class="offline"></span></div>
                                <div class="info">
                                    <div class="wrapper d-flex">
                                        <p>Catherine</p>
                                    </div>
                                    <p>Away</p>
                                </div>
                                <div class="badge badge-success badge-pill my-auto mx-2">4</div>
                                <small class="text-muted my-auto">23 min</small>
                            </li>
                            <li class="list">
                                <div class="profile"><img src="{{ asset('img/faces/face3.jpg') }}"
                                        alt="image"><span class="online"></span></div>
                                <div class="info">
                                    <p>Daniel Russell</p>
                                    <p>Available</p>
                                </div>
                                <small class="text-muted my-auto">14 min</small>
                            </li>
                            <li class="list">
                                <div class="profile"><img src="{{ asset('img/faces/face4.jpg') }}"
                                        alt="image"><span class="offline"></span></div>
                                <div class="info">
                                    <p>James Richardson</p>
                                    <p>Away</p>
                                </div>
                                <small class="text-muted my-auto">2 min</small>
                            </li>
                            <li class="list">
                                <div class="profile"><img src="{{ asset('img/faces/face5.jpg') }}"
                                        alt="image"><span class="online"></span></div>
                                <div class="info">
                                    <p>Madeline Kennedy</p>
                                    <p>Available</p>
                                </div>
                                <small class="text-muted my-auto">5 min</small>
                            </li>
                            <li class="list">
                                <div class="profile"><img src="{{ asset('img/faces/face6.jpg') }}"
                                        alt="image"><span class="online"></span></div>
                                <div class="info">
                                    <p>Sarah Graves</p>
                                    <p>Available</p>
                                </div>
                                <small class="text-muted my-auto">47 min</small>
                            </li>
                        </ul>
                    </div>
                    <!-- chat tab ends -->
                </div>
            </div>
            <!-- partial -->
            <!-- partial:partials/_sidebar.html -->
            <nav class="sidebar sidebar-offcanvas" id="sidebar">
                <ul class="nav">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/admin/dashboard') }}">
                            <i class="icon-grid menu-icon"></i>
                            <span class="menu-title">Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false"
                            aria-controls="ui-basic">
                            <i class="icon-layout menu-icon"></i>
                            <span class="menu-title">Orders</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="collapse" id="ui-basic">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item"> <a class="nav-link" href="{{ url('/admin/orders') }}">All
                                        Orders</a></li>
                                <li class="nav-item"> <a class="nav-link" href="{{ url('/admin/orders/new') }}">New
                                        Orders</a></li>
                                <li class="nav-item"> <a class="nav-link"
                                        href="{{ url('/admin/orders/cancelled') }}">Cancelled Orders</a></li>
                                <li class="nav-item"> <a class="nav-link"
                                        href="{{ url('/admin/orders/completed') }}">Completed Orders</a></li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="collapse" href="#form-elements" aria-expanded="false"
                            aria-controls="form-elements">
                            <i class="icon-columns menu-icon"></i>
                            <span class="menu-title">Products</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="collapse" id="form-elements">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item"><a class="nav-link" href="{{ url('/admin/Addproducts') }}">Add
                                        Products</a></li>
                                <li class="nav-item"><a class="nav-link" href="{{ url('/admin/product/all') }}">All
                                        Products</a></li>
                                <li class="nav-item"><a class="nav-link"
                                        href="{{ url('/admin/product/inactive') }}">Inactive
                                        Products</a></li>

                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('admin/users') }}" aria-expanded="false"
                            aria-controls="charts">
                            <i class="icon-bar-graph menu-icon"></i>
                            <span class="menu-title">Users</span>

                        </a>

                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="collapse" href="#tables" aria-expanded="false"
                            aria-controls="tables">
                            <i class="icon-grid-2 menu-icon"></i>
                            <span class="menu-title">Reports</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="collapse" id="tables">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item"> <a class="nav-link"
                                        href="{{ url('admin/orderReport') }}">Order Reports</a></li>
                                <li class="nav-item"> <a class="nav-link" href="{{ url('admin/userReport') }}">User
                                        Reports</a></li>

                            </ul>
                        </div>
                    </li>

                    <!--  <li class="nav-item">
                        <a class="nav-link"  href="{{ url('admin/users') }}" aria-expanded="false"
                            aria-controls="charts">
                            <i class="icon-bar-graph menu-icon"></i>
                            <span class="menu-title">Invoice</span>
                            
                        </a>
                        
                    </li> -->

                    {{-- <li class="nav-item">
                        <a class="nav-link" data-toggle="collapse" href="#icons" aria-expanded="false"
                            aria-controls="icons">
                            <i class="icon-contract menu-icon"></i>
                            <span class="menu-title">Banners</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="collapse" id="icons">
                            <ul class="nav flex-column sub-menu">

                                <li class="nav-item"> <a class="nav-link" href="#">Menu Management</a></li>
                                <li class="nav-item"> <a class="nav-link"
                                        href="{{ url('admin/slider-management') }}">Slider Management</a></li>
                                <li class="nav-item"> <a class="nav-link" href="#">Category Management</a></li>

                            </ul>
                        </div>
                    </li> --}}




                    <li class="nav-item">
                        <a class="nav-link" data-toggle="collapse" href="#error" aria-expanded="false"
                            aria-controls="error">
                            <i class="fa-solid fa-gear menu-icon"></i>
                            <span class="menu-title">Settings</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="collapse" id="error">
                            <ul class="nav flex-column sub-menu">

                                <li class="nav-item"> <a class="nav-link"
                                        href="{{ url('admin/menu-management') }}">Menu Management</a></li>
                                <li class="nav-item"> <a class="nav-link"
                                        href="{{ url('admin/slider-management') }}">Slider Management</a></li>
                                <li class="nav-item"> <a class="nav-link"
                                        href="{{ url('admin/category-management') }}">Category Management</a></li>
                                {{-- <li class="nav-item"> <a class="nav-link"
                                        href="{{ url('admin/additional-setting') }}">Additional Settings</a></li> --}}
                                <li class="nav-item"> <a class="nav-link" href="{{ url('admin/logout') }}">Logout
                                    </a></li>

                            </ul>
                        </div>
                    </li>

                </ul>
            </nav>

            {{-- main content for individual page  --}}


            @yield('Admincontent') <!-- This is where the content from your views will be inserted -->


            {{-- main content for individual page end  --}}



        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->

    @include('common.adminFooter')


    {{-- user view model --}}

    <div class="modal fade" id="viewUserModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">User Details</h5>

                    <i class="fa-solid fa-delete-left" data-dismiss="modal"></i>
                </div>
                <div class="modal-body">

                    <div class="profilebox-item">

                        <div class="profile-picture">
                            <img src="{{ asset('img/logo.png') }}" alt="Profile Picture" id="user_pic">

                        </div>

                    </div>

                    <form id="editUserForm" method="post" action="{{ url('/admin/viewUser') }}"
                        enctype="multipart/form-data">
                        {{-- <input type="hidden" name="id" id="uid" > --}}
                        <div class="form-group">
                            <label for="edit_name">Name</label>
                            <input type="text" name="name" id="edit_name" required placeholder="Enter Name"
                                class="form-control" disabled>
                        </div>
                        <div class="form-group">
                            <label for="edit_email">Email</label>
                            <input type="text" name="email" id="edit_email" required placeholder="Enter Email"
                                class="form-control" disabled>
                        </div>



                        <div class="form-group">
                            <label for="edit_phone">Phone</label>
                            <input type="number" name="phone" id="edit_phone" required placeholder="Enter Phone"
                                class="form-control" disabled>
                        </div>


                    </form>

                </div>
                <div class="modal-footer">
                    {{-- <button type="button" class="btn btn-primary" id="viewUserBtn">Save changes</button> --}}
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>

                </div>
            </div>
        </div>
    </div>






    @if (session('success'))
        <script>
            toastr.success("{{ session('success') }}", 'Success');
        </script>
    @endif

    @if (session('error'))
        <script>
            toastr.error("{{ session('error') }}", 'Oops');
        </script>
    @endif


</body>

<script>
    const baseUrl = "{{ asset('testimonials') }}";
</script>

<script>
    $(function() {
        $("#start_date").datepicker({
            "dateFormat": "yy-mm-dd"
        });
        $("#end_date").datepicker({
            "dateFormat": "yy-mm-dd"
        });

        $("#startDate").datepicker({
            "dateFormat": "yy-mm-dd"
        });
        $("#endDate").datepicker({
            "dateFormat": "yy-mm-dd"
        });


    });




    // $(document).ready(function() {
    //     $("input[type=file]").change(function(e) {
    //         $(this).parents(".uploadFile").find(".filename").text(e.target.files[0].name);
    //     });
    // });

    $(document).ready(function() {
        $("input[type=file]").change(function(e) {
            var files = e.target.files;
            var fileNameList = [];

            for (var i = 0; i < files.length; i++) {
                fileNameList.push(files[i].name);
            }

            $(this).parents(".uploadFile").find(".filename").text(fileNameList.join(', '));
        });
    });




    //menu data table 

    $(document).ready(function() {


        const url = "{{ url('admin/getAllMenus') }}";
        const tableId = "menuTable";
        fetch(url, {
                method: 'GET'
            })
            .then(response => response.json())
            .then(data => {
                console.log(data);

                const columns = [{
                        data: null,
                        render: function(data, type, row) {
                            if (type === 'display') {

                                if (row.status == 1) {
                                    return `
            <i class="fa-regular fa-pen-to-square" title="Edit" style="margin-left:4px;font-size:20px;" onclick="editMenu(${row.id})"></i>
            <i class="fa-solid fa-toggle-on text-success" title="Change Status" style="margin-left:4px;font-size:22px;" onclick="deleteMenu(${row.id})"></i>
            
        `;
                                } else {
                                    return `
            <i class="fa-regular fa-pen-to-square"  style="margin-left:4px;font-size:20px;" onclick="editMenu(${row.id})"></i>
            <i class="fa-solid fa-toggle-off text-danger" title="Change Status" style="margin-left:4px;font-size:22px;" onclick="deleteMenu(${row.id})"></i>
            
        `;
                                }


                            }
                            return data;
                        }
                    },
                    {
                        data: 'id'
                    },
                    {
                        data: 'name'
                    },
                    {
                        data: 'url'
                    },

                    {
                        data: 'parent_name',
                        render: function(data) {
                            return data ? data : "NA"; // Display "NA" if 'icon' is blank or null
                        }
                    },

                    // {
                    //     data: 'parent_id',
                    //     render: function(data) {
                    //         return data ? data : "NA"; // Display "NA" if 'icon' is blank or null
                    //     }
                    // },

                    {
                        data: 'icon',
                        render: function(data) {
                            return data ? data : "NA"; // Display "NA" if 'icon' is blank or null
                        }
                    },
                    {
                        data: 'status',
                        render: function(data, type, row) {
                            if (type == 'display') {
                                if (data == 1) {
                                    return '<i class="fa-solid fa-power-off text-success" title="Active"></i>';
                                } else if (data == 2) {
                                    return '<i class="fa-solid fa-power-off text-danger" title="Deactive"></i>';
                                } else {
                                    // Handle any other cases or unexpected values
                                    return 'Unknown Status';
                                }
                            }
                            return data;
                        }
                    },


                ];

                populateTable(data, tableId, columns);
            })
            .catch(error => console.error(error));
    });


    //banner datatable



    $(document).ready(function() {


        const url = "{{ url('admin/getAllBanners') }}";
        const tableId = "bannerTable";
        fetch(url, {
                method: 'GET'
            })
            .then(response => response.json())
            .then(data => {
                console.log(data);

                const columns = [{
                        data: null,
                        render: function(data, type, row) {
                            if (type === 'display') {

                                if (row.status == 1) {
                                    return `
            <i class="fa-regular fa-pen-to-square" title="Edit" style="margin-left:4px;font-size:20px;" onclick="editBanner(${row.id})"></i>
            <i class="fa-solid fa-toggle-on text-success" title="Change Status" style="margin-left:4px;font-size:22px;" onclick="deleteBanner(${row.id})"></i>
            
        `;
                                } else {
                                    return `
            <i class="fa-regular fa-pen-to-square"  style="margin-left:4px;font-size:20px;" onclick="editBanner(${row.id})"></i>
            <i class="fa-solid fa-toggle-off text-danger" title="Change Status" style="margin-left:4px;font-size:22px;" onclick="deleteBanner(${row.id})"></i>
            
        `;
                                }


                            }
                            return data;
                        }
                    },
                    {
                        data: 'id'
                    },
                    {
                        data: 'target'
                    },
                    {
                        data: 'image',
                        render: function(data, type, row) {
                            if (type === 'display') {
                                const imageUrl = `{{ asset('banners/${data}') }}`;
                                return `<img src="${imageUrl}"  style="border-radius:5px; width:100px;height:auto;" />`;
                            }
                            return data;
                        }
                    },


                    {
                        data: 'status',
                        render: function(data, type, row) {
                            if (type == 'display') {
                                if (data == 1) {
                                    return '<i class="fa-solid fa-power-off text-success" title="Active"></i>';
                                } else if (data == 2) {
                                    return '<i class="fa-solid fa-power-off text-danger" title="Deactive"></i>';
                                } else {
                                    // Handle any other cases or unexpected values
                                    return 'Unknown Status';
                                }
                            }
                            return data;
                        }
                    },

                    {
                        data: 'created_at',
                        render: function(data, type, row) {
                            if (type === 'display' || type === 'filter') {

                                if (data === null || data === '1970-01-01') {
                                    return 'NA';
                                }

                                // Assuming 'created_at' is in the default ISO 8601 format
                                var date = new Date(data);
                                var year = date.getFullYear();
                                var month = (date.getMonth() + 1).toString().padStart(2,
                                    '0'); // Add 1 to month because it's zero-based
                                var day = date.getDate().toString().padStart(2, '0');
                                return year + '-' + month + '-' + day;
                            } else {
                                return data;
                            }
                        }
                    }


                ];

                populateTable(data, tableId, columns);
            })
            .catch(error => console.error(error));
    });



    //occasion image datatable


    $(document).ready(function() {


        const url = "{{ url('admin/getOccasionImages') }}";
        const tableId = "imageTable";
        fetch(url, {
                method: 'GET'
            })
            .then(response => response.json())
            .then(data => {
                console.log(data);

                const columns = [{
                        data: null,
                        render: function(data, type, row) {
                            if (type === 'display') {

                                if (row.status == 1) {
                                    return `
    <i class="fa-regular fa-pen-to-square" title="Edit" style="margin-left:4px;font-size:20px;" onclick="editImage(${row.id})"></i>
    <i class="fa-solid fa-toggle-on text-success" title="Change Status" style="margin-left:4px;font-size:22px;" onclick="deleteImage(${row.id})"></i>
    
`;
                                } else {
                                    return `
    <i class="fa-regular fa-pen-to-square"  style="margin-left:4px;font-size:20px;" onclick="editImage(${row.id})"></i>
    <i class="fa-solid fa-toggle-off text-danger" title="Change Status" style="margin-left:4px;font-size:22px;" onclick="deleteImage(${row.id})"></i>
    
`;
                                }


                            }
                            return data;
                        }
                    },
                    {
                        data: 'id'
                    },
                    {
                        data: 'target'
                    },
                    {
                        data: 'image',
                        render: function(data, type, row) {
                            if (type === 'display') {
                                const imageUrl = `{{ asset('occasions/${data}') }}`;
                                return `<img src="${imageUrl}"  style="border-radius:5px; width:100px;height:auto;" />`;
                            }
                            return data;
                        }
                    },

                    {
                        data: 'type',
                        render: function(data, type, row) {
                            if (type == 'display') {
                                if (data == 1) {
                                    return '<p class="text-danger">Large</p>';
                                } else if (data == 2) {
                                    return '<p class="text-primary">Small</p>';
                                } else {
                                    // Handle any other cases or unexpected values
                                    return 'NA';
                                }
                            }
                            return data;
                        }
                    },

                    {
                        data: 'button',
                        render: function(data) {
                            if (data !== "" && data !== null) {
                                return data;
                            } else {
                                return 'NA';
                            }
                        }
                    },

                    {
                        data: 'status',
                        render: function(data, type, row) {
                            if (type == 'display') {
                                if (data == 1) {
                                    return '<i class="fa-solid fa-power-off text-success" title="Active"></i>';
                                } else if (data == 2) {
                                    return '<i class="fa-solid fa-power-off text-danger" title="Deactive"></i>';
                                } else {
                                    // Handle any other cases or unexpected values
                                    return 'Unknown Status';
                                }
                            }
                            return data;
                        }
                    },

                    {
                        data: 'created_at',
                        render: function(data, type, row) {
                            if (type === 'display' || type === 'filter') {

                                if (data === null || data === '1970-01-01') {
                                    return 'NA';
                                }

                                // Assuming 'created_at' is in the default ISO 8601 format
                                var date = new Date(data);
                                var year = date.getFullYear();
                                var month = (date.getMonth() + 1).toString().padStart(2,
                                    '0'); // Add 1 to month because it's zero-based
                                var day = date.getDate().toString().padStart(2, '0');
                                return year + '-' + month + '-' + day;
                            } else {
                                return data;
                            }
                        }
                    }


                ];

                populateTable(data, tableId, columns);
            })
            .catch(error => console.error(error));
    });


    //slider datatable



    $(document).ready(function() {


        const url = "{{ url('admin/getAllSliders') }}";
        const tableId = "sliderTable";
        fetch(url, {
                method: 'GET'
            })
            .then(response => response.json())
            .then(data => {
                console.log(data);

                const columns = [{
                        data: null,
                        render: function(data, type, row) {
                            if (type === 'display') {

                                if (row.status == 1) {
                                    return `
            <i class="fa-regular fa-pen-to-square" title="Edit" style="margin-left:4px;font-size:20px;" onclick="editSlider(${row.id})"></i>
            <i class="fa-solid fa-toggle-on text-success" title="Change Status" style="margin-left:4px;font-size:22px;" onclick="deleteSlider(${row.id})"></i>
            
        `;
                                } else {
                                    return `
            <i class="fa-regular fa-pen-to-square"  style="margin-left:4px;font-size:20px;" onclick="editSlider(${row.id})"></i>
            <i class="fa-solid fa-toggle-off text-danger" title="Change Status" style="margin-left:4px;font-size:22px;" onclick="deleteSlider(${row.id})"></i>
            
        `;
                                }


                            }
                            return data;
                        }
                    },
                    {
                        data: 'id'
                    },
                    {
                        data: 'type',
                        render: function(data, type, row) {
                            if (type == 'display') {
                                if (data == 1) {
                                    return 'Featured Collection';
                                } else if (data == 2) {
                                    return 'Best Selling';
                                } else {
                                    // Handle any other cases or unexpected values
                                    return 'Unknown Status';
                                }
                            }
                            return data;
                        }
                    },
                    {
                        data: 'product_images',
                        render: function(data, type, row) {
                            if (type === 'display') {
                                console.log('data:', data);
                                const productImages = data.map(image =>
                                    `<img src="{{ asset('products/${image}') }}" alt="Product Image" style="border-radius:5px; width:60px; height:auto;" />`
                                );
                                console.log('productImages:', productImages);
                                return productImages.join(', ');
                            }
                            return data;
                        }
                    },

                    {
                        data: 'status',
                        render: function(data, type, row) {
                            if (type == 'display') {
                                if (data == 1) {
                                    return '<i class="fa-solid fa-power-off text-success" title="Active"></i>';
                                } else if (data == 2) {
                                    return '<i class="fa-solid fa-power-off text-danger" title="Deactive"></i>';
                                } else {
                                    // Handle any other cases or unexpected values
                                    return 'Unknown Status';
                                }
                            }
                            return data;
                        }
                    },

                    {
                        data: 'created_at',
                        render: function(data, type, row) {
                            if (type === 'display' || type === 'filter') {

                                if (data === null || data === '1970-01-01') {
                                    return 'NA';
                                }

                                // Assuming 'created_at' is in the default ISO 8601 format
                                var date = new Date(data);
                                var year = date.getFullYear();
                                var month = (date.getMonth() + 1).toString().padStart(2,
                                    '0'); // Add 1 to month because it's zero-based
                                var day = date.getDate().toString().padStart(2, '0');
                                return year + '-' + month + '-' + day;
                            } else {
                                return data;
                            }
                        }
                    }


                ];

                populateTable(data, tableId, columns);
            })
            .catch(error => console.error(error));
    });


    //Testimonial datatable



    $(document).ready(function() {


        const url = "{{ url('admin/getAllTestimonials') }}";
        const tableId = "sliderTestimonialTable";
        fetch(url, {
                method: 'GET'
            })
            .then(response => response.json())
            .then(data => {
                console.log(data);

                const columns = [{
                        data: null,
                        render: function(data, type, row) {
                            if (type === 'display') {

                                if (row.status == 1) {
                                    return `
            <i class="fa-regular fa-pen-to-square" title="Edit" style="margin-left:4px;font-size:20px;" onclick="editTestimonialSlider(${row.id})"></i>
            <i class="fa-solid fa-toggle-on text-success" title="Change Status" style="margin-left:4px;font-size:22px;" onclick="deleteTestimonialSlider(${row.id})"></i>
            
        `;
                                } else {
                                    return `
            <i class="fa-regular fa-pen-to-square"  style="margin-left:4px;font-size:20px;" onclick="editTestimonialSlider(${row.id})"></i>
            <i class="fa-solid fa-toggle-off text-danger" title="Change Status" style="margin-left:4px;font-size:22px;" onclick="deleteTestimonialSlider(${row.id})"></i>
            
        `;
                                }


                            }
                            return data;
                        }
                    },
                    {
                        data: 'id'
                    },
                    {
                        data: 'name'
                    },
                    {
                        data: 'designation'
                    },

                    {
                        data: 'image',
                        render: function(data, type, row) {
                            if (type === 'display' && data) {
                                const testimonial_image =
                                    `<img src="${baseUrl}/${data}" alt="Testimonial Image" style="border-radius: 5px; width: 60px; height: auto;" />`;
                                return testimonial_image;
                            }
                            return data;
                        }
                    },

                    {
                        data: 'description'
                    },

                    {
                        data: 'status',
                        render: function(data, type, row) {
                            if (type == 'display') {
                                if (data == 1) {
                                    return '<i class="fa-solid fa-power-off text-success" title="Active"></i>';
                                } else if (data == 2) {
                                    return '<i class="fa-solid fa-power-off text-danger" title="Deactive"></i>';
                                } else {
                                    // Handle any other cases or unexpected values
                                    return 'Unknown Status';
                                }
                            }
                            return data;
                        }
                    },

                    {
                        data: 'created_at',
                        render: function(data, type, row) {
                            if (type === 'display' || type === 'filter') {

                                if (data === null || data === '1970-01-01') {
                                    return 'NA';
                                }

                                // Assuming 'created_at' is in the default ISO 8601 format
                                var date = new Date(data);
                                var year = date.getFullYear();
                                var month = (date.getMonth() + 1).toString().padStart(2,
                                    '0'); // Add 1 to month because it's zero-based
                                var day = date.getDate().toString().padStart(2, '0');
                                return year + '-' + month + '-' + day;
                            } else {
                                return data;
                            }
                        }
                    }


                ];

                populateTable(data, tableId, columns);
            })
            .catch(error => console.error(error));
    });


    //category datatable


    $(document).ready(function() {


        const url = "{{ url('admin/getAllCategories') }}";
        const tableId = "categoryTable";
        fetch(url, {
                method: 'GET'
            })
            .then(response => response.json())
            .then(data => {
                console.log(data);

                const columns = [{
                        data: null,
                        render: function(data, type, row) {
                            if (type === 'display') {

                                if (row.status == 1) {
                                    return `
            <i class="fa-regular fa-pen-to-square" title="Edit" style="margin-left:4px;font-size:20px;" onclick="editCategory(${row.id})"></i>
            <i class="fa-solid fa-toggle-on text-success" title="Change Status" style="margin-left:4px;font-size:22px;" onclick="deletecategory(${row.id})"></i>
            
        `;
                                } else {
                                    return `
            <i class="fa-regular fa-pen-to-square"  style="margin-left:4px;font-size:20px;" onclick="editCategory(${row.id})"></i>
            <i class="fa-solid fa-toggle-off text-danger" title="Change Status" style="margin-left:4px;font-size:22px;" onclick="deletecategory(${row.id})"></i>
            
        `;
                                }


                            }
                            return data;
                        }
                    },
                    {
                        data: 'id'
                    },
                    {
                        data: 'name'
                    },

                    {
                        data: 'status',
                        render: function(data, type, row) {
                            if (type == 'display') {
                                if (data == 1) {
                                    return '<i class="fa-solid fa-power-off text-success" title="Active"></i>';
                                } else if (data == 2) {
                                    return '<i class="fa-solid fa-power-off text-danger" title="Deactive"></i>';
                                } else {
                                    // Handle any other cases or unexpected values
                                    return 'Unknown Status';
                                }
                            }
                            return data;
                        }
                    },

                    {
                        data: 'created_at',
                        render: function(data, type, row) {
                            if (type === 'display' || type === 'filter') {

                                if (data === null || data === '1970-01-01') {
                                    return 'NA';
                                }

                                // Assuming 'created_at' is in the default ISO 8601 format
                                var date = new Date(data);
                                var year = date.getFullYear();
                                var month = (date.getMonth() + 1).toString().padStart(2,
                                    '0'); // Add 1 to month because it's zero-based
                                var day = date.getDate().toString().padStart(2, '0');
                                return year + '-' + month + '-' + day;
                            } else {
                                return data;
                            }
                        }
                    }


                ];

                populateTable(data, tableId, columns);
            })
            .catch(error => console.error(error));
    });

    // GST DataTable

    function getGstDataTable() {

        const url = "{{ url('admin/getGstDetails') }}";
        const tableId = "gstTable";
        fetch(url, {
                method: 'GET'
            })
            .then(response => response.json())
            .then(data => {
                console.log(data);

                const columns = [{
                        data: null,
                        render: function(data, type, row) {
                            if (type === 'display') {

                                if (row.status == 1) {
                                    return `
    <i class="fa-regular fa-pen-to-square" title="Edit" style="margin-left:4px;font-size:20px;" onclick="editGst(${row.id})"></i>
    <i class="fa-solid fa-toggle-on text-success" title="Change Status" style="margin-left:4px;font-size:22px;" onclick="changeGstDetails(${row.id})"></i>
    
`;
                                } else {
                                    return `
    <i class="fa-regular fa-pen-to-square"  style="margin-left:4px;font-size:20px;" onclick="editGst(${row.id})"></i>
    <i class="fa-solid fa-toggle-off text-danger" title="Change Status" style="margin-left:4px;font-size:22px;" onclick="changeGstDetails(${row.id})"></i>
    
`;
                                }


                            }
                            return data;
                        }
                    },
                    {
                        data: 'id'
                    },
                    {
                        data: 'cgst'
                    },

                    {
                        data: 'sgst'
                    },

                    {
                        data: 'igst',
                        render: function(data) {
                            if (data !== "" && data !== null) {
                                return data;
                            } else {
                                return 'NA';
                            }
                        }
                    },
                    {
                        data: 'status',
                        render: function(data, type, row) {
                            if (type == 'display') {
                                if (data == 1) {
                                    return '<i class="fa-solid fa-power-off text-success" title="Active"></i>';
                                } else if (data == 2) {
                                    return '<i class="fa-solid fa-power-off text-danger" title="Deactive"></i>';
                                } else {
                                    // Handle any other cases or unexpected values
                                    return 'Unknown Status';
                                }
                            }
                            return data;
                        }
                    },

                    {
                        data: 'created_at',
                        render: function(data, type, row) {
                            if (type === 'display' || type === 'filter') {

                                if (data === null || data === '1970-01-01') {
                                    return 'NA';
                                }

                                // Assuming 'created_at' is in the default ISO 8601 format
                                var date = new Date(data);
                                var year = date.getFullYear();
                                var month = (date.getMonth() + 1).toString().padStart(2,
                                    '0'); // Add 1 to month because it's zero-based
                                var day = date.getDate().toString().padStart(2, '0');
                                return year + '-' + month + '-' + day;
                            } else {
                                return data;
                            }
                        }
                    }


                ];

                populateTable(data, tableId, columns);
            })
            .catch(error => console.error(error));
    }



    //sub category datatable


    $(document).ready(function() {


        const url = "{{ url('admin/getAllSubcategories') }}";
        const tableId = "subcategoryTable";
        fetch(url, {
                method: 'GET'
            })
            .then(response => response.json())
            .then(data => {
                console.log(data);

                const columns = [{
                        data: null,
                        render: function(data, type, row) {
                            if (type === 'display') {

                                if (row.status == 1) {
                                    return `
            <i class="fa-regular fa-pen-to-square" title="Edit" style="margin-left:4px;font-size:20px;" onclick="editSubcategory(${row.id})"></i>
            <i class="fa-solid fa-toggle-on text-success" title="Change Status" style="margin-left:4px;font-size:22px;" onclick="deleteSubcategory(${row.id})"></i>
            
        `;
                                } else {
                                    return `
            <i class="fa-regular fa-pen-to-square"  style="margin-left:4px;font-size:20px;" onclick="editSubcategory(${row.id})"></i>
            <i class="fa-solid fa-toggle-off text-danger" title="Change Status" style="margin-left:4px;font-size:22px;" onclick="deleteSubcategory(${row.id})"></i>
            
        `;
                                }


                            }
                            return data;
                        }
                    },
                    //new


                    {
                        data: 'id'
                    },
                    {
                        data: 'name'
                    },

                    {
                        data: 'main_category.name',
                        name: 'main_category.name',
                        render: function(data, type, row) {
                            if (type === 'display') {
                                return data;
                            }
                            return data;
                        }
                    },


                    {
                        data: 'status',
                        render: function(data, type, row) {
                            if (type == 'display') {
                                if (data == 1) {
                                    return '<i class="fa-solid fa-power-off text-success" title="Active"></i>';
                                } else if (data == 2) {
                                    return '<i class="fa-solid fa-power-off text-danger" title="Deactive"></i>';
                                } else {
                                    // Handle any other cases or unexpected values
                                    return 'Unknown Status';
                                }
                            }
                            return data;
                        }
                    },

                    {
                        data: 'created_at',
                        render: function(data, type, row) {
                            if (type === 'display' || type === 'filter') {

                                if (data === null || data === '1970-01-01') {
                                    return 'NA';
                                }

                                // Assuming 'created_at' is in the default ISO 8601 format
                                var date = new Date(data);
                                var year = date.getFullYear();
                                var month = (date.getMonth() + 1).toString().padStart(2,
                                    '0'); // Add 1 to month because it's zero-based
                                var day = date.getDate().toString().padStart(2, '0');
                                return year + '-' + month + '-' + day;
                            } else {
                                return data;
                            }
                        }
                    }


                ];

                populateTable(data, tableId, columns);
            })
            .catch(error => console.error(error));
    });





    $(() => {
        AllProductsDatatable();
        getGstDataTable();
        getAlluserDatatable();
        orderReport();
        userReport();
        getAllInactiveDatatable();
        getAllorderDatatable();
        getAllNewordersDatatable()
    });

    //All products datatable

    function AllProductsDatatable() {


        const url = "{{ url('admin/getAllProducts') }}";
        const tableId = "productTable";
        fetch(url, {
                method: 'GET'
            })
            .then(response => response.json())
            .then(data => {
                console.log(data);

                const columns = [



                    {
                        data: null,
                        render: function(data, type, row) {
                            if (type === 'display') {

                                if (row.status == 1) {
                                    return `
            <i class="fa-regular fa-pen-to-square" title="Edit" style="margin-left:4px;font-size:20px;" onclick="editProduct(${row.id},event)"></i>
            <i class="fa-solid fa-toggle-on text-success" title="Change Status" style="margin-left:4px;font-size:22px;" onclick="ProductChange(${row.id})"></i>
            
        `;
                                } else {
                                    return `
            <i class="fa-regular fa-pen-to-square"  style="margin-left:4px;font-size:20px;" onclick="editProduct(${row.id},event)"></i>
            <i class="fa-solid fa-toggle-off text-danger" title="Change Status" style="margin-left:4px;font-size:22px;" onclick="ProductChange(${row.id})"></i>
            
        `;
                                }


                            }
                            return data;
                        }
                    },




                    {
                        data: 'id'
                    },
                    {
                        data: 'title'
                    },
                    {
                        data: 'sku'
                    },
                    {
                        data: 'code'
                    },
                    {
                        data: 'main_category.name',
                        name: 'main_category.name',
                        render: function(data, type, row) {
                            if (type === 'display') {
                                if (row.main_category && row.main_category.name !== null) {
                                    return row.main_category.name;
                                } else {
                                    return 'NA';
                                }
                            }
                            return data;
                        }
                    },

                    {
                        data: 'sub_category.name',
                        name: 'sub_category.name',
                        render: function(data, type, row) {
                            if (type === 'display') {
                                if (row.sub_category && row.sub_category.name !== null) {
                                    return row.sub_category.name;
                                } else {
                                    return 'NA';
                                }
                            }
                            return data;
                        }
                    },

                    {
                        "data": 'tags',
                        "render": function(data, type, row) {
                            if (data === null || data === '') {
                                return 'NA';
                            } else {
                                var tagsArray = data.split(', '); // Split the string into an array
                                var buttons = '';

                                tagsArray.forEach(function(tag) {
                                    buttons +=
                                        '<button class="btn btn-primary tag-button p-2">' +
                                        tag + '</button> ';
                                });

                                return buttons;
                            }
                        }
                    },



                    {
                        data: 'price'
                    },
                    {
                        data: 'actual_price',
                        render: function(data) {
                            if (data !== "" && data !== null) {
                                return data;
                            } else {
                                return 'NA';
                            }
                        }
                    },



                    {
                        data: 'created_at',
                        render: function(data, type, row) {
                            if (type === 'display' || type === 'filter') {
                                // Assuming 'created_at' is in the default ISO 8601 format
                                var datetime = new Date(data);
                                var year = datetime.getFullYear();
                                var month = (datetime.getMonth() + 1).toString().padStart(2, '0');
                                var day = datetime.getDate().toString().padStart(2, '0');
                                var hours = datetime.getHours().toString().padStart(2, '0');
                                var minutes = datetime.getMinutes().toString().padStart(2, '0');
                                var seconds = datetime.getSeconds().toString().padStart(2, '0');

                                // Format the date and time as 'yyyy-mm-dd HH:MM:SS'
                                return year + '-' + month + '-' + day + ' ' + hours + ':' +
                                    minutes + ':' + seconds;
                            } else {
                                return data;
                            }
                        }
                    }



                ];

                populateTable(data, tableId, columns);
            })
            .catch(error => console.error(error));
    }





    //inactive products datatable


    function getAllInactiveDatatable() {


        const url = "{{ url('admin/getAllInactiveProducts') }}";
        const tableId = "productInactive";
        fetch(url, {
                method: 'GET'
            })
            .then(response => response.json())
            .then(data => {
                console.log(data);

                const columns = [

                  

                    {
                        data: null,
                        render: function(data, type, row) {
                            if (type === 'display') {

                                if (row.status == 1) {
                                    return `
    <i class="fa-solid fa-trash text-danger" title="Delete Product" style="margin-left:4px;font-size:20px;" onclick="deleteProduct(${row.id})"></i>
    <i class="fa-solid fa-toggle-on text-success" title="Change Status" style="margin-left:4px;font-size:22px;" onclick="ProductChangeInactive(${row.id})"></i>
    
`;
                                } else {
                                    return `
    <i class="fa-solid fa-trash text-danger"  title="Delete Product" style="margin-left:4px;font-size:20px;" onclick="deleteProduct(${row.id})"></i>
    <i class="fa-solid fa-toggle-off text-danger" title="Change Status" style="margin-left:4px;font-size:22px;" onclick="ProductChangeInactive(${row.id})"></i>
    
`;
                                }


                            }
                            return data;
                        }
                    },




                    {
                        data: 'id'
                    },
                    {
                        data: 'title'
                    },
                    {
                        data: 'sku'
                    },
                    {
                        data: 'code'
                    },

                    {
                        data: 'main_category.name',
                        name: 'main_category.name',
                        render: function(data, type, row) {
                            if (type === 'display') {
                                return data;
                            }
                            return data;
                        }
                    },
                    {
                        data: 'sub_category.name',
                        name: 'sub_category.name',
                        render: function(data, type, row) {
                            if (type === 'display') {
                                return data;
                            }
                            return data;
                        }
                    },

                    // {
                    //     data: 'description',
                    //     render: function(data, type, row) {
                    //         if (type === 'display') {
                    //             if (data.length > 20) {
                    //                 return `<span class="tooltipHover" title="${data}">${data.slice(0, 20)}...</span>`;
                    //             } else {
                    //                 return data;
                    //             }
                    //         }
                    //         return data;
                    //     }
                    // },
                    {
                        data: 'price'
                    },
                    {
                        data: 'actual_price',
                        render: function(data) {
                            if (data !== "" && data !== null) {
                                return data;
                            } else {
                                return 'NA';
                            }
                        }
                    },


                    // {
                    //     data: 'status',
                    //     render: function(data, type, row) {
                    //         if (type == 'display') {
                    //             if (data == 1) {
                    //                 return '<i class="fa-solid fa-power-off text-success" title="Active"></i>';
                    //             } else if (data == 2) {
                    //                 return '<i class="fa-solid fa-power-off text-danger" title="Deactive"></i>';
                    //             } else {
                    //                 // Handle any other cases or unexpected values
                    //                 return 'Unknown Status';
                    //             }
                    //         }
                    //         return data;
                    //     }
                    // },

                    {
                        data: 'created_at',
                        render: function(data, type, row) {
                            if (type === 'display' || type === 'filter') {
                                // Assuming 'created_at' is in the default ISO 8601 format
                                var datetime = new Date(data);
                                var year = datetime.getFullYear();
                                var month = (datetime.getMonth() + 1).toString().padStart(2, '0');
                                var day = datetime.getDate().toString().padStart(2, '0');
                                var hours = datetime.getHours().toString().padStart(2, '0');
                                var minutes = datetime.getMinutes().toString().padStart(2, '0');
                                var seconds = datetime.getSeconds().toString().padStart(2, '0');

                                // Format the date and time as 'yyyy-mm-dd HH:MM:SS'
                                return year + '-' + month + '-' + day + ' ' + hours + ':' +
                                    minutes + ':' + seconds;
                            } else {
                                return data;
                            }
                        }
                    }



                ];

                populateTable(data, tableId, columns);
            })
            .catch(error => console.error(error));
    }





    // all orders DataTable

   function getAllorderDatatable() {


        const url = "{{ url('admin/getAllOrders') }}";

        const tableId1 = "allOrdersTable1";
        //  const tableId2 = "allOrdersTable2";

        fetch(url, {
                method: 'GET'
            })
            .then(response => response.json())
            .then(data => {
                console.log(data);

                const columns = [



                    {
                        data: null,
                        render: function(data, type, row) {
                            if (type === 'display') {


                                return `
            <i class="fa-regular fa-eye text-primary" title="Edit" style="margin-left:4px;font-size:20px;" data-id="${row.id}" onclick="viewOrder(event)"></i>
            <i class="fa-solid fa-trash text-danger" title="Change Status" style="margin-left:4px;font-size:22px;" onclick="deleteOrderAll(${row.id})"></i>
            
        `;




                            }
                            return data;
                        }
                    },

                    {
                        data: 'order_id'
                    },
                    {
                        data: 'user.name'
                    },
                    {
                        data: 'user.phone'
                    },

                    {
                        "data": "products",
                        "render": function(data, type, row) {
                            if (type === 'display' && data.length > 20) {
                                return '<span data-toggle="tooltip" title="' + data + '">' + data
                                    .substr(0, 20) + '...</span>';
                            } else {
                                return data;
                            }
                        }
                    },

                    {
                        data: 'amount'
                    },

                    // {
                    //     data: 'order_status'
                    // },
                    {
                        data: 'order_status',
                        render: function(data, type, row) {
                            if (type == 'display') {
                                if (data == 0) {
                                    return '<button class="btn-danger btn btn-sm" style="padding: 7px 10px 7px 10px;">Cancelled Order</button>';
                                } else if (data == 1) {
                                    return '<button class="btn-primary btn btn-sm" style="padding: 7px 10px 7px 10px;">Order Placed</button>';
                                } else if (data == 2) {
                                    return '<button class="btn-info btn btn-sm" style="padding: 7px 10px 7px 10px;">Order Shipped</button>';
                                } else if (data == 3) {
                                    return '<button class="btn-warning btn btn-sm" style="padding: 7px 10px 7px 10px;">Reached Hub</button>';
                                } else if (data == 4) {
                                    return '<button class="btn-light btn btn-sm" style="padding: 7px 10px 7px 10px;">Out for Delivery</button>';
                                } else if (data == 5) {
                                    return '<button class="btn-success btn btn-sm" style="padding: 7px 10px 7px 10px;">Order Delivered</button>';
                                } else {
                                    // Handle any other cases or unexpected values
                                    return '<button class="btn-default btn btn-sm" style="padding: 7px 10px 7px 10px;">Status Unknown</button>';
                                }
                            }
                            return data;
                        }
                    },


                    // {
                    //     data: 'transaction_id'
                    // },

                    {
                        data: 'created_at',
                        render: function(data, type, row) {
                            if (type === 'display' || type === 'filter') {
                                // Assuming 'created_at' is in the default ISO 8601 format
                                var datetime = new Date(data);
                                var year = datetime.getFullYear();
                                var month = (datetime.getMonth() + 1).toString().padStart(2, '0');
                                var day = datetime.getDate().toString().padStart(2, '0');
                                var hours = datetime.getHours().toString().padStart(2, '0');
                                var minutes = datetime.getMinutes().toString().padStart(2, '0');
                                var seconds = datetime.getSeconds().toString().padStart(2, '0');

                                // Format the date and time as 'yyyy-mm-dd HH:MM:SS'
                                return year + '-' + month + '-' + day + ' ' + hours + ':' +
                                    minutes + ':' + seconds;
                            } else {
                                return data;
                            }
                        }
                    }


                ];

                populateTable(data, tableId1, columns);

            })
            .catch(error => console.error(error));
    }


    //All users datatable

    function getAlluserDatatable() {


        const url = "{{ url('admin/getAllUsers') }}";

        const tableId = "usersTable1";


        fetch(url, {
                method: 'GET'
            })
            .then(response => response.json())
            .then(data => {
                console.log(data);

                const columns = [

                    {
                        data: null,
                        render: function(data, type, row) {
                            if (type === 'display') {

                                if (row.status == 1) {
                                    return `
            <i class="fa-regular fa-eye" title="Edit" style="margin-left:4px;font-size:20px;" data-id="${row.id}" onclick="viewUser(event)"></i>
            <i class="fa-solid fa-toggle-on text-success" title="Change Status" style="margin-left:4px;font-size:22px;" onclick="changeUser(${row.id})"></i>
            <i class="fa-solid fa-trash text-danger" title="Delete User" style="margin-left:4px;font-size:22px;" onclick="deleteUser(${row.id})"></i>
            
        `;
                                } else {
                                    return `
            <i class="fa-regular fa-eye"  style="margin-left:4px;font-size:20px;" data-id="${row.id}" onclick="viewUser(event)"></i>
            <i class="fa-solid fa-toggle-off text-danger" title="Change Status" style="margin-left:4px;font-size:22px;" onclick="changeUser(${row.id})"></i>
            <i class="fa-solid fa-trash text-danger" title="Delete User" style="margin-left:4px;font-size:22px;" onclick="deleteUser(${row.id})"></i>
            
        `;
                                }


                            }
                            return data;
                        }
                    },


                    {
                        data: 'id'
                    },
                    {
                        data: 'name'
                    },
                    {
                        data: 'email'
                    },

                    {
                        data: 'phone'
                    },
                    {
                        data: 'is_verified',
                        render: function(data, type, row) {
                            if (type == 'display') {
                                if (data == 0) {
                                    return 'Not Verified';
                                } else if (data == 1) {
                                    return 'Verified';
                                } else {
                                    // Handle any other cases or unexpected values
                                    return 'Unknown Status';
                                }
                            }
                            return data;
                        }
                    },

                    {
                        data: 'status',
                        render: function(data, type, row) {
                            if (type == 'display') {
                                if (data == 1) {
                                    return '<i class="fa-solid fa-power-off text-success" title="Active"></i>';
                                } else if (data == 2) {
                                    return '<i class="fa-solid fa-power-off text-danger" title="Deactive"></i>';
                                } else {
                                    // Handle any other cases or unexpected values
                                    return 'Unknown Status';
                                }
                            }
                            return data;
                        }
                    },
                    {
                        data: 'created_at',
                        render: function(data, type, row) {
                            if (type === 'display' || type === 'filter') {
                                // Assuming 'created_at' is in the default ISO 8601 format
                                var date = new Date(data);
                                var year = date.getFullYear();
                                var month = (date.getMonth() + 1).toString().padStart(2,
                                    '0'); // Add 1 to month because it's zero-based
                                var day = date.getDate().toString().padStart(2, '0');
                                return year + '-' + month + '-' + day;
                            } else {
                                return data;
                            }
                        }
                    }


                ];

                populateTable(data, tableId, columns);

            })
            .catch(error => console.error(error));
    }


    function orderReport() {
        const url = "{{ url('admin/getAllOrders') }}";


        const tableId = "allOrdersTable2";

        fetch(url, {
                method: 'GET'
            })
            .then(response => response.json())
            .then(data => {
                console.log(data);

                const columns = [
                    //      {
                    //         data: null,
                    //         render: function(data, type, row) {
                    //             if (type === 'display') {

                    //                 return `
                    //     <button class="btn btn-primary" title="View" data-id="${row.id}" onclick="viewOrder(event)" style="padding: 7px 11px;" ><i class="fa-regular fa-eye" style="margin-left:4px;" data-id="${row.id}" onclick="viewOrder(event)"></i></button>
                    //     <button class="btn btn-danger" title="Delete" onclick="deleteOrder(${row.id})" style="padding: 7px 11px;"><i class="fa-solid fa-trash" style="margin-left:4px;" onclick="deleteOrder(${row.id})"></i></button>

                    // `;
                    //             }
                    //             return data;
                    //         }
                    //     },
                    {
                        data: null,
                        render: function(data, type, row) {
                            if (type === 'display') {


                                return `
            <i class="fa-regular fa-eye text-primary" title="Edit" style="margin-left:4px;font-size:20px;" data-id="${row.id}" onclick="viewOrder(event)"></i>
            <i class="fa-solid fa-trash text-danger" title="Change Status" style="margin-left:4px;font-size:22px;" onclick="deleteOrder(${row.id})"></i>
            
        `;




                            }
                            return data;
                        }
                    },

                    {
                        data: 'order_id'
                    },
                    {
                        data: 'user.name'
                    },
                    {
                        data: 'user.phone'
                    },
                    {
                        "data": "products",
                        "render": function(data, type, row) {
                            if (type === 'display' && data.length > 20) {
                                return '<span data-toggle="tooltip" title="' + data + '">' + data
                                    .substr(0, 20) + '...</span>';
                            } else {
                                return data;
                            }
                        }
                    },
                    {
                        data: 'amount'
                    },

                    // {
                    //     data: 'order_status'
                    // },
                    {
                        data: 'order_status',
                        render: function(data, type, row) {
                            if (type == 'display') {
                                if (data == 0) {
                                    return '<button class="btn-danger btn btn-sm" style="padding: 7px 10px 7px 10px;">Cancelled Order</button>';
                                } else if (data == 1) {
                                    return '<button class="btn-primary btn btn-sm" style="padding: 7px 10px 7px 10px;">Order Placed</button>';
                                } else if (data == 2) {
                                    return '<button class="btn-info btn btn-sm" style="padding: 7px 10px 7px 10px;">Order Shipped</button>';
                                } else if (data == 3) {
                                    return '<button class="btn-warning btn btn-sm" style="padding: 7px 10px 7px 10px;">Reached Hub</button>';
                                } else if (data == 4) {
                                    return '<button class="btn-light btn btn-sm" style="padding: 7px 10px 7px 10px;">Out for Delivery</button>';
                                } else if (data == 5) {
                                    return '<button class="btn-success btn btn-sm" style="padding: 7px 10px 7px 10px;">Order Delivered</button>';
                                } else {
                                    // Handle any other cases or unexpected values
                                    return '<button class="btn-default btn btn-sm" style="padding: 7px 10px 7px 10px;">Status Unknown</button>';
                                }
                            }
                            return data;
                        }
                    },



                    // {
                    //     data: 'transaction_id'
                    // },

                    {
                        data: 'created_at',
                        render: function(data, type, row) {
                            if (type === 'display' || type === 'filter') {
                                // Assuming 'created_at' is in the default ISO 8601 format
                                var datetime = new Date(data);
                                var year = datetime.getFullYear();
                                var month = (datetime.getMonth() + 1).toString().padStart(2, '0');
                                var day = datetime.getDate().toString().padStart(2, '0');
                                var hours = datetime.getHours().toString().padStart(2, '0');
                                var minutes = datetime.getMinutes().toString().padStart(2, '0');
                                var seconds = datetime.getSeconds().toString().padStart(2, '0');

                                // Format the date and time as 'yyyy-mm-dd HH:MM:SS'
                                return year + '-' + month + '-' + day + ' ' + hours + ':' + minutes + ':' +
                                    seconds;
                            } else {
                                return data;
                            }
                        }
                    }



                ];


                populateTable(data, tableId, columns);
            })
            .catch(error => console.error(error));
    }


    function userReport() {
        const url = "{{ url('admin/getAllUsers') }}";

        const tableId = "usersTable2";


        fetch(url, {
                method: 'GET'
            })
            .then(response => response.json())
            .then(data => {
                console.log(data);

                const columns = [


                    {
                        data: null,
                        render: function(data, type, row) {
                            if (type === 'display') {

                                if (row.status == 1) {
                                    return `
            <i class="fa-regular fa-eye" title="Edit" style="margin-left:4px;font-size:20px;" data-id="${row.id}" onclick="viewUser(event)"></i>
            <i class="fa-solid fa-toggle-on text-success" title="Change Status" style="margin-left:4px;font-size:22px;" onclick="changeUserReport(${row.id})"></i>
            <i class="fa-solid fa-trash text-danger" title="Delete User" style="margin-left:4px;font-size:22px;" onclick="deleteUserReport(${row.id})"></i>
            
        `;
                                } else {
                                    return `
            <i class="fa-regular fa-eye"  style="margin-left:4px;font-size:20px;" data-id="${row.id}" onclick="viewUser(event)"></i>
            <i class="fa-solid fa-toggle-off text-danger" title="Change Status" style="margin-left:4px;font-size:22px;" onclick="changeUserReport(${row.id})"></i>
            <i class="fa-solid fa-trash text-danger" title="Delete User" style="margin-left:4px;font-size:22px;" onclick="deleteUserReport(${row.id})"></i>
            
        `;
                                }


                            }
                            return data;
                        }
                    },

                    {
                        data: 'id'
                    },
                    {
                        data: 'name'
                    },
                    {
                        data: 'email'
                    },

                    {
                        data: 'phone'
                    },
                    {
                        data: 'is_verified',
                        render: function(data, type, row) {
                            if (type == 'display') {
                                if (data == 0) {
                                    return 'Not Verified';
                                } else if (data == 1) {
                                    return 'Verified';
                                } else {
                                    // Handle any other cases or unexpected values
                                    return 'Unknown Status';
                                }
                            }
                            return data;
                        }
                    },
                    {
                        data: 'status',
                        render: function(data, type, row) {
                            if (type == 'display') {
                                if (data == 1) {
                                    return '<i class="fa-solid fa-power-off text-success" title="Active"></i>';
                                } else if (data == 2) {
                                    return '<i class="fa-solid fa-power-off text-danger" title="Deactive"></i>';
                                } else {
                                    // Handle any other cases or unexpected values
                                    return 'Unknown Status';
                                }
                            }
                            return data;
                        }
                    },
                    {
                        data: 'created_at',
                        render: function(data, type, row) {
                            if (type === 'display' || type === 'filter') {
                                // Assuming 'created_at' is in the default ISO 8601 format
                                var date = new Date(data);
                                var year = date.getFullYear();
                                var month = (date.getMonth() + 1).toString().padStart(2,
                                    '0'); // Add 1 to month because it's zero-based
                                var day = date.getDate().toString().padStart(2, '0');
                                return year + '-' + month + '-' + day;
                            } else {
                                return data;
                            }
                        }
                    }


                ];

                populateTable(data, tableId, columns);

            })
            .catch(error => console.error(error));
    }



   

    //filter records for order report



    $(document).on("click", "#filter", function(e) {
        e.preventDefault();

        var start_date = $("#start_date").val();
        var end_date = $("#end_date").val();

        if (start_date == "" || end_date == "") {
            toastr.warning("Start and end date are required!");
        } else {
            $('#allOrdersTable2').DataTable().destroy();
            filter_records(start_date, end_date);
        }
    });


    $(document).on("click", "#filter_user", function(e) {
        e.preventDefault();

        var startDate = $("#startDate").val();
        var endDate = $("#endDate").val();

        if (startDate == "" || endDate == "") {
            toastr.warning("Start and end date are required!");
        } else {
            $('#usersTable2').DataTable().destroy();
            filterRecords(startDate, endDate);
        }
    });


    function filterRecords(startDate, endDate) {
        console.log(startDate);
        console.log(endDate);

        const url = "{{ url('admin/getFilterUsers') }}";

        const tableId = "usersTable2";

        const csrfToken = getCsrfToken();

        const form_datas = {
            startDate: startDate,
            endDate: endDate
        };

        fetch(url, {
                method: 'POST',
                body: JSON.stringify(form_datas),
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                },
            })
            .then(response => response.json())
            .then(data => {
                console.log(data);

                const columns = [


                    {
                        data: null,
                        render: function(data, type, row) {
                            if (type === 'display') {

                                if (row.status == 1) {
                                    return `
            <i class="fa-regular fa-eye" title="Edit" style="margin-left:4px;font-size:20px;" data-id="${row.id}" onclick="viewUser(event)"></i>
            <i class="fa-solid fa-toggle-on text-success" title="Change Status" style="margin-left:4px;font-size:22px;" onclick="changeUserReport(${row.id})"></i>
            <i class="fa-solid fa-trash text-danger" title="Delete User" style="margin-left:4px;font-size:22px;" onclick="deleteUserReport(${row.id})"></i>
            
        `;
                                } else {
                                    return `
            <i class="fa-regular fa-eye"  style="margin-left:4px;font-size:20px;" data-id="${row.id}" onclick="viewUser(event)"></i>
            <i class="fa-solid fa-toggle-off text-danger" title="Change Status" style="margin-left:4px;font-size:22px;" onclick="changeUserReport(${row.id})"></i>
            <i class="fa-solid fa-trash text-danger" title="Delete User" style="margin-left:4px;font-size:22px;" onclick="deleteUserReport(${row.id})"></i>
            
        `;
                                }


                            }
                            return data;
                        }
                    },

                    {
                        data: 'id'
                    },
                    {
                        data: 'name'
                    },
                    {
                        data: 'email'
                    },

                    {
                        data: 'phone'
                    },
                    {
                        data: 'is_verified',
                        render: function(data, type, row) {
                            if (type == 'display') {
                                if (data == 0) {
                                    return 'Not Verified';
                                } else if (data == 1) {
                                    return 'Verified';
                                } else {
                                    // Handle any other cases or unexpected values
                                    return 'Unknown Status';
                                }
                            }
                            return data;
                        }
                    },
                    {
                        data: 'status',
                        render: function(data, type, row) {
                            if (type == 'display') {
                                if (data == 1) {
                                    return '<i class="fa-solid fa-power-off text-success" title="Active"></i>';
                                } else if (data == 2) {
                                    return '<i class="fa-solid fa-power-off text-danger" title="Deactive"></i>';
                                } else {
                                    // Handle any other cases or unexpected values
                                    return 'Unknown Status';
                                }
                            }
                            return data;
                        }
                    },
                    {
                        data: 'created_at',
                        render: function(data, type, row) {
                            if (type === 'display' || type === 'filter') {
                                // Assuming 'created_at' is in the default ISO 8601 format
                                var date = new Date(data);
                                var year = date.getFullYear();
                                var month = (date.getMonth() + 1).toString().padStart(2,
                                    '0'); // Add 1 to month because it's zero-based
                                var day = date.getDate().toString().padStart(2, '0');
                                return year + '-' + month + '-' + day;
                            } else {
                                return data;
                            }
                        }
                    }


                ];

                populateTable(data, tableId, columns);




            })
            .catch(error => console.error(error));
    }


    function filter_records(start_date, end_date) {
        console.log(start_date);
        console.log(end_date);

        const url = "{{ url('admin/getFilterOrders') }}";

        const tableId = "allOrdersTable2";

        const csrfToken = getCsrfToken();

        const form_datas = {
            start_date: start_date,
            end_date: end_date
        };

        fetch(url, {
                method: 'POST',
                body: JSON.stringify(form_datas),
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                },
            })
            .then(response => response.json())
            .then(data => {
                console.log(data);

                const columns = [
                    //      {
                    //         data: null,
                    //         render: function(data, type, row) {
                    //             if (type === 'display') {

                    //                 return `
                    //     <button class="btn btn-primary" data-id="${row.id}" onclick="viewOrder(event)" style="padding: 7px 11px;" ><i class="fa-regular fa-eye" style="margin-left:4px;" data-id="${row.id}" onclick="viewOrder(event)"></i></button>
                    //     <button class="btn btn-danger" onclick="deleteOrder(${row.id})" style="padding: 7px 11px;"><i class="fa-solid fa-trash" style="margin-left:4px;" onclick="deleteOrder(${row.id})"></i></button>

                    // `;
                    //             }
                    //             return data;
                    //         }
                    //     },
                    {
                        data: null,
                        render: function(data, type, row) {
                            if (type === 'display') {


                                return `
            <i class="fa-regular fa-eye text-primary" title="Edit" style="margin-left:4px;font-size:20px;" data-id="${row.id}" onclick="viewOrder(event)"></i>
            <i class="fa-solid fa-trash text-danger" title="Change Status" style="margin-left:4px;font-size:22px;" onclick="deleteOrder(${row.id})"></i>
            
        `;




                            }
                            return data;
                        }
                    },
                    {
                        data: 'order_id'
                    },
                    {
                        data: 'user.name'
                    },
                    {
                        data: 'user.phone'
                    },
                    {
                        "data": "products",
                        "render": function(data, type, row) {
                            if (type === 'display' && data.length > 20) {
                                return '<span data-toggle="tooltip" title="' + data + '">' + data
                                    .substr(0, 20) + '...</span>';
                            } else {
                                return data;
                            }
                        }
                    },
                    {
                        data: 'amount'
                    },

                    // {
                    //     data: 'order_status'
                    // },
                    {
                        data: 'order_status',
                        render: function(data, type, row) {
                            if (type == 'display') {
                                if (data == 0) {
                                    return '<button class="btn-danger btn btn-sm" style="padding: 7px 10px 7px 10px;">Cancelled Order</button>';
                                } else if (data == 1) {
                                    return '<button class="btn-primary btn btn-sm" style="padding: 7px 10px 7px 10px;">Order Placed</button>';
                                } else if (data == 2) {
                                    return '<button class="btn-info btn btn-sm" style="padding: 7px 10px 7px 10px;">Order Shipped</button>';
                                } else if (data == 3) {
                                    return '<button class="btn-warning btn btn-sm" style="padding: 7px 10px 7px 10px;">Reached Hub</button>';
                                } else if (data == 4) {
                                    return '<button class="btn-light btn btn-sm" style="padding: 7px 10px 7px 10px;">Out for Delivery</button>';
                                } else if (data == 5) {
                                    return '<button class="btn-success btn btn-sm" style="padding: 7px 10px 7px 10px;">Order Delivered</button>';
                                } else {
                                    // Handle any other cases or unexpected values
                                    return '<button class="btn-default btn btn-sm" style="padding: 7px 10px 7px 10px;">Status Unknown</button>';
                                }
                            }
                            return data;
                        }
                    },



                    // {
                    //     data: 'transaction_id'
                    // },

                    {
                        data: 'created_at',
                        render: function(data, type, row) {
                            if (type === 'display' || type === 'filter') {
                                // Assuming 'created_at' is in the default ISO 8601 format
                                var datetime = new Date(data);
                                var year = datetime.getFullYear();
                                var month = (datetime.getMonth() + 1).toString().padStart(2, '0');
                                var day = datetime.getDate().toString().padStart(2, '0');
                                var hours = datetime.getHours().toString().padStart(2, '0');
                                var minutes = datetime.getMinutes().toString().padStart(2, '0');
                                var seconds = datetime.getSeconds().toString().padStart(2, '0');

                                // Format the date and time as 'yyyy-mm-dd HH:MM:SS'
                                return year + '-' + month + '-' + day + ' ' + hours + ':' + minutes + ':' +
                                    seconds;
                            } else {
                                return data;
                            }
                        }
                    }

                ];

                populateTable(data, tableId, columns);

            })
            .catch(error => console.error(error));

    }




    $(document).on("click", "#reset", function(e) {
        e.preventDefault();

        $("#start_date").val(''); // empty value
        $("#end_date").val('');

        $('#allOrdersTable2').DataTable().destroy();
        orderReport();


    });


    $(document).on("click", "#reset_user", function(e) {
        e.preventDefault();

        $("#startDate").val(''); // empty value
        $("#endDate").val('');

        $('#usersTable2').DataTable().destroy();
        userReport();


    });






    // new orders DataTable

    function getAllNewordersDatatable() {


        const url = "{{ url('admin/getNewOrders') }}";
        const tableId = "newOrdersTable";
        fetch(url, {
                method: 'GET'
            })
            .then(response => response.json())
            .then(data => {
                console.log(data);

                const columns = [
                    
                    {
                        data: null,
                        render: function(data, type, row) {
                            if (type === 'display') {


                                return `
            <i class="fa-regular fa-eye text-primary" title="Edit" style="margin-left:4px;font-size:20px;" data-id="${row.id}" onclick="viewOrder(event)"></i>
            <i class="fa-solid fa-trash text-danger" title="Change Status" style="margin-left:4px;font-size:22px;" onclick="deleteOrderNew(${row.id})"></i>
            
        `;



                            }
                            return data;
                        }
                    },


                    {
                        data: 'order_id'
                    },
                    {
                        data: 'user.name'
                    },
                    {
                        data: 'user.phone'
                    },
                    {
                        "data": "products",
                        "render": function(data, type, row) {
                            if (type === 'display' && data.length > 20) {
                                return '<span data-toggle="tooltip" title="' + data + '">' + data
                                    .substr(0, 20) + '...</span>';
                            } else {
                                return data;
                            }
                        }
                    },
                    {
                        data: 'amount'
                    },

                    // {
                    //     data: 'order_status'
                    // },

                    {
                        data: 'order_status',
                        render: function(data, type, row) {
                            if (type == 'display') {
                                if (data == 0) {
                                    return '<button class="btn-danger btn btn-sm" style="padding: 7px 10px 7px 10px;">Cancelled Order</button>';
                                } else if (data == 1) {
                                    return '<button class="btn-primary btn btn-sm" style="padding: 7px 10px 7px 10px;">Order Placed</button>';
                                } else if (data == 2) {
                                    return '<button class="btn-info btn btn-sm" style="padding: 7px 10px 7px 10px;">Order Shipped</button>';
                                } else if (data == 3) {
                                    return '<button class="btn-warning btn btn-sm" style="padding: 7px 10px 7px 10px;">Reached Hub</button>';
                                } else if (data == 4) {
                                    return '<button class="btn-light btn btn-sm" style="padding: 7px 10px 7px 10px;">Out for Delivery</button>';
                                } else if (data == 5) {
                                    return '<button class="btn-success btn btn-sm" style="padding: 7px 10px 7px 10px;">Order Delivered</button>';
                                } else {
                                    // Handle any other cases or unexpected values
                                    return '<button class="btn-default btn btn-sm" style="padding: 7px 10px 7px 10px;">Status Unknown</button>';
                                }
                            }
                            return data;
                        }
                    },




                    // {
                    //     data: 'transaction_id'
                    // },

                    {
                        data: 'created_at',
                        render: function(data, type, row) {
                            if (type === 'display' || type === 'filter') {
                                // Assuming 'created_at' is in the default ISO 8601 format
                                var datetime = new Date(data);
                                var year = datetime.getFullYear();
                                var month = (datetime.getMonth() + 1).toString().padStart(2, '0');
                                var day = datetime.getDate().toString().padStart(2, '0');
                                var hours = datetime.getHours().toString().padStart(2, '0');
                                var minutes = datetime.getMinutes().toString().padStart(2, '0');
                                var seconds = datetime.getSeconds().toString().padStart(2, '0');

                                // Format the date and time as 'yyyy-mm-dd HH:MM:SS'
                                return year + '-' + month + '-' + day + ' ' + hours + ':' +
                                    minutes + ':' + seconds;
                            } else {
                                return data;
                            }
                        }
                    }


                ];

                populateTable(data, tableId, columns);
            })
            .catch(error => console.error(error));
    }


    // cancelled orders table

    function getAllCancelledordersDatatable() {


        const url = "{{ url('admin/getCancelledOrders') }}";
        const tableId = "cancelledOrdersTable";
        fetch(url, {
                method: 'GET'
            })
            .then(response => response.json())
            .then(data => {
                console.log(data);

                const columns = [
                  

                    {
                        data: null,
                        render: function(data, type, row) {
                            if (type === 'display') {


                                return `
            <i class="fa-regular fa-eye text-primary" title="Edit" style="margin-left:4px;font-size:20px;" data-id="${row.id}" onclick="viewOrder(event)"></i>
            <i class="fa-solid fa-trash text-danger" title="Change Status" style="margin-left:4px;font-size:22px;" onclick="deleteOrderCancelled(${row.id})"></i>
            
        `;




                            }
                            return data;
                        }
                    },

                    {
                        data: 'order_id'
                    },
                    {
                        data: 'user.name'
                    },
                    {
                        data: 'user.phone'
                    },
                    {
                        "data": "products",
                        "render": function(data, type, row) {
                            if (type === 'display' && data.length > 20) {
                                return '<span data-toggle="tooltip" title="' + data + '">' + data
                                    .substr(0, 20) + '...</span>';
                            } else {
                                return data;
                            }
                        }
                    },
                    {
                        data: 'amount'
                    },

                    // {
                    //     data: 'order_status'
                    // },

                    {
                        data: 'order_status',
                        render: function(data, type, row) {
                            if (type == 'display') {
                                if (data == 0) {
                                    return '<button class="btn-danger btn btn-sm" style="padding: 7px 10px 7px 10px;">Cancelled Order</button>';
                                } else if (data == 1) {
                                    return '<button class="btn-primary btn btn-sm" style="padding: 7px 10px 7px 10px;">Order Placed</button>';
                                } else if (data == 2) {
                                    return '<button class="btn-info btn btn-sm" style="padding: 7px 10px 7px 10px;">Order Shipped</button>';
                                } else if (data == 3) {
                                    return '<button class="btn-warning btn btn-sm" style="padding: 7px 10px 7px 10px;">Reached Hub</button>';
                                } else if (data == 4) {
                                    return '<button class="btn-light btn btn-sm" style="padding: 7px 10px 7px 10px;">Out for Delivery</button>';
                                } else if (data == 5) {
                                    return '<button class="btn-success btn btn-sm" style="padding: 7px 10px 7px 10px;">Order Delivered</button>';
                                } else {
                                    // Handle any other cases or unexpected values
                                    return '<button class="btn-default btn btn-sm" style="padding: 7px 10px 7px 10px;">Status Unknown</button>';
                                }
                            }
                            return data;
                        }
                    },


                    // {
                    //     data: 'transaction_id'
                    // },

                    {
                        data: 'created_at',
                        render: function(data, type, row) {
                            if (type === 'display' || type === 'filter') {
                                // Assuming 'created_at' is in the default ISO 8601 format
                                var datetime = new Date(data);
                                var year = datetime.getFullYear();
                                var month = (datetime.getMonth() + 1).toString().padStart(2, '0');
                                var day = datetime.getDate().toString().padStart(2, '0');
                                var hours = datetime.getHours().toString().padStart(2, '0');
                                var minutes = datetime.getMinutes().toString().padStart(2, '0');
                                var seconds = datetime.getSeconds().toString().padStart(2, '0');

                                // Format the date and time as 'yyyy-mm-dd HH:MM:SS'
                                return year + '-' + month + '-' + day + ' ' + hours + ':' +
                                    minutes + ':' + seconds;
                            } else {
                                return data;
                            }
                        }
                    }

                ];

                populateTable(data, tableId, columns);
            })
            .catch(error => console.error(error));
    }


    //completed orders datatable

    $(document).ready(function() {


        const url = "{{ url('admin/getCompletedOrders') }}";
        const tableId = "completedOrdersTable";
        fetch(url, {
                method: 'GET'
            })
            .then(response => response.json())
            .then(data => {
                console.log(data);

                const columns = [
                    //       {
                    //         data: null,
                    //         render: function(data, type, row) {
                    //             if (type === 'display') {

                    //                 return `
                    //     <button class="btn btn-primary" data-id="${row.id}" onclick="viewOrder(event)" style="padding: 7px 11px;" ><i class="fa-regular fa-eye" style="margin-left:4px;" data-id="${row.id}" onclick="viewOrder(event)"></i></button>
                    //     <button class="btn btn-danger" onclick="deleteOrder(${row.id})" style="padding: 7px 11px;"><i class="fa-solid fa-trash" style="margin-left:4px;" onclick="deleteOrder(${row.id})"></i></button>

                    // `;
                    //             }
                    //             return data;
                    //         }
                    //     },
                    {
                        data: null,
                        render: function(data, type, row) {
                            if (type === 'display') {


                                return `
            <i class="fa-regular fa-eye text-primary" title="Edit" style="margin-left:4px;font-size:20px;" data-id="${row.id}" onclick="viewOrder(event)"></i>
            <i class="fa-solid fa-trash text-danger" title="Change Status" style="margin-left:4px;font-size:22px;" onclick="deleteOrder(${row.id})"></i>
            
        `;



                            }
                            return data;
                        }
                    },
                    {
                        data: 'order_id'
                    },
                    {
                        data: 'user.name'
                    },
                    {
                        data: 'user.phone'
                    },
                    {
                        "data": "products",
                        "render": function(data, type, row) {
                            if (type === 'display' && data.length > 20) {
                                return '<span data-toggle="tooltip" title="' + data + '">' + data
                                    .substr(0, 20) + '...</span>';
                            } else {
                                return data;
                            }
                        }
                    },
                    {
                        data: 'amount'
                    },

                    // {
                    //     data: 'order_status'
                    // },

                    {
                        data: 'order_status',
                        render: function(data, type, row) {
                            if (type == 'display') {
                                if (data == 0) {
                                    return '<button class="btn-danger btn btn-sm" style="padding: 7px 10px 7px 10px;">Cancelled Order</button>';
                                } else if (data == 1) {
                                    return '<button class="btn-primary btn btn-sm" style="padding: 7px 10px 7px 10px;">Order Placed</button>';
                                } else if (data == 2) {
                                    return '<button class="btn-info btn btn-sm" style="padding: 7px 10px 7px 10px;">Order Shipped</button>';
                                } else if (data == 3) {
                                    return '<button class="btn-warning btn btn-sm" style="padding: 7px 10px 7px 10px;">Reached Hub</button>';
                                } else if (data == 4) {
                                    return '<button class="btn-light btn btn-sm" style="padding: 7px 10px 7px 10px;">Out for Delivery</button>';
                                } else if (data == 5) {
                                    return '<button class="btn-success btn btn-sm" style="padding: 7px 10px 7px 10px;">Order Delivered</button>';
                                } else {
                                    // Handle any other cases or unexpected values
                                    return '<button class="btn-default btn btn-sm" style="padding: 7px 10px 7px 10px;">Status Unknown</button>';
                                }
                            }
                            return data;
                        }
                    },


                    // {
                    //     data: 'transaction_id'
                    // },

                    {
                        data: 'created_at',
                        render: function(data, type, row) {
                            if (type === 'display' || type === 'filter') {
                                // Assuming 'created_at' is in the default ISO 8601 format
                                var datetime = new Date(data);
                                var year = datetime.getFullYear();
                                var month = (datetime.getMonth() + 1).toString().padStart(2, '0');
                                var day = datetime.getDate().toString().padStart(2, '0');
                                var hours = datetime.getHours().toString().padStart(2, '0');
                                var minutes = datetime.getMinutes().toString().padStart(2, '0');
                                var seconds = datetime.getSeconds().toString().padStart(2, '0');

                                // Format the date and time as 'yyyy-mm-dd HH:MM:SS'
                                return year + '-' + month + '-' + day + ' ' + hours + ':' +
                                    minutes + ':' + seconds;
                            } else {
                                return data;
                            }
                        }
                    }


                ];

                populateTable(data, tableId, columns);
            })
            .catch(error => console.error(error));
    });




    var Globaltable;

    function populateTable(data, tableId, columns) {

        Globaltable = $('#' + tableId).DataTable({
            data: data,
            // buttons
            "dom": "<'row'<'col-sm-12 col-md-4'l><'col-sm-12 col-md-4'B><'col-sm-12 col-md-4'f>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
            "buttons": [
                'csv', 'pdf', 'print'
            ],
            order: [
                [0, 'desc']
            ],
            "oLanguage": {
                "sEmptyTable": "No records found."
            },
            columnDefs: [{
                "defaultContent": "-",
                "targets": "_all"
            }],
            columns: columns,


        });
    }


    function resetGSTForm(){
        $("#addgstForm").trigger('reset');
    }





    function editCategory(id) {

        const csrfToken = getCsrfToken();
        $("#cid").val(id);
        const form_datas = {
            id: id,
        };


        fetch("{{ url('/admin/getCategory') }}", {
                method: 'POST',
                body: JSON.stringify(form_datas),
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                },
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {

                console.log(data);
                $("#EditCategoryModal").modal('show');
                $("#edit_category_name").val(data.name);
                //  const Bannerurl = "{{ asset('/banners') }}/"+data.image;
                //  $("#edit_banner_img").attr('src',Bannerurl);



            })
            .catch(error => {
                console.error('Fetch error:', error);
            });

    }


    function editGst(id) {
        const csrfToken = getCsrfToken();
        $("#gid").val(id);
        const form_datas = {
            id: id,
        };


        fetch("{{ url('/admin/getGst') }}", {
                method: 'POST',
                body: JSON.stringify(form_datas),
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                },
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {

                console.log(data);
                $("#EditGstModal").modal('show');
                $("#edit_cgst").val(data.cgst);
                $("#edit_sgst").val(data.sgst);
            })
            .catch(error => {
                console.error('Fetch error:', error);
            });
    }


    function editSubcategory(id) {


        const csrfToken = getCsrfToken();
        $("#subid").val(id);
        const form_datas = {
            id: id,
        };

        fetch("{{ url('/admin/getSubcategory') }}", {
                method: 'POST',
                body: JSON.stringify(form_datas),
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                },
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {

                console.log(data);
                $("#EditSubModal").modal('show');
                $("#edit_sub_name").val(data.name);

                console.log(data.main_category);

                var selectElement = document.getElementById("edit_main_category");
                for (var i = 0; i < selectElement.options.length; i++) {
                    if (selectElement.options[i].value == data.main_category) {
                        selectElement.options[i].selected = true;
                        break;
                    }
                }

            })
            .catch(error => {
                console.error('Fetch error:', error);
            });


    }



    function editBanner(id) {
        $("#bid").val(id);
        $("#EditBannerModal").modal('show');

        const csrfToken = getCsrfToken();

        const form_datas = {
            id: id,
        };


        fetch("{{ url('/admin/getBanner') }}", {
                method: 'POST',
                body: JSON.stringify(form_datas),
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                },
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {

                console.log(data);
                $("#edit_target_url").val(data.target);
                const Bannerurl = "{{ asset('/banners') }}/" + data.image;
                $("#edit_banner_img").attr('src', Bannerurl);



            })
            .catch(error => {
                console.error('Fetch error:', error);
            });
    }


    function editImage(id) {
        $("#iid").val(id);
        $("#EditimageModal").modal('show');

        const csrfToken = getCsrfToken();

        const form_datas = {
            id: id,
        };


        fetch("{{ url('/admin/getImage') }}", {
                method: 'POST',
                body: JSON.stringify(form_datas),
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                },
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {

                console.log(data);
                $("#edit_target_occasion").val(data.target);
                $("#edit_button_occasion").val(data.button);
                // const Bannerurl = "{{ asset('/banners') }}/" + data.image;
                // $("#edit_banner_img").attr('src', Bannerurl);

                var selectElement = document.getElementById("edit_image_type");
                for (var i = 0; i < selectElement.options.length; i++) {
                    if (selectElement.options[i].value == data.type) {
                        selectElement.options[i].selected = true;
                        break;
                    }
                }



            })
            .catch(error => {
                console.error('Fetch error:', error);
            });
    }





    function editSlider(id) {
        $("#sid").val(id);
        $("#EditSliderModal").modal('show');

        const csrfToken = getCsrfToken();

        const form_datas = {
            id: id,
        };


        fetch("{{ url('/admin/getSlider') }}", {
                method: 'POST',
                body: JSON.stringify(form_datas),
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                },
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {

                console.log(data);
                $("#sid").val(data.id);

                var selectElement = document.getElementById("edit_type");
                for (var i = 0; i < selectElement.options.length; i++) {
                    if (selectElement.options[i].value == data.type) {
                        selectElement.options[i].selected = true;
                        break;
                    }
                }


                var productStr = data.products;

                var products = productStr.split(',');

                console.log(products);
                $('#edit_products').selectpicker('val', products);




            })
            .catch(error => {
                console.error('Fetch error:', error);
            });



    }


    function editTestimonialSlider(id) {
        $("#sid").val(id);
        $("#EditTestimonialSliderModal").modal('show');

        const csrfToken = getCsrfToken();

        const form_datas = {
            id: id,
        };


        fetch("{{ url('/admin/getTestimonialSlider') }}", {
                method: 'POST',
                body: JSON.stringify(form_datas),
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                },
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {

                console.log(data);
                $("#tid").val(data.id);

                $("#edit_testimonial_name").val(data.name);
                //$("#edit_testimonial_description").val(data.description);
                $("#edit_testimonial_designation").val(data.designation);

                tinymce.get('edit_testimonial_description').setContent(data.description);



            })
            .catch(error => {
                console.error('Fetch error:', error);
            });



    }




    function viewOrder(event) {

        var orderId = event.target.getAttribute('data-id');
        console.log(orderId);

        var url = "{{ url('admin/orderDetails') }}/" + orderId;

        window.open(url, '_blank');


    }

    function viewUser(event) {



        var userId = event.target.getAttribute('data-id');
        //alert(userId);

        const csrfToken = getCsrfToken();

        const form_datas = {
            id: userId,
        };


        fetch("{{ url('/admin/getUser') }}", {
                method: 'POST',
                body: JSON.stringify(form_datas),
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                },
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {

                console.log(data);
                $("#edit_name").val(data.name);
                $("#edit_email").val(data.email);
                $("#edit_phone").val(data.phone);

                imgName = data.profile_image;
                if (imgName != null) {
                    imgUrl = "{{ asset('/profile') }}/" + imgName;
                } else {
                    imgUrl = "{{ asset('images/logo.png') }}";
                }

                console.log(imgUrl);

                $("#user_pic").attr('src', imgUrl);

                $("#viewUserModal").modal('show');


            })
            .catch(error => {
                console.error('Fetch error:', error);
            });



    }


    function editProduct(id, event) {

        document.getElementById('edit_subcategory').innHTML = "";
        var loader = document.querySelector(".loader-container");
        loader.style.display = "flex";

        const csrfToken = getCsrfToken();

        const form_datas = {
            id: id,
        };

        fetch("{{ url('/admin/getProduct') }}", {
                method: 'POST',
                body: JSON.stringify(form_datas),
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                },
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {

                console.log(data.slug);

                const imgurl = "{{ asset('/products') }}/" + data.product_image;
                $("#edit_product_img").attr('src', imgurl);

                // Clear existing alt images
                $("#altImagesContainer").empty();

                // Display product_alt_images
                const altImages = JSON.parse(data.product_alt_images);


                // Check if altImages is an array
                if (Array.isArray(altImages) && altImages.length > 0) {
                    altImages.forEach(altImage => {
                        const altImageUrl = "{{ asset('/product_alt') }}/" + altImage;
                        const altImageElement =
                            `<img src="${altImageUrl}" class="img-thumbnail" alt="Product Alt Image">`;
                        $("#altImagesContainer").append(altImageElement);
                    });
                } else {
                    console.log(typeof(data.product_alt_images));
                    console.error('product_alt_images is not an array or is empty');
                }


                $("#edit_title").val(data.title);
                $("#edit_code").val(data.code);
                $("#edit_sku").val(data.sku);
                $("#edit_slug").val(data.slug);

                loader.style.display = "none";
                $("#editproductModal").modal('show');


                var edit_category = document.getElementById('edit_category');

                var edit_subcategory = document.getElementById('edit_subcategory');
                var edit_product_status = document.getElementById('edit_product_status');

                for (var i = 0; i < edit_category.options.length; i++) {

                    if (edit_category.options[i].value == data.main_category) {

                        edit_category.options[i].selected = true;
                    }

                }

                for (var i = 0; i < edit_subcategory.options.length; i++) {

                    if (edit_subcategory.options[i].value == data.sub_category) {

                        edit_subcategory.options[i].selected = true;
                    }

                }


                for (var i = 0; i < edit_product_status.options.length; i++) {

                    if (edit_product_status.options[i].value == data.status) {

                        edit_product_status.options[i].selected = true;
                    }

                }

                $("#eid").val(data.id);

                tinymce.get('edit_description').setContent(data.description);
                $("#edit_weight").val(data.weight);
                $("#edit_height").val(data.height);
                $("#edit_length").val(data.length);

                $("#edit_breadth").val(data.breadth);
                $("#edit_price").val(data.price);
                $("#edit_gst").val(data.gst);

                console.log("Actual price" + data.actual_price);

                if (data.actual_price != "" && data.actual_price != null) {
                    $("#edit_actual_price").val(data.actual_price);

                }

                $("#edit_product_height").val(data.product_height);
                $("#edit_product_breadth").val(data.product_breadth);
                $("#edit_product_length").val(data.product_length);

                var tagstr = data.tags;
                console.log(tagstr);

                if (tagstr && tagstr !== "") {
                    // Trim any whitespace and then split the string by commas
                    var tags = tagstr.split(',').map(tag => tag.trim());

                    $('#edit_tags').selectpicker('val', tags);
                } else {
                    $('#edit_tags').selectpicker('val', []);
                }



            })
            .catch(error => {
                console.error('Fetch error:', error);
            });

    }


    //new form submit for product edit

    // 

    document.addEventListener("DOMContentLoaded", function() {
        var editProductForm = document.getElementById('editProductForm');

        if (editProductForm) {
            editProductForm.onsubmit = function(event) {

                event.preventDefault();

                let formElement = event.target;
                const formData = new FormData(formElement);
                let content = tinymce.get('edit_description').getContent();
                formData.set('description', content);
                let formAction = formElement.getAttribute('action');

                const csrfToken = getCsrfToken();


                const edit_product_image = document.getElementById('edit_product_image');
                var imageFile = edit_product_image.files[0];

                if (!imageFile) {
                    fetch(formAction, {
                            method: 'POST',
                            body: formData,
                            headers: {
                                'X-CSRF-TOKEN': csrfToken,
                            },
                        })
                        .then((response) => response.json())
                        .then(data => {

                            console.log(data);
                            if (data.errors) {
                                var error = data.errors;
                                for (const fieldName in error) {
                                    if (error.hasOwnProperty(fieldName)) {
                                        const errorMessages = error[fieldName];
                                        errorMessages.forEach(errorMessage => {
                                            toastr.error(errorMessage);
                                        });
                                    }
                                }
                            }

                            if (data.code == 200) {
                                toastr.success(data.msg, 'Success', {
                                    onHidden: function() {
                                        //window.location.reload();

                                        // refresh the DataTable

                                        $("#editproductModal").modal('hide');
                                        $('#productTable').DataTable().destroy();
                                        AllProductsDatatable();
                                    },
                                });
                            }


                        })
                        .catch(error => {
                            console.error('Fetch error:', error);
                        });
                } else {
                    if (imageFile.size > 5 * 1024 * 1024) {
                        $("#uploadErrorSpan").html('Image shoul be less than 5MB');
                    } else {

                        fetch(formAction, {
                                method: 'POST',
                                body: formData,
                                headers: {
                                    'X-CSRF-TOKEN': csrfToken,
                                },
                            })
                            .then((response) => response.json())
                            .then(data => {

                                console.log(data);
                                if (data.errors) {
                                    var error = data.errors;
                                    for (const fieldName in error) {
                                        if (error.hasOwnProperty(fieldName)) {
                                            const errorMessages = error[fieldName];
                                            errorMessages.forEach(errorMessage => {
                                                toastr.error(errorMessage);
                                            });
                                        }
                                    }
                                }

                                if (data.code == 200) {
                                    toastr.success(data.msg, 'Success', {
                                        onHidden: function() {
                                            //window.location.reload();

                                            // refresh the DataTable
                                            $("#editproductModal").modal('hide');
                                            $('#productTable').DataTable().destroy();
                                            AllProductsDatatable();
                                        },
                                    });
                                }


                            })
                            .catch(error => {
                                console.error('Fetch error:', error);
                            });
                    }
                }



            }
        }



    });






    // const editProductBtn = document.getElementById('editProductBtn');


    // if (editProductBtn) {

    //     editProductBtn.addEventListener('click', function() {

    //         var html = '<i class="fa fa-spinner fa-spin" ></i>';
    //         var resetbtn = "Save changes";

    //         editProductBtn.innerHTML = html;
    //         editProductBtn.disabled = true;

    //         const edit_product_image = document.getElementById('edit_product_image');

    //         var imageFile = edit_product_image.files[0];

    //         if (!imageFile) {
    //             editProductBtn.innerHTML = resetbtn;
    //             editProductBtn.disabled = false;

    //             $("#uploadErrorSpan").html('Please Select an image!');
    //         } else {

    //             if (imageFile.size > 5 * 1024 * 1024) {
    //                 editProductBtn.innerHTML = resetbtn;
    //                 editProductBtn.disabled = false;
    //                 $("#uploadErrorSpan").html('Image shoul be less than 5MB');
    //             } else {
    //                 //fetch will call
    //                 const editProductForm = document.getElementById("editProductForm");
    //                 const formData = new FormData(editProductForm);

    //                 const url = "{{ url('admin/editProduct') }}";
    //                 const csrfToken = getCsrfToken();

    //                 const requestOptions = {
    //                     method: 'POST',
    //                     headers: {

    //                         'X-CSRF-TOKEN': csrfToken,
    //                     },
    //                     body: formData,
    //                 };


    //                 fetch(url, requestOptions)
    //                     .then((response) => {
    //                         if (!response.ok) {
    //                             throw new Error('Network response was not ok');
    //                         }
    //                         return response.json(); // Parse the response as JSON if needed
    //                     })
    //                     .then((data) => {
    //                         editProductBtn.innerHTML = resetbtn;
    //                         console.log(data);
    //                         if (data.code == 200) {
    //                             toastr.success(data.msg, 'Success', {
    //                                 onHidden: function() {

    //                                     editProductBtn.disabled = false;
    //                                     location.reload();
    //                                 }
    //                             });

    //                         }
    //                     }).catch((error) => {
    //                         editProductBtn.innerHTML = resetbtn;
    //                         editProductBtn.disabled = false;
    //                         console.error('There was a problem with the fetch operation:', error);
    //                     });



    //             }
    //         }






    // });

    //}





    function deleteOrder(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#004a8c',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                const csrfToken = getCsrfToken();
                const form_datas = {
                    id: id,
                };

                fetch("{{ url('/admin/orderDelete') }}", {
                        method: 'POST',
                        body: JSON.stringify(form_datas),
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken,
                        },
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .then(data => {


                        toastr.error('Order deleted successfully', 'Oops', {
                            onHidden: function() {
                                location.reload();
                            }
                        });


                    })
                    .catch(error => {
                        console.error('Fetch error:', error);
                    });



            }
        });

    }


    function deleteOrderAll(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#004a8c',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                const csrfToken = getCsrfToken();
                const form_datas = {
                    id: id,
                };

                fetch("{{ url('/admin/orderDelete') }}", {
                        method: 'POST',
                        body: JSON.stringify(form_datas),
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken,
                        },
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .then(data => {


                        toastr.error('Order deleted successfully', 'Oops', {
                            onHidden: function() {
                                //location.reload();

                                $('#allOrdersTable1').DataTable().destroy();
                                getAllorderDatatable();
                            }
                        });


                    })
                    .catch(error => {
                        console.error('Fetch error:', error);
                    });



            }
        });

    }


    function deleteOrderNew(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#004a8c',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                const csrfToken = getCsrfToken();
                const form_datas = {
                    id: id,
                };

                fetch("{{ url('/admin/orderDelete') }}", {
                        method: 'POST',
                        body: JSON.stringify(form_datas),
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken,
                        },
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .then(data => {


                        toastr.error('Order deleted successfully', 'Oops', {
                            onHidden: function() {
                                //location.reload();

                                $('#newOrdersTable').DataTable().destroy();
                                getAllNewordersDatatable();
;
                            }
                        });


                    })
                    .catch(error => {
                        console.error('Fetch error:', error);
                    });



            }
        });

    }


    function deleteOrderCancelled(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#004a8c',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                const csrfToken = getCsrfToken();
                const form_datas = {
                    id: id,
                };

                fetch("{{ url('/admin/orderDelete') }}", {
                        method: 'POST',
                        body: JSON.stringify(form_datas),
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken,
                        },
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .then(data => {


                        toastr.error('Order deleted successfully', 'Oops', {
                            onHidden: function() {
                                //location.reload();

                                $('#cancelledOrdersTable').DataTable().destroy();
                                getAllCancelledordersDatatable();
;
                            }
                        });


                    })
                    .catch(error => {
                        console.error('Fetch error:', error);
                    });



            }
        });

    }

    


    

    function changeUser(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#004a8c',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes'
        }).then((result) => {
            if (result.isConfirmed) {
                const csrfToken = getCsrfToken();
                const form_datas = {
                    id: id,
                };

                fetch("{{ url('/admin/userChange') }}", {
                        method: 'POST',
                        body: JSON.stringify(form_datas),
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken,
                        },
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .then(data => {


                        toastr.success('User status changed successfully', 'Oops', {
                            onHidden: function() {
                                 $('#usersTable1').DataTable().destroy();
                                getAlluserDatatable();
                            }
                        });


                    })
                    .catch(error => {
                        console.error('Fetch error:', error);
                    });



            }
        });
    }


    function deleteUser(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#004a8c',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes'
        }).then((result) => {
            if (result.isConfirmed) {
                const csrfToken = getCsrfToken();
                const form_datas = {
                    id: id,
                };

                fetch("{{ url('/admin/userDelete') }}", {
                        method: 'POST',
                        body: JSON.stringify(form_datas),
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken,
                        },
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .then(data => {


                        toastr.success('User deleted successfully', 'Oops', {
                            onHidden: function() {
                                // location.reload();
                                // refresh the DataTable
                                $('#usersTable1').DataTable().destroy();
                                getAlluserDatatable();
                            }
                        });


                    })
                    .catch(error => {
                        console.error('Fetch error:', error);
                    });



            }
        });
    }


    function changeUserReport(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#004a8c',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes'
        }).then((result) => {
            if (result.isConfirmed) {
                const csrfToken = getCsrfToken();
                const form_datas = {
                    id: id,
                };

                fetch("{{ url('/admin/userChange') }}", {
                        method: 'POST',
                        body: JSON.stringify(form_datas),
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken,
                        },
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .then(data => {


                        toastr.success('User status changed successfully', 'Oops', {
                            onHidden: function() {
                                 $('#usersTable2').DataTable().destroy();
                                 userReport();
                            }
                        });


                    })
                    .catch(error => {
                        console.error('Fetch error:', error);
                    });



            }
        });
    }


    function deleteUserReport(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#004a8c',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes'
        }).then((result) => {
            if (result.isConfirmed) {
                const csrfToken = getCsrfToken();
                const form_datas = {
                    id: id,
                };

                fetch("{{ url('/admin/userDelete') }}", {
                        method: 'POST',
                        body: JSON.stringify(form_datas),
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken,
                        },
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .then(data => {


                        toastr.success('User deleted successfully', 'Oops', {
                            onHidden: function() {
                                // location.reload();
                                // refresh the DataTable
                                $('#usersTable2').DataTable().destroy();
                                userReport();
                            }
                        });


                    })
                    .catch(error => {
                        console.error('Fetch error:', error);
                    });



            }
        });
    }


    function deleteProduct(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#004a8c',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes'
        }).then((result) => {
            if (result.isConfirmed) {
                const csrfToken = getCsrfToken();
                const form_datas = {
                    id: id,
                };

                fetch("{{ url('/admin/productDelete') }}", {
                        method: 'POST',
                        body: JSON.stringify(form_datas),
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken,
                        },
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .then(data => {


                        toastr.success('Product deleted successfully', 'Oops', {
                            onHidden: function() {
                                $('#productInactive').DataTable().destroy();
                               getAllInactiveDatatable();
                            }
                        });


                    })
                    .catch(error => {
                        console.error('Fetch error:', error);
                    });



            }
        });

    }


    function ProductChange(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#004a8c',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes Delete It'
        }).then((result) => {
            if (result.isConfirmed) {
                const csrfToken = getCsrfToken();
                const form_datas = {
                    id: id,
                };

                fetch("{{ url('/admin/productChange') }}", {
                        method: 'POST',
                        body: JSON.stringify(form_datas),
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken,
                        },
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .then(data => {


                        toastr.success('Product status changed successfully', 'Oops', {
                            onHidden: function() {
                               // location.reload();
                               $('#productTable').DataTable().destroy();
                               AllProductsDatatable();
                            }
                        });


                    })
                    .catch(error => {
                        console.error('Fetch error:', error);
                    });



            }
        });

    }


    function ProductChangeInactive(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#004a8c',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes Delete It'
        }).then((result) => {
            if (result.isConfirmed) {
                const csrfToken = getCsrfToken();
                const form_datas = {
                    id: id,
                };

                fetch("{{ url('/admin/productChange') }}", {
                        method: 'POST',
                        body: JSON.stringify(form_datas),
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken,
                        },
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .then(data => {


                        toastr.success('Product status changed successfully', 'Oops', {
                            onHidden: function() {
                               // location.reload();
                               $('#productInactive').DataTable().destroy();
                               getAllInactiveDatatable();
                            }
                        });


                    })
                    .catch(error => {
                        console.error('Fetch error:', error);
                    });



            }
        });

    }





    function deleteMenu(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You want to change the status",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#004a8c',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes'
        }).then((result) => {
            if (result.isConfirmed) {
                const csrfToken = getCsrfToken();
                const form_datas = {
                    id: id,
                };

                fetch("{{ url('/admin/menuDelete') }}", {
                        method: 'POST',
                        body: JSON.stringify(form_datas),
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken,
                        },
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .then(data => {


                        toastr.success('Menu status changed successfully', 'Success', {
                            onHidden: function() {
                                location.reload();
                            }
                        });


                    })
                    .catch(error => {
                        console.error('Fetch error:', error);
                    });



            }
        });
    }

    //delete slider

    function deleteSlider(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You want to change the status",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#004a8c',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes'
        }).then((result) => {
            if (result.isConfirmed) {
                const csrfToken = getCsrfToken();
                const form_datas = {
                    id: id,
                };

                fetch("{{ url('/admin/sliderDelete') }}", {
                        method: 'POST',
                        body: JSON.stringify(form_datas),
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken,
                        },
                    })
                    .then((response) => response.json())
                    .then(data => {

                        if (data.errors) {

                            toastr.error(data.errors);

                        }

                        if (data.code == 200) {
                            toastr.success('Slider status changed successfully', 'Success', {
                                onHidden: function() {
                                    location.reload();
                                }
                            });
                        }



                    })
                    .catch(error => {
                        console.error('Fetch error:', error);
                    });



            }
        });
    }

    //change gst status

    function changeGstDetails(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You want to change the status",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#004a8c',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes'
        }).then((result) => {
            if (result.isConfirmed) {
                const csrfToken = getCsrfToken();
                const form_datas = {
                    id: id,
                };

                fetch("{{ url('/admin/gstStatusUpdate') }}", {
                        method: 'POST',
                        body: JSON.stringify(form_datas),
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken,
                        },
                    })
                    .then((response) => response.json())
                    .then(data => {

                        if (data.errors) {

                            toastr.error(data.errors);

                        }

                        if (data.code == 200) {
                            toastr.success('GST status changed successfully', 'Success', {
                                onHidden: function() {
                                   // location.reload();
                                   $('#gstTable').DataTable().destroy();
                                   getGstDataTable();
                                }
                            });
                        }



                    })
                    .catch(error => {
                        console.error('Fetch error:', error);
                    });



            }
        });
    }



    //delete testimonial slider

    function deleteTestimonialSlider(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You want to change the status",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#004a8c',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes'
        }).then((result) => {
            if (result.isConfirmed) {
                const csrfToken = getCsrfToken();
                const form_datas = {
                    id: id,
                };

                fetch("{{ url('/admin/TestimonialDelete') }}", {
                        method: 'POST',
                        body: JSON.stringify(form_datas),
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken,
                        },
                    })
                    .then((response) => response.json())
                    .then(data => {

                        if (data.errors) {

                            toastr.error(data.errors);

                        }

                        if (data.code == 200) {
                            toastr.success('Tastimonial status changed successfully', 'Success', {
                                onHidden: function() {
                                    location.reload();
                                }
                            });
                        }



                    })
                    .catch(error => {
                        console.error('Fetch error:', error);
                    });



            }
        });
    }


    //delete banner

    function deleteBanner(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You want to change the status",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#004a8c',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes'
        }).then((result) => {
            if (result.isConfirmed) {
                const csrfToken = getCsrfToken();
                const form_datas = {
                    id: id,
                };

                fetch("{{ url('/admin/bannerDelete') }}", {
                        method: 'POST',
                        body: JSON.stringify(form_datas),
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken,
                        },
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .then(data => {


                        toastr.success('Banner status changed successfully', 'Success', {
                            onHidden: function() {
                                location.reload();
                            }
                        });


                    })
                    .catch(error => {
                        console.error('Fetch error:', error);
                    });



            }
        });
    }

    //Delete Occasion Image
    function deleteImage(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You want to change the status",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#004a8c',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes'
        }).then((result) => {
            if (result.isConfirmed) {
                const csrfToken = getCsrfToken();
                const form_datas = {
                    id: id,
                };

                fetch("{{ url('/admin/imageDelete') }}", {
                        method: 'POST',
                        body: JSON.stringify(form_datas),
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken,
                        },
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .then(data => {


                        toastr.success('Occasion Image status changed successfully', 'Success', {
                            onHidden: function() {
                                location.reload();
                            }
                        });


                    })
                    .catch(error => {
                        console.error('Fetch error:', error);
                    });



            }
        });
    }

    //Delete Category

    function deletecategory(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You want to change the status",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#004a8c',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes'
        }).then((result) => {
            if (result.isConfirmed) {
                const csrfToken = getCsrfToken();
                const form_datas = {
                    id: id,
                };

                fetch("{{ url('/admin/categoryDelete') }}", {
                        method: 'POST',
                        body: JSON.stringify(form_datas),
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken,
                        },
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .then(data => {


                        toastr.success('Category status changed successfully', 'Success', {
                            onHidden: function() {
                                location.reload();
                            }
                        });


                    })
                    .catch(error => {
                        console.error('Fetch error:', error);
                    });



            }
        });
    }

    function deleteSubcategory(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You want to change the status",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#004a8c',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes'
        }).then((result) => {
            if (result.isConfirmed) {
                const csrfToken = getCsrfToken();
                const form_datas = {
                    id: id,
                };

                fetch("{{ url('/admin/subcategoryDelete') }}", {
                        method: 'POST',
                        body: JSON.stringify(form_datas),
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken,
                        },
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .then(data => {


                        toastr.success('Subcategory status changed successfully', 'Success', {
                            onHidden: function() {
                                location.reload();
                            }
                        });


                    })
                    .catch(error => {
                        console.error('Fetch error:', error);
                    });



            }
        });
    }


    $(document).ready(() => {

        $("#addMenuForm").submit((event) => {
            event.preventDefault();
            //alert("working");
            const csrfToken = getCsrfToken();
            const formAction = event.target.getAttribute('action');

            // Serialize the form data
            // const formData = new FormData(event.target);
            const formData = $(event.target).serializeArray();


            // Make the Fetch API call
            fetch(formAction, {
                    method: 'POST',
                    body: JSON.stringify(formData),
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                    },
                })
                .then((response) => response.json())
                .then((data) => {
                    // Handle the response from the server
                    console.log(data);

                    if (data.errors) {
                        var error = data.errors;
                        for (const fieldName in error) {
                            if (error.hasOwnProperty(fieldName)) {
                                const errorMessages = error[fieldName];
                                errorMessages.forEach(errorMessage => {
                                    toastr.error(errorMessage);
                                });
                            }
                        }
                    }


                    if (data.code == 200) {
                        toastr.success(data.msg, 'Success', {
                            onHidden: function() {
                                location.reload();
                            }
                        });
                    }
                })
                .catch((error) => {
                    console.error(error);

                });
        });

    });




    $(document).ready(() => {

        $("#editMenuForm").submit((event) => {
            event.preventDefault();
            //alert("working");
            const csrfToken = getCsrfToken();
            const formAction = event.target.getAttribute('action');

            // Serialize the form data
            // const formData = new FormData(event.target);
            const formData = $(event.target).serializeArray();


            // Make the Fetch API call
            fetch(formAction, {
                    method: 'POST',
                    body: JSON.stringify(formData),
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                    },
                })
                .then((response) => response.json())
                .then((data) => {
                    // Handle the response from the server
                    console.log(data);

                    if (data.errors) {
                        var error = data.errors;
                        for (const fieldName in error) {
                            if (error.hasOwnProperty(fieldName)) {
                                const errorMessages = error[fieldName];
                                errorMessages.forEach(errorMessage => {
                                    toastr.error(errorMessage);
                                });
                            }
                        }
                    }

                    if (data.code == 200) {
                        toastr.success(data.msg, 'Success', {
                            onHidden: function() {
                                location.reload();
                            }
                        });
                    }
                })
                .catch((error) => {
                    console.error(error);

                });
        });

    });








    // $(document).on("click","#editMenuBtn",()=>{
    //     var formData=$("#editMenuForm").serializeArray();
    //     const csrfToken = getCsrfToken();
    //     const url = $("#editMenuForm").attr('action');
    //     fetch(url, {
    //         method: 'POST', 
    //         body: JSON.stringify(formData), 
    //         headers: {
    //                 'Content-Type': 'application/json',
    //                 'X-CSRF-TOKEN': csrfToken,
    //             },
    //     })
    //     .then(response => response.json())
    //     .then(data => {

    //         console.log(data);

    //         if(data.code==200){
    //             toastr.success(data.msg, 'Success', {
    //                         onHidden: function() {
    //                             location.reload();
    //                         }
    //                     });
    //         }
    //     })
    //     .catch(error => {
    //         console.error('Error:', error);
    //     });

    // });

    function editMenu(id) {

        const csrfToken = getCsrfToken();

        const form_datas = {
            id: id,
        };


        fetch("{{ url('/admin/showMenu') }}", {
                method: 'POST',
                body: JSON.stringify(form_datas),
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                },
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {

                console.log(data);

                if (data) {
                    var generatedURL = "{{ url('/admin/edit-menu') }}/" + data.url;
                    console.log(generatedURL);
                    window.location.href = generatedURL;

                }

            })
            .catch(error => {
                console.error('Fetch error:', error);
            });


    }
</script>

</html>
