<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Cart;
use App\Models\Address;
use APP\Models\GST;
use App\Models\Order;
use Exception;
use Illuminate\Support\Facades\DB;
use App\Mail\OrderPlacedEmail;
use Illuminate\Support\Facades\Mail;

class PaymentController extends Controller
{

    public function payment()
    {
        return view('PaymentView');
    }

    public function Razorpay(Request $request)
    {

        try {
            $api_key = 'rzp_test_rJOE3IGvN7MvAl';
            $api_secret = 't0kvT9O051MYC2XremGfQrZY';
            $item_name = "CrazzyGift";
            $item_desc = "test Description";

            $name = auth()->user()->name;
            $email = auth()->user()->email;
            $phone = auth()->user()->phone;

            $data = [];

            $api_endpoint = 'https://api.razorpay.com/v1/orders';

            // Create a unique order ID
            $order_id = uniqid();
            $totalprice = $request->input('amount');
            $amount = $totalprice * 100;
            $currency = 'INR';


            $order_data = [
                'amount' => $amount,
                'currency' => $currency,
                'receipt' => $order_id,
            ];

            $json_data = json_encode($order_data);
            $ch = curl_init($api_endpoint);

            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($ch, CURLOPT_POSTFIELDS, $json_data);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                'Content-Type: application/json',
                'Authorization: Basic ' . base64_encode("$api_key:$api_secret"),
            ]);


            $response = curl_exec($ch);

            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            if ($httpCode === 200) {
                $checkoutData = json_decode($response);

                $data = [
                    "key" => $api_key,
                    "amount" => $checkoutData->amount,
                    "name" => $item_name,
                    "description" => $item_desc,
                    "image" => asset('images/logo.png'),
                    "prefill" => [
                        "name" => $name,
                        "email" => $email,
                        "contact" => $phone,
                    ],
                    "notes" => [
                        "address" => "Dummy",
                        "merchant_order_id" => "MWyl2wvaZk0swU",
                    ],
                    "theme" => [
                        "color" => "#00b0e4"
                    ],
                    "order_id" => $checkoutData->id,

                ];
            }

            curl_close($ch);

            return response()->json($data);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 502);
        }
    }

    public function payment_status($payment_id, $amount)
    {

        // try {

            $title = 'Payment Status|CrazzyGift';

            $api_key = 'rzp_test_rJOE3IGvN7MvAl';
            $api_secret = 't0kvT9O051MYC2XremGfQrZY';

            $url = "https://api.razorpay.com/v1/payments/$payment_id";

            $ch = curl_init($url);

            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');

            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                'Content-Type: application/json',
            ]);


            curl_setopt($ch, CURLOPT_USERPWD, $api_key . ':' . $api_secret);


            $response = curl_exec($ch);


            if (curl_errno($ch)) {
                echo 'cURL Error: ' . curl_error($ch);
            }

            curl_close($ch);

            $data = json_decode($response);
            $httpCode1 = curl_getinfo($ch, CURLINFO_HTTP_CODE);

            if ($httpCode1 === 200) {

            //order creation 
            $user_id = auth()->user()->id;
            $order['order_id'] = uniqid() . "_" . $user_id;
            $order['user_id'] = $user_id;

            $order['amount'] = $amount / 100;
            $order['payment_status'] = $data->status;
            $order['transaction_id'] = $data->id;

            $carts = Cart::where('user_id', auth()->user()->id)->with('product')->get();
            $billingAddress = Address::where(['user_id' => $user_id, 'is_billing_address' => 1, 'status' => 2])->first();
            $shipingAddress = Address::where(['user_id' => $user_id, 'is_shipping_address' => 1, 'status' => 2])->first();

            $product_arr = [];
            foreach ($carts as $cart) {
                $product = $cart->product;
                 if(isset($product)){
                $row = [];

                $row['product_id'] = $product->id;
                $row['title'] = $product->title;

                $main_category_id = $product->main_category;
                $main_category = DB::table('main_categories')->select('name')->where('id', $main_category_id)->first();

                $sub_category_id = $product->sub_category;
                $sub_category = DB::table('sub_categories')->select('name')->where('id', $sub_category_id)->first();

                $L3_category_id = $product->L3_category;
                $L3_category = DB::table('l3_categories')->select('name')->where('id', $L3_category_id)->first();

                $row['main_category'] = $main_category;
                $row['sub_category'] = $sub_category;
                $row['product_code'] = $product->code;
                $row['L3_category'] = $L3_category;
                $row['description'] = $product->description;
                $row['product_image'] = $product->product_image;
                $row['product_type'] = $product->product_type;
                $row['weight'] = $product->weight;
                $row['height'] = $product->height;
                $row['length'] = $product->length;
                $row['breadth'] = $product->breadth;
                $row['price'] = $product->price;
                $row['gst'] = $product->gst;
                $row['discount'] = $product->discount;
                $row['quantity'] = $cart->quantity;
                $row['custom_image'] = $cart->custom_image;
                $row['custom_text'] = $cart->custom_text;

                $product_arr[] = $row;

            }

            }

if(count($product_arr) > 0){
     $order['product_details'] = json_encode($product_arr);


            $order['billing_address'] = (($billingAddress) ? $billingAddress->street_address1 : '') . "," . (($billingAddress) ? $billingAddress->street_address2 : '') . "," . (($billingAddress) ? $billingAddress->city : '') . "," . (($billingAddress) ? $billingAddress->state : '') . "," . (($billingAddress) ? $billingAddress->postal_code : '');
            $order['shipping_address'] = (($shipingAddress) ? $shipingAddress->street_address1 : '') . "," . (($shipingAddress) ? $shipingAddress->street_address2 : '') . "," . (($shipingAddress) ? $shipingAddress->city : '') . "," . (($shipingAddress) ? $shipingAddress->state : '') . "," . (($shipingAddress) ? $shipingAddress->postal_code : '');

            if ($data->status == "captured") {

            //awb generation start

                $curl = curl_init();

                curl_setopt_array($curl, array(
                    CURLOPT_URL => 'https://api.ecomexpress.in/apiv2/fetch_awb/',
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'POST',
                    CURLOPT_POSTFIELDS => array('username' => 'HACREATIONSLLP914909', 'password' => 'UlewRODjHc', 'count' => '1', 'type' => 'PPD'),
                )
                );

                $jsonString = curl_exec($curl);

            //awb generation end

                $httpCode2 = curl_getinfo($curl, CURLINFO_HTTP_CODE);

                if ($httpCode2 === 200) {
                    $phpObject = json_decode($jsonString);
                    $awb_number = $phpObject->awb[0]; //store awb
                }
                else{
                    $awb_number = "";
                }

                $order['order_status'] = 1; //1 for order placed

                curl_close($curl);

            } else {
                $awb_number = "";
                $order['order_status'] = 0; // 0 for order pending
            }



            $res = Order::create($order);
            $insertedId = (int) $res->id;
            $creatd_at = $res->created_at;

            Order::where(['id' => $insertedId])->update(['awb' => strval($awb_number)]);


            //order date for showing status
            $order_date = date('Y-m-d', strtotime($creatd_at));
            $order_time = date('H-i-s A', strtotime($creatd_at));



            //call Forward Shipment Manifest API for shipment creation
            if ($data->status == "captured") {
                $order_data = Order::where(['id' => $insertedId])->first();

                $this->shipment_manifest($res->id, $billingAddress, $shipingAddress);
                //delete all records from cart
               $this->eachCartDelete();

               //MAIL SEND
               $user=DB::table('users')->where('id',$user_id)->first();
               $user_email = $user->email;
               $user_name = $user->name; 
              
               Mail::to($user_email)->send(new OrderPlacedEmail($order_data,$user_name));

            }

            

             return view('paymentStatusView', compact('title', 'data', 'order', 'order_date','order_time'));
            
}
else{
    return redirect('/shippingInformation');
}
 

        }
        
        // } catch (Exception $e) {
        //     return response()->json(['message' => $e->getMessage()], 502);
        // }
    }


    public function eachCartDelete(){

        $user_id = auth()->user()->id;

       // $carts = Cart::where('user_id',$user_id)->get();

        // foreach($carts as $cart){
        //     $custom_image = $cart->custom_image;
        //     if (isset($custom_image) && $custom_image != "") {
        //     //delete the image 
        //     $uploadPath = public_path('cart');
        //     $existingImagePath = $uploadPath . '/' . $custom_image;
        //     if (file_exists($existingImagePath)) {
        //         unlink($existingImagePath);
        //     }
        // }

        // }

         Cart::where('user_id', $user_id)->delete();


    }


    public function getStateCode($stateName)
    {
        $stateCodes = array(
            "Andaman and Nicobar Islands" => "AN",
            "Andhra Pradesh" => "AP",
            "Arunachal Pradesh" => "AR",
            "Assam" => "AS",
            "Bihar" => "BR",
            "Chandigarh" => "CH",
            "Chhattisgarh" => "CG",
            "Dadra and Nagar Haveli and Daman and Diu" => "DN",
            "Delhi" => "DL",
            "Goa" => "GA",
            "Gujarat" => "GJ",
            "Haryana" => "HR",
            "Himachal Pradesh" => "HP",
            "Jammu and Kashmir" => "JK",
            "Jharkhand" => "JH",
            "Karnataka" => "KA",
            "Kerala" => "KL",
            "Ladakh" => "LA",
            "Lakshadweep" => "LD",
            "Madhya Pradesh" => "MP",
            "Maharashtra" => "MH",
            "Manipur" => "MN",
            "Meghalaya" => "ML",
            "Mizoram" => "MZ",
            "Nagaland" => "NL",
            "Odisha" => "OR",
            "Puducherry" => "PY",
            "Punjab" => "PB",
            "Rajasthan" => "RJ",
            "Sikkim" => "SK",
            "Tamil Nadu" => "TN",
            "Telangana" => "TG",
            "Tripura" => "TR",
            "Uttar Pradesh" => "UP",
            "Uttarakhand" => "UK",
            "West Bengal" => "WB"
        );

        if (isset($stateCodes[$stateName])) {
            return $stateCodes[$stateName];
        }
    }

    public function shipment_manifest($id, $billingAddress,$shipingAddress)
    {
        $orders = Order::where(['id' => $id])->first();

        $result = [];

        $products = $orders->product_details;

        foreach (json_decode($products) as $product) {

            $row["AWB_NUMBER"] = $orders->awb;
            $row["ORDER_NUMBER"] = $orders->order_id;
            $row["PRODUCT"] = "PPD";
            $row["CONSIGNEE"] = $shipingAddress->name;
            $row["CONSIGNEE_ADDRESS1"] = $shipingAddress->street_address1;
            $row["CONSIGNEE_ADDRESS2"] = $shipingAddress->street_address2;
            $row["CONSIGNEE_ADDRESS3"] = $shipingAddress->street_address2;
            $row["DESTINATION_CITY"] = $shipingAddress->city;
            $row["PINCODE"] = $shipingAddress->postal_code;

            $shipingStateName = $shipingAddress->state;
            $stateCode = $this->getStateCode($shipingStateName);

            $row["STATE"] = $stateCode;
            $row["MOBILE"] = $shipingAddress->phone;
            $row["TELEPHONE"] = $shipingAddress->alternate_phone;

            $row["ITEM_DESCRIPTION"] = $product->title;
            $row["PIECES"] = (int) $product->quantity;
            $row["COLLECTABLE_VALUE"] = 0;
            $row["DECLARED_VALUE"] = $product->price;
            $row["ACTUAL_WEIGHT"] = $product->weight;
            $row["VOLUMETRIC_WEIGHT"] = ($product->length * $product->breadth * $product->height) / 5000;
            $row["LENGTH"] = $product->length;
            $row["BREADTH"] = $product->breadth;
            $row["HEIGHT"] = $product->height;
            $row["PICKUP_NAME"] = "Test Pickup Name";
            $row["PICKUP_ADDRESS_LINE1"] = "Test Pickup Address1";
            $row["PICKUP_ADDRESS_LINE2"] = "Test Pickup Address2";
            $row["PICKUP_PINCODE"] = "560034";
            $row["PICKUP_PHONE"] = "7890601534";
            $row["PICKUP_MOBILE"] = "7001086366";
            $row["RETURN_NAME"] = "Test Return Name";
            $row["RETURN_ADDRESS_LINE1"] = "Test Return Address1";
            $row["RETURN_ADDRESS_LINE2"] = "Test Return Address2";
            $row["RETURN_PINCODE"] = "122008";
            $row["RETURN_PHONE"] = "2222222222";
            $row["RETURN_MOBILE"] = "3333333333";
            $row["DG_SHIPMENT"] = "false";

            $row["ADDITIONAL_INFORMATION"] = [
                "GST_TAX_CGSTN" => "",
                "GST_TAX_IGSTN" => "",
                "GST_TAX_SGSTN" => "",
                "SELLER_GSTIN" => "GISTN988787",
                "INVOICE_DATE" => "12-08-2022",
                "INVOICE_NUMBER" => "INVOICE_001",
                "GST_TAX_RATE_SGSTN" => "",
                "GST_TAX_RATE_IGSTN" => "",
                "GST_TAX_RATE_CGSTN" => "",
                "GST_HSN" => "123456",
                "GST_TAX_BASE" => "",
                "GST_ERN" => "123456789876",
                "ESUGAM_NUMBER" => "",
                "ITEM_CATEGORY" => "Gift Items",
                "GST_TAX_NAME" => "",
                "ESSENTIALPRODUCT" => "Y",
                "PICKUP_TYPE" => "WH",
                "OTP_REQUIRED_FOR_DELIVERY" => "Y",
                "RETURN_TYPE" => "WH",
                "GST_TAX_TOTAL" => "",
                "SELLER_TIN" => "",

                "CONSIGNEE_ADDRESS_TYPE" => "HOME",
                "CONSIGNEE_LONG" => "1.4434",
                "CONSIGNEE_LAT" => "2.987",
                "what3words" => "tall.basically.flattered"
            ];


            $result[] = $row;
        }




        $jsonStr = json_encode($result);

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.ecomexpress.in/apiv2/manifest_awb/',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array('username' => 'HACREATIONSLLP914909', 'password' => 'UlewRODjHc', 'json_input' => $jsonStr),
        )
        );

        $res = curl_exec($curl);

        curl_close($curl);

     

    }

    public function cancellShipment(Request $request){
       
        $order_id = $request->input('id');
        $order = Order::where('id',$order_id)->first();


        $apiUrl = 'https://api.ecomexpress.in/apiv2/cancel_awb/';
        $username = 'HACREATIONSLLP914909';
        $password = 'UlewRODjHc';
        $awb = $order->awb;


        $data = array(
            'username' => $username,
            'password' => $password,
            'awbs' => $awb
        );

    $ch = curl_init($apiUrl);

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

    $response = curl_exec($ch);

    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        if ($httpCode === 200) {
            $orderStatus['order_status']=0;
            Order::where('id',$order_id)->update($orderStatus);

            $data=['msg'=>'Order Cancelled Successfully','code'=>200];
        }
        else{
           $data=['msg'=>'Something went wrong','code'=>210];
        }

        return response()->json($data);
        curl_close($ch);

    }


    public function generateInvoice($order_id){
        $title = 'Invoice Generation | CrazzyGift'; 
        $heading = "Invoice";
        
        $order=Order::with('user')->where('id',$order_id)->first();
        $gst =DB::table('gst')
        ->orderBy('id', 'desc')
        ->first();

        $productStr = $order->product_details;
        $products = json_decode($productStr);
            $subtotal =0;
            foreach($products as $product){

                $subtotal = $subtotal + ((int)$product->price * (int)$product->quantity);
            }


        $invoice['userDetails'] = $order->user;
        $invoice['products'] = $products;
        $invoice['amount_captured'] = $order->amount;
        $invoice['billing_address'] = $order->billing_address;
        $invoice['shipping_address'] = $order->shipping_address;
        $invoice['subtotal']=$subtotal;
        $invoice['cgst']=$gst->cgst;
        $invoice['sgst']=$gst->sgst;

        return view('common.InvoiceView',compact('title','heading','invoice'));
    } 

    public function orderStatusUpdate(){
        $orders = Order::where(['order_status'=> 1])->orderBy('id', 'desc')->get();

     //   $trackingData = [];
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

        foreach ($orders as $order){
            if ($order->track_shipping) {

                $id = $order->id;
                $reason_code_number = $order->track_shipping->object->field[14];

                if($reason_code_number == 003){
                    //order shipped update order_status as 2
                    Order::where('id', $id)->update(['order_status' => 2]);

                }
                if($reason_code_number == 005){
                    //order reached hub update order_status as 3
                    Order::where('id', $id)->update(['order_status' => 3]);

                }

                if($reason_code_number == 006){
                    //order out for delivery update order_status as 4
                    Order::where('id', $id)->update(['order_status' => 4]);

                }

                if($reason_code_number == 999){
                    //order deliverd update order_status as 5
                    Order::where('id', $id)->update(['order_status' => 5]);

                }

                 
            }
        }

        echo "<pre>";
        var_dump($orders);
        die;
        

    }

}