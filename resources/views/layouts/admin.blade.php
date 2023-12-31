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
                                    <input type="text" class="form-control todo-list-input" placeholder="Add To-do">
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
            @include('common.adminFooter')

            @yield('Admincontent') <!-- This is where the content from your views will be inserted -->


            {{-- main content for individual page end  --}}



        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->




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


    var Globaltable;

    function populateTable(data, tableId, columns) {

        Globaltable = $('#' + tableId).DataTable({
            "processing": "<i class='fa fa-spinner fa-spin fa-3x fa-fw'></i>Verarbeitung läuft...",
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

   

    </script>

</html>
