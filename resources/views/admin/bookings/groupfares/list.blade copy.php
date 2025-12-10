@extends('admin.layouts.dashboard-header-table')



<!-- Pre-loader end -->
<div id="pcoded" class="pcoded">
    <div class="pcoded-overlay-box"></div>
    <div class="pcoded-container navbar-wrapper">

        <nav class="navbar header-navbar pcoded-header">
            <div class="navbar-wrapper">

                <div class="navbar-logo">
                    <a class="mobile-menu" id="mobile-collapse" href="#!">
                        <i class="feather icon-menu"></i>
                    </a>
                    <a href="index.html">
                        <img class="img-fluid" src="../files/assets/images/logo.png" alt="Theme-Logo" />
                    </a>
                    <a class="mobile-options">
                        <i class="feather icon-more-horizontal"></i>
                    </a>
                </div>

                <div class="navbar-container container-fluid">
                    <ul class="nav-left">
                        <li class="header-search">
                            <div class="main-search morphsearch-search">
                                <div class="input-group">
                                    <span class="input-group-addon search-close"><i class="feather icon-x"></i></span>
                                    <input type="text" class="form-control">
                                    <span class="input-group-addon search-btn"><i
                                            class="feather icon-search"></i></span>
                                </div>
                            </div>
                        </li>
                        <li>
                            <a href="#!" onclick="javascript:toggleFullScreen()">
                                <i class="feather icon-maximize full-screen"></i>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav-right">
                        <li class="header-notification">
                            <div class="dropdown-primary dropdown">
                                <div class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="feather icon-bell"></i>
                                    <span class="badge bg-c-pink">5</span>
                                </div>
                                <ul class="show-notification notification-view dropdown-menu" data-dropdown-in="fadeIn"
                                    data-dropdown-out="fadeOut">
                                    <li>
                                        <h6>Notifications</h6>
                                        <label class="label label-danger">New</label>
                                    </li>
                                    <li>
                                        <div class="media">
                                            <img class="d-flex align-self-center img-radius"
                                                src="../files/assets/images/avatar-4.jpg"
                                                alt="Generic placeholder image">
                                            <div class="media-body">
                                                <h5 class="notification-user">John Doe</h5>
                                                <p class="notification-msg">Lorem ipsum dolor sit amet, consectetuer
                                                    elit.</p>
                                                <span class="notification-time">30 minutes ago</span>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="media">
                                            <img class="d-flex align-self-center img-radius"
                                                src="../files/assets/images/avatar-3.jpg"
                                                alt="Generic placeholder image">
                                            <div class="media-body">
                                                <h5 class="notification-user">Joseph William</h5>
                                                <p class="notification-msg">Lorem ipsum dolor sit amet, consectetuer
                                                    elit.</p>
                                                <span class="notification-time">30 minutes ago</span>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="media">
                                            <img class="d-flex align-self-center img-radius"
                                                src="../files/assets/images/avatar-4.jpg"
                                                alt="Generic placeholder image">
                                            <div class="media-body">
                                                <h5 class="notification-user">Sara Soudein</h5>
                                                <p class="notification-msg">Lorem ipsum dolor sit amet, consectetuer
                                                    elit.</p>
                                                <span class="notification-time">30 minutes ago</span>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="header-notification">
                            <div class="dropdown-primary dropdown">
                                <div class="displayChatbox dropdown-toggle" data-toggle="dropdown">
                                    <i class="feather icon-message-square"></i>
                                    <span class="badge bg-c-green">3</span>
                                </div>
                            </div>
                        </li>
                        <li class="user-profile header-notification">
                            <div class="dropdown-primary dropdown">
                                <div class="dropdown-toggle" data-toggle="dropdown">
                                    <img src="../files/assets/images/avatar-4.jpg" class="img-radius"
                                        alt="User-Profile-Image">
                                    <span>John Doe</span>
                                    <i class="feather icon-chevron-down"></i>
                                </div>
                                <ul class="show-notification profile-notification dropdown-menu"
                                    data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                                    <li>
                                        <a href="#!">
                                            <i class="feather icon-settings"></i> Settings
                                        </a>
                                    </li>
                                    <li>
                                        <a href="user-profile.html">
                                            <i class="feather icon-user"></i> Profile
                                        </a>
                                    </li>
                                    <li>
                                        <a href="email-inbox.html">
                                            <i class="feather icon-mail"></i> My Messages
                                        </a>
                                    </li>
                                    <li>
                                        <a href="auth-lock-screen.html">
                                            <i class="feather icon-lock"></i> Lock Screen
                                        </a>
                                    </li>
                                    <li>
                                        <a href="auth-normal-sign-in.html">
                                            <i class="feather icon-log-out"></i> Logout
                                        </a>
                                    </li>
                                </ul>

                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Sidebar chat start -->
        <div id="sidebar" class="users p-chat-user showChat">
            <div class="had-container">
                <div class="card card_main p-fixed users-main">
                    <div class="user-box">
                        <div class="chat-inner-header">
                            <div class="back_chatBox">
                                <div class="right-icon-control">
                                    <input type="text" class="form-control  search-text" placeholder="Search Friend"
                                        id="search-friends">
                                    <div class="form-icon">
                                        <i class="icofont icofont-search"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="main-friend-list">
                            <div class="media userlist-box" data-id="1" data-status="online"
                                data-username="Josephin Doe" data-toggle="tooltip" data-placement="left"
                                title="Josephin Doe">
                                <a class="media-left" href="#!">
                                    <img class="media-object img-radius img-radius"
                                        src="../files/assets/images/avatar-3.jpg" alt="Generic placeholder image ">
                                    <div class="live-status bg-success"></div>
                                </a>
                                <div class="media-body">
                                    <div class="f-13 chat-header">Josephin Doe</div>
                                </div>
                            </div>
                            <div class="media userlist-box" data-id="2" data-status="online" data-username="Lary Doe"
                                data-toggle="tooltip" data-placement="left" title="Lary Doe">
                                <a class="media-left" href="#!">
                                    <img class="media-object img-radius" src="../files/assets/images/avatar-2.jpg"
                                        alt="Generic placeholder image">
                                    <div class="live-status bg-success"></div>
                                </a>
                                <div class="media-body">
                                    <div class="f-13 chat-header">Lary Doe</div>
                                </div>
                            </div>
                            <div class="media userlist-box" data-id="3" data-status="online" data-username="Alice"
                                data-toggle="tooltip" data-placement="left" title="Alice">
                                <a class="media-left" href="#!">
                                    <img class="media-object img-radius" src="../files/assets/images/avatar-4.jpg"
                                        alt="Generic placeholder image">
                                    <div class="live-status bg-success"></div>
                                </a>
                                <div class="media-body">
                                    <div class="f-13 chat-header">Alice</div>
                                </div>
                            </div>
                            <div class="media userlist-box" data-id="4" data-status="online" data-username="Alia"
                                data-toggle="tooltip" data-placement="left" title="Alia">
                                <a class="media-left" href="#!">
                                    <img class="media-object img-radius" src="../files/assets/images/avatar-3.jpg"
                                        alt="Generic placeholder image">
                                    <div class="live-status bg-success"></div>
                                </a>
                                <div class="media-body">
                                    <div class="f-13 chat-header">Alia</div>
                                </div>
                            </div>
                            <div class="media userlist-box" data-id="5" data-status="online" data-username="Suzen"
                                data-toggle="tooltip" data-placement="left" title="Suzen">
                                <a class="media-left" href="#!">
                                    <img class="media-object img-radius" src="../files/assets/images/avatar-2.jpg"
                                        alt="Generic placeholder image">
                                    <div class="live-status bg-success"></div>
                                </a>
                                <div class="media-body">
                                    <div class="f-13 chat-header">Suzen</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Sidebar inner chat start-->
        <div class="showChat_inner">
            <div class="media chat-inner-header">
                <a class="back_chatBox">
                    <i class="feather icon-chevron-left"></i> Josephin Doe
                </a>
            </div>
            <div class="media chat-messages">
                <a class="media-left photo-table" href="#!">
                    <img class="media-object img-radius img-radius m-t-5" src="../files/assets/images/avatar-3.jpg"
                        alt="Generic placeholder image">
                </a>
                <div class="media-body chat-menu-content">
                    <div class="">
                        <p class="chat-cont">I'm just looking around. Will you tell me something about yourself?</p>
                        <p class="chat-time">8:20 a.m.</p>
                    </div>
                </div>
            </div>
            <div class="media chat-messages">
                <div class="media-body chat-menu-reply">
                    <div class="">
                        <p class="chat-cont">I'm just looking around. Will you tell me something about yourself?</p>
                        <p class="chat-time">8:20 a.m.</p>
                    </div>
                </div>
                <div class="media-right photo-table">
                    <a href="#!">
                        <img class="media-object img-radius img-radius m-t-5" src="../files/assets/images/avatar-4.jpg"
                            alt="Generic placeholder image">
                    </a>
                </div>
            </div>
            <div class="chat-reply-box p-b-20">
                <div class="right-icon-control">
                    <input type="text" class="form-control search-text" placeholder="Share Your Thoughts">
                    <div class="form-icon">
                        <i class="feather icon-navigation"></i>
                    </div>
                </div>
            </div>
        </div>
        <!-- Sidebar inner chat end-->
        <div class="pcoded-main-container">
            <div class="pcoded-wrapper">
                <nav class="pcoded-navbar">
                    <div class="pcoded-inner-navbar main-menu">

                        <ul class="pcoded-item pcoded-left-item">

                            <li class="pcoded-hasmenu">
                                <a href="javascript:void(0)">
                                    <span class="pcoded-micon"><i class="feather icon-sidebar"></i></span>
                                    <span class="pcoded-mtext">bookings</span>

                                </a>
                                <ul class="pcoded-submenu">

                                    <li class=" ">
                                        <a href="menu-bottom.html">
                                            <span class="pcoded-mtext">All</span>
                                        </a>
                                    </li>
                                    <li class=" ">
                                        <a href="box-layout.html" target="_blank">
                                            <span class="pcoded-mtext">Group Fare</span>
                                        </a>
                                    </li>
                                    <li class=" ">
                                        <a href="menu-rtl.html" target="_blank">
                                            <span class="pcoded-mtext">Flights</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <!-- <li class="">
                                    <a href="navbar-light.html">
                                        <span class="pcoded-micon"><i class="feather icon-menu"></i></span>
                                        <span class="pcoded-mtext">Navigation</span>
                                    </a>
                                </li> -->
                            <!-- <li class="pcoded-hasmenu">
                                    <a href="javascript:void(0)">
                                        <span class="pcoded-micon"><i class="feather icon-layers"></i></span>
                                        <span class="pcoded-mtext" >Widget</span>
                                        <span class="pcoded-badge label label-danger">100+</span>
                                    </a>
                                    <ul class="pcoded-submenu">
                                        <li class=" ">
                                            <a href="widget-statistic.html">
                                                <span class="pcoded-mtext" >Statistic</span>
                                            </a>
                                        </li>
                                        <li class=" ">
                                            <a href="widget-data.html">
                                                <span class="pcoded-mtext" >Data</span>
                                            </a>
                                        </li>
                                        <li class=" ">
                                            <a href="widget-chart.html">
                                                <span class="pcoded-mtext" >Chart Widget</span>
                                            </a>
                                        </li>

                                    </ul>
                                </li> -->
                        </ul>
                    </div>
                </nav>
                <div class="pcoded-content">
                    <div class="pcoded-inner-content">
                        <div class="main-body">
                            <div class="page-wrapper">
                                <!-- Page-header start -->
                                <div class="page-header">
                                    <div class="row align-items-end">
                                        <div class="col-lg-8">
                                            <div class="page-header-title">
                                                <div class="d-inline">
                                                    <h4>Booking</h4>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="page-header-breadcrumb">
                                                <ul class="breadcrumb-title">
                                                    <li class="breadcrumb-item">
                                                        <a href="index.html"> <i class="feather icon-home"></i> </a>
                                                    </li>


                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Page-header end -->

                                <!-- Page-body start -->
                                <div class="page-body">
                                    <!-- DOM/Jquery table start -->
                                    <div class="card">

                                        <div class="card-block">
                                            <div class="table-responsive dt-responsive">
                                                <div id="dom-jqry_wrapper" class="dataTables_wrapper dt-bootstrap4">
                                                    <div class="row">
                                                        <div class="col-xs-12 col-sm-12 col-sm-12 col-md-6">
                                                            <div class="dataTables_length" id="dom-jqry_length">
                                                                <label>Show <select name="dom-jqry_length"
                                                                        aria-controls="dom-jqry"
                                                                        class="form-control input-sm">
                                                                        <option value="10">10</option>
                                                                        <option value="25">25</option>
                                                                        <option value="50">50</option>
                                                                        <option value="100">100</option>
                                                                    </select> entries</label></div>
                                                        </div>
                                                        <div class="col-xs-12 col-sm-12 col-md-6">
                                                            <div id="dom-jqry_filter" class="dataTables_filter">
                                                                <label>Search:<input type="search"
                                                                        class="form-control input-sm" placeholder=""
                                                                        aria-controls="dom-jqry"></label></div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <table id="dom-jqry"
                                                                class="table table-striped table-bordered nowrap dataTable"
                                                                role="grid" aria-describedby="dom-jqry_info">
                                                                <thead>
                                                                    <tr role="row">
                                                                        <th class="sorting_asc" tabindex="0"
                                                                            aria-controls="dom-jqry" rowspan="1"
                                                                            colspan="1" aria-sort="ascending"
                                                                            aria-label="Name: activate to sort column descending"
                                                                            style="width: 271.781px;">ID</th>
                                                                        <th class="sorting" tabindex="0"
                                                                            aria-controls="dom-jqry" rowspan="1"
                                                                            colspan="1"
                                                                            aria-label="Position: activate to sort column ascending"
                                                                            style="width: 397.422px;">Origin</th>
                                                                        <th class="sorting" tabindex="0"
                                                                            aria-controls="dom-jqry" rowspan="1"
                                                                            colspan="1"
                                                                            aria-label="Office: activate to sort column ascending"
                                                                            style="width: 200.766px;">Arrival</th>
                                                                        <th class="sorting" tabindex="0"
                                                                            aria-controls="dom-jqry" rowspan="1"
                                                                            colspan="1"
                                                                            aria-label="Age: activate to sort column ascending"
                                                                            style="width: 107.312px;">Status</th>
                                                                            <th class="sorting" tabindex="0"
                                                                            aria-controls="dom-jqry" rowspan="1"
                                                                            colspan="1"
                                                                            aria-label="Age: activate to sort column ascending"
                                                                            style="width: 107.312px;">Action</th>
                                                                        
                                                                    </tr>
                                                                </thead>
                                                                <tbody>















 @foreach($routes as $route)

 
      <tr>
         <td>{{ $route['id'] }}</td>
        <td>{{ $route['origin'] }}</td>
        <td>{{ $route['destination'] }}</td>
        <td>{{ $route['status'] }}</td>
        <td><a href="{{ route('admin.gfares.list', $route['id']) }}" class="btn btn-primary">Edit</a></td>
      </tr>
    @endforeach
                                                                </tbody>
                                                                <tfoot>
                                                                    <tr>
                                                                        <th rowspan="1" colspan="1">ID</th>
                                                                        <th rowspan="1" colspan="1">Origion</th>
                                                                        <th rowspan="1" colspan="1">Arrival</th>
                                                                        <th rowspan="1" colspan="1">Status</th>
                                                                        <th rowspan="1" colspan="1">Action</th>
                                                                    </tr>
                                                                </tfoot>
                                                            </table>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-xs-12 col-sm-12 col-md-5">
                                                            <div class="dataTables_info" id="dom-jqry_info"
                                                                role="status" aria-live="polite">Showing 1 to 10 of 20
                                                                entries</div>
                                                        </div>
                                                        <div class="col-xs-12 col-sm-12 col-md-7">
                                                            <div class="dataTables_paginate paging_simple_numbers"
                                                                id="dom-jqry_paginate">
                                                                <ul class="pagination">
                                                                    <li class="paginate_button page-item previous disabled"
                                                                        id="dom-jqry_previous"><a href="#"
                                                                            aria-controls="dom-jqry" data-dt-idx="0"
                                                                            tabindex="0" class="page-link">Previous</a>
                                                                    </li>
                                                                    <li class="paginate_button page-item active"><a
                                                                            href="#" aria-controls="dom-jqry"
                                                                            data-dt-idx="1" tabindex="0"
                                                                            class="page-link">1</a></li>
                                                                    <li class="paginate_button page-item "><a href="#"
                                                                            aria-controls="dom-jqry" data-dt-idx="2"
                                                                            tabindex="0" class="page-link">2</a></li>
                                                                    <li class="paginate_button page-item next"
                                                                        id="dom-jqry_next"><a href="#"
                                                                            aria-controls="dom-jqry" data-dt-idx="3"
                                                                            tabindex="0" class="page-link">Next</a></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- DOM/Jquery table end -->

                                    <!-- Row Created Callback table end -->
                                </div>
                                <!-- Page-body start -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@extends('admin.layouts.dashboard-footer')