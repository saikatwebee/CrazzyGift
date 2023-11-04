<?php

namespace App\Http\Controllers;

use Exception;

use Illuminate\Support\Facades\Validator;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Laravel\Passport\TokenRepository;
use Laravel\Passport\RefreshTokenRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Admin;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;


class AdminController extends Controller
{

    public function login(Request $request){
        $title = 'Admin Login|CrazzyGift';
        return view('admin.LoginView', compact('title'));
    }

    public function register(Request $request){
        $title = 'Admin Register|CrazzyGift';
        return view('admin.RegisterView', compact('title'));
    }

     public function dashboard(Request $request){
        $title = 'Admin Dashboard|CrazzyGift';
        $order_count = Order::count();
        $user_count = User::count();
        $delivered_count = Order::where('order_status',5)->count();
        $active_product_count = Product::where('status',1)->count();

        return view('admin.DashboardView', compact('title','order_count','user_count','delivered_count','active_product_count'));
    }



    public function loginSubmit(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        

        if ($validator->fails()) {
            // return response()->json(['error' => $validator->errors()], 401);
            return redirect()->route('adminLogin')->with('error', 'Something went wrong!');
        }

        if (Auth::guard('admin')->attempt(['email' => $request->input('email'), 'password' => $request->input('password')])) {
            $admin = Auth::guard('admin')->user();
            $token = $admin->createToken('AdminAccessToken')->accessToken;

            return redirect()->route('adminDashboard')->with('success', 'Login Successful');

        } else {

            return redirect()->route('adminLogin');
        }
    }

    public function registerSubmit(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'phone' => 'required',
            'email' => 'required|string|email|max:255|unique:admins',
            'password' => 'required|string|min:8',
        ]);

        if ($validator->fails()) {
            //return response()->json(['error' => $validator->errors()], 422);
            return redirect()->route('adminRegister')->with('error', 'Something went wrong!');
        }

        $admin = Admin::create([ 
            'phone' => $request->input('phone'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
        ]);

          if($admin)
           return redirect()->back()->with('success', 'Registration Successful');

        // $token = $admin->createToken('AdminAccessToken')->accessToken;
        // return response()->json(['token' => $token], 201);
    }

    public function logout(){
        if (auth('admin')->check()) {
           // Auth::logout();
            Auth::guard('admin')->logout();
            return redirect()->route('adminLogin');
        }
    }


    public function users(){

        $title = 'Users|CrazzyGift';
        $heading = "All User";

        return view('admin.usersView', compact('title','heading'));
    }


    public function getAllUsers(Request $request){

        $users =User::orderBy('id', 'desc')->get();
        return response()->json($users);
    }


    public function userReport(Request $request){

        $title = 'Reports|CrazzyGift';
        $heading = "User Report";

         $user['totalUser'] = User::count();
         $user['verifiedUser'] = User::where('is_verified',1)->count();

        // $order['completedOrder'] = Order::where('order_status',5)->count();
        // $order['pendingOrder'] = Order::whereIn('order_status', [1, 2, 3, 4])->count();
        // $order['cancelledOrder'] = Order::where('order_status',0)->count();


        return view('admin.userReportView', compact('title','heading','user'));
    }


    public function getFilterUsers(Request $request){
        $startDate = $request->input('startDate');
        $endDate = $request->input('endDate');

        $startDate = date('Y-m-d 00:00:00', strtotime($startDate));
        $endDate = date('Y-m-d 23:59:59', strtotime($endDate));

         $orders = User::whereBetween('created_at', [$startDate, $endDate])
                    ->orderBy('created_at', 'desc')
                    ->get();

        return response()->json($orders);

    }


    public function getUser(Request $request){

        if($request->has('id')){
            $id = $request->input('id');
            $user = User::where('id',$id)->first();

            return response()->json($user);
        }

    }

    public function userDelete(Request $request){
        if($request->has('id')){

            $id = $request->input('id');

            $user = User::find($id);
            $user->status = ($user->status == 1) ? 2 : 1;
            $user->updated_at =date('Y-m-d H:i:s');
            $res=$user->save();
             if($res){
                return response()->json(['code'=>200,'msg'=>'user status changed successfully'],200);
            }
        }
    }



}
