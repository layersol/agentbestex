@extends('admin.layouts.dashboard-header')










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
                                                    <h4>Forms Group Fares</h4>
                                                   
                                                </div>
                                            </div>
                                        </div>
                                      
                                    </div>
                                </div>
                                <!-- Page-header end -->

                                <!-- Page body start -->
                            <div class="page-body">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-block p-3">
                    <form id="flightForm" method="post" action="{{ route('admin.gfares.store') }}" novalidate>
                        @csrf
                        <div class="row">

                            <!-- Column 1 -->
                            <div class="col-md-3">
                               
<input type="text" class="form-control" name="route_id" id="route_id" value="<?=$route['id']?>" placeholder="Route ID" required>
                                <div class="form-group">
                                    <label for="departure_airport">Departure Airport</label>
                                    <input type="text" class="form-control" name="departure_airport" id="departure_airport" value="<?=$route['origin']?>" placeholder="Departure Airport" required>
                                </div>

                                <div class="form-group">
                                    <label for="arrival_airport">Arrival Airport</label>
                                    <input type="text" class="form-control" name="arrival_airport" id="arrival_airport" value="<?=$route['destination']?>" placeholder="Arrival Airport" required>
                                </div>

                                <div class="form-group">
                                    <label for="departure_date">Departure Date</label>
                                    <input type="date" class="form-control" name="departure_date" id="departure_date" required>
                                </div>
                                 <div class="form-group">
                                    <label for="return_date">Return Date</label>
                                    <input type="date" class="form-control" name="return_date" id="return_date" required>
                                </div>
                            </div>

                            <!-- Column 2 -->
                            <div class="col-md-3">
                               

                                <div class="form-group">
                                    <label for="departure_time">Departure Time</label>
                                    <input type="time" class="form-control" name="departure_time" id="departure_time" required>
                                </div>

                                <div class="form-group">
                                    <label for="arrival_time">Arrival Time</label>
                                    <input type="time" class="form-control" name="arrival_time" id="arrival_time" required>
                                </div>

                                <div class="form-group">
                                    <label for="airline_id">Airline ID</label>
                                    <input type="text" class="form-control" name="airline_id" id="airline_id" placeholder="Airline ID" required>
                                </div>
                                <div class="form-group">
                                    <label for="code">Flight Code</label>
                                    <input type="text" class="form-control" name="code" id="code" placeholder="Flight Code" required>
                                </div>
                            </div>

                            <!-- Column 3 -->
                            <div class="col-md-3">
                                

                                <div class="form-group">
                                    <label for="number">Flight Number</label>
                                    <input type="text" class="form-control" name="number" id="number" placeholder="Flight Number" required>
                                </div>

                                <div class="form-group">
                                    <label for="baggaes">Baggage (KG)</label>
                                    <input type="number" class="form-control" name="baggaes" id="baggaes" placeholder="Baggage" required>
                                </div>

                                <div class="form-group">
                                    <label for="seats">Seats</label>
                                    <input type="number" class="form-control" name="seats" id="seats" placeholder="Seats" required>
                                </div>
                                 <div class="form-group">
                                    <label for="currency">Currency</label>
                                    <input type="text" class="form-control" name="currency" id="currency" placeholder="Currency (e.g. USD)" required>
                                </div>
                            </div>

                            <!-- Column 4 -->
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="adult_price">Adult Price</label>
                                    <input type="number" class="form-control" name="adult_price" id="adult_price" placeholder="Adult Price" required>
                                </div>

                                <div class="form-group">
                                    <label for="child_price">Child Price</label>
                                    <input type="number" class="form-control" name="child_price" id="child_price" placeholder="Child Price" required>
                                </div>

                                <div class="form-group">
                                    <label for="infant_price">Infant Price</label>
                                    <input type="number" class="form-control" name="infant_price" id="infant_price" placeholder="Infant Price" required>
                                </div>

                               

                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select class="form-control" name="status" id="status" required>
                                        <option value="">Select Status</option>
                                        <option value="1">YES</option>
                                        <option value="0">NO</option>
                                    </select>
                                </div>
                            </div>

                        </div>

                        <!-- Submit button -->
                        <div class="row mt-3">
                            <div class="col-md-12 text-end">
                                <button type="submit" class="btn btn-primary">Save Flight</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

        </div>
    </div>
</div>

@extends('admin.layouts.dashboard-footer')