<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Exception;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;



class ProductInventoryController extends Controller
{
   
    public function all_product(){
        $title = 'Products|CrazzyGift';
        $heading = "All Products";

       return view('admin.ProductsView', compact('title','heading'));
    }

    public function getAllProducts(){
       $products = Product::with('mainCategory','subCategory')->get();
        return response()->json($products);
    }

    public function Addproducts(){
        $title = 'Products|CrazzyGift';
        $heading = "All New Product";

       return view('admin.AddProductView', compact('title','heading'));
    }

    public function productDelete(Request $request){

        if($request->has('id')){

            $productId = $request->input('id');

            $res = Product::where('id',$productId)->delete();

            if($res){
                return response()->json(['code'=>200,'msg'=>'Product Deleted successfully'],200);
            }
        }
    }

    public function subproducts(Request $request){
   
   
          $rules = [
        'title' => 'required',
        'code' => 'required',
        'main_category' => 'required',
        'sub_category' => 'required',
        'weight' => 'required|numeric',
        'height' => 'required|numeric',
        'length' => 'required|numeric',
        'breadth' => 'required|numeric',
        'price' => 'required|numeric',
        'status' => 'required',
        'description' => 'required',
        'product_image' => 'required|image|max:5000', // Max 5MB
    ];

    // Create a validator instance
    $validator = Validator::make($request->all(), $rules);

    // Check if the validation fails
    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }


 
    // Handle file upload and storage
    if ($request->hasFile('product_image')) {



        $image = $request->file('product_image');
       
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $uploadPath = public_path('products'); 

            // Create the 'images' directory if it doesn't exist
            if (!is_dir($uploadPath)) {
                mkdir($uploadPath, 0755, true);
            }

          //  $image->move($uploadPath, $imageName);

          

        if ($image->move($uploadPath, $imageName)) {
            // File has been successfully uploaded

         $data =   [
        'title' => $request->input('title'),
        'code' => $request->input('code'),
        'main_category' => $request->input('main_category'),
        'sub_category' => $request->input('sub_category'),
        'weight' => $request->input('weight'),
        'height' => $request->input('height'),
        'length' => $request->input('length'),
        'breadth' => $request->input('breadth'),
        'price' => $request->input('price'),
        'status' => $request->input('status'),
        'description' => $request->input('description'),
        'product_image' => $imageName,
    ];

    

    DB::table('products')->insert($data);

    return redirect()->back()->with('success', 'Product added successfully');
   
        } else {
                
           return redirect()->back()->with('error', 'Image upload failed!');
        }

    }

   }
  

    public function getProduct(Request $request){

        if($request->has('id')){

            $productId = $request->input('id');
           $product = Product::where('id',$productId)->first();

           return response()->json($product);
        }
    }


    public function editProduct(Request $request){

        try {

                

                $data['title']=$request->input('title');
                $data['code']=$request->input('code');
                $data['main_category']=$request->input('main_category');
                $data['sub_category']=$request->input('sub_category');

                $data['description']=$request->input('description');
                $data['weight']=$request->input('weight');
                $data['height']=$request->input('height');
                $data['length']=$request->input('length');
                $data['breadth']=$request->input('breadth');
                $data['price']=$request->input('price');
                $data['status']=$request->input('status');



            if ($request->hasFile('product_image')) {
            
                $image = $request->file('product_image');
                $image_name = time() . '.' . $image->getClientOriginalExtension();
                $uploadPath = public_path('products');


                if (!is_dir($uploadPath)) {

                    mkdir($uploadPath, 0755, true);
                }


                 if ($request->has('id')) {

                        $id = $request->input('id');
                        $product = Product::where('id', $id)->first();

                        

                            if ($product->product_image != "") {

                                $existingImagePath = $uploadPath . '/' . $product->product_image;

                                if (file_exists($existingImagePath)) {
                                        unlink($existingImagePath);
                                }
                            }


                            $image->move($uploadPath, $image_name);

                            $data['product_image']=$image_name;

                            

                    }

        }


       $res = DB::table('products')->where('id', $id)->update($data);

       if($res)

        return response()->json(['code'=>200,'msg'=>'Shipping Address updated Successfully'],200);





           // foreach($request->all() as $result){
                
           //      if($result['name']=="_token"){
           //          continue;
           //      }
           //      $data[$result['name']] = trim($result['value']);
           //  }


       
           //      $id = $data['id'];

           //      if ($id  != "") {
           //      //update 
           //      Product::where(['id' => $id])->update($data);

           //      return response()->json(['code'=>200,'msg'=>'Shipping Address updated Successfully'],200);
           //  }



        } 
        catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 502);
        }
    }

}
