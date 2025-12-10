<html lang="en" dir="LTR">

<head>
    <title>Flights Invoice</title>
    <link rel="shortcut icon" href="https://agentbestex.com/uploads/global/favicon.png">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta charset="UTF-8">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="viewport"
        content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, viewport-fit=cover">
    <script src="https://agentbestex.com/assets/js/jquery.js"></script>
    <link rel="stylesheet" type="text/css" href="https://agentbestex.com/assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://agentbestex.com/assets/css/app.css">
    <link
        href="https://fonts.googleapis.com/css2?family=Inter,wght@0,100;0,300;0,400;0,500;0,600;0,700;0,900;1,500&amp;display=swap"
        rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://agentbestex.com/assets/css/themes/default.css">
    <link rel="stylesheet" type="text/css" href="https://agentbestex.com/assets/css/theme.css">
    <link rel="stylesheet" type="text/css" href="https://agentbestex.com/assets/css/agent.css">
    <script>
        // JS code goes here
    </script>
    <style>
        .vt-container {
            position: fixed;
            width: 100%;
            height: 100vh;
            top: 0;
            left: 0;
            z-index: 9999;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            pointer-events: none;
        }

        .vt-row {
            display: flex;
            justify-content: space-between;
        }

        .vt-col {
            flex: 1;
            margin: 10px 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .vt-col.top-left,
        .vt-col.bottom-left {
            align-items: flex-start;
        }

        .vt-col.top-right,
        .vt-col.bottom-right {
            align-items: flex-end;
        }

        .vt-card {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 12px 20px;
            background-color: #fff;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            color: #000;
            border-radius: 4px;
            margin: 0px;
            transition: 0.3s all ease-in-out;
            pointer-events: all;
            border-left: 3px solid #8b8b8b;
            cursor: pointer;
        }

        .vt-card.success {
            border-left: 3px solid #6ec05f;
        }

        .vt-card.warn {
            border-left: 3px solid #fed953;
        }

        .vt-card.info {
            border-left: 3px solid #1271ec;
        }

        .vt-card.error {
            border-left: 3px solid #d60a2e;
        }

        .vt-card .text-group {
            margin-left: 15px;
        }

        .vt-card h4 {
            margin: 0;
            margin-bottom: 0px;
            font-size: 16px;
            font-weight: 900;
        }

        .vt-card p {
            margin: 0;
            font-size: 14px;
        }

        @media(max-width: 768px) {
            .vt-col {
                flex: unset;
            }
        }
    </style>
    <style type="text/css">
        .pulse-animation {
            animation: pulse 1s infinite;
        }

        @keyframes pulse {
            0% {
                opacity: 1;
            }

            50% {
                opacity: 0.5;
            }

            100% {
                opacity: 1;
            }
        }
    </style>
</head>

<body id="fadein">


    <?php 

// print_r(json_decode($booking->guest));

?>
    <!-- THEME PRIMARY COLOR -->
    <style>
        :root {
            --theme-bg: #0091ff
        }
    </style>
    

    <script>
        // HEADER NAVBAR
        let resize = true;
        $(window).scroll(function () {
            var nav = $('#navbarMain');
            var top = 50;
            if ($(window).scrollTop() >= top && resize) {
                $("header").addClass('swap_navbar');
            } else if (resize) {
                $("header").removeClass('swap_navbar');
            }
        });

        $(window).on("load", (function () {
            if ($(window).innerWidth() + 10 < 769) {
                $("header").addClass('swap_navbar');
                resize = false;
            }
            else {
                $("header").removeClass('swap_navbar');
                resize = true;
            }
        }));

        $(window).on("load", (function () {
            var scroll = $(window).scrollTop();
            if (scroll > 20) {
                $("header").addClass('swap_navbar');
            }
        }))

        // Check if website is being executed from localhost
        setTimeout(function () {
            // Get user's country
            var requestUrl = "https://agentbestex.com/visitor_details";
            fetch(requestUrl)
                .then(function (response) { return response.json(); })
                .then(function (c) {
                    if (typeof c.country_code === "undefined") {
                        // If country_code is undefined, log and return or handle appropriately
                        console.log("Localhost traffic not counted");
                    } else {
                        console.log(c.country_code);
                        var country = c.country_code.toUpperCase();
                        // Submit to db
                        var req = 'https://agentbestex.com/api/traffic?country_code=' + country;
                        fetch(req);
                    }
                });
        }, 5000);

    </script>

    <div class="bodyload" style="margin-top:80px;display:none">
        <div class="rotatingDiv"></div>
    </div>

    <main>














        <!-- ICONS PHP -->




        <div class="bg-light">
            <div class="container pt-5 pb-5" style="max-width: 800px;">


                <!-- Optimized Bootstrap Timer with SVG Icons -->
                  <?php 
     
if($booking->payment_status=='unpaid'){

      
    ?>
                <div class="card border-primary shadow-sm mb-3">
                    <div class="card-body p-2">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#0d6efd"
                                    class="bi bi-alarm me-2" viewBox="0 0 16 16">
                                    <path
                                        d="M8.5 5.5a.5.5 0 0 0-1 0v3.362l-1.429 2.38a.5.5 0 1 0 .858.515l1.5-2.5A.5.5 0 0 0 8.5 9z">
                                    </path>
                                    <path
                                        d="M6.5 0a.5.5 0 0 0 0 1H7v1.07a7.001 7.001 0 0 0-3.273 12.474l-.602.602a.5.5 0 0 0 .707.708l.746-.746A6.97 6.97 0 0 0 8 16a6.97 6.97 0 0 0 3.422-.892l.746.746a.5.5 0 0 0 .707-.708l-.601-.602A7.001 7.001 0 0 0 9 2.07V1h.5a.5.5 0 0 0 0-1h-3zm1.038 3.018a6.093 6.093 0 0 1 .924 0 6 6 0 1 1-.924 0zM0 3.5c0 .753.333 1.429.86 1.887A8.035 8.035 0 0 1 4.387 1.86 2.5 2.5 0 0 0 0 3.5M13.5 1c-.753 0-1.429.333-1.887.86a8.035 8.035 0 0 1 3.527 3.527A2.5 2.5 0 0 0 13.5 1">
                                    </path>
                                </svg>
                                <span class="text-primary fw-bold">Payment Time</span>
                            </div>
                            <div id="timer" class="fw-bold fs-5 text-primary">29<span class="text-muted">:</span>23
                            </div>
                        </div>
                        <div class="progress mt-1" style="height: 4px;">
                            <div class="progress-bar bg-primary" id="timer-progress" role="progressbar"
                                style="width: 98.1626%;"></div>
                        </div>
                    </div>
                </div>

                      <!-- Placeholder for expired message -->
                <div id="expired"></div>

                <script>
                    $(function () {
                        // Get the remaining seconds calculated by PHP (server time)
                        let remainingSeconds = 1796;
                        let initialSeconds = remainingSeconds; // Store initial value for progress bar
                        let timer;

                        function updateTimer() {
                            const mins = Math.floor(remainingSeconds / 60);
                            const secs = remainingSeconds % 60;

                            // Update timer text
                            $("#timer").html(`${mins}<span class="text-muted">:</span>${secs < 10 ? "0" : ""}${secs}`);

                            // Update progress bar and apply animation
                            const percentRemaining = (remainingSeconds / initialSeconds) * 100;
                            $("#timer-progress").css("width", percentRemaining + "%");

                            // Apply pulsating effect when time is running low
                            if (remainingSeconds <= 60) {
                                if (!$("#timer").hasClass("pulse-animation")) {
                                    $("#timer").addClass("text-danger pulse-animation");
                                    $("#timer-progress").removeClass("bg-primary").addClass("bg-danger");

                                    // Add alarm icon when time is critical
                                    $("#timer").prepend(`
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-exclamation-triangle-fill me-1" viewBox="0 0 16 16">
                      <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                    </svg>
                `);
                                }
                            }

                            // Handle expiration
                            if (--remainingSeconds < 0) {
                                clearInterval(timer);
                                $(".options").empty();  // Clear previous content
                                $("#form_gateway").remove();  // Clear previous content
                                $(".card").remove(); // Remove timer card

                                $("#expired").html(`
            <div class="alert alert-danger p-2 shadow-sm">
                <div class="d-flex align-items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-x-octagon-fill me-2" viewBox="0 0 16 16">
                      <path d="M11.46.146A.5.5 0 0 0 11.107 0H4.893a.5.5 0 0 0-.353.146L.146 4.54A.5.5 0 0 0 0 4.893v6.214a.5.5 0 0 0 .146.353l4.394 4.394a.5.5 0 0 0 .353.146h6.214a.5.5 0 0 0 .353-.146l4.394-4.394a.5.5 0 0 0 .146-.353V4.893a.5.5 0 0 0-.146-.353L11.46.146zm-6.106 4.5L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 1 1 .708-.708z"/>
                    </svg>
                    <div>
                        <p class="m-0 fw-bold">Booking Expired</p>
                        <p class="m-0 small">Your reservation has expired. Please make a new reservation.</p>
                    </div>
                </div>
            </div>
            `);
                            }
                        }

                        // Add CSS for pulse animation
                        $("<style>")
                            .prop("type", "text/css")
                            .html(`
        .pulse-animation {
            animation: pulse 1s infinite;
        }
        @keyframes pulse {
            0% { opacity: 1; }
            50% { opacity: 0.5; }
            100% { opacity: 1; }
        }
        `)
                            .appendTo("head");

                        // Initial call and set interval
                        updateTimer();
                        timer = setInterval(updateTimer, 1000);
                    });
                </script>

                <a href="https://agentbestex.com/" class="btn btn-primary mb-3 w-100 no_print waves-effect">Back to
                    Home</a>
 <?php 
}

      
    ?>
          
                <div class="card p-3 mx-auto rounded-4 shadow-sm" id="invoice">
                    <div class="border p-3 mb-3 rounded-4">

                        <div class="row py-3">
                            <div class="col-sm-4 d-flex align-items-center justify-content-center ">
                                <img src="" style="max-width: 180px" class="logo px-1 rounded">
                            </div>
                            <div class="col-sm-8 text-right invoice_contact d-flex justify-content-end gap-3">

<?php

$userinfo=json_decode($booking->user_data);


?>




                                <div class="px-2">
                                    <p class="mb-0 text-start"><strong></strong></p>
                                    <p class="mb-0 text-start"><strong></strong> </p>
                                    <hr class="my-2">
                                    <p class="mb-0 text-start"><strong>Phone :</strong> <?=$userinfo->phone ?></p>
                                    <p class="mb-0 text-start"><strong>Email :</strong> <?=$userinfo->email ?></p>
                                </div>
                            </div>
                        </div>

                    </div>
 <?php 






     
if($booking->payment_status=='unpaid'){

      
    ?>




               

                          <form method="POST" action="{{ route('payment.balance') }}">
   @csrf
                    <div    class="border p-3 rounded-4 mb-3 no_print">
                        <div class="row g-2">
                            <div class="col-md-2 pt-1 d-flex align-items-center justify-content-center"><strong>Pay
                                    With</strong></div>
                            <div class="col-md-4">
                                <div class="dropdown bootstrap-select payment_gateway w-100 rounded-0"><select
                                        id="gateway" onchange="changeFormAction()"
                                        class="selectpicker payment_gateway w-100 rounded-0" name="payment_gateway"
                                        data-live-search="true" required="">

                                        <option class="wallet_balance" value="wallet_balance"
                                            data-content="&lt;img class='' src='https://agentbestex.com/assets/img/gateways/wallet_balance.png' style='max-height: 30px; margin-right: 14px; border-radius: 8px; color: #fff;'&gt;&lt;span class='text-dark'&gt; Wallet Balance &lt;/span&gt;"
                                            selected="selected"> </option>
                                    </select>

                                    <div class="dropdown-menu ">
                                        <div class="bs-searchbox"><input type="search" class="form-control"
                                                autocomplete="off" role="combobox" aria-label="Search"
                                                aria-controls="bs-select-1" aria-autocomplete="list"></div>
                                        <div class="inner show" role="listbox" id="bs-select-1" tabindex="-1">
                                            <ul class="dropdown-menu inner show" role="presentation">

                                            </ul>
                                        </div>
                                    </div>
                                </div>
                              
                                <div id="response"></div>
                            </div>
                            <div class="col-md-3">
                                <input type="hidden" name="ticketprice" value="<?=$booking->price_original?>">
                                <input id="form" type="submit" class="btn btn-success w-100" value="Proceed"
                                    style="height: 58px;">
                            </div>
                            <div class="col-md-3 text-center d-flex align-items-center justify-content-center mt-3">
                                <strong class="">
                                    <h5><small style="font-weight:300;font-size:16px">INR</small>
                                        <strong>
                                            <?=$booking->price_original?>


                                        </strong>
                                    </h5>
                                </strong>
                            </div>
                        </div>
                        <input type="hidden" name="booking_ref_no"
                            value="<?=$booking->booking_ref_no ?>">
                        <input type="hidden" name="payload"
                            value="<?= json_encode($booking)?>">
                    </form>





 <?php 
}

      
    ?>










                    
                  
                    <style>
                        .pay_later {
                            display: none
                        }

                        @media screen and (max-width: 767px) {
                            .invoice_contact p {
                                font-size: 10px;
                            }
                        }
                    </style>
                    <table class="table table-bordered">
                        <thead class="bg-light">
                            <tr>
                                <th class="text-center">Booking ID</th>
                                <th class="text-center">Booking Reference</th>
                                <?php if ($booking->pnr > 0) {?>
                                <th class="text-center">PNR</th>
                                <?php }?>
                                <th class="text-center">Booking Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th class="text-center"><?=$booking->booking_id?></th>
                                <th class="text-center"><?=$booking->booking_ref_no?></th>

                                <?php if ($booking->pnr > 0) {?>
                                <th class="text-center"><?=$booking->pnr?></th>
                                <?php }?>

                                <th class="text-center"><?=$booking->booking_date?></th>
                            </tr>
                        </tbody>
                    </table>

                    <p class="border mb-0 p-2 px-3"><strong class="text-uppercase"><small>Travellers</small></strong>
                    </p>
                    <table class="table table-bordered">
                        <thead class="bg-light">
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">SR</th>
                                <th class="text-center">Name</th>
                                <th class="text-center">Passport No.</th>
                                <th class="text-center">Passport Issue - Expiry</th>
                                <th class="text-center">Date of Birth</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php 
          $booking_data = json_decode($booking->booking_data);
// print_r($booking_data);
$guest = json_decode($booking->guest);



foreach ($guest as $key => $row) {
      
    ?>







                            <tr>
                                <th class="text-center"><?=$key + 1?></th>
                                <th class="text-center"><?=$row->title?></th>
                                <th class="text-center"><?=$row->first_name . ' ' . $row->last_name ?>
                                    <small class="d-block fw-light"><?=$row->email?></small>
                                    <small class="d-block fw-light"><?=$row->phone?></small>
                                </th>
                                <th class="text-center"><?=$row->passport?></th>
                                <th class="text-center"><?=$row->passport_issue?> -- <?=$row->passport_expiry?></th>
                                <th class="text-center"><?=$row->dob?></th>
                            </tr>
                           

                            <?php }  ?>

                        </tbody>
                    </table>

                    <p class="border mb-0 p-2 px-3"><strong class="text-uppercase"><small>Flights</small></strong></p>


                    <div class="mb-4">

                        <div class="border">
                            <div class="row g-1 p-2">
                                <div class="col-md-1 d-flex align-items-center col-3">
                                    <img style="height:16px;"
                                        src="https://assets.duffel.com/img/airlines/for-light-background/full-color-logo/{{ $booking_data->airline_code }}.svg"
                                         alt="">
                                </div>
                                <div class="col-md-7 col-9">
                                    <div class="p-2 lh-sm mt-2">
                                        <small class="mb-0"><strong class="border p-2 rounded mt-5 mx-3">Number
                                                {{ $booking_data->number }}</strong></small>
                                        <small class="mb-0">{{ $booking_data->airline_code }}</small>
                                    </div>
                                </div>
                                <div class="col-md-3 col-9">
                                    <div class="p-2 lh-sm">
                                        <small class="mb-0"><strong>Cabin Baggage: {{ $booking_data->baggaes }}
                                                KG</strong></small>
                                        <small class="d-block mt-2">Baggage: 1 PC</small>
                                    </div>
                                </div>
                                <div class="col-md-1 d-flex align-items-center col-3">
                                    <svg fill="#393e4b" height="35px" width="35px" version="1.1" id="Layer_1"
                                        xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        viewBox="0 0 512 512" xml:space="preserve">
                                        <g>
                                            <g>
                                                <path
                                                    d="M389.742,77.553H329.99V30.417h15.146V0H166.865v30.417h15.146v47.135h-59.752c-19.059,0-34.566,15.506-34.566,34.566 V438.41c0,19.059,15.506,34.566,34.566,34.566h26.268V512h30.417v-39.024h154.114V512h30.417v-39.024h26.268 c19.059,0,34.566-15.506,34.566-34.566V112.119C424.308,93.058,408.802,77.553,389.742,77.553z M179.349,408.086h-30.417V229.638 h30.417V408.086z M212.426,30.417h87.146v47.135h-87.146V30.417z M240.589,408.086h-30.417V229.638h30.417V408.086z M301.829,408.086h-30.417V229.638h30.417V408.086z M316.834,190.41H195.166v-46.294h121.669V190.41z M363.068,408.086h-30.417 V229.638h30.417V408.086z">
                                                </path>
                                            </g>
                                        </g>
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <div class="p-3 bg-light rounded-3 border"
                            style="border-top-left-radius: 0px !important; border-top-right-radius: 0px !important;">
                            <div class="position-relative">
                                <!-- <div class="position-absolute border bg-light invoice--time-line" style="width: 1px; height: 53px; top: 37px; left: 23px; border-color: #000 !important;"></div> -->
                                <div class="position-absolute border bg-light invoice--time-line"></div>
                                <div class="d-flex align-items-center">
                                    <span class="position-relative mb-2 me-4 align-self-start">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15"
                                            viewBox="0 0 24 24" fill="none" stroke="#000" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round">
                                            <circle cx="12" cy="12" r="10"></circle>
                                        </svg>
                                    </span>
                                    <div class="d-flex flex-wrap">
                                        <div class="flight--ddt fw-bold d-flex align-items-center gap-2 flex-wrap">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                                viewBox="0 0 24 24" fill="none" stroke="#000000" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round">
                                                <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                                <line x1="16" y1="2" x2="16" y2="6"></line>
                                                <line x1="8" y1="2" x2="8" y2="6"></line>
                                                <line x1="3" y1="10" x2="21" y2="10"></line>
                                            </svg>
                                            <span>{{ $booking_data->departure_date }}</span>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                                viewBox="0 0 24 24" fill="none" stroke="#000000" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round">
                                                <circle cx="12" cy="12" r="10"></circle>
                                                <polyline points="12 6 12 12 16 14"></polyline>
                                            </svg>
                                            <span class="me-3 d-flex align-items-center gap-2">

                                                <?php echo date('h:i A', strtotime($booking_data->departure_time)) ?>

                                            </span>
                                        </div>
                                        <small class="d-sm-inline">Depart From <b>


                                                <?php echo strtoupper($booking_data->departure_airport) ?>
                                            </b> (<?=$booking_data->departure_airport_name ?>)</small>
                                    </div>
                                </div>
                                <div class="mt-1 h6" style="margin-left: 42px; font-size: 14px;">
                                    <span>Trip Duration</span>
                                    <span>

                                        <?php
$departure = new DateTime($booking_data->departure_time);
$arrival = new DateTime($booking_data->arrival_time);

$interval = $departure->diff($arrival);
$duration = $interval->format('%h hr %i min');
?>
                                        <?= $duration ?>


                                    </span>
                                </div>
                                <div class="d-flex align-items-center mt-2">
                                    <span class="me-4">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15"
                                            viewBox="0 0 24 24" fill="none" stroke="#000" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round">
                                            <circle cx="12" cy="12" r="10"></circle>
                                        </svg>
                                    </span>
                                    <div class="d-flex flex-wrap">
                                        <div class="flight--ddt fw-bold d-flex align-items-center gap-2 flex-wrap">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                                viewBox="0 0 24 24" fill="none" stroke="#000000" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round">
                                                <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                                <line x1="16" y1="2" x2="16" y2="6"></line>
                                                <line x1="8" y1="2" x2="8" y2="6"></line>
                                                <line x1="3" y1="10" x2="21" y2="10"></line>
                                            </svg>
                                            <span>{{ $booking_data->return_date }}</span>
                                            <div>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                                    viewBox="0 0 24 24" fill="none" stroke="#000000" stroke-width="2"
                                                    stroke-linecap="round" stroke-linejoin="round">
                                                    <circle cx="12" cy="12" r="10"></circle>
                                                    <polyline points="12 6 12 12 16 14"></polyline>
                                                </svg>
                                            </div>
                                            <span class="me-3 d-flex align-items-center gap-2">

                                                <?php echo date('h:i A', strtotime($booking_data->arrival_time)) ?>
                                            </span>
                                        </div>
                                        <small class="d-sm-inline">Arrive At <b>


                                                <?php echo strtoupper($booking_data->arrival_airport) ?>

                                            </b>


                                            ( <?=$booking_data->arrival_airport_name ?> )</small>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>



                    <p><strong>Fare Details</strong></p>
                    <table class="table table-bordered">
                        <thead class="">
                            <!-- <tr>
                <th class="text-start">Ticket Fare</th>
                <th class="text-end">INR 51892</th>
            </tr> -->
                            <!-- <tr>
                <th class="text-start">GST</th>
                <th class="text-end">% 0</th>
            </tr> -->
                            <!-- <tr>
                <th class="text-start">VAT</th>
                <th class="text-end">% 0</th>
            </tr> -->
                            <tr>
                                <th class="text-start">TAX</th>
                                <th class="text-end">% 0</th>
                            </tr>

                            <tr class="bg-light">
                                <th class="text-start"><strong>Total</strong></th>
                                <th class="text-end"><strong>INR <?=$booking->price_original?></strong></th>
                            </tr>

                        </thead>
                    </table>



                    <div class="row g-2 options">
                        <div class="col"><button
                                class="btn border no_print w-100 d-flex item-align-center gap-3 justify-content-center p-3 waves-effect"
                                onclick="download_pdf()">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                                    fill="none" stroke="#000" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <path d="M3 15v4c0 1.1.9 2 2 2h14a2 2 0 0 0 2-2v-4M17 9l-5 5-5-5M12 12.8V2.5">
                                    </path>
                                </svg>
                                Download as PDF</button></div>


                        <div class="col">
                            <form onsubmit="show_alert(event);" action="#" method="GET">
                                <button type="submit"
                                    class="btn border no_print w-100 d-flex item-align-center gap-3 justify-content-center p-3 waves-effect">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                                        fill="none" stroke="#000" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <line x1="18" y1="6" x2="6" y2="18"></line>
                                        <line x1="6" y1="6" x2="18" y2="18"></line>
                                    </svg>
                                    Request for Cancellation </button>
                            </form>
                        </div>
                    </div>



                    <script>
                        // CANCELLATION REQUEST
                        function show_alert() {
                            if (!confirm("Are you sure about canellation?")) {
                                event.preventDefault();
                                return false;
                            }

                            event.preventDefault();

                            // SHOW LOADING ANIMATION
                            document.getElementById("loading").style.display = "flex";
                            var form = new FormData();
                            form.append("booking_ref_no", "20251029020703");
                            var settings = {
                                "url": "https://agentbestex.com/api/flights/cancellation",
                                "method": "POST",
                                "timeout": 0,
                                "processData": false,
                                "mimeType": "multipart/form-data",
                                "contentType": false,
                                "data": form
                            };

                            $.ajax(settings).done(function (response) {
                                console.log(response);
                                location.reload();
                            });
                        }
                        var url = "https://wa.me/+9544717221?text=Booking%20Invoice%20" + encodeURIComponent(window.location.href);
                        document.getElementById('a').setAttribute('href', url);

                    </script>

                    <!-- LOADING ANIMATION FOR CANCELLATION -->
                    <div id="loading"
                        style="display: none;padding: 150px; align-items: center; position: fixed; width: 100%; top: 0; left: 0; background: #fff; z-index: 9999; height: 100%;">
                        <div class="rotatingDiv"></div>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.2.61/jspdf.min.js"></script>
        <script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>

        <!-- js pdf  -->
        <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script> -->
        <script>
            var w = 776;
            var h = 1259;

            var timeEvent = 1000;
            var windowWidth = 0;

            const loadingElement = document.querySelector("div#loading");

            function download_pdf() {
                (windowWidth > 0) && (window.innerWidth = windowWidth + "px");

                windowWidth = window.innerWidth;

                if (windowWidth < 768) {
                    window.innerWidth = 992 + "px";

                    timeEvent = 2000;
                }


                $(".no_print").attr("style", "display: none !important");

                setTimeout(function () {
                    $(".no_print").attr("style", "")
                    loadingElement.classList.remove("_show");
                }, 5000);

                setTimeout(() => {
                    html2canvas($("#invoice")[0], {
                        useCORS: true
                    }).then((canvas) => {
                        var img = canvas.toDataURL("image/jpeg");

                        // loading animation
                        loadingElement.classList.add("_show");

                        var invoicePdf = new jsPDF({
                            unit: "px",
                        });
                        invoicePdf.addImage(img, 'jpeg', 23.28, 25.18, 400, 550, 'FAST');
                        invoicePdf.save("invoice.pdf");

                        location.reload();
                    });

                }, timeEvent);
            }
        </script>

        <!-- ANIMATION LIBRARY -->
        <script
            src="https://cdn.jsdelivr.net/npm/tsparticles-confetti@2.9.3/tsparticles.confetti.bundle.min.js"></script>

        <!-- ANIMATION FOR SUCCESSFULL PAYMENT -->

        <!-- ANIMATION FOR SUCCESSFULL NEW BOOKING CELEBRATION -->
        <script>
            const count = 200, defaults = { origin: { y: .7 } }; function fire(e, t) { confetti(Object.assign({}, defaults, t, { particleCount: Math.floor(count * e) })) } fire(.25, { spread: 26, startVelocity: 55 }), fire(.2, { spread: 60 }), fire(.35, { spread: 100, decay: .91, scalar: .8 }), fire(.1, { spread: 120, startVelocity: 25, decay: .92, scalar: 1.2 }), fire(.1, { spread: 120, startVelocity: 45 });
        </script>

        <style>
            .form-check {
                cursor: pointer
            }

            .header-top-bar,
            .main-menu-content,
            .info-area,
            .footer-area,
            .cta-area {
                display: none
            }

            .menu-wrapper {
                display: flex;
                justify-content: center;
                padding: 12px;
            }

            .nav-link:focus,
            .nav-link:hover {
                color: var(--theme-bg) !important;
            }

            .newsletter-section {
                display: none;
            }

            /* cancellation read more  */
            .to--be>p {
                max-height: calc(3.5em + 2px);
                overflow: hidden;
            }

            .to--be>.read--more {
                display: none;
            }

            .to--be>.read--more>label {
                cursor: pointer;
            }

            .to--be:has(:checked)>p {
                max-height: unset !important;
            }

            .to--be:has(:checked)>.read--more>#to--be_1 {
                display: none !important;
            }

            .to--be:has(:checked)>.read--more>#to--be_2 {
                display: block !important;
            }

            header #navbarSupportedContent {
                display: none !important
            }

            header {
                display: none !important
            }

            body {
                padding-top: 0px;
            }

            .mobile_apps {
                display: none
            }

            header .container {
                justify-content: center !important;
            }

            ._show {
                display: block !important;
                background: #ffffff36 !important;
            }
        </style>
        <style>
            .invoice--time-line {
                width: 1px;
                height: 53px;
                top: calc(16px + 14px);
                left: 7px;
                border-color: #000 !important;
            }


            @media only screen and (min-width: 320px) {
                .invoice--time-line {
                    width: 1px;
                    height: calc(100% - 71px);
                    top: calc(16px + 5px);
                    left: 7px;
                    border-color: #000 !important;
                }
            }

            @media only screen and (min-width: 345px) {
                .invoice--time-line {
                    height: calc(100% - 55px);
                }
            }

            @media only screen and (min-width: 475px) {
                .invoice--time-line {
                    height: calc(100% - 40px);
                }
            }

            @media only screen and (max-width: 767px) {
                table {
                    font-size: 9px;
                }

                .table>:not(caption)>*>* {
                    padding: 0;
                }
            }
        </style>
    </main>
    <div id="confetti"><canvas data-generated="true"
            style="width: 100% !important; height: 100% !important; position: fixed !important; z-index: 100 !important; top: 0px !important; left: 0px !important; pointer-events: none;"
            aria-hidden="true" width="1351" height="335"></canvas></div>


    <section data-aos="fade-up" class="footer-area bg-white">

        <div class="container">
            <hr class="pt-5 m-0">
        </div>

        <div class="container">
            <div class="">
                <div class="row g-0">

                    <div class="col-lg-12 responsive-column">
                        <ul class="foot_menu w-100">
                            <!-- header manue -->
                            <li class="footm row w-100">
                                <!-- <a href="company" class=" waves-effect"><strong>Company</strong>  </a> -->
                                <ul class="dropdown-menu-item row">
                                    <li class="col-md-3"><a href="https://agentbestex.com/page/about-us"
                                            class="fadeout  waves-effect">about us</a> </li>
                                    <li class="col-md-3"><a href="https://agentbestex.com/page/contact-us"
                                            class="fadeout  waves-effect">contact us</a> </li>
                                    <li class="col-md-3"><a href="https://agentbestex.com/page/terms-of-use"
                                            class="fadeout  waves-effect">terms of use</a> </li>
                                    <li class="col-md-3"><a href="https://agentbestex.com/page/cookies-policy"
                                            class="fadeout  waves-effect">cookies policy</a> </li>
                                    <li class="col-md-3"><a href="https://agentbestex.com/page/privacy-policy"
                                            class="fadeout  waves-effect">privacy policy</a> </li>
                                    <li class="col-md-3"><a href="https://agentbestex.com/page/become-a-supplier"
                                            class="fadeout  waves-effect">become a supplier</a> </li>
                                    <li class="col-md-3"><a href="https://agentbestex.com/page/faq"
                                            class="fadeout  waves-effect">faq</a> </li>
                                    <li class="col-md-3"><a href="https://agentbestex.com/page/booking-tips"
                                            class="fadeout  waves-effect">booking tips</a> </li>
                                    <li class="col-md-3"><a href="https://agentbestex.com/page/file-a-claim"
                                            class="fadeout  waves-effect">file a claim</a> </li>
                                    <li class="col-md-3"><a href="https://agentbestex.com/page/careers-and-jobs"
                                            class="fadeout  waves-effect">careers and jobs</a> </li>
                                    <li class="col-md-3"><a href="https://agentbestex.com/page/how-to-book"
                                            class="fadeout  waves-effect">how to book</a> </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- end row -->
                <div class="row my-3">
                    <div class="section-block mt-4"></div>
                </div>
             
                <!-- end row -->
            </div>
            <!-- end container -->
          

        </div>
    </section>

   
   

    <script src="https://agentbestex.com/assets/js/app.js"></script>
   
    <script src="https://agentbestex.com/assets/js/bootstrap-select.js"></script>
  
</body>

</html>