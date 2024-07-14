<?php

namespace App\Http\Controllers\coupon;

use App\Http\Controllers\Controller;
use App\Http\Requests\CouponRequest;
use App\Models\Brands;
use App\Models\Categories;
use App\Models\Coupon;
use App\Models\Stores;
use App\Models\Store_Game;
use App\Models\game_code;
use App\Models\Users;
use App\Models\Winner;
use App\Models\WinnerSelection;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class CouponController extends Controller
{
    //
    public function index()
    {
        $coupons = Coupon::all();
        return view('admin.coupon.coupon-list', compact('coupons'));
    }

    public function create()
    {
        $categories = Categories::all();
        $brands = Brands::all();
        $stores = Stores::all();

        return view('admin.coupon.create', compact('categories', 'brands', 'stores'));
    }

    public function store(CouponRequest $request): RedirectResponse
    {
        $validatedData = $request->validated();
        $imageName = time() . '.' . $validatedData["image"]->extension();
        $imagePath = 'coupon/' . $imageName;
        $isHidden = 0;
        if ($validatedData['is_hidden'] == "show") {
            $isHidden = 1;
        } else {
            $isHidden = 0;
        }
        $coupon = new Coupon();
        $coupon->name = $validatedData['name'];
        $coupon->percentage = $validatedData['percentage'];
        $coupon->image = $imagePath;
        $request->image->move(public_path('coupon/'), $imageName);
        $coupon->is_hidden = $isHidden;
        $coupon->description = $validatedData['description'];
        $coupon->website_url = $validatedData['website_url'];
        $coupon->details = $validatedData['details'];
        $coupon->price = $validatedData['price'];
        $coupon->start_date = $validatedData['start_date'];
        $coupon->expiration_date = $validatedData['expiration_date'];
        $coupon->usage_limit = $validatedData['usage_limit'];
        $coupon->sku = $validatedData['sku'];
        $coupon->category_id = $validatedData['category_id'];
        $coupon->store_id = $validatedData['store_id'];
        $coupon->brand_id = $validatedData['brand_id'];
        $coupon->save();
        return redirect()->route('admin.coupon.view')->with('success', 'Coupon created successfully.');
    }

    public function edit($id)
    {
        $coupon = Coupon::findOrFail($id);
        $categories = Categories::all();
        $stores = Stores::all();
        $brands = Brands::all();
        if (!empty($coupon)) {
            return view('admin.coupon.coupon-edit', compact('coupon', 'categories', 'stores', 'brands'));
        }
        return redirect()->route('admin.coupon.view')->with('error', 'Coupon not found');
    }

    public function update(CouponRequest $request, $id)
    {
        $validatedData = $request->validated();

        // Find the coupon to update
        $coupon = Coupon::findOrFail($id);

        // If a new image is provided, update the image
        if ($request->hasFile('image')) {
            if ($coupon->image) {
                File::delete(public_path($coupon->image));
            }
            $imageName = time() . '.' . $validatedData["image"]->extension();
            $imagePath = 'coupon/' . $imageName;
            $request->image->move(public_path('coupon/'), $imageName);
            $coupon->image = $imagePath;
        }

        // Update other fields
        $coupon->name = $validatedData['name'];
        $coupon->percentage = $validatedData['percentage'];
        $coupon->is_hidden = $validatedData['is_hidden'] == "show" ? 1 : 0;
        $coupon->description = $validatedData['description'];
        $coupon->website_url = $validatedData['website_url'];
        $coupon->details = $validatedData['details'];
        $coupon->price = $validatedData['price'];
        $coupon->start_date = $validatedData['start_date'];
        $coupon->expiration_date = $validatedData['expiration_date'];
        $coupon->usage_limit = $validatedData['usage_limit'];
        $coupon->sku = $validatedData['sku'];
        $coupon->category_id = $validatedData['category_id'];
        $coupon->store_id = $validatedData['store_id'];
        $coupon->brand_id = $validatedData['brand_id'];

        // Save the changes
        $coupon->save();

        return redirect()->route('admin.coupon.view')->with('success', 'Coupon updated successfully.');
    }


    public function destroy($id)
    {
        $coupon = Coupon::findOrFail($id);
        if (!empty($coupon)) {
            if ($coupon->image) {
                File::delete(public_path($coupon->image));
            }
            $coupon->delete();
            return redirect()->route('admin.coupon.view')->with('success', 'Coupon deleted successfully.');
        }

        return redirect()->route('admin.coupon.view')->with('error', 'Coupon not found.');
    }


    // Daily Coupon code functions
    public function dailyCreateView(){
        $today = Carbon::today();
        $nextDate = $today->addDays(1)->format('d-m-Y');
        $findDate = game_code::where('publish_date',$nextDate)->first();
        if($findDate){
            return view('admin.coupon.dailyCouponCode',['gameCodeData' => $findDate]);
        }else{
            return view('admin.coupon.dailyCouponCode',['gameCodeData' => '']);
        }
        
    }

    public function dailyCouponCodeStore(Request $request){
        $auth = Auth::user();
        if($auth){
            $validator = Validator::make($request->all(),[
                'numberGame'      => 'required',
                'AlphabetGame'  => 'required',
            ],[
                'numberGame.required' => 'Coupon Code for number game cannot be null.',
                'AlphabetGame.required' => 'Coupon Code for alphabet game cannot be null.',
            ]);
    
            if ($validator->fails()) {
                return response()->json(['status' => 0, 'errors' => $validator->messages(), 'msg' => '']);
            }else{
                $today = Carbon::today();
                $nextDate = $today->addDays(1)->format('d-m-Y');
                $findDate = game_code::where('publish_date',$nextDate)->first();
                if(empty($findDate)){
                    $gameCode = game_code::create([
                        'game_code_number' => $request->numberGame,
                        'game_code_alphabet' => $request->AlphabetGame,
                        'publish_date' => $nextDate
                    ]);
                }else{

                    // $gameCode = game_code::where('id',$findDate->id)->update([
                    //     'game_code_number' => $request->numberGame,
                    //     'game_code_alphabet' => $request->AlphabetGame,
                    //     'publish_date' => $nextDate
                    // ]);

                    return response()->json(['status' => 0, 'errors' => '', 'msg' => 'Sorry, Game Code cannot be updated.']);

                }
    
                if($gameCode){
                    return response()->json(['status' => 1, 'errors' => '', 'msg' => 'Daily Coupon Code Saved Successfully.']);
                }else{
                    return response()->json(['status' => 0, 'errors' => '', 'msg' => 'Something went wrong, create the option.']);
                }
            }
        }else{
            return response()->json(['status' => 2, 'errors' => '', 'msg' => 'Session Logged out. Please login again first.']);
        }
    }

    public function dailyWinnerView(){
        $today = Carbon::today()->format('d-m-Y');
        $findDate = WinnerSelection::where('publish_date',$today)->first();
        if($findDate){
            return view('admin.coupon.dailyWinner',['winnerData' => $findDate]);
        }else{
            return view('admin.coupon.dailyWinner',['winnerData' => '']);
        }
    }

    public function dailyWinnerStore(Request $request){
        // dd($request);
        $auth = Auth::user();
        if($auth){
            $validator = Validator::make($request->all(),[
                'numberWinner'      => 'required',
                'AlphabetWinner'  => 'required',
            ],[
                'numberWinner.required' => 'Winner for number game cannot be null.',
                'AlphabetWinner.required' => 'Winner for alphabet game cannot be null.',
            ]);
    
            if ($validator->fails()) {
                return response()->json(['status' => 0, 'errors' => $validator->messages(), 'msg' => '']);
            }else{
                $today = Carbon::today()->format('d-m-Y');
                $findGameData = game_code::where('publish_date',$today)->first();
                if(!empty($findGameData)){
                    $findDate = WinnerSelection::where('publish_date',$today)->first();
                    if(empty($findDate)){
                        //winner selection function in table
                        $gameCode = WinnerSelection::create([
                            'number_winner' => $request->numberWinner,
                            'alphabet_winner' => $request->AlphabetWinner,
                            'game_code_num' => $findGameData->game_code_number,
                            'game_code_alph' => $findGameData->game_code_alphabet,
                            'publish_date' => $today
                        ]);

                        //searching for number game winners
                        $findNumberWinner = Store_Game::where('game_number',$request->numberWinner)
                                                        ->where('game_code',$findGameData->game_code_number)
                                                        // ->where('date',$findGameData->publish_date)
                                                        ->get();

                        //checking and saving function for winners of daily number game
                        if($findNumberWinner->isNotEmpty()){
                            // dd($findNumberWinner);
                            // $users = Users::where('role','user')->get();
                            foreach($findNumberWinner as $user){
                                $numberWinner = Winner::create([
                                                    'gameType' => 'NumberGame',
                                                    'gameCode' => $findGameData->game_code_number,
                                                    'coupon_id' => $user->coupon_id,
                                                    'user_id' => $user->user_id,
                                                    'winningAnswer' => $request->numberWinner,
                                                    'winningDate' => $today,
                                                    'seen' => 'No',
                                                ]);
                            }
                        }

                        //searching for alphabet game winners
                        $findAlphabetWinner = Store_Game::where('game_number',$request->AlphabetWinner)
                                                        ->where('game_code',$findGameData->game_code_alphabet)
                                                        // ->where('date',$findGameData->publish_date)
                                                        ->get();

                        //checking and saving function for winners of daily alphabet game
                        if($findAlphabetWinner->isNotEmpty()){
                            // dd($findAlphabetWinner);
                            // $users = Users::where('role','user')->get();
                            foreach($findAlphabetWinner as $user){
                                $alphabetWinner = Winner::create([
                                                    'gameType' => 'AlphabetGame',
                                                    'gameCode' => $findGameData->game_code_alphabet,
                                                    'coupon_id' => $user->coupon_id,
                                                    'user_id' => $user->user_id,
                                                    'winningAnswer' => $request->AlphabetWinner,
                                                    'winningDate' => $today,
                                                    'seen' => 'No',
                                                ]);
                            }
                        }

                        if($gameCode){
                            return response()->json(['status' => 1, 'errors' => '', 'msg' => 'Winners Saved Successfully and will be notified soon.']);
                        }else{
                            return response()->json(['status' => 0, 'errors' => '', 'msg' => 'Something went wrong, winner cannot be saved.']);
                        }
                    }else{
                        return response()->json(['status' => 0, 'errors' => '', 'msg' => 'Sorry, Winner cannot be updated.']);
                    }
                }else{
                    // $gameCode = game_code::where('id',$findDate->id)->update([
                    //     'game_code_number' => $request->numberGame,
                    //     'game_code_alphabet' => $request->AlphabetGame,
                    //     'publish_date' => $nextDate
                    // ]);
                    return response()->json(['status' => 0, 'errors' => '', 'msg' => 'Something went wrong, Game data not found.']);
                }
            }
        }else{
            return response()->json(['status' => 2, 'errors' => '', 'msg' => 'Session Logged out. Please login again first.']);
        }
    }

}
