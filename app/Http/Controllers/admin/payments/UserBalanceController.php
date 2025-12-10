<?php

namespace App\Http\Controllers\payments;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserBalance;
use App\Models\User;
use App\Models\Transection;
use App\Models\PaymentGateway;
use Illuminate\Support\Facades\Session;
use DB;
class UserBalanceController extends Controller
{
    public function index() {
        $user = auth()->user();
        if(!$user->hasPermissionTo('manage all transactions')){
            return redirect()->back()->with('error','Not Authrized');
        }
        $query =  UserBalance::query();
        $balances=$query->with('user')->get();
        return view('backend/payments/user_balance/index',compact('balances'));
    }

    public function create(Request $request){

        $user = auth()->user();
        if(!$user->hasPermissionTo('manage all transactions')){
            return redirect()->back()->with('error','Not Authrized');
        }

        $users=User::all();
       
        return view('backend/payments/user_balance/create',compact('users'));
           
    }

    public function store(Request $request){
        $request->validate([
            'user' => 'required|exists:users,id',
        ]);
       
        return redirect()->route('userBalance.add',$request->input('user'))->with('success','Please Select Amount And Payment Mode Now.');
  
    }

    public function show($userId){

        $user = auth()->user();
    
        // Check authorization
        if (!$user->hasPermissionTo('manage all transactions') && $user->id != $userId) {
            return redirect()->back()->with('error', 'Not Authorized');
        }

        $balance=UserBalance::where('user_id',$userId)->with('user','updatedBy')->first();
        return view('backend/payments/user_balance/show',compact('balance'));

    }

    public function addBalance(Request $request, $userId)
    {
        $user = auth()->user();
    
        // Check authorization
        if (!$user->hasPermissionTo('manage all transactions') && $user->id != $userId) {
            return redirect()->back()->with('error', 'Not Authorized');
        }
    
        // Retrieve or create user balance
        $balance = UserBalance::firstOrCreate(['user_id' => $userId], [
            'updated_by' => $user->id,
        ]);

        $balance=UserBalance::where('user_id',$userId)->with('user','updatedBy')->first();
    
        // Load view for GET request
        if ($request->isMethod('get')) {
            return view('backend/payments/user_balance/add', compact('balance'));
        }
        
        // Handle POST request
        $request->validate([
            'amount' => 'required|numeric',
            'payment_mode' => 'required|in:card-payment,direct-deposit',
        ]);
    
        // Handle direct deposit
        if ($request->input('payment_mode') == 'direct-deposit') {
            if (!$user->hasPermissionTo('manage all transactions')) {
                return redirect()->back()->with('error', 'Not Authorized Payment Mode');
            }
            
            $lastBalance = $balance->balance_amount;
            $balance->balance_amount += $request->input('amount');
            $balance->last_balance = $lastBalance;
            $balance->updated_by = $user->id;
            $balance->save();
    
            // Create transaction record
            Transection::create([
                'created_by' => $user->id,
                'user_id' => $userId,
                'transection_category' => 'deposit',
                'transection_type' => 'direct-deposit',
                'amount' => $request->input('amount'),
                'currency' =>'USD',
                'transection_date_timestamp' => now(),
                'comments' => 'Amount deposited with direct deposit',
                'status' => 'completed',
                'last_amount'=>$lastBalance,
                'walletid' => $balance->id,
                'releted_id' => $balance->id,
                'releted_type' => 'App\Models\UserBalance',
            ]);
    
            return redirect()->route('user-balance.index')->with('success', 'Balance updated. Amount Added: '.$request->input('amount'));
        }
    
        // Handle card payment
        elseif ($request->input('payment_mode') == 'card-payment') {

            $balanceUser=User::find($userId);
            $stripe=PaymentGateway::where('identity','stripe')->first();
            $data=[
                'total_amount'=>$request->input('amount'),
                'private_key'=>$stripe->secret_key,
                'public_key'=>$stripe->public_key,
                'name'=>$balanceUser->name,
                'email'=>$balanceUser->email,
                'id'=>$balanceUser->id,
            ];
            $paymentIntent=$this->initializeStripe($data);
            Session::put('paymentData',$data);
            return view('backend/payments/user_balance/card-deposit',compact('paymentIntent','data','balance'));
        }
    
        // Default redirect
        else {
            return redirect()->route('user-balance.index');
        }
    }

    public function removeBalance(Request $request, $userId)
    {
        $user = auth()->user();
    
        // Check authorization
        if (!$user->hasPermissionTo('manage all transactions')) {
            return redirect()->back()->with('error', 'Not Authorized');
        }
        
        $balance=UserBalance::where('user_id',$userId)->with('user','updatedBy')->first();
        if(!$balance){
            return redirect()->back()->with('error', 'No balance amount found.');

        }
        // Load view for GET request
        if ($request->isMethod('get')) {
            return view('backend/payments/user_balance/remove', compact('balance'));
        }
        
        // Handle POST request
        $request->validate([
            'amount' => 'required|numeric',
            'payment_mode' => 'required|in:card-payment,direct-debit',
        ]);
    
        // Handle direct deposit
        if ($request->input('payment_mode') == 'direct-debit') {
            if (!$user->hasPermissionTo('manage all transactions')) {
                return redirect()->back()->with('error', 'Not Authorized Payment Mode');
            }

            if($request->input('amount') > $balance->balance_amount){
                return redirect()->back()->with('error', 'Debit Amount Must Not Be Greater Then User Balance');

            }
            
            $lastBalance = $balance->balance_amount;
            $balance->balance_amount -= $request->input('amount');
            $balance->last_balance = $lastBalance;
            $balance->updated_by = $user->id;
            $balance->save();
    
            // Create transaction record
            Transection::create([
                'created_by' => $user->id,
                'user_id' => $userId,
                'transection_category' => 'withdraw',
                'transection_type' => 'direct-withdraw',
                'amount' => $request->input('amount'),
                'currency' =>'USD',
                'transection_date_timestamp' => now(),
                'comments' => 'Amount withdraw with direct debit',
                'status' => 'completed',
                'last_amount'=>$lastBalance,
                'walletid' => $balance->id,
                'releted_id' => $balance->id,
                'releted_type' => 'App\Models\UserBalance',
            ]);
    
            return redirect()->route('user-balance.index')->with('success', 'Balance updated. Debited : '.$request->input('amount'));
        }
    
        // Handle card payment
        elseif ($request->input('payment_mode') == 'card-payment') {
            dd($request->all());
        }
    
        // Default redirect
        else {
            return redirect()->route('user-balance.index');
        }
    }

    public function initializeStripe(array $result){
     

        $amount=$result['total_amount']*100;
		
		$stripe= new \Stripe\StripeClient([
		   'api_key'=>$result['private_key'], // secret key in stripe  case 
		   ]);
		   $paymentIntent= $stripe->paymentIntents->create(
			[
			  'description' => 'Payment for wallet balance add',
			  'shipping' => [
				'name' => $result['name'],
				'address' => [
				  'line1' => 'jhonson street',
				  'postal_code' => '98140',
				  'city' => 'Paris',
				  'state' => 'state',
				  'country' => 'US',
				  
				],
			  ],
			  'amount' => $amount,
			  'currency' =>'USD',
			  'payment_method_types' => ['card'],
			  'receipt_email'=>$result['email'],
			  
			]
		  );
          return $paymentIntent;
     
    } 

    public function cardProceed($userId){

        $authUser=auth()->user();

        $paymentData=Session::get('paymentData');
        if($paymentData['id']!=$userId){
            return redirect()->back();
        }
        $stripe= new \Stripe\StripeClient([
            'api_key'=>$paymentData['private_key'],
            ]);
        $paymentIntent=$stripe->paymentIntents->retrieve($_GET['payment_intent']);
        $balance=UserBalance::where('user_id',$userId)->first();

        if($paymentIntent->status=='succeeded' && $balance){

            $lastBalance = $balance->balance_amount;
            $balance->balance_amount += $paymentData['total_amount'];
            $balance->last_balance = $lastBalance;
            $balance->updated_by = $authUser->id;
            $balance->save();
    
            // Create transaction record
            Transection::create([
                'created_by' => $authUser->id,
                'user_id' => $userId,
                'transection_category' => 'deposit',
                'transection_type' => 'card-deposit',
                'amount' => $paymentData['total_amount'],
                'currency' =>'USD',
                'transection_date_timestamp' => now(),
                'comments' => 'Amount deposited with card-deposit',
                'status' => 'completed',
                'trx_id'=>$paymentIntent->id,
                'paid_amount_currency'=>'USD',
                'last_amount'=>$lastBalance,
                'walletid' => $balance->id,
                'releted_id' => $balance->id,
                'releted_type' => 'App\Models\UserBalance',
            ]);
            Session::forget('paymentData');
            // admin case
            if($authUser->hasPermissionTo('manage payments')){

                return redirect()->route('user-balance.index')->with('success', 'Balance updated. Amount Added: '.$paymentData['total_amount']);
            }

            return redirect()->route('user-balance.show',$userId)->with('success', 'Balance updated. Amount Added: '.$paymentData['total_amount']);
           
        }

    }
     
}
