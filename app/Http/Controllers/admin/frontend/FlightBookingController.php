<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Module;
use App\Models\ModuleApiSetting;
use App\Models\Countries;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\CommissionSetting;
use App\Models\FlightBooking;
use App\Models\Booking;
use App\Models\Passenger;
use App\Models\PaymentGateway;

use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\RequestException;

use Carbon\Carbon;

class FlightBookingController extends Controller
{
    public function book(Request $request){
       
        if ($request->isMethod('post')) {
          
            // forgetting existing sessions if not available
            if(!$request->has('inboundData') && !$request->has('outboundData')){
                Session::forget(['inboundData','outboundData']);

            }else if(!$request->has('selectedFlightData')){
                Session::forget(['selectedFlightData']);
            }

            $dataArray=['dictionaries','selectedFlightData','inboundData','outboundData'];
            // Check if any element from array exist
        if ($request->hasAny($dataArray) ) {
            $dictionaries = $request->has('dictionaries') ? json_decode($request->input('dictionaries')) : null;

            $traceId = $request->has('traceId') ? $request->input('traceId') : null;

            $selectedFlightData =$request->has('selectedFlightData') ? json_decode($request->input('selectedFlightData',true)) : null ;

            $inboundData =$request->has('inboundData') ? json_decode($request->input('inboundData',true)) : null ;

            $outboundData =$request->has('outboundData') ? json_decode($request->input('outboundData',true)) : null ;

           
            if ($inboundData !== null && $outboundData!==null) {
                Session::put('inboundData', $inboundData);
                Session::put('outboundData', $outboundData);
            }
            if ($dictionaries !== null) {
                Session::put('dictionaries', $dictionaries);
            }
            if ($selectedFlightData !== null) {
                Session::put('selectedFlightData', $selectedFlightData);
            }
            if ($traceId !== null) {
                Session::put('traceId', $traceId);
            }
           
        } else {
            
            return redirect()->back();
        }
        
        // Redirect to the booking page
        return redirect()->route('flight-book');
    } elseif(session()->has('selectedFlightData') || (session()->has('inboundData') && session()->has('outboundData'))) {
            // Retrieve the selected data from the session
            $selectedFlightData = Session::get('selectedFlightData',null);
            $dictionaries= Session::get('dictionaries',null);
            $apiMethodName = Session::get('apiMethodName');
            $traceId = Session::get('traceId',null);
            $inboundData = Session::get('inboundData',null);
            $outboundData = Session::get('outboundData',null);
            
            $countries=Countries::all();
            $paymentGateWays=PaymentGateway::where('status','active')->get();
            // echo "<pre>";print_r($selectedFlightData);exit;
            if($inboundData !=null && $outboundData !=null){
                 // Display the booking page with the selected data
              return view('frontend/flights/bdfare/proceed-special', compact('countries','traceId','paymentGateWays','inboundData','outboundData'));
            }
             // Display the booking page with the selected data
            return view('frontend/flights/'.$apiMethodName.'/proceed', compact('selectedFlightData','countries','dictionaries','traceId','paymentGateWays','inboundData','outboundData'));
        }else{
           
            return redirect()->back();
        }
    }

    public function bookingForm(Request $request){
      

        $this->validateForm($request);

        // dd($request->all());
        $searchSess=Session::get('searchParams');
        $selectedData=Session::get('selectedFlightData');
        $traceId=Session::get('traceId');
        $apiUsed=session('apiMethodName');
        $api=ModuleApiSetting::where('api_name',$apiUsed)->where('api_type','flights')->first();

        if($searchSess['trip_type']=='return'){
            $tripType='round';
            $destinations=$searchSess['departure_code'].'-'.$searchSess['arrival_code'].'-'.$searchSess['departure_code'];

            $departureDate=date('Y-m-d',strtotime($searchSess['departure_date']));

        }else  if($searchSess['trip_type']=='oneway'){
            $tripType='single';
            $destinations=$searchSess['departure_code'].'-'.$searchSess['arrival_code'];
            $departureDate=date('Y-m-d',strtotime($searchSess['departure_date']));
            
        }
        // for amadeus
        $client=new Client;
        $token=$this->getToken($client,$api); // generating token 
         // Check if the token retrieval was successful
         if (isset($tokenResponse['error'])) {

            return redirect()->back()->with('error','Error : ' . $token['error']);

        }

        $access_token = $token['access_token'];
       
        $confirmPrice=$this->confirmPriceAmadeus($selectedData,$access_token,$api->api_mode); // confirming the price
        // Construct the base URL
        $baseUrl = url('flight/list');
        
        // Append the query string
        $urlWithQuery = $baseUrl . '?' . http_build_query($searchSess);
        if (!$confirmPrice['success']) {
            // Dump and die with errors
    
            return redirect()->back()->with('error', '<b>Price Error </b> '.$confirmPrice['error']. ' Please search again. <br>' . '<a href="' . $urlWithQuery . '" class="rt-btn  pill rt-gradient text-uppercase">Search Again</a>');
        }

       // continue to booking on amadeus api 
            $bookingResult = $this->liveBooking($confirmPrice['data'], $access_token, $request->input(),$api->api_mode);
     

       if (!$bookingResult['success'] || $bookingResult['errors'] !== null) {
          // Dump and die with errors
          return redirect()->back()->with('error','<b>Order Create Error </b> '.$bookingResult['errors'][0]['title'].':'.$bookingResult['errors'][0]['detail'] .' '. '<a href="' . $urlWithQuery . '" class="rt-btn  pill rt-gradient text-uppercase">Search Again</a>');
      }

        $results=$bookingResult['decoded'];
        
        if(!isset($results['data']['associatedRecords'])){
            return redirect()->back()->with('error','<b>There is a problem while creating PNR with airline</b>');
        }
       
        // echo "<pre>";print_r($results);exit;

        $queuingOfficeId=$results['data']['queuingOfficeId'];
        $pnr=$results['data']['associatedRecords'][0]['reference'];

        // Check if the user is authenticated
        if (auth()->check()) {
            $userId = auth()->user()->id;
        } else {
            // Check if a user with the given email exists in the users table
            $userByEmail = User::where('email', $request->input('email'))->first();
        
            if ($userByEmail) {
                $userId = $userByEmail->id;
            } else {
                // Create a new user
                $newUser = User::create([
                    'name' => 'Guest',
                    'email' => $request->input('email'),
                    'password'=>Hash::make(12345678),
                    'status'=>'inactive',
                    'affiliate_code' => 'Guest'.'_'.Str::random(6),
                ]);
                $newUser->assignRole('B2C');
                $userId = $newUser->id;
            }
        }

        $ticket = new FlightBooking;
        $ticket->user_id = $userId;
        $ticket->pnr_no = $pnr;

        $ticket->details = json_encode($selectedData);
        $ticket->live_details = json_encode($results);
        $ticket->queuingOfficeId=$queuingOfficeId;
        $ticket->p_name=$request->input('name');

        $ticket->contact_no=$request->input('contact_no');
        $ticket->total_amount=$results['data']['flightOffers'][0]['price']['grandTotal'];
        $ticket->admin_price=$results['data']['flightOffers'][0]['price']['grandTotal'];
        $ticket->amount=$results['data']['flightOffers'][0]['price']['grandTotal'];
        $ticket->currency=$results['data']['flightOffers'][0]['price']['currency'];
        $ticket->email=$request->input('email');
        $ticket->departure_date=$departureDate;
        $ticket->return_date=($tripType =='round' && $searchSess['return_date']!='') ? $searchSess['return_date'] : null;
        $ticket->tripType=$tripType;
        $ticket->destinations= $destinations;
        $ticket->last_ticketing_date=$results['data']['flightOffers'][0]['lastTicketingDate'];
        $ticket->booking_status='pending';
        $ticket->payment_status='pending';

        $ticket->api_used = $apiUsed;
        $ticket->save();

        $lastInsertedId = $ticket->id;
        for ($i=0; $i < count($request->input('first_name')) ; $i++) { 
            $passenger=new Passenger;
            $passenger->ticket_id =$lastInsertedId;
            // $passenger->title=$request->title[$i];
            $passenger->name=$request->first_name[$i];
            $passenger->surname=$request->last_name[$i];
            $passenger->passType=$request->passType[$i];
            $passenger->gender=$request->gender[$i];
            $passenger->dob=date('Y-m-d',strtotime($request->dob[$i]));
            // adding dummy data if orignal not available
            $passenger->pidno=strtoupper(isset($request->pidno[$i]) &&  $request->pidno[$i] !== null &&  $request->pidno[$i] !== '' ?  $request->pidno[$i] : "abc123");

            $passenger->pied=isset($request->pied[$i]) && $request->pied[$i] !== null && $request->pied[$i] !== '' ? $request->pied[$i] : date('Y-m-d');

            $passenger->country=strtoupper(isset($request->country[$i]) && $request->country[$i] !== null &&   $request->country[$i] !== '' ?   $request->country[$i] : "US");

            $passenger->passport_country=strtoupper(isset($request->passport_country[$i]) && $request->passport_country[$i] !== null &&  $request->passport_country[$i] !== '' ?   $request->passport_country[$i] :null);

            $passenger->save();
        }

         // // Insert data into your generic booking table
        $genericBooking = new Booking([
            'booking_type' => 'flight',
            'booking_id' => $ticket->id,
            'user_id' => $ticket->user_id,
            'ref_code'=>$ticket->pnr_no,
            'booking_date' => now(),
            'departure_date' =>  Carbon::parse($ticket->departure_date)->format('Y-m-d'),
            'arrival_date' => Carbon::parse($ticket->return_date)->format('Y-m-d'),
            'number_of_guests'=>count($request->input('first_name')),
            'price'=>$ticket->total_amount,
            'currency'=>$ticket->currency,
            'status'=>$ticket->booking_status,
            'bookingable_type' => 'flight',
            'bookingable_id' => $ticket->id,
            
        ]);
        $genericBooking->save();
       
        Session::put('ticket_id',$lastInsertedId);
        
        Session::put('booking_type','flight');

        return redirect()->route('/payment-initialize',$ticket->id);

    }


    // function to get api credentials based on provided api from db 
    private function getApiCredentials($api)
    {
        
        $apiMode = $api->api_mode;

        // Define  API data based on modes
        $apiData = [
            'test' => [
                'api_url' => $api->api_test_endpoint,
                'api_key' => $api->api_test_key,
                'api_secret' => $api->api_test_secret_key,
                'api_mode' => 'test',
            ],
            'live' => [
                'api_url' => $api->api_endpoint,
                'api_key' => $api->api_key,
                'api_secret' => $api->api_secret,
                'api_mode' => 'live',
            ],
        ];

        // Return the data based on the provided mode, default to test if mode is not recognized
        return $apiData[$apiMode] ?? $apiData['test'];
    }

    // function to make booking on Bdfare api 
    private function confrimPriceBdfare($traceId, $offerId,$apiModel) {
        // Retrieve API credentials
        
        $endpoint = 'https://bdf.centralindia.cloudapp.azure.com/api/enterprise/OfferPrice';
        $credentials = $this->getApiCredentials($apiModel);
        
        // Construct the request body
        $body = [
            'traceId' => $traceId,
            'offerId' => [$offerId],   
        ];
    
        $url = $endpoint;
        $client = new Client;
        try {
            $response = $client->post($url, [
                'headers' => [
                    'X-Api-Key' => $credentials['api_key'],
                    'Content-Type' => 'application/json',
                ],
                'json' => $body,
            ]);
    
            $decodedResult = json_decode($response->getBody()->getContents(), true);

            if (isset($decodedResult['error'])) {
                $results = ['error' => $decodedResult['error']['errorCode'] . ' : ' . $decodedResult['error']['errorMessage'], 'success' => false];
            } else {
                $results = ['response' => $decodedResult, 'success' => true, 'error' => null];
            }
        } catch (RequestException $e) {
                $errors=json_decode($e->getResponse()->getBody()->getContents(),true);

                if (isset($errors['error'])) {
                $results = ['error' => $errors['error']['errorCode'] . ' : ' . $errors['error']['errorMessage'], 'success' => false];
            }
        }
        return $results;
    }
        
    // function to make booking on Bdfare api 
    private function orderSellBdfare($traceId, $offerId, $postData, $apiModel) {
        // Retrieve API credentials
        $credentials = $this->getApiCredentials($apiModel);
    
        $endpoint = 'https://bdf.centralindia.cloudapp.azure.com/api/enterprise/OrderSell';
        
        // Construct the request body
        $body = [
            'traceId' => $traceId,
            'offerId' => [$offerId],
            'request' => [
                'contactInfo' => [
                    'phone' => [
                        'phoneNumber' => $postData['contact_no'],
                        'countryDialingCode' => $postData['country_code']
                    ],
                    'emailAddress' => $postData['email']
                ],
                'paxList' => []
            ]
        ];
    
        // Populate passenger data in the request body
        for ($i = 0; $i < count($postData['passType']); $i++) {
            $passenger = [
                'ptc' => strtolower(ucfirst($postData['passType'][$i])),
                'individual' => [
                    // 'title' => $postData['title'][$i],
                    'givenName' => $postData['first_name'][$i],
                    'surname' => $postData['last_name'][$i],
                    'gender' => $postData['gender'][$i],
                    'birthdate' => date('Y-m-d', strtotime($postData['dob'][$i])),
                    'nationality' => $postData['country'][$i],
                    'identityDoc' => [
                        'identityDocType' => 'Passport', // Assuming always passport
                        'identityDocID' => $postData['pidno'][$i],
                        'expiryDate' => date('Y-m-d', strtotime($postData['pied'][$i]))
                    ],
                    // 'associatePax' => [
                    //     'givenName' => $postData['first_name'][$i],
                    //     'surname' => $postData['last_name'][$i],
                    // ],
                ]
            ];
            $body['request']['paxList'][] = $passenger;
        }

        $url = $endpoint;
        $client = new Client;
        try {
            $response = $client->post($url, [
                'headers' => [
                    'X-Api-Key' => $credentials['api_key'],
                    'Content-Type' => 'application/json',
                ],
                'json' => $body,
            ]);
    
            $decodedResult = json_decode($response->getBody()->getContents(), true);

            if (isset($decodedResult['error'])) {
                $results = ['error' => $decodedResult['error']['errorCode'] . ' : ' . $decodedResult['error']['errorMessage'], 'success' => false];
            } else {
                $results = ['response' => $decodedResult, 'success' => true, 'error' => null];
            }
        } catch (RequestException $e) {
             $errors=json_decode($e->getResponse()->getBody()->getContents(),true);

             if (isset($errors['error'])) {
                $results = ['error' => $errors['error']['errorCode'] . ' : ' . $errors['error']['errorMessage'], 'success' => false];
            }
        }
        return $results;
    }
    
    private function orderCreateBdfare($traceId, $offerId, $postData, $apiModel) {
        // Retrieve API credentials
        $credentials = $this->getApiCredentials($apiModel);
    
        $endpoint = 'https://bdf.centralindia.cloudapp.azure.com/api/enterprise/OrderCreate';
        
        // Construct the request body
        $body = [
            'traceId' => $traceId,
            'offerId' => [$offerId],
            'request' => [
                'contactInfo' => [
                    'phone' => [
                        'phoneNumber' => $postData['contact_no'],
                        'countryDialingCode' => $postData['country_code']
                    ],
                    'emailAddress' => $postData['email']
                ],
                'paxList' => []
            ]
        ];
    
        // Populate passenger data in the request body
        for ($i = 0; $i < count($postData['passType']); $i++) {
            $passenger = [
                'ptc' => strtolower(ucfirst($postData['passType'][$i])),
                'individual' => [
                    // 'title' => $postData['title'][$i],
                    'givenName' => $postData['first_name'][$i],
                    'surname' => $postData['last_name'][$i],
                    'gender' => $postData['gender'][$i],
                    'birthdate' => date('Y-m-d', strtotime($postData['dob'][$i])),
                    'nationality' => $postData['country'][$i],
                    'identityDoc' => [
                        'identityDocType' => 'Passport', // Assuming always passport
                        'identityDocID' => $postData['pidno'][$i],
                        'expiryDate' => date('Y-m-d', strtotime($postData['pied'][$i]))
                    ],
                    // 'associatePax' => [
                    //     'givenName' => $postData['first_name'][$i],
                    //     'surname' => $postData['last_name'][$i],
                    // ],
                ]
            ];
            $body['request']['paxList'][] = $passenger;
        }

        $url = $endpoint;
        $client = new Client;
        try {
            $response = $client->post($url, [
                'headers' => [
                    'X-Api-Key' => $credentials['api_key'],
                    'Content-Type' => 'application/json',
                ],
                'json' => $body,
            ]);
    
            $decodedResult = json_decode($response->getBody()->getContents(), true);

            if (isset($decodedResult['error'])) {
                $results = ['error' => $decodedResult['error']['errorCode'] . ' : ' . $decodedResult['error']['errorMessage'], 'success' => false];
            } else {
                $results = ['response' => $decodedResult, 'success' => true, 'error' => null];
            }
        } catch (RequestException $e) {
             $errors=json_decode($e->getResponse()->getBody()->getContents(),true);

             if (isset($errors['error'])) {
                $results = ['error' => $errors['error']['errorCode'] . ' : ' . $errors['error']['errorMessage'], 'success' => false];
            }
        }
        return $results;
    }

    // amadues live booking 
    private function liveBooking($flightsData, $token, $postData,$mode='test')
    {
      
        $endpoint = $mode=='test' ?  'https://test.api.amadeus.com/v1/booking/flight-orders' : 'https://api.amadeus.com/v1/booking/flight-orders';

        $uriParam = [
            "forceClass" => 'false',
        ];

        $remarks = [
            "general" => [
                [
                    "subType" => "GENERAL_MISCELLANEOUS",
                    "text" => "ONLINE BOOKING FROM MYTRAVEL"
                ]
            ]
        ];
        $ticketingAgreement = [
            "option" => "DELAY_TO_CANCEL",
            "delay" => "6D"
        ];

        $contacts = [
            "addresseeName" => [
                "firstName" => "MY",
                "lastName" => "TRAVEL"
            ],
            "companyName" => "MYTRAVEL",
            "purpose" => "INVOICE",
            "phones" => [
                [
                    "deviceType" => "LANDLINE",
                    "countryCallingCode" => "1",
                    "number" => "771626247"
                ],
                [
                    "deviceType" => "MOBILE",
                    "countryCallingCode" => "1",
                    "number" => "950379967"
                ]
            ],
            "emailAddress" => "info@mytravel.com",
            "address" => [
                "lines" => [
                    "test address"
                ],
                "postalCode" => "12345",
                "cityName" => "test city",
                "countryCode" => "US"
            ]
        ];
        $travelers_array = [];

        for ($i = 0; $i < count($postData['first_name']); $i++) {
            $travelers_array []= [
                "id" => $i + 1,
                "dateOfBirth" => $this->getDobBasedOnPassType($postData['dob'][$i],$postData['passType'][$i]),
                "name" => [
                    "firstName" => strtoupper($postData['first_name'][$i]),
                    "lastName" => strtoupper($postData['last_name'][$i])
                ],
                "gender" => strtoupper($postData['gender'][$i]),
                "contact" => [
                    "emailAddress" => strtoupper($postData['email']),
                    "phones" => [
                        [
                            "deviceType" => "MOBILE",
                            "countryCallingCode" => "92",
                            "number" => '1234567890'
                        ]
                    ]
                ],
                "documents" => [
                    [
                        "documentType" => "PASSPORT",
                        "number" => strtoupper(isset($postData['pidno'][$i]) && $postData['pidno'][$i] !== null && $postData['pidno'][$i] !== '' ? $postData['pidno'][$i] : "abc123"),
                        "expiryDate" => isset($postData['pied'][$i]) && $postData['pied'][$i] !== null && $postData['pied'][$i] !== '' ? Carbon::parse($postData['pied'][$i])->format('Y-m-d') : date('Y-m-d'),
                        "issuanceCountry" => strtoupper(isset($postData['passport_country'][$i]) && $postData['passport_country'][$i] !== null && $postData['passport_country'][$i] !== '' ? $postData['passport_country'][$i] : "US"),
                        "validityCountry" => strtoupper(isset($postData['passport_country'][$i]) && $postData['passport_country'][$i] !== null && $postData['passport_country'][$i] !== '' ? $postData['passport_country'][$i] : "US"),
                        "nationality" => strtoupper(isset($postData['country'][$i]) && $postData['country'][$i] !== null && $postData['country'][$i] !== '' ? $postData['country'][$i] : "US"),
                        "holder" => true
                    ]
                ]
                

            ];
        }
        $travel=[];
        foreach ($travelers_array as $key => $value) {
            $travel[]=$value;
        }

        $body = json_encode([
            "data" => [
                "type" => "flight-order",
                "flightOffers" => [$flightsData['data']['flightOffers'][0]],
                "travelers" => $travel,
                "remarks" => $remarks,
                "ticketingAgreement" => $ticketingAgreement,
                "contacts" => [$contacts],
            ],
        ]);

        $params = http_build_query($uriParam);
        $url = $endpoint . '?' . $params;

        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . $token,
        ];

        try {
            $response = Http::withHeaders($headers)->timeout(40)->post($url, json_decode($body, true));
            $decodedResponse=json_decode($response->body(),true);

            if(!empty($decodedResponse['errors'])){

                return ['response' => $response->body(), 'errors' => $decodedResponse['errors'],'success'=>false];
            }

            return ['response' => $response->body(), 'errors' => null,'success'=>true,'decoded'=>$decodedResponse];
        } catch (\Illuminate\Http\Client\RequestException $exception) {
            return ['response' => null, 'errors' => $exception->response->body(),'success'=>false];
        }
    }

    private function confirmPriceAmadeus($flightsData, $token, $mode = 'test')
    {
        try {
            $endpoint = $mode == 'test' ? 'https://test.api.amadeus.com/v1/shopping/flight-offers/pricing' : 'https://api.amadeus.com/v1/shopping/flight-offers/pricing';
            $uriParam = [
                "forceClass" => 'true',
            ];
    
            $body = json_encode([
                "data" => [
                    "type" => "flight-offers-pricing",
                    "flightOffers" => [$flightsData],
                ],
            ]);
    
            $params = http_build_query($uriParam);
            $url = $endpoint . '?' . $params;
    
            $headers = [
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer ' . $token,
            ];
    
            $response = Http::withHeaders($headers)->post($url, json_decode($body, true));
    
            if ($response->successful()) {
                return [
                    'success' => true,
                    'data' => json_decode($response->body(), true)
                ];
            } else {
                return [
                    'success' => false,
                    'message' => 'Failed to confirm price with Amadeus.'
                ];
            }
        } catch (\Exception $e) {
            return [
                'success' => false,
                'message' => $e->getMessage()
            ];
        }
    }
    
    // private function to get token from amadeus api for api call
    private function getToken($client, $api)
    {
        $credentials = $this->getApiCredentials($api);

        $url = $credentials['api_mode']=='test' ? 'https://test.api.amadeus.com/v1/security/oauth2/token' :     'https://api.amadeus.com/v1/security/oauth2/token';
    
        try {
            $response = $client->post($url, [
                'headers'      => ['Accept' => 'application/json'],
                'form_params'  => [
                    'grant_type'    => 'client_credentials',
                    'client_id'     => $credentials['api_key'],
                    'client_secret' => $credentials['api_secret'],
                ],
            ]);
    
            $responseBody = json_decode($response->getBody(), true);
    
            // Check if the token retrieval was successful
            if ($response->getStatusCode() >= 200 && $response->getStatusCode() < 300) {
                return $responseBody;
            } else {
                return ['error' => $responseBody['title'] ?? 'Token retrieval failed.'];
            }
        } catch (RequestException $exception) {
            if ($exception->hasResponse()) {
                $errorResponse = json_decode($exception->getResponse()->getBody(), true);
    
                // Return the error response
                // return ['error' => $errorResponse['title'] . ': ' . $errorResponse['detail']];
                return ['error' => $errorResponse];

            } else {
                return ['error' => $exception->getMessage()];
            }
        }
    }

    public function getDobBasedOnPassType($dob, $passType) {
        if (empty($dob) || is_null($dob) || $dob == '') {
            switch ($passType) {
                case 'ADULT':
                    // Set dynamic date for an adult (over 18 years old)
                    return Carbon::now()->subYears(20)->format('Y-m-d');
                case 'CHILD':
                    // Set dynamic date for a child (between 2 and 12 years old)
                    return Carbon::now()->subYears(6)->format('Y-m-d');
                case 'HELD_INFANT':
                    // Set dynamic date for an infant (less than 2 years old)
                    return Carbon::now()->subYears(1)->format('Y-m-d');
                default:
                    // Set a default dynamic date for other cases
                    return Carbon::now()->subYears(20)->format('Y-m-d');
            }
        }
    
        return Carbon::parse($dob)->format('Y-m-d');
    }

    public function validateForm($request){
        $request->validate([
            'first_name.*' => ['required', 'string', 'max:191'],
            'last_name.*' => ['sometimes','nullable', 'string', 'max:191'],
            'email' => ['required', 'email'],
            'name' => ['required', 'string'],
            'contact_no' => ['required', 'string', 'max:30'],
            'country_code' => ['nullalble', 'string', 'max:4'],
            'passType.*' => ['required', 'string'],
            'title.*' => ['nullalble', 'string'],
            'gender.*' => ['required', 'in:Male,Female'],
            // 'name.*' => ['required', 'string'],
            // 'surname.*' => ['required', 'string'],
            'pidno.*' => ['required', 'string'],
            'pied.*' => [
                'sometimes','required',
                'date',
                'after:' . now()->format('Y-m-d'), // Ensures the date is in the future
            ],
            'dob.*' => [
                'sometimes','required',
                'date',
                function ($attribute, $value, $fail) use ($request) {
                    $index = str_replace('dob.', '', $attribute);
                    $passType = $request->input("passType.$index");
        
                    $dob = new \DateTime($value);
                    $today = new \DateTime();
                    $age = $today->diff($dob)->y;
        
                    if ($passType === 'ADULT') {
                        if ($age < 12) {
                            $fail('The passenger must be 12 or older on the date of departure for ADULT type.');
                        }
                    } elseif ($passType === 'CHILD') {
                        if ($age <= 2 || $age >= 12) {
                            $fail('The passenger must be older than 2 and younger than 12 on the date of departure for CHILD type.');
                        }
                    } elseif ($passType === 'INFANT') {
                        if ($age > 2) {
                            $fail('The passenger must be 2 or younger on the date of departure for INFANT type.');
                        }
                    }
                },
            ],
            'country.*' => ['required', 'string','exists:countries,shortname'],
            'passport_country.*' => ['required', 'string','exists:countries,shortname'],
            'payment_gateway' => ['nullable', 'numeric', 'exists:payment_gateway,id']

        ]);
        
        // Additional check for a single adult passenger
        if (count($request->passType) == 1 && $request->passType[0] === 'ADULT') {
            $request->validate([
                'dob.0' => ['required', 'date', 'before_or_equal:' . now()->subYears(18)->format('Y-m-d')],
            ]);
        }
    }
}
