<?php

namespace App\Http\Controllers\User;



use App\Models\Coupon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\UserCouponVariation;
use App\Models\CouponVarations;
use App\Models\Store_Game;
use App\Models\game_code;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Razorpay\Api\Api;

class UserCoupon extends Controller
{

    public $api;

    public function __construct($foo = null){
        $this->api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));
    }

    public function allcoupon()
    {
        $allcoupons = Coupon::all();
        return view('mainwebsite.pages.couponList', ['allcoupons' => $allcoupons]);
    }

    public function allCouponDetail($couponId)
    {
        $allcoupons = Coupon::where('id', $couponId)->first();
        // dd($allcoupons);
        if (empty($allcoupons)) {
            return view('mainwebsite.pages.couponList', compact('allcoupons'))->with('error', 'You have viewed all the coupon code for this coupon.');
        } else {

            $userId = Auth::id();
            $variations = CouponVarations::where('coupon_id', $couponId)->get();
            // Filter out the variations that the user has already seen
            $unseenVariations = $variations->filter(function ($variation) use ($userId) {
                $exists = UserCouponVariation::where('user_id', $userId)
                    ->where('coupon_variation_id', $variation->id)
                    ->exists();
                return !$exists;
            });

            if ($unseenVariations->isEmpty()) {
                $allcoupons = Coupon::all();
                return redirect()->route('allcoupon')->with('error', 'You have viewed all the coupon code for this coupon.');
            } else {
                // Get the first unseen variation
                $singleVariationDetail = $unseenVariations->first();

                // Record that the user has seen this coupon variation
                $insertVartion = UserCouponVariation::create([
                    'user_id' => $userId,
                    'coupon_variation_id' => $singleVariationDetail->id,
                ]);
                return view('mainwebsite.pages.singleCoupon', compact('singleVariationDetail', 'allcoupons'));
            }
        }
    }

    public function game1to100($id)
    {
        $auth = Auth::user();
        if($auth){
            $order_id = rand('100000','999999');

            $couponAmount = Coupon::where('id',$id)->first();

            if($couponAmount){
                $orderdata=([
                        'receipt' => 'recp_123',
                        'amount' => $couponAmount->price * 100, 
                        'currency' => 'INR',
                        'notes' => [
                            'order_id' => $order_id
                        ],
                    ]);

                $razorpayOrder = $this->api->order->create($orderdata);
                
                if(!empty($razorpayOrder)){
                    $data = [
                        "key"               => env('RAZORPAY_KEY'), // Enter the Key ID generated from the Dashboard
                        "amount"            => $razorpayOrder->amount, // Amount is in currency subunits. Default currency is INR. Hence, 50000 refers to 50000 paise
                        "currency"          => $razorpayOrder->currency,
                        "name"              => $auth->name,
                        "notes"             => [
                            "address"           => "Razorpay Corporate Office",
                            "merchant_order_id" => "12312321",
                        ],
                        "order_id"          => $razorpayOrder->id, // This is a sample Order ID. Pass the `id` obtained in the response of Step 1
                    ];

                    return view('mainwebsite.pages.game1to10', ['data' => $data, 'razorData' => $razorpayOrder, 'auth' =>$auth, 'id' => $id]);

                }else{
                    return redirect()->back()->with("error","Something went wrong. Payment not initiated.");
                }
            }else{
                return redirect()->back()->with("error","Coupon Not found.");
            }

        }else{
            return redirect()->route('login');
        }
    }

    public function gameatoz($id)
    {
        return view('mainwebsite.pages.gameatoz', compact('id'));
    }

    public function game1to100Save(Request $request)
    {
        // dd($request);
        $auth = Auth::user();
        if ($auth) {
            $validator = Validator::make($request->all(), [
                'coupon'      => 'required',
                'numberGameOption'  => 'required',
                // 'pay_order_id' => 'required',
            ], [
                'coupon.required' => 'Coupon ID not found.',
                'numberGameOption.required' => 'At least One number need to be selected.',
                // 'pay_order_id' => '',
            ]);

            if ($validator->fails()) {
                return response()->json(['status' => 0, 'errors' => $validator->messages(), 'msg' => '']);
            } else {

                $today = Carbon::now();
                $nextDate = $today->addDays(1)->format('d-m-Y');
                $findDate = game_code::where('publish_date',$nextDate)->first();
                if($findDate){
                    $numberCode = $findDate->game_code_number;
                    
                    $checkOption = Store_Game::where('user_id',$auth->id)
                                            ->where('coupon_id',$request->coupon)
                                            ->where('game_number',$request->numberGameOption)
                                            ->where('game_code',$numberCode)
                                            ->first();

                    if(empty($checkOption)){
                        $store = Store_Game::create([
                            'coupon_id' => $request->coupon,
                            'user_id' => $auth->id,
                            'game_number' => $request->numberGameOption,
                            'game_code' => $numberCode,
                            'date' => $today,
                            'pay_order_id' => $request->pay_order_id
                        ]);
                    }else{
                        $newCount = $checkOption->count++;
                        $store = Store_Game::where('id',$checkOption->id)->update([
                            'count' => $newCount,
                            'pay_order_id' => $request->pay_order_id
                        ]);
                        // return response()->json(['status' => 0, 'errors' => '', 'msg' => 'You have already submitted this option.']);
                    }
                    
                    if($store) {
                        return response()->json(['status' => 1, 'errors' => '', 'msg' => 'Your option saved successfully.']);
                    } else {
                        return response()->json(['status' => 0, 'errors' => '', 'msg' => 'Something went wrong, create the option.']);
                    }
                }else{
                    return response()->json(['status' => 3, 'errors' => '', 'msg' => "Something went wrong. Today's game not declared."]);
                }

                
            }
        } else {
            return response()->json(['status' => 2, 'errors' => '', 'msg' => 'Session Logged out. Please login again first.']);
        }
    }

    public function gameAtoZSave(Request $request){
        $auth = Auth::user();
        if ($auth) {
            $validator = Validator::make($request->all(), [
                'coupon'      => 'required',
                'alphabetGameOption'  => 'required',
            ], [
                'coupon.required' => 'Coupon ID not found.',
                'alphabetGameOption.required' => 'At least One number need to be selected.',
            ]);

            if ($validator->fails()) {
                return response()->json(['status' => 0, 'errors' => $validator->messages(), 'msg' => '']);
            } else {

                $today = Carbon::now();
                $todayDate = Carbon::today()->format('d-m-Y');
                $nextDate = $today->addDays(1)->format('d-m-Y');
                $findDate = game_code::where('publish_date',$nextDate)->first();
                if($findDate){
                    $alphaCode = $findDate->game_code_alphabet;
                    
                    $checkOption = Store_Game::where('user_id',$auth->id)
                                            ->where('coupon_id',$request->coupon)
                                            ->where('game_number',$request->alphabetGameOption)
                                            ->where('game_code',$alphaCode)
                                            ->first();

                    if(empty($checkOption)){
                        $create = Store_Game::create([
                            'coupon_id' => $request->coupon,
                            'user_id' => $auth->id,
                            'game_number' => $request->alphabetGameOption,
                            'game_code' => $alphaCode,
                            'date' => $todayDate
                        ]);
                    }else{
                        return response()->json(['status' => 0, 'errors' => '', 'msg' => 'You have already submitted this option.']);
                    }
                    
                    if ($create) {
                        return response()->json(['status' => 1, 'errors' => '', 'msg' => 'Your option saved successfully.']);
                    } else {
                        return response()->json(['status' => 0, 'errors' => '', 'msg' => 'Something went wrong, create the option.']);
                    }
                }else{
                    return response()->json(['status' => 3, 'errors' => '', 'msg' => "Something went wrong. Today's game not declared."]);
                }
            }
        } else {
            return response()->json(['status' => 2, 'errors' => '', 'msg' => 'Session Logged out. Please login again first.']);
        }
    }

    public function paymentSuccess(Request $request,$pay_id,$order_id){
        // dd(["payment_id" => $pay_id, "order_id" => $order_id]);
        $auth = Auth::user();
        if($auth){
            $paymentCheck =  $this->api->payment->fetch($pay_id);
            if($paymentCheck){
                if($paymentCheck->status == "captured"){

                    $couponIdget = Store_Game::where('pay_order_id',$order_id)->first();

                    $couponId = $couponIdget->coupon_id;

                    $allcoupons = Coupon::where('id',$couponId)->first();
                    // dd($allcoupons);
                    if (empty($allcoupons)) {
                        return view('mainwebsite.pages.couponList', compact('allcoupons'))->with('error', 'You have viewed all the coupon code for this coupon.');
                    } else {

                        $userId = Auth::id();
                        $variations = CouponVarations::where('coupon_id', $couponId)->get();
                        // Filter out the variations that the user has already seen
                        $unseenVariations = $variations->filter(function ($variation) use ($userId) {
                            $exists = UserCouponVariation::where('user_id', $userId)
                                ->where('coupon_variation_id', $variation->id)
                                ->exists();
                            return !$exists;
                        });

                        if ($unseenVariations->isEmpty()) {
                            $allcoupons = Coupon::all();
                            return redirect()->route('allcoupon')->with('error', 'You have viewed all the coupon code for this coupon.');
                        } else {
                            // Get the first unseen variation
                            $singleVariationDetail = $unseenVariations->first();

                            // Record that the user has seen this coupon variation
                            $insertVartion = UserCouponVariation::create([
                                'user_id' => $userId,
                                'coupon_variation_id' => $singleVariationDetail->id,
                            ]);
                            // return view('mainwebsite.pages.singleCoupon', compact('singleVariationDetail', 'allcoupons'));
                            $store = Store_Game::where('pay_order_id',$order_id)->update([
                                'payment' => 'success'
                            ]);

                            // dd($singleVariationDetail);

                            return view('mainwebsite.pages.payment_status',['allCoupons' => $allcoupons, 'var_data' => $singleVariationDetail])->with('success','Payment Success.');
                        }
                    }
                }else{
                    $store = Store_Game::where('pay_order_id',$order_id)->update([
                        'payment' => 'failed'
                    ]);
                    return view('mainwebsite.pages.payment_status')->with('error','Payment Failed.');
                }
            }else{
                return view('mainwebsite.pages.payment_status')->with('error','Payment not found.');
            }   
        }else{
            return redirect()->route('login');
        }
    }

}
