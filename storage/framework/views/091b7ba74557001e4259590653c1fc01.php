<!DOCTYPE HTML>
<html lang="en" dir="LTR">
<head>
    <title>Bestex Travels</title>
    <link rel="shortcut icon" href="http://agentbestex.com/uploads/global/favicon.png">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta charset="UTF-8">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, viewport-fit=cover" />
  
    <script type="javascript" src="<?php echo e(asset('assets/js/jquery.js')); ?>"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/bootstrap.min.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/app.css')); ?>">
    <link href="https://fonts.googleapis.com/css2?family=Inter,wght@0,100;0,300;0,400;0,500;0,600;0,700;0,900;1,500&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/themes/default.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/theme.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/agent.css')); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <script>
// JS code goes here
</script>
</head>

<body id="fadein" style="background-color:#f8f8f8">
<!-- THEME PRIMARY COLOR -->
<style>:root {--theme-bg: #0b66f9}</style>
    <header class="navbar fixed-top navbar-expand-lg p-lg-0">
        <div class="container">
            <!-- logo  -->
            <div class="d-flex">
                <a href="http://agentbestex.com/" class="fadeout navbar-brand m-0 py-2 px-2 rounded-2">
                    <img class="logo p-1 rounded" style="max-width:180px;max-height:74px;" src="<?php echo e(asset('assets/img/logo.webp')); ?>" alt="logo">
                </a>
            </div>

            <!-- toggle button  -->
            <button class="navbar-toggler rounded-4" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- nav items  -->
            <div class="collapse navbar-collapse justify-content-between" id="navbarSupportedContent">

                <!-- left  -->
                <div class="nav-item--left ms-lg-0">
                    <ul class="header_menu navbar-nav">

                                            <li>
                            <a class="fw-light nav-link fadeout " href="#" style="color:#3f3f3f!important">
                                Flights                            </a>
                        </li>
                    
                                                        <li>
                                    <a class="nav-link fadeout" href="#" style="color:#3f3f3f!important">
                                        group fares                                    </a>
                                </li>
                                                </ul>
                </div>

                <!-- right  -->
                <div class="nav-item--right" role="search">
                    <ul class="navbar-nav gap-1 me-auto mb-2 mb-lg-0">

                    <!-- SEARCHES -->
                     
                        <script>
                        $(document).ready(function() {
                            $(".clear_searches").click(function() {
                                $.ajax({
                                    url: "http://agentbestex.com/clear_searches",
                                    type: "POST",
                                    success: function() {
                                        // location.reload();
                                        $(".searches li").remove();
                                        $(".searches").remove();
                                    }
                                });
                            });
                        });
                        </script>


                                                <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle btn ps-3 p-0 py-2 px-0 text-center d-flex align-items-center justify-content-center gap-0 border rounded-4"
                                href="javascript:void(0)" role="button" data-bs-toggle="dropdown" aria-expanded="false">

                                                                <img class="me-2" style="width:18px"
                                    src="http://agentbestex.com/assets/img/flags/us.svg"
                                    alt="flag">
                                
                                <span class="h6 m-0 header_options text-dark fw-light">
                                                                        English                                                                    </span>
                                <svg class="mx-1" xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                    viewBox="0 0 24 24" fill="none" stroke="#000000" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M6 9l6 6 6-6" />
                                </svg>
                            </a>
                            <!-- <ul class="dropdown-menu bg-white rounded-4 p-2">
                                                                <li><a class="dropdown-item d-flex gap-3 fadeout rounded-4"
                                        href="http://agentbestex.com/language/us/English/LTR">
                                        <img style="width:18px"
                                             src="http://agentbestex.com/assets/img/flags/us.svg"
                                             alt="flag"> </i><span>English</span></a></li>
                                                                <li><a class="dropdown-item d-flex gap-3 fadeout rounded-4"
                                        href="http://agentbestex.com/language/sa/Arabic/RTL">
                                        <img style="width:18px"
                                             src="http://agentbestex.com/assets/img/flags/sa.svg"
                                             alt="flag"> </i><span>Arabic</span></a></li>
                                                                <li><a class="dropdown-item d-flex gap-3 fadeout rounded-4"
                                        href="http://agentbestex.com/language/tr/Turkish/LTR">
                                        <img style="width:18px"
                                             src="http://agentbestex.com/assets/img/flags/tr.svg"
                                             alt="flag"> </i><span>Turkish</span></a></li>
                                                                <li><a class="dropdown-item d-flex gap-3 fadeout rounded-4"
                                        href="http://agentbestex.com/language/ru/Russian/LTR">
                                        <img style="width:18px"
                                             src="http://agentbestex.com/assets/img/flags/ru.svg"
                                             alt="flag"> </i><span>Russian</span></a></li>
                                                                <li><a class="dropdown-item d-flex gap-3 fadeout rounded-4"
                                        href="http://agentbestex.com/language/fr/French/LTR">
                                        <img style="width:18px"
                                             src="http://agentbestex.com/assets/img/flags/fr.svg"
                                             alt="flag"> </i><span>French</span></a></li>
                                                                <li><a class="dropdown-item d-flex gap-3 fadeout rounded-4"
                                        href="http://agentbestex.com/language/cn/Chinese/LTR">
                                        <img style="width:18px"
                                             src="http://agentbestex.com/assets/img/flags/cn.svg"
                                             alt="flag"> </i><span>Chinese</span></a></li>
                                                                <li><a class="dropdown-item d-flex gap-3 fadeout rounded-4"
                                        href="http://agentbestex.com/language/de/Germany/LTR">
                                        <img style="width:18px"
                                             src="http://agentbestex.com/assets/img/flags/de.svg"
                                             alt="flag"> </i><span>Germany</span></a></li>
                                                            </ul> -->
                        </li>
                        
                                                <li class="nav-item dropdown multi_currency">
                            <a class="nav-link dropdown-toggle btn px-0 ps-3 text-center d-flex align-items-center justify-content-center gap-1 border text-dark rounded-4"
                                href="javascript:void(0)" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <span class="h6 m-0 header_options fw-light">
                                                                        INR                                                                    </span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24"
                                    fill="none" stroke="#000000" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <path d="M6 9l6 6 6-6" />
                                </svg>
                            </a>
                            <!-- <ul class="dropdown-menu bg-white rounded-4 p-2">
                                                            <li><a class="dropdown-item fadeout rounded-4 px-1" href="http://agentbestex.com/currency/EUR">
                                        <img class="mx-2" style="width:18px"
                                            src="http://agentbestex.com/assets/img/flags/de.svg"
                                            alt="flag">
                                        <span>EUR</span>
                                        <span class="mx-2">-</span> <small>Germany</small>
                                    </a></li>
                                                                <li><a class="dropdown-item fadeout rounded-4 px-1" href="http://agentbestex.com/currency/PHP">
                                        <img class="mx-2" style="width:18px"
                                            src="http://agentbestex.com/assets/img/flags/ph.svg"
                                            alt="flag">
                                        <span>PHP</span>
                                        <span class="mx-2">-</span> <small>Philippines</small>
                                    </a></li>
                                                                <li><a class="dropdown-item fadeout rounded-4 px-1" href="http://agentbestex.com/currency/SAR">
                                        <img class="mx-2" style="width:18px"
                                            src="http://agentbestex.com/assets/img/flags/sa.svg"
                                            alt="flag">
                                        <span>SAR</span>
                                        <span class="mx-2">-</span> <small>Saudi Arabia</small>
                                    </a></li>
                                                                <li><a class="dropdown-item fadeout rounded-4 px-1" href="http://agentbestex.com/currency/GBP">
                                        <img class="mx-2" style="width:18px"
                                            src="http://agentbestex.com/assets/img/flags/gb.svg"
                                            alt="flag">
                                        <span>GBP</span>
                                        <span class="mx-2">-</span> <small>United Kingdom</small>
                                    </a></li>
                                                                <li><a class="dropdown-item fadeout rounded-4 px-1" href="http://agentbestex.com/currency/USD">
                                        <img class="mx-2" style="width:18px"
                                            src="http://agentbestex.com/assets/img/flags/us.svg"
                                            alt="flag">
                                        <span>USD</span>
                                        <span class="mx-2">-</span> <small>United States</small>
                                    </a></li>
                                                            </ul> -->
                        </li>
                        
                        
                        
                            <li class="nav-item dropdown">
                            <a class="rounded-4 bg-light nav-link dropdown-toggle btn btn-outline-secondary px-0 ps-3 text-center d-flex align-items-center justify-content-center gap-1 border"
                                href="<?php echo e(route('login')); ?>" role="button" data-bs-toggle="dropdown" aria-expanded="false">

                               

                                <span class="m-0 text-dark fw-light">

                                Login                            </span>
                              
                            </a>

                            <ul class="dropdown-menu bg-white rounded-4 p-2">
                                <li><a class="dropdown-item fadeout rounded-4" href="http://agentbestex.com/dashboard"> Dashboard</i></a></li>
                                <li><a class="dropdown-item fadeout rounded-4" href="http://agentbestex.com/bookings"> Bookings</i></a></li>
                                                                <li><a class="dropdown-item fadeout rounded-4" href="http://agentbestex.com/deposit/"> Deposit</i></a></li>
                                <li><a class="dropdown-item fadeout rounded-4" href="http://agentbestex.com/markups/"> Markups</i></a></li>
                                <!-- <li><a class="dropdown-item fadeout rounded-4" href="http://agentbestex.com/reports/2025"> Reports</i></a></li> -->
                                                                <!-- <li><a class="dropdown-item fadeout" href="http://agentbestex.com/wallet"> Wallet</i></a></li> -->
                                <li><a class="dropdown-item fadeout rounded-4" href="http://agentbestex.com/profile"> Profile</i></a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item fadeout rounded-4" href="http://agentbestex.com/logout"> Logout</i></a></li>
                            </ul>

                        </li>

                                            </ul>
                </div>
            </div>
            <!-- nav items end  -->
        </div>
    </header>
      <div class="container py-4" style="margin-top:80px;">

<?php /**PATH C:\xampp\htdocs\agentbestex\resources\views/layouts/header.blade.php ENDPATH**/ ?>