<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Product;




class SliderController extends Controller
{
    public function sliderManagement(){
         $title = 'Sliders Mangement | CrazzyGift';
        $heading = "Sliders";

        $products = Product::latest()->get();
        $allBanners = DB::table('banners')->get();
    

       
        return view('admin.SliderView',compact('title','heading','products'));
    }

    public function addBanner(Request $request){

        if ($request->hasFile('image')) {

         $image = $request->file('image');
         $target = $request->input('target');
         $image_name = time() . '.' . $image->getClientOriginalExtension();
         $uploadPath = public_path('banners');


            if (!is_dir($uploadPath)) {
                mkdir($uploadPath, 0755, true);
            }

             
           if($image->move($uploadPath, $image_name)){
                 $bannerData['image']=$image_name;
                  $bannerData['target']=$target;
           }

            DB::table('banners')->insert($bannerData);
            return response()->json(['msg' => "Banner Added Successfully",'code'=>200], 200);

            }

    }

    public function addSlider(Request $request){

        $data['type'] = $request->input('type');
        $productsarr = $request->input('products');

        $data['products'] = implode(',', $productsarr);

        // var_dump($data);
        // die;

        DB::table('sliders')->insert($data);
         return response()->json(['msg' => "Slider Added Successfully",'code'=>200], 200);


    }

   


}
