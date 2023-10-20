<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Address;
use App\Models\Banner;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Laravel\Passport\TokenRepository;
use Laravel\Passport\RefreshTokenRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{

   

    public function index()
    {
        $title = 'Home|CrazzyGift';
        $banners = Banner::latest()->get();
        $featured_collection = DB::table('sliders')->where('type',1)->latest('created_at')->first();
        $best_selling = DB::table('sliders')->where('type',2)->latest('created_at')->first();

        $productsString1 = $featured_collection->products;
        $productsString2 = $best_selling->products; 
        $featured_products_ids = explode(',', $productsString1);
        $best_products_ids = explode(',', $productsString2);

        $res1=[];
        foreach($featured_products_ids as $id1){
           $featured_products = Product::where('id',$id1)->first();
           $data1['id']=$featured_products->id;
           $data1['product_image']=$featured_products->product_image;
           $data1['title']=$featured_products->title;
           $data1['price']=$featured_products->price;

           $res1[]=$data1;
        }

        $res2=[];
        foreach($best_products_ids as $id2){
          $best_products = Product::where('id',$id2)->first();
          $data2['id']=$best_products->id;
          $data2['product_image']=$best_products->product_image;
          $data2['title']=$best_products->title;
          $data2['price']=$best_products->price;

           $res2[]=$data2;
        }

   
        return view('DashboardView', compact('title','banners','res1','res2'));
    }


    public function login()
    {
        $title = 'Login|CrazzyGift';
        return view('LoginView', compact('title'));
    }

    public function checkUser()
    {
        if (auth()->check()) {
            $data = Cart::where('user_id', auth()->user()->id)->get();
            return response()->json(['message' => 'loggedIn User', 'code' => 200, 'data' => $data], 200);
        } else {
            return response()->json(['message' => 'Guest User', 'code' => 210, 'data' => ''], 200);
        }
    }

    public function signin()
    {
        $title = 'Signin|CrazzyGift';
        return view('SigninView', compact('title'));
    }

    public function register()
    {
        $title = 'Register|CrazzyGift';
        return view('RegisterView', compact('title'));
    }


    public function demo()
    {
        $data['firstname'] = "Saikat";
        $data['email'] = "hazra2482@gmail.com";
    }



    public function profile()
    {
        $title = 'My Profile|CrazzyGift';
        $user_id = auth()->user()->id;
        $orders = Order::where(['user_id' => $user_id,'order_status'=> 1])->get();
         $trackingData = [];
        if ($orders) {
            if (count($orders) > 0) {
                foreach ($orders as $order) {


                    $curl = curl_init();

                    curl_setopt_array($curl, array(
                        CURLOPT_URL => 'https://plapi.ecomexpress.in/track_me/api/mawbd/',
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_ENCODING => '',
                        CURLOPT_MAXREDIRS => 10,
                        CURLOPT_TIMEOUT => 0,
                        CURLOPT_FOLLOWLOCATION => true,
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        CURLOPT_CUSTOMREQUEST => 'POST',
                        CURLOPT_POSTFIELDS => array('username' => 'HACREATIONSLLP914909', 'password' => 'UlewRODjHc', 'awb' => $order->awb),
                    )
                    );

                    $response = curl_exec($curl);

                    $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
                    if ($httpCode === 200) {
                        $order->track_shipping = simplexml_load_string($response);

                    }

                    curl_close($curl);
                }
            }
        }
        
        $addresses = Address::where(['user_id' => $user_id])->get();
        return view('ProfileView', compact('title', 'orders', 'addresses'));
    }

    public function logout()
    {
        if (auth()->check()) {
            Auth::logout();
            // User::with('AauthAcessToken')->delete();
            return redirect()->route('login');
        }
    }

    public function redirectToGoogle(Request $request)
    {
        $cartData = $request->input('cartItems');
        $token_cart = uniqid(); // Generate a unique token
        session(['tokenCart' => $token_cart]);
        session(['cart_' . $token_cart => $cartData]);

        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        //  try {

        $user = Socialite::driver('google')->user();
        $finduser = User::where('google_id', $user->id)->first();

        if ($finduser) {

            //echo "found";

            if (auth()->attempt(['username' => $user->email, 'password' => 'Zikra@Byte'])) {

                $token = auth()->user()->createToken('passport_token')->accessToken;

                $user_id = auth()->user()->id;
                $res = $this->transferCartFromGoogle($user_id);

              

                    return redirect('/Myprofile');
               

            } else {

                return redirect()->route('login');
            }
        } else {


          //  echo "not found";


            $create = [
                'name' => $user->name,
                'email' => $user->email,
                'username' => $user->email,
                'google_id' => $user->id,
                'password' => Hash::make('Zikra@Byte')

            ];

            $newUser = User::create($create);
            if ($newUser) {
                
                if (auth()->attempt(['username' => $user->email, 'password' => 'Zikra@Byte'])) {
                    $token = auth()->user()->createToken('passport_token')->accessToken;

                    $user_id = auth()->user()->id;
                    $res = $this->transferCartFromGoogle($user_id);

                    

                        return redirect('/Myprofile');
                  

                } else {
                    redirect()->route('login');
                }
            }
        }
        // } 
        // catch (Exception $e) {
        //     return response()->json(['message' => $e->getMessage()], 502);
        // }
    }



    public function transferCartFromGoogle($user_id)
    {

        $token_cart = session('tokenCart');
        $cartsData = session('cart_' . $token_cart);


        if ($cartsData) {
            if (count($cartsData) > 0) {

                foreach ($cartsData as $cartItem) {
                    $cartItem['user_id'] = $user_id;
    
                   if(Cart::where(['user_id'=>$user_id,'product_id'=>$cartItem['product_id'] ])->exists()){

                   $existingCart =  Cart::where(['user_id'=>$user_id,'product_id'=>$cartItem['product_id'] ])->first();
                   
                   $cartItem['quantity'] = (int)$existingCart->quantity + (int) $cartItem['quantity'];

                    DB::table('carts')->where(['user_id'=>$user_id,'product_id'=>$cartItem['product_id'] ])->update($cartItem);

                   }
                   else{
                        DB::table('carts')->insert($cartItem);
                   }
                    

                }

                return true;

            }
        }
    }



    public function sentRegisterOtp(Request $request)
    {

        try {
            $name = trim($request->input('name'));
            $phone = trim($request->input('phone'));
            $email = trim($request->input('email'));


            if (User::where('username', $phone)->exists()) {

                //user Already Exist error will be shown here.
                $response = ['msg' => 'User already exist,kindly Login to continue', 'code' => 210];
            } else {

                $recipientMobileNumber = "91" . $request->input('phone');
                $otp = rand(1000, 9999);
                $authKey = '120132A9wLo7oCT63fc9230P1';

                $senderId = "SLMYCL";
                $msg = "Your verification OTP for SellMyCell is $otp. Don't share it with anyone.";
                $message = urlencode($msg);

                $api_url = 'https://api.msg91.com/api/sendhttp.php?mobiles=' . $recipientMobileNumber . '&authkey=' . $authKey . '&route=4&sender=' . $senderId . '&message=' . $message . '&country=91&DLT_TE_ID=1307161933111595817';

                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $api_url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $response = curl_exec($ch);
                curl_close($ch);

                $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

                if ($httpCode == 200) {

                    // insert the record in database after succesfully call the msg91 api

                    User::create([
                        'name' => $name,
                        'phone' => $phone,
                        'email' => $email,
                        'username' => $phone,
                        'otp' => (int) $otp,
                        'password' => Hash::make('Zikra@Byte'),
                    ]);

                    $response = ['msg' => 'Otp has been sent successfully', 'code' => 200];
                } else {
                    $response = ['msg' => 'Something went wrong!', 'code' => 210];
                }
            }

            return response()->json($response, 200);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 502);
        }
    }


    public function sentLoginOtp(Request $request)
    {
        try {

            $phone = trim($request->input('phone'));

            if (User::where('username', $phone)->exists()) {

                //if user exist //sent otp 

                $recipientMobileNumber = "91" . $request->input('phone');
                $otp = rand(1000, 9999);
                $authKey = '120132A9wLo7oCT63fc9230P1';
                $senderId = "SLMYCL";
                $msg = "Your verification OTP for SellMyCell is $otp. Don't share it with anyone.";
                $message = urlencode($msg);

                $api_url = 'https://api.msg91.com/api/sendhttp.php?mobiles=' . $recipientMobileNumber . '&authkey=' . $authKey . '&route=4&sender=' . $senderId . '&message=' . $message . '&country=91&DLT_TE_ID=1307161933111595817';

                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $api_url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $response = curl_exec($ch);
                curl_close($ch);

                $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

                if ($httpCode == 200) {
                    //update the otp in database after succesfully call the msg91 api
                    $data['otp'] = (int) $otp;
                    User::where(['username' => $phone])->update($data);
                    $response = ['msg' => 'Otp has been sent successfully!', 'code' => 200];
                } else {
                    $response = ['msg' => 'Something went wrong,check your Internet Connection!', 'code' => 210];
                }



            } else {
                $response = ['msg' => 'You have not registered yet,kindly Register to continue', 'code' => 210];
            }

            return response()->json($response, 200);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 502);
        }
    }


    public function verifyOtp(Request $request)
    {
        try {

            $str = $request->input('otp1') . "" . $request->input('otp2') . "" . $request->input('otp3') . "" . $request->input('otp4');
            $userOtp = (int) $str;
            $phone = $request->input('phone');



            if (User::where(['username' => $phone, 'otp' => $userOtp])->exists()) {
                //verified

                // authentication attempt
                if (auth()->attempt(['username' => $phone, 'password' => 'Zikra@Byte'])) {
                    $token = auth()->user()->createToken('passport_token')->accessToken;

                    if(User::where(['id'=>auth()->user()->id,'is_verified'=>0])->exists()){

                        
                            $data['is_verified']=1;
                            User::where('id',auth()->user()->id)->update($data);
                    }
                    

                    $response = ['msg' => 'OTP Verified successfully!', 'code' => 200];
                } else {

                    $response = ['msg' => 'Something went wrong!', 'code' => 210];
                }
            } else {

                $response = ['msg' => 'OTP Verification failed!', 'code' => 210];
            }

            return response()->json($response, 200);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 502);
        }
    }


    public function resendOtp(Request $request){

        if($request->input('phone')!=""){
            
            $phone = $request->input('phone');

             if (User::where('username', $phone)->exists()) {

                //if user exist //sent otp 

                $recipientMobileNumber = "91" . $request->input('phone');
                $otp = rand(1000, 9999);
                $authKey = '120132A9wLo7oCT63fc9230P1';
                $senderId = "SLMYCL";
                $msg = "Your verification OTP for SellMyCell is $otp. Don't share it with anyone.";
                $message = urlencode($msg);

                $api_url = 'https://api.msg91.com/api/sendhttp.php?mobiles=' . $recipientMobileNumber . '&authkey=' . $authKey . '&route=4&sender=' . $senderId . '&message=' . $message . '&country=91&DLT_TE_ID=1307161933111595817';

                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $api_url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $response = curl_exec($ch);
                curl_close($ch);

                $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

                if ($httpCode == 200) {
                    //update the otp in database after succesfully call the msg91 api
                    $data['otp'] = (int) $otp;
                    User::where(['username' => $phone])->update($data);
                    $response = ['msg' => 'Otp has been sent successfully!', 'code' => 200];
                } else {
                    $response = ['msg' => 'Something went wrong,check your Internet Connection!', 'code' => 210];
                }



            } else {
                $response = ['msg' => 'You have not registered yet,kindly Register to continue', 'code' => 210];
            }

            return response()->json($response, 200);
        }
    }

    public function verifyOtpProfile(Request $request){
        $str = $request->input('otp1') . "" . $request->input('otp2') . "" . $request->input('otp3') . "" . $request->input('otp4');
        $userOtp = (int) $str;
        $user_id = auth()->user()->id;
        if($userOtp!=""){
                if (User::where(['id' =>$user_id ,'otp' => $userOtp])->exists()) {
            //verfied
            if(User::where(['id'=>auth()->user()->id,'is_verified'=>0])->exists()){

                        
                            $data['is_verified']=1;
                            User::where('id',auth()->user()->id)->update($data);

                            //return response()->json(['msg'=>'Your phone number has been verified successfully.','code'=>200],200);
                            return redirect('/')->with('success', 'Your phone number has been verified successfully.');


                    }
        }
        else{
             //return response()->json(['msg'=>'Invalid OTP!','code'=>210],200);
            return redirect('/Myprofile')->with('error', 'Invalid OTP!');

        }

        }
        

    }


    public function checkGoogle()
    {



        if (auth()->check()) {
            $findUser = User::where(['id' => auth()->user()->id])->whereNotNull('google_id')->first();
            if ($findUser) {
                return response()->json(['code' => 200, 'msg' => 'googleUser'], 200);
            }
        } else {
            return response()->json(['code' => 210, 'msg' => 'not googleUser'], 200);
        }
    }

    public function profileUpload(Request $request)
    {
        $request->validate([
            'profile_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            // Adjust validation rules as needed.
        ]);

        if ($request->hasFile('profile_image')) {
            $image = $request->file('profile_image');
            // $originalName = $image->getClientOriginalName();
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $uploadPath = public_path('profile'); // Specify the path to the images directory

            // Create the 'images' directory if it doesn't exist
            if (!is_dir($uploadPath)) {
                mkdir($uploadPath, 0755, true);
            }

            if (auth()->user()->profile_image) {
                // Check if the image already exists and delete it
                $existingImagePath = $uploadPath . '/' . auth()->user()->profile_image;
                if (file_exists($existingImagePath)) {
                    unlink($existingImagePath);
                }
            }


            // Store the new image with the same name
            $image->move($uploadPath, $imageName);

            $data['profile_image'] = $imageName;
            $user_id = auth()->user()->id;

            User::where('id', $user_id)->update($data);

            //return redirect('/Myprofile')->with('success', 'Image uploaded successfully.');
            return response()->json(['code' => 200, 'msg' => 'Profile image uploaded successfully.']);
        }
    }

    public function updateProfile(Request $request)
    {
        try {
            $id = auth()->user()->id;
            $data['name'] = trim($request->input('name'));
            $data['phone'] = trim($request->input('phone'));
            $data['email'] = trim($request->input('email'));

            if(auth()->user()->is_verified==0){
                 $recipientMobileNumber = "91" . $request->input('phone');
                $otp = rand(1000, 9999);
                $authKey = '120132A9wLo7oCT63fc9230P1';
                $senderId = "SLMYCL";
                $msg = "Your verification OTP for SellMyCell is $otp. Don't share it with anyone.";
                $message = urlencode($msg);

                $api_url = 'https://api.msg91.com/api/sendhttp.php?mobiles=' . $recipientMobileNumber . '&authkey=' . $authKey . '&route=4&sender=' . $senderId . '&message=' . $message . '&country=91&DLT_TE_ID=1307161933111595817';

                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $api_url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $response = curl_exec($ch);
                curl_close($ch);

                $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

                if ($httpCode == 200) {

                    //update the otp in database after succesfully call the msg91 api
                    $data['otp'] = (int) $otp;

                    $res = User::where('id', $id)->update($data);

                    return response()->json(['msg'=>'Profile updated successfully!','code'=>200,'is_verified'=>'0'],200);
                } else {
                    
                    return response()->json(['msg'=>'Something went wrong,check your Internet Connection!','code'=>210],200);
                }

            }else{
                     $res = User::where('id', $id)->update($data);
                     return response()->json(['msg'=>'Profile updated successfully!','code'=>200,'is_verified'=>'1'],200);
            }


          
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 502);
        }
    }
}