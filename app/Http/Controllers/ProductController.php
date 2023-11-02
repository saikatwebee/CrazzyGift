<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Exception;
use App\Models\Product;
use App\Models\Cart;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


//use Illuminate\Http\Request;

class ProductController extends Controller
{

   
    public function index(Request $request)
    {

        $title = 'Products|CrazzyGift';
        $heading = "All Products";
        $recordsPerPage = 12;
        $query = '';


        // $products = Product::paginate(12);

        $result = DB::table('products');

        if ($request->has('query')) {


            $query = $request->query('query');

            if ($query === 'price_high_to_low') {
                $result->orderBy('products.price', 'desc');
            } elseif ($query === 'price_low_to_high') {
                $result->orderBy('products.price', 'asc');
            } elseif ($query === 'latest_product') {
                $result->orderBy('products.created_at', 'desc');
            }
           

        }
        else{
            $result->orderBy('products.created_at', 'desc');
        }
        

        $allProducts = $result->get();
        $totalRecords = count($allProducts);
        $currentPage = $request->input('page', 1);
        $offset = ($currentPage - 1) * $recordsPerPage;
        $products = $allProducts->forPage($currentPage, $recordsPerPage);




        return view('ProductView', compact('title', 'products', 'heading', 'totalRecords', 'currentPage', 'recordsPerPage', 'query'));
    }


    public function search(Request $request)
    {

        $searchQuery = $request->input('searchQuery');
        $title = 'Products-Search|CrazzyGift';
        $heading = $searchQuery;
        $recordsPerPage = 12;
        $query = '';

        $result = DB::table('products')
            ->leftJoin('main_categories', 'products.main_category', '=', 'main_categories.id')
            ->leftJoin('sub_categories', 'products.sub_category', '=', 'sub_categories.id')
            ->where('products.title', 'LIKE', '%' . $heading . '%')
            ->orWhere('main_categories.name', 'LIKE', '%' . $heading . '%')
            ->orWhere('sub_categories.name', 'LIKE', '%' . $heading . '%');

            if ($request->has('query')) {


                $query = $request->query('query');
    
                if ($query === 'price_high_to_low') {
                    $result->orderBy('products.price', 'desc');
                } elseif ($query === 'price_low_to_high') {
                    $result->orderBy('products.price', 'asc');
                } elseif ($query === 'latest_product') {
                    $result->orderBy('products.created_at', 'desc');
                }
               
    
            }
            else{
                $result->orderBy('products.created_at', 'desc');
            }




        $allProducts = $result->get();
        $totalRecords = count($allProducts);
        $currentPage = $request->input('page', 1);
        $offset = ($currentPage - 1) * $recordsPerPage;
        $products = $allProducts->forPage($currentPage, $recordsPerPage);


        //         dd([
        //             'query' => $results->toSql(),
        //             'bindings' => $results->getBindings(),
        //             'results' =>  $products,
        //         ]);

        // die;

        // var_dump($query);die;

        return view('SearchView', compact('title', 'products', 'heading', 'totalRecords', 'currentPage', 'recordsPerPage','query','searchQuery'));
    }




    public function product_3d_crystal(Request $request)
    {

        $title = 'Products-3D-Photo-Crystal|CrazzyGift';
        $heading = "3D Crystal";
        $recordsPerPage = 12;
        $query = '';

        $result = DB::table('products')
            ->join('sub_categories', 'products.sub_category', '=', 'sub_categories.id')
            ->select('products.*', 'sub_categories.name as subcategory')
            ->where('sub_categories.name', 'LIKE', '%Crystal%')
            ->orWhere('products.title', 'LIKE', '%Crystal%');

        if ($request->has('query')) {

            $query = $request->query('query');

            if ($query === 'price_high_to_low') {
                $result->orderBy('products.price', 'desc');
            } elseif ($query === 'price_low_to_high') {
                $result->orderBy('products.price', 'asc');
            } elseif ($query === 'latest_product') {
                $result->orderBy('products.created_at', 'desc');
            }

        }
         else{
            $result->orderBy('products.created_at', 'desc');
        }


        $allProducts = $result->get();
        $totalRecords = count($allProducts);
        $currentPage = $request->input('page', 1);
        $offset = ($currentPage - 1) * $recordsPerPage;
        $products = $allProducts->forPage($currentPage, $recordsPerPage);

        // Paginate the results
        // $products = $result->paginate(12);


        return view('Product-3d-photo-crystals', compact('title', 'products', 'heading', 'totalRecords', 'currentPage', 'recordsPerPage', 'query'));
    }

    public function wooden_engraved(Request $request)
    {


        $title = 'Products-Wooden-Engraved|CrazzyGift';
        $heading = "Wooden Engraved";
        $recordsPerPage = 12;
        $query = '';


        $result = DB::table('products')
            ->join('sub_categories', 'products.sub_category', '=', 'sub_categories.id')
            ->select('products.*', 'sub_categories.name as subcategory')
            ->where('sub_categories.name', 'LIKE', '%Wooden%')
            ->orWhere('products.title', 'LIKE', '%Wooden%');


        if ($request->has('query')) {

            $query = $request->query('query');

            if ($query === 'price_high_to_low') {
                $result->orderBy('products.price', 'desc');
            } elseif ($query === 'price_low_to_high') {
                $result->orderBy('products.price', 'asc');
            } elseif ($query === 'latest_product') {
                $result->orderBy('products.created_at', 'desc');
            }

        }
        else{
            $result->orderBy('products.created_at', 'desc');
        }

        $allProducts = $result->get();
        $totalRecords = count($allProducts);
        $currentPage = $request->input('page', 1);
        $offset = ($currentPage - 1) * $recordsPerPage;
        $products = $allProducts->forPage($currentPage, $recordsPerPage);



        return view('Product-wooden-engraved', compact('title', 'products', 'heading', 'totalRecords', 'currentPage', 'recordsPerPage', 'query'));
    }

    public function photo_frames(Request $request)
    {

        $title = 'Products-Photo-Frames|CrazzyGift';
        $heading = "Photo Frames";
        $recordsPerPage = 12;
        $query = '';

        $result = DB::table('products')
            ->join('sub_categories', 'products.sub_category', '=', 'sub_categories.id')
            ->select('products.*', 'sub_categories.name as subcategory')
            ->where('sub_categories.name', 'LIKE', '%Frames%')
            ->orWhere('products.title', 'LIKE', '%Frames%');

        if ($request->has('query')) {

            $query = $request->query('query');

            if ($query === 'price_high_to_low') {
                $result->orderBy('products.price', 'desc');
            } elseif ($query === 'price_low_to_high') {
                $result->orderBy('products.price', 'asc');
            } elseif ($query === 'latest_product') {
                $result->orderBy('products.created_at', 'desc');
            }

        }
        else{
            $result->orderBy('products.created_at', 'desc');
        }

        $allProducts = $result->get();
        $totalRecords = count($allProducts);
        $currentPage = $request->input('page', 1);
        $offset = ($currentPage - 1) * $recordsPerPage;
        $products = $allProducts->forPage($currentPage, $recordsPerPage);

        return view('Product-photo-frames', compact('title', 'products', 'heading', 'totalRecords', 'currentPage', 'recordsPerPage', 'query'));
    }

    public function product_price_low(Request $request)
    {
        //0 to 500
        //$products = Product::whereBetween('price', [0, 500])->paginate(12);
         $title = '0 to 500|CrazzyGift';
        $heading = "0 to 500";
        $recordsPerPage = 12;
        $query = '';

       $result = DB::table('products')
        ->whereBetween('price', [0, 500]);

        if ($request->has('query')) {

            $query = $request->query('query');

            if ($query === 'price_high_to_low') {
                $result->orderBy('products.price', 'desc');
            } elseif ($query === 'price_low_to_high') {
                $result->orderBy('products.price', 'asc');
            } elseif ($query === 'latest_product') {
                $result->orderBy('products.created_at', 'desc');
            }

        }
        else{
            $result->orderBy('products.created_at', 'desc');
        }

        $allProducts = $result->get();
        $totalRecords = count($allProducts);
        $currentPage = $request->input('page', 1);
        $offset = ($currentPage - 1) * $recordsPerPage;
        $products = $allProducts->forPage($currentPage, $recordsPerPage);

        // var_dump($products);
        // die;


       
        return view('Product-low-price', compact('title', 'products', 'heading', 'totalRecords', 'currentPage', 'recordsPerPage', 'query'));
       
    }

    public function product_price_medium(Request $request)
    {
        //1001 to 2000
       // $products = Product::whereBetween('price', [1001, 2000])->paginate(12);
        $title = '1001 to 2000|CrazzyGift';
        $heading = "1001 to 2000";

        $recordsPerPage = 12;
        $query = '';

       $result = DB::table('products')
        ->whereBetween('price', [1001, 2000]);

        if ($request->has('query')) {

            $query = $request->query('query');

            if ($query === 'price_high_to_low') {
                $result->orderBy('products.price', 'desc');
            } elseif ($query === 'price_low_to_high') {
                $result->orderBy('products.price', 'asc');
            } elseif ($query === 'latest_product') {
                $result->orderBy('products.created_at', 'desc');
            }

        }
        else{
            $result->orderBy('products.created_at', 'desc');
        }

        $allProducts = $result->get();
        $totalRecords = count($allProducts);
        $currentPage = $request->input('page', 1);
        $offset = ($currentPage - 1) * $recordsPerPage;
        $products = $allProducts->forPage($currentPage, $recordsPerPage);


       
        return view('Product-medium-price', compact('title', 'products', 'heading', 'totalRecords', 'currentPage', 'recordsPerPage', 'query'));




      
    }

    public function product_price_high(Request $request)
    {
        //2000 and above
       // $products = Product::where('price', '>=', 2000)->paginate(12);
        $title = '2000 and Above|CrazzyGift';
        $heading = "2000 and Above";
        $recordsPerPage = 12;
        $query = '';

       $result = DB::table('products')
            ->where('price', '>=', 2000);

        if ($request->has('query')) {

            $query = $request->query('query');

            if ($query === 'price_high_to_low') {
                $result->orderBy('products.price', 'desc');
            } elseif ($query === 'price_low_to_high') {
                $result->orderBy('products.price', 'asc');
            } elseif ($query === 'latest_product') {
                $result->orderBy('products.created_at', 'desc');
            }

        }
        else{
            $result->orderBy('products.created_at', 'desc');
        }

        $allProducts = $result->get();
        $totalRecords = count($allProducts);
        $currentPage = $request->input('page', 1);
        $offset = ($currentPage - 1) * $recordsPerPage;
        $products = $allProducts->forPage($currentPage, $recordsPerPage);


       
        return view('Product-high-price', compact('title', 'products', 'heading', 'totalRecords', 'currentPage', 'recordsPerPage', 'query'));
       
    }


    public function occasions(Request $request)
    {
        $title = 'Occasions|CrazzyGift';
        $heading = "All Occasions";
        $recordsPerPage = 12;
        $query = '';

        $result = DB::table('products')
            ->join('main_categories', 'products.main_category', '=', 'main_categories.id')
            ->select('products.*', 'main_categories.name as maincategory')
            ->where('main_categories.name', 'LIKE', '%Occasion%');
           

        if ($request->has('query')) {

            $query = $request->query('query');

            if ($query === 'price_high_to_low') {
                $result->orderBy('products.price', 'desc');
            } elseif ($query === 'price_low_to_high') {
                $result->orderBy('products.price', 'asc');
            } elseif ($query === 'latest_product') {
                $result->orderBy('products.created_at', 'desc');
            }

        }
        else{
            $result->orderBy('products.created_at', 'desc');
        }

        $allProducts = $result->get();
        $totalRecords = count($allProducts);
        $currentPage = $request->input('page', 1);
        $offset = ($currentPage - 1) * $recordsPerPage;
        $products = $allProducts->forPage($currentPage, $recordsPerPage);

        // ->paginate(12);

        return view('OccasionsView', compact('title', 'products', 'heading', 'totalRecords', 'currentPage', 'recordsPerPage', 'query'));
    }

    public function product_anniversary(Request $request)
    {


        $title = 'Products-Anniversary|CrazzyGift';
        $heading = "Anniversary";
        $recordsPerPage = 12;
        $query = '';

        $result = DB::table('products')
            ->join('sub_categories', 'products.sub_category', '=', 'sub_categories.id')
            ->select('products.*', 'sub_categories.name as subcategory')
            ->where('sub_categories.name', 'LIKE', '%Anniversary%');
           

        if ($request->has('query')) {

            $query = $request->query('query');

            if ($query === 'price_high_to_low') {
                $result->orderBy('products.price', 'desc');
            } elseif ($query === 'price_low_to_high') {
                $result->orderBy('products.price', 'asc');
            } elseif ($query === 'latest_product') {
                $result->orderBy('products.created_at', 'desc');
            }

        }
        else{
            $result->orderBy('products.created_at', 'desc');
        }

        $allProducts = $result->get();
        $totalRecords = count($allProducts);
        $currentPage = $request->input('page', 1);
        $offset = ($currentPage - 1) * $recordsPerPage;
        $products = $allProducts->forPage($currentPage, $recordsPerPage);



        //  ->paginate(12);
        return view('Product-anniversary', compact('title', 'products', 'heading', 'totalRecords', 'currentPage', 'recordsPerPage', 'query'));
    }

    public function product_birthday(Request $request)
    {


        $title = 'Products-Birthday|CrazzyGift';
        $heading = "Birthday";
        $recordsPerPage = 12;
        $query = '';


        $result = DB::table('products')
        ->join('sub_categories', 'products.sub_category', '=', 'sub_categories.id')
        ->select('products.*', 'sub_categories.name as subcategory')
        ->where('sub_categories.name', 'LIKE', '%Birthday%');

        if ($request->has('query')) {

            $query = $request->query('query');

            if ($query === 'price_high_to_low') {
                $result->orderBy('products.price', 'desc');
            } elseif ($query === 'price_low_to_high') {
                $result->orderBy('products.price', 'asc');
            } elseif ($query === 'latest_product') {
                $result->orderBy('products.created_at', 'desc');
            }

        }
        else{
            $result->orderBy('products.created_at', 'desc');
        }

        $allProducts = $result->get();
        $totalRecords = count($allProducts);
        $currentPage = $request->input('page', 1);
        $offset = ($currentPage - 1) * $recordsPerPage;
        $products = $allProducts->forPage($currentPage, $recordsPerPage);

        //->paginate(12);

        return view('Product-birthday', compact('title', 'products', 'heading', 'totalRecords', 'currentPage', 'recordsPerPage', 'query'));
    }

    public function product_valentines(Request $request)
    {


        $title = 'Products-Valentines|CrazzyGift';
        $heading = "Valentines";
        $recordsPerPage = 12;
        $query = '';


        $result = DB::table('products')
        ->join('sub_categories', 'products.sub_category', '=', 'sub_categories.id')
        ->select('products.*', 'sub_categories.name as subcategory')
        ->where('sub_categories.name', 'LIKE', '%Valentines%');


        if ($request->has('query')) {

            $query = $request->query('query');

            if ($query === 'price_high_to_low') {
                $result->orderBy('products.price', 'desc');
            } elseif ($query === 'price_low_to_high') {
                $result->orderBy('products.price', 'asc');
            } elseif ($query === 'latest_product') {
                $result->orderBy('products.created_at', 'desc');
            }

        }
         else{
            $result->orderBy('products.created_at', 'desc');
        }

        $allProducts = $result->get();
        $totalRecords = count($allProducts);
        $currentPage = $request->input('page', 1);
        $offset = ($currentPage - 1) * $recordsPerPage;
        $products = $allProducts->forPage($currentPage, $recordsPerPage);




        //->paginate(12);
        return view('Product-valentines', compact('title', 'products', 'heading', 'totalRecords', 'currentPage', 'recordsPerPage', 'query'));
    }





    public function details($slug)
    {
        //$product = Product::find($lug);
        $product = Product::where('slug',$slug)->first();
        $similarProducts = Product::where('main_category', $product->main_category)
            ->where('slug', '!=', $slug)
            ->take(4)
            ->get();
        $title = 'Product Details|CrazzyGift';
        return view('ProductDetailsView', compact('title', 'product', 'similarProducts'));
    }

    public function ecom()
    {
        return view('EcomapiView');
    }

    public function serviceAjax(Request $request)
    {
        try {

            $pincode = $request->input('location');


if($pincode!=""){
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
            curl_close($curl);


            $data = json_decode($response);
            if (auth()->check()) {
                $userStatus = 1;
            } else {
                $userStatus = 0;
            }


            if (count($data) > 0) {
                foreach ($data as $row) {
                    if ($row->active) {
                        //return redirect()->back()->with('success', 'Service Available in Your Area');
                        return response()->json(['pincode' => $pincode, 'status' => $userStatus, 'message' => 'Service Available in Your Area', 'code' => 200], 200);
                    } else {
                        // return redirect()->back()->with('error', 'Service Unavailable in Your Area');
                        return response()->json(['message' => 'Service Unavailable in Your Area', 'code' => 210], 200);
                    }
                }
            } else {
                //return redirect()->back()->with('error', 'Service Unavailable in Your Area');
                return response()->json(['message' => 'Service Unavailable in Your Area', 'code' => 210], 200);
            }

}
else{
    return response()->json(['message' => 'Pincode is missing!', 'code' => 210], 200);
}

            

        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 502);
        }
    }

    public function awbAjax()
    {
        try {

            $username = "HACREATIONSLLP914909";
            $password = "UlewRODjHc";
            $count = 1;
            $type = 'EXPP';


            $curl = curl_init();

            curl_setopt_array(
                $curl,
                array(
                    CURLOPT_URL => 'https://clbeta.ecomexpress.in/services/shipment/products/v2/fetch_awb',
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'POST',
                    CURLOPT_POSTFIELDS => array('username' => $username, 'password' => $password, 'count' => $count, 'type' => $type),
                )
            );

            $response = curl_exec($curl);
            curl_close($curl);

            echo $response;
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 502);
        }
    }

    public function manifestAjax()
    {
        try {

            $username = "HACREATIONSLLP914909";
            $password = "UlewRODjHc";



            $curl = curl_init();

            curl_setopt_array(
                $curl,
                array(
                    CURLOPT_URL => 'https://clbeta.ecomexpress.in/services/expp/manifest/v2/expplus',
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
                            'json_input' => '[{
                    "AWB_NUMBER": "111914590534",
                    "ORDER_NUMBER": "12-903624",
                    "PRODUCT": "COD",
                    "CONSIGNEE": "Test shipment do not ship",
                    "CONSIGNEE_ADDRESS1": "Test shipment",
                    "CONSIGNEE_ADDRESS2": "Test shipment",
                    "CONSIGNEE_ADDRESS3": "Test shipment",
                    "DESTINATION_CITY": "Bijapur",
                    "STATE": "Chhattisgarh",
                    "PINCODE": "122012",
                    "TELEPHONE": "9560350578",
                    "MOBILE": "9560350578",
                    "RETURN_NAME": "Test shipment",
                    "RETURN_MOBILE": "9560350578",
                    "RETURN_PINCODE": "110037",
                    "RETURN_ADDRESS_LINE1": "Test shipment",
                    "RETURN_ADDRESS_LINE2": "Test shipment",
                    "RETURN_PHONE": "9560350578",
                    "PICKUP_NAME": "Test shipment",
                    "PICKUP_PINCODE": "110037",
                    "PICKUP_MOBILE": "9560350578",
                    "PICKUP_PHONE": "9560350578",
                    "PICKUP_ADDRESS_LINE1": "Test shipment",
                    "PICKUP_ADDRESS_LINE2": "Test shipment",
                    "COLLECTABLE_VALUE": "1",
                    "DECLARED_VALUE": "1",
                    "ITEM_DESCRIPTION": "Test shipment",
                    "DG_SHIPMENT": "false",
                    "PIECES": 1,
                    "HEIGHT": "1",
                    "BREADTH": "1",
                    "LENGTH": "1",
                    "VOLUMETRIC_WEIGHT": 0,
                    "ACTUAL_WEIGHT": 0.5,
                    "ADDITIONAL_INFORMATION": [{}],
                    "GST_TAX_RATE_SGSTN": 0,
                    "GST_TAX_IGSTN": 179.82,
                    "DISCOUNT": 0,
                    "GST_TAX_RATE_IGSTN": 18,
                    "GST_TAX_BASE": 1,
                    "GST_TAX_SGSTN": 0,
                    "INVOICE_DATE": "2022-08-18",
                    "SELLER_GSTIN": "36XXX1230X1X6",
                    "GST_TAX_RATE_CGSTN": 0,
                    "GST_HSN": "33049990",
                    "GST_TAX_NAME": "CHHATTISGARHGST",
                    "INVOICE_NUMBER": "12-903624",
                    "GST_TAX_TOTAL": 1,
                    "GST_TAX_CGSTN": 0,
                    "GST_ERN": "123456789012",
                    "ITEM_CATEGORY": "SKINCARE",
                    "ESSENTIAL_PRODUCT": "N",
                    "CONSIGNEE_LAT": "22.22",
                    "CONSIGNEE_LONG": "44.56"
                }]'
                        ),
                )
            );

            $response = curl_exec($curl);

            curl_close($curl);

            echo $response;
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 502);
        }
    }

    public function addToCart(Request $request)
    {
        try {
            $productId = trim($request->input('product_id'));
            $quantity = trim($request->input('quantity'));
            $pincode = trim($request->input('pincode'));

            $product = Product::find($productId);

            if (auth()->check()) {
                //for logged in users
                //need to store cart data into database
                $data['user_id'] = auth()->user()->id;
                $data['product_id'] = $productId;

                $data['pincode'] = $pincode;

                $rules = [
                    'product_id' => 'required',
                    'quantity' => 'required|min:1|max:15',
                    'pincode' => 'required',
                ];

                $validator = Validator::make($request->all(), $rules);

                if ($validator->fails()) {
                    return response()->json(['info' => $validator->errors()->toJson(), 'message' => 'Oops Invalid data request!',], 400);
                } 
                else {
                    //DB::enableQueryLog();

                    if (Cart::where(['product_id' => $product->id, 'user_id' => auth()->user()->id])->exists()) {

                        $existingCart = Cart::where(['product_id' => $product->id, 'user_id' => auth()->user()->id])->first();
                        $newQuantity = (int) $quantity + (int) $existingCart->quantity;
                        $data['quantity'] = $newQuantity;
                        DB::table('carts')->where(['product_id' => $product->id, 'user_id' => auth()->user()->id])->update($data);


                    } else {
                        // Cart::create($data);
                        $data['quantity'] = $quantity;
                        DB::table('carts')->insert($data);
                    }

                    // $lastQuery = DB::getQueryLog();
                    // $lastQuery = end($lastQuery);


                    //return redirect()->route('shippingcart')->with('cartsuccess', 'Item added to cart');
                    return response()->json(['message' => 'Item added to cart', 'code' => 200], 200);
                }
            } else {
                //for guest users
                //need to store cart data into browser
                $data['id'] = uniqid();
                $data['productId'] = $product->id;
                $data['title'] = $product->title;
                $data['main_category'] = $product->main_category;
                $data['sub_category'] = $product->sub_category;
                $data['L3_category'] = $product->L3_category;
                $data['description'] = $product->description;
                $data['product_image'] = $product->product_image;
                $data['product_type'] = $product->product_type;

                $data['weight'] = $product->weight;
                $data['height'] = $product->height;
                $data['length'] = $product->length;
                $data['breadth'] = $product->breadth;
                $data['price'] = $product->price;
                $data['gst'] = $product->gst;
                $data['discount'] = $product->discount;
                $data['sale'] = $product->sale;
                $data['status'] = $product->status;
                $data['quantity'] = $quantity;
                $data['pincode'] = $pincode;
                // $lastQuery="";
                return response()->json(['message' => 'Item added to cart', 'code' => 210, 'data' => $data], 200);
            }
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 502);
        }
    }

    public function transferCart(Request $request)
    {
        try {

            $data = $request->all();

            if ($data) {
                if (count($data) > 0) {

                    // foreach ($data as $cartItem) {

                    //     $cartItem['user_id'] = auth()->user()->id;
                    //     DB::table('carts')->insert($cartItem);
                    // }
                    
                    $user_id = auth()->user()->id;

                    foreach ($data as $cartItem) {

                        $cartItem['user_id'] = $user_id;

                        if (Cart::where(['user_id' => $user_id, 'product_id' => $cartItem['product_id']])->exists()) {

                            $existingCart = Cart::where(['user_id' => $user_id, 'product_id' => $cartItem['product_id']])->first();

                            $cartItem['quantity'] = (int) $existingCart->quantity + (int) $cartItem['quantity'];

                            DB::table('carts')->where(['user_id' => $user_id, 'product_id' => $cartItem['product_id']])->update($cartItem);

                        } else {
                            DB::table('carts')->insert($cartItem);
                        }


                    }

                    return response()->json(['msg' => 'Success'], 200);
                }
            }

        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 502);
        }
    }


    public function deleteCart(Request $request)
    {
        $id = $request->input('id');
        $user_id = auth()->user()->id;

        $cart = Cart::where(['user_id' => $user_id, 'id' => $id])->first();

        if (isset($cart->custom_image) && $cart->custom_image != "") {
            //delete the image 
            $uploadPath = public_path('cart');
            $existingImagePath = $uploadPath . '/' . $cart->custom_image;
            if (file_exists($existingImagePath)) {
                unlink($existingImagePath);
            }
        }

        $res = Cart::where(['user_id' => $user_id, 'id' => $id])->delete();
        if ($res)
            return response()->json(['msg' => 'Cart Details Delted Successfully'], 200);
    }

    public function customUpload(Request $request)
    {

        
        $rules = [
            'custom_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:5242880',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        } 



        if ($request->hasFile('custom_image')) {



            $image = $request->file('custom_image');
            $image_name = time() . '.' . $image->getClientOriginalExtension();
            $uploadPath = public_path('cart');


            if (!is_dir($uploadPath)) {
                mkdir($uploadPath, 0755, true);
            }

            if ($request->has('id')) {
                $cart_id = $request->input('id');

                if (is_numeric($cart_id)) {

                    $cart = Cart::where('id', $cart_id)->first();

                    if ($cart->custom_image != "") {

                        $existingImagePath = $uploadPath . '/' . $cart->custom_image;

                        if (file_exists($existingImagePath)) {
                            unlink($existingImagePath);
                        }
                    }
                    $image->move($uploadPath, $image_name);

                    DB::table('carts')->where('id', $cart_id)->update(array('custom_image' => $image_name));




                } else {

                    if ($request->has('local_image')) {
                        $existingImagePath = $uploadPath . '/' . $request->input('local_image');

                        if (file_exists($existingImagePath)) {
                            unlink($existingImagePath);
                        }
                    }

                    // Store the new image with the same name
                    $image->move($uploadPath, $image_name);


                }
                return response()->json(['code'=>200,'msg' => "Cart Image uploaded successfully", 'custom_image' => $image_name, 'uid' => $request->input('id')], 200);
            }



        }
    }
    public function customMessage(Request $request)
    {
        // dd($request->all());
        if ($request->has('id')) {
            $cart_id = $request->input('id');
            $data['custom_text'] = $request->input('custom_text');
            Cart::where('id', $cart_id)->update($data);
            return response()->json(['msg' => 'Message updated successfully.'], 200);
        }


    }

    public function guestCartImgDelete(Request $request)
    {
        if ($request->has('custom_image')) {
            $custom_image = $request->input('custom_image');

            if ($custom_image) {
                //delete the image 
                $uploadPath = public_path('cart');
                $existingImagePath = $uploadPath . '/' . $custom_image;
                if (file_exists($existingImagePath)) {
                    unlink($existingImagePath);
                }

                // return response()->json(['msg'=>"Image file deleted successfully",'code'=>200],200);
            }
            return response()->json(['msg' => "Image file deleted successfully", 'code' => 200], 200);
        }
    }

    public function normalCartImgDelete(Request $request)
    {
        if ($request->has('id')) {
            $id = $request->input('id');
            $cart = Cart::where('id', $id)->first();

            if ($cart->custom_image) {
                $custom_image = $cart->custom_image;
                //delete the image 
                $uploadPath = public_path('cart');
                $existingImagePath = $uploadPath . '/' . $custom_image;
                if (file_exists($existingImagePath)) {
                    unlink($existingImagePath);
                }


                Cart::where('id', $id)->update(['custom_image' => null]);

            }

            return response()->json(['msg' => "Image file deleted successfully", 'code' => 200], 200);

        }
    }

    public function cartUpdateNormal(Request $request)
    {
        try {
            $id = $request->input('id');
            $data['quantity'] = $request->input('quantity');

            $res = Cart::where('id', $id)->update($data);
            if ($res)
                return response()->json(['msg' => "Cart updated successfully", 'code' => 200, 'response' => Cart::where('user_id', auth()->user()->id)->with('product')->get()], 200);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 502);
        }
    }

    public function cartValidation(){
        $user_id =auth()->user()->id;

        $data = Cart::where('user_id',$user_id)->get();

        
        $allObjectsHaveCustomData = true;

        foreach ($data as $item) {
             if (!isset($item->custom_text) || !isset($item->custom_image)) {
                $allObjectsHaveCustomData = false;
                break; 
            }
        }

    if ($allObjectsHaveCustomData) {
    
        return response()->json(['code'=>200,'msg'=>'proceed to payment'],200);
    
    } else {

         return response()->json(['code'=>210,'msg'=>"Image or Message is missing for atleast one item in the cart."],200);
    
       
    }
}

public function editCustomMessage(Request $request){
    try{
        $id = $request->input('id');
        $data['custom_text'] = $request->input('custom_text');

        if($id!=""){
            $res = Cart::where('id',$id)->update($data);
            if($res){
                return response()->json(['code'=>200,'msg'=>'Message updated successfully.'],200);
            }

        }
    }
    catch (Exception $e) {
        return response()->json(['message' => $e->getMessage()], 502);
    }
}

}