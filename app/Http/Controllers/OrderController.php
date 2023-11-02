<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Address;
use App\Models\Order;
use App\Models\User;
use App\Models\GST;
use Illuminate\Support\Facades\DB;

use Exception;


class OrderController extends Controller
{

     

    public function index()
    {

        $title = 'My Orders|CrazzyGift';
        $user_id = auth()->user()->id;
       
        $orders = Order::where(['user_id' => $user_id])->orderBy('id','desc')->get();

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
                       $trackShipping = simplexml_load_string($response);
                       if(count($trackShipping->object) > 0){
                            $order->track_shipping = $trackShipping;
                       }
                       else{
                        $order->track_shipping = null;
                        }

                    }

                    curl_close($curl);
                }
            }
        }

          
       return view('AllordersView', compact('title', 'orders'));
    }



    public function shippingInfo()
    {
        $user_id = auth()->user()->id;

         $data = Cart::where('user_id',$user_id)->get();
        $allObjectsHaveCustomData = true;

        foreach ($data as $item) {
             if (!isset($item->custom_text) || !isset($item->custom_image)) {
                $allObjectsHaveCustomData = false;
                break; 
            }
        }

    if ($allObjectsHaveCustomData) {

        $title = 'Shipping Information|CrazzyGift';
        $carts = Cart::where('user_id', auth()->user()->id)->with('product')->get();

        if (count($carts) == 0) {

            return redirect('/products/all');

        } else {
            
            $billingAddress = Address::where(['user_id' => $user_id, 'is_billing_address' => 1, 'status' => 2])->first();

            if(Address::where(['user_id' => $user_id, 'is_billing_address' => 1,'is_shipping_address'=>1, 'status' => 2])->exists()){
                $is_samae_as_billing = true;
            }
            else{
                $is_samae_as_billing = false;
            }

            
            $shippingAddresses = Address::where(['user_id' => $user_id, 'is_shipping_address' => 1,])->whereNull('is_billing_address')->get();

            $shippingDefault = Address::where(['user_id' => $user_id, 'is_shipping_address' => 1, 'status' => 2])->whereNull('is_billing_address')->first();

                $gst_details = GST::first();



            return view('ShippingInfoView', compact('title', 'carts', 'user_id', 'billingAddress', 'shippingAddresses', 'shippingDefault','is_samae_as_billing','gst_details'));
        }
    }
    else{
        return redirect('/shippingCart');
    }
    




    }

    public function shippingCart()
    {
        $title = 'Shipping Cart|CrazzyGift';

        if (auth()->check()) {
            //authenticated users
            $carts = Cart::where('user_id', auth()->user()->id)->with('product')->get();
            $status = true;
        } else {
            $carts = "";
            $status = false;
        }

        return view('ShippingcartView', compact('title', 'carts', 'status'));
    }

    public function editBillingAddress(Request $request)
    {
        try {
            $data['name'] = trim($request->input('name'));
            $data['street_address1'] = trim($request->input('street_address1'));
            $data['street_address2'] = trim($request->input('street_address2'));
            $data['street_address3'] = trim($request->input('street_address3'));
            $data['city'] = trim($request->input('city'));
            $data['state'] = trim($request->input('state'));
            $data['postal_code'] = trim($request->input('pincode'));
            $data['phone'] = trim($request->input('phone'));
            $data['alternate_phone'] = trim($request->input('alternate_phone'));
            $data['is_billing_address'] = 1;

            $id = $request->input('address_id');

            if ($id != "") {
                //update addresss
                $res = Address::where(['id' => $id])->update($data);
            } else {
                $data['status'] = 2;
                $data['user_id'] = auth()->user()->id;
                //add new address
                $res = Address::create($data);
            }

            if ($res) {
                return response()->json(['msg' => 'Address Saved Successfully'], 200);
            }
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 502);
        }
    }


    public function editShippingAddress(Request $request)
    {
        try {
           foreach($request->all() as $result){
                
                if($result['name']=="_token"){
                    continue;
                }
                $data[$result['name']] = trim($result['value']);
            }


                  //serviceability check
            $pincode = $data['postal_code'];
            $username = "HACREATIONSLLP914909";
            $password = "UlewRODjHc";
            $url2 = "https://api.ecomexpress.in/apiv3/pincode/";
            $curl = curl_init();

            curl_setopt_array(
                $curl,
                array(
                    CURLOPT_URL => $url2,
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'POST',
                    CURLOPT_POSTFIELDS => array(
                        'username' => $username,
                        'password' => $password,
                        'pincode' => $pincode
                        // 'destination_pincode' => $destination_pincode
                    ),
                ),
            );

            $response = curl_exec($curl);

            $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            if ($httpCode === 200) {
                $res = json_decode($response);
                if ($res) {
                    if (count($res) > 0) {
                        foreach ($res as $row) {
                            if ($row->active) {
                                //update
                                    $id = $data['id'];
                                    if ($id  != "") {
                                        Address::where(['id' => $id])->update($data);
                                        return response()->json(['code'=>200,'msg'=>'Shipping Address updated Successfully'],200);
                                    }
                            }
                            else{
                                return response()->json(['code'=>210,'msg'=>'Service Unavailable in Your Area!' ],200); 
                            }
                        }
                    }
                    else{
                        return response()->json(['code'=>210,'msg'=>'Service Unavailable in Your Area!' ],200);
                    }
                }
                else{
                    return response()->json(['code'=>210,'msg'=>'Service Unavailable in Your Area!' ],200);
                }
            }
            else{
                //curl error try again
                return response()->json(['code'=>210,'msg'=>'Oops! something went wrong,Try Again' ],200);
            }

        } 
        catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 502);
        }
    }


    public function getShippingAddress(Request $request)
    {
        $id = $request->input('id');
        $data = Address::where('id', $id)->first();
        return response()->json($data, 200);

    }


    public function updateBillingOnInput(Request $request)
    {

        try {

            if ($request->has('name')) {
                $data['name'] = $request->input('name');
            }
            if ($request->has('street_address1')) {
                $data['street_address1'] = $request->input('street_address1');
            }
            if ($request->has('street_address2')) {
                $data['street_address2'] = $request->input('street_address2');
            }
            if ($request->has('street_address3')) {
                $data['street_address3'] = $request->input('street_address3');
            }
            if ($request->has('state')) {
                $data['state'] = $request->input('state');
            }

            if ($request->has('city')) {
                $data['city'] = $request->input('city');
            }

              if ($request->has('gst')) {
                $data['gst'] = $request->input('gst');
            }

             if ($request->has('company_name')) {
                $data['company_name'] = $request->input('company_name');
            }




            if ($request->has('postal_code')) {
                $postalInput = strval($request->input('postal_code'));
                if (strlen($postalInput) > 0) {
                    $postal_code = $postalInput;
                    $data['postal_code'] = substr($postal_code, 0, 6);
                } else {
                    $data['postal_code'] = "";
                }
            }

            if ($request->has('phone')) {
                $phoneInput = strval($request->input('phone'));
                if (strlen($phoneInput) > 0) {
                    $phone = strval($phoneInput);
                    $data['phone'] = substr($phone, 0, 10);
                } else {
                    $data['phone'] = "";
                }
            }

            if ($request->has('alternate_phone')) {
                $alternateInput = strval($request->input('alternate_phone'));
                if (strlen($alternateInput) > 0) {
                    $alternate_phone = strval($alternateInput);
                    $data['alternate_phone'] = substr($alternate_phone, 0, 10);
                } else {
                    $data['alternate_phone'] = "";
                }
            }

            $data['is_billing_address'] = 1;
            $data['status'] = 2;
            $user_id = auth()->user()->id;


            if (Address::where(['user_id' => $user_id, 'is_billing_address' => 1])->exists()) {
                //update the particular record
                $res = Address::where(['user_id' => $user_id, 'is_billing_address' => 1])->update($data);
            } else {
                //insert one record
                $data['user_id'] = $user_id;
                $res = Address::create($data);
            }

            if ($res)
                return response()->json(['message' => "Billing Address updated successfully"], 200);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 502);
        }
    }

    public function addShippingAddress(Request $request)
    {

          try {


            foreach($request->all() as $row){
                $input[$row['name']]=$row['value'];
            }


            $data['is_shipping_address'] = 1;
           

            //serviceability check
            $pincode = $input['postal_code'];
            $username = "HACREATIONSLLP914909";
            $password = "UlewRODjHc";
            $url2 = "https://api.ecomexpress.in/apiv3/pincode/";
            $curl = curl_init();

            curl_setopt_array(
                $curl,
                array(
                    CURLOPT_URL => $url2,
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'POST',
                    CURLOPT_POSTFIELDS => array(
                        'username' => $username,
                        'password' => $password,
                        'pincode' => $pincode
                        // 'destination_pincode' => $destination_pincode
                    ),
                ),
            );

            $response = curl_exec($curl);

           


            $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            if ($httpCode === 200) {
                $res = json_decode($response);
                if ($res) {
                    if (count($res) > 0) {
                        foreach ($res as $row) {
                            if ($row->active) {
                                $user_id = auth()->user()->id;


                                if (Address::where(['user_id' => $user_id,'is_shipping_address' => 1,'status' => 2,])->whereNull('is_billing_address')->exists()) {

                                    //update the status of that record as 1
                                    $previousRecords = Address::where(['user_id' => $user_id,'is_shipping_address' => 1,'status' => 2,])->whereNull('is_billing_address')->get();

                                    foreach($previousRecords as $previousRecord){
                                        $previousId = $previousRecord->id;
                                        $data1['status'] = 1;
                                         $res = Address::where('id', $previousId)->update($data1);
                                    }


                                    
                                }

                                $res = Address::where(['user_id'=>$user_id,'is_billing_address'=>1,'status'=>2])->update($data);

                                if ($res) {
                                   // return redirect()->back()->with('success', 'Shipping address added successfully');
                                    return response()->json(['code'=>200,'msg'=>'Shipping Address same as Billing Address updated' ],200);
                                }
                            } else {
                                //return redirect()->back()->with('error', 'Service Unavailable in Your Area!');

                                 return response()->json(['code'=>210,'msg'=>'Service Unavailable in Your Area!' ],200);

                            }
                        }
                    } else {

                       // return redirect()->back()->with('error', 'Service Unavailable in Your Area!');
                        return response()->json(['code'=>210,'msg'=>'Service Unavailable in Your Area!' ],200);
                        
                    }
                }
                else{
                     return response()->json(['code'=>210,'msg'=>'Service Unavailable in Your Area!' ],200);
                }
            }
            else{
                return response()->json(['code'=>210,'msg'=>'Something went wrong!' ],200);
            }

            curl_close($curl);


        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 502);
        }


        
    }

    public function addShipping(Request $request)
    {
        try {


            foreach($request->all() as $row){
                if($row['name']=="_token"){
                    continue;
                }
                $input[$row['name']]=$row['value'];
            }

            

            // $data['name'] = $request->input('name');
            // $data['street_address1'] = $request->input('street_address1');
            // $data['street_address2'] = $request->input('street_address2');
            // $data['street_address3'] = $request->input('street_address3');

            // $data['city'] = $request->input('city');
            // $data['state'] = $request->input('state');
            // $data['postal_code'] = $request->input('postal_code');
            // $data['phone'] = $request->input('phone');
            // $data['alternate_phone'] = $request->input('alternate_phone');

            //default field to insert for shipping address

            $input['user_id'] = auth()->user()->id;
            $input['is_shipping_address'] = 1;
            $input['status'] = 2;

            


            //serviceability check
            $pincode = $input['postal_code'];
            $username = "HACREATIONSLLP914909";
            $password = "UlewRODjHc";
            $url2 = "https://api.ecomexpress.in/apiv3/pincode/";
            $curl = curl_init();

            curl_setopt_array(
                $curl,
                array(
                    CURLOPT_URL => $url2,
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'POST',
                    CURLOPT_POSTFIELDS => array(
                        'username' => $username,
                        'password' => $password,
                        'pincode' => $pincode
                        // 'destination_pincode' => $destination_pincode
                    ),
                ),
            );

            $response = curl_exec($curl);


            
            $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
           
            if ($httpCode === 200) {
                $res = json_decode($response);

                if ($res) {

                    if (count($res) > 0) {
                        
                        foreach ($res as $row) {
                            if ($row->active) {
                                $user_id = auth()->user()->id;


                                if (Address::where(['user_id' => $user_id,'is_shipping_address' => 1,'is_billing_address'=>1,'status' => 2])->exists()) {

                                    $sameAsBilling=Address::where(['user_id' => $user_id,'is_shipping_address' => 1,'is_billing_address'=>1,'status' => 2])->first();

                                    $previousId = $sameAsBilling->id;
                                    $data1['is_shipping_address'] = null;
                                    $res = Address::where('id', $previousId)->update($data1);
                                }

                               

                                 if (Address::where(['user_id' => $user_id,'is_shipping_address' => 1,'status' => 2,])->whereNull('is_billing_address')->exists()) {

                                    //update the status of that record as 1
                                    $previousRecords = Address::where(['user_id' => $user_id,'is_shipping_address' => 1,'status' => 2,])->whereNull('is_billing_address')->get();
                                  
                                    foreach($previousRecords as $previousRecord){
                                        $previousId = $previousRecord->id;
                                        $data2['status'] = 1;
                                         $res = Address::where('id', $previousId)->update($data2);
                                    }

                                   
                                }
                              
                                        $res = Address::create($input);
                                

                                if ($res) {
                                    //return redirect()->back()->with('success', 'Shipping address added successfully');
                                     return response()->json(['msg' => 'Shipping address added successfully','code'=>200],200);
                                }
                            } else {
                                //return redirect()->back()->with('error', 'Service Unavailable in Your Area!');
                                return response()->json(['msg' => 'Service Unavailable in Your Area!','code'=>210],200);

                            }
                        }
                    } else {
                         
                       // return redirect()->back()->with('error', 'Service Unavailable in Your Area!');
                        return response()->json(['msg' => 'Service Unavailable in Your Area!','code'=>210],200);
                    }
                }
                else{
                   
                     //return redirect()->back()->with('error', 'Service Unavailable in Your Area!');
                      return response()->json(['msg' => 'Service Unavailable in Your Area!','code'=>210],200);
                }
            }
            else{
                //return redirect()->back()->with('error', 'Something went wrong!');
                return response()->json(['msg' => 'Something went wrong!','code'=>210],200);
            }

            curl_close($curl);


        } catch (Exception $e) {
            // return redirect()->back()->with('error', $e->getMessage());
            return response()->json(['msg' => $e->getMessage()], 502);
        }
    }



    public function selectShipping(Request $request)
    {
        $id = $request->input('id');
        //check any other record with status 2 exist or not

        $user_id = auth()->user()->id;

        if (Address::where(['user_id' => $user_id, 'is_shipping_address' => 1, 'status' => 2])->exists()) {
            //update the status of that record as 1
            $previousRecord = Address::where(['user_id' => $user_id, 'is_shipping_address' => 1, 'status' => 2])->first();
            $previousId = $previousRecord->id;
            $data1['status'] = 1;
            $res = Address::where('id', $previousId)->update($data1);
        }

        $data['status'] = 2;
        $res = Address::where('id', $id)->update($data);

        if ($res) {
            return response()->json(['msg' => 'Shipping address updated successfully'], 200);
        }
    }

    public function deleteShipping(Request $request)
    {
        $id = $request->input('id');

        $res = Address::where('id', $id)->delete();

        if ($res) {
            return response()->json(['msg' => 'Shipping address deleted successfully'], 200);
        }
    }

    public function uncheckSameAsBilling(){
        $user_id = auth()->user()->id;

        if(Address::where(['user_id'=>$user_id,'is_billing_address'=>1,'is_shipping_address'=>1,'status'=>2])->exists()){
            //true
            $check = Address::where(['user_id'=>$user_id,'is_billing_address'=>1,'is_shipping_address'=>1,'status'=>2])->first();
            $previousId =  $check->id;
            $data['is_shipping_address']=null;

            //update the record to make uncheck
            Address::where(['user_id'=>$user_id,'is_billing_address'=>1,'is_shipping_address'=>1,'status'=>2])->update($data);


            return response()->json(['code'=>200,'msg'=>'true'],200);
        }
        

    }


    public function checkShipping(){
        $user_id = auth()->user()->id;
        $result=Address::where(['user_id'=>$user_id,'is_shipping_address'=>1,'status'=>2])->first();
        if($result){
            return response()->json(['msg'=>'record exist','code'=>200],200);
        }
        else{
            return response()->json(['msg'=>'record not exist','code'=>210],200);
        }

    }
}