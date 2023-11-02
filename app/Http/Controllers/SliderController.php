<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Slider;
use Exception;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Models\Menu;
use App\Models\Page;
use App\Models\MainCategory;
use App\Models\SubCategory;



class SliderController extends Controller
{
    public function sliderManagement(){
         $title = 'Sliders Mangement | CrazzyGift';
        $heading = "Sliders";

        $products = Product::latest()->get();
        $allBanners = DB::table('banners')->get();
    

       
        return view('admin.SliderView',compact('title','heading','products'));
    }

    public function menuManagement(){
        $title = 'Menu Mangement | CrazzyGift';
        $heading = "Menus";
        $menus = Menu::orderBy('id','desc')->get();
         return view('admin.MenuView',compact('title','heading','menus'));
    }

     public function addMenuView(){
        $title = 'Add Menu | CrazzyGift';
        $heading = "Add Menu";
        $menus = Menu::orderBy('id','desc')->get();
        $is_home = Page::where('status', 4)->exists();
        $categories =  MainCategory::where('status',1)->orderBy('id','desc')->get();
         return view('admin.addMenuView',compact('title','heading','menus','categories','is_home'));
    }

    public function editMenuView($menu_id){

        $result = Menu::with('page')->where('url',$menu_id)->first();
       
        $title = 'Edit Menu | CrazzyGift';
        $heading = "Edit Menu";
        $menus = Menu::orderBy('id','desc')->get();
        $is_home = Page::where('status', 4)->exists();
        $categories =  MainCategory::where('status',1)->orderBy('id','desc')->get();
         return view('admin.editMenuView',compact('title','heading','menus','categories','result','is_home'));
    }




    public function categoryManagement(){
        $title = 'Category Mangement | CrazzyGift';
        $heading = "Category";
        $categories=MainCategory::where('status',1)->get();
         return view('admin.CategoryView',compact('title','heading','categories'));
    }



    public function getAllMenus(){
        //$menus = Menu::orderBy('id', 'desc')->get();

        $menus = Menu::with('parent')->orderBy('id', 'desc')->get(); 

       
        $menus = $menus->map(function ($menu) {
            return [
                'id' => $menu->id,
                'name' => $menu->name,
                'url' => $menu->url,
                'parent_name' => $menu->parent ? $menu->parent->name : null,
                'icon' => $menu->icon,
                'status'=>$menu->status
            
            ];
        });


         return response()->json($menus);
     }

     public function getAllBanners(){
        $banners = Banner::orderBy('id', 'desc')->get(); 
        return response()->json($banners);
     }

     public function getAllCategories(){
        $categories = MainCategory::orderBy('id', 'desc')->get(); 
        return response()->json($categories);
     }


     public function getAllSubcategories(){
        $sub_categories = SubCategory::with('mainCategory')->orderBy('id', 'desc')->get(); 
        return response()->json($sub_categories);
     }

     

     public function getBanner(Request $request){
        $id = $request->input('id');
        $banner = Banner::where('id',$id)->first(); 
        return response()->json($banner);
     }

     public function getSlider(Request $request){
        $id = $request->input('id');
        $slider = Slider::where('id',$id)->first(); 
        return response()->json($slider);
     }


     public function getAllSliders(){
        $sliders = Slider::orderBy('id', 'desc')->get(); 
        foreach($sliders as $slider){
            $productStr = $slider->products;
            $productArr = explode(',',  $productStr);
            $productImages = [];
            foreach ($productArr as $productId) {
                // Fetch the product_image for each product ID
                $product = Product::find($productId);
                if ($product) {
                    $productImages[] = $product->product_image;
                }
            }

            $data['id']= $slider->id;
            $data['type']=$slider->type;
            $data['status']=$slider->status;
            $data['created_at']=$slider->created_at;
            $data['products']=$productArr;
            $data['product_images'] = $productImages;
            $result[]=$data;
        }

       
        return response()->json($result);
     }
     
     

     public function menuDelete(Request $request){
        if($request->has('id')){

            $id = $request->input('id');

            $menu = Menu::find($id);
            $menu->status = ($menu->status == 1) ? 2 : 1;
            $menu->updated_at =date('Y-m-d H:i:s');
            $res=$menu->save();
             if($res){
                return response()->json(['code'=>200,'msg'=>'Menu status changed successfully'],200);
            }
        }
    }

    public function bannerDelete(Request $request){
        if($request->has('id')){

            $id = $request->input('id');

            $banner = Banner::find($id);
            $banner->status = ($banner->status == 1) ? 2 : 1;
            $banner->updated_at =date('Y-m-d H:i:s');
            $res=$banner->save();
             if($res){
                return response()->json(['code'=>200,'msg'=>'Banner status changed successfully'],200);
            }
        }
    }

    public function sliderDelete(Request $request){
        if($request->has('id')){

             $id = $request->input('id');
           $slider = Slider::find($id);

           $ch= Slider::where(['status'=>1,'type'=>$slider->type])->get();
          

           if ($slider->status == 2 ){
            Slider::where(['status'=>1,'type'=>$slider->type])->update(['status'=>2]) ;

            $slider->status = ($slider->status == 1) ? 2 : 1;
            
            $slider->updated_at =date('Y-m-d H:i:s');
           $res=$slider->save();
            if($res){
               return response()->json(['code'=>200,'msg'=>'Slider status changed successfully'],200);
           }
            }
          
            if($slider->status==1){
                
                
                    if(count($ch) < 2){
                        
                        return response()->json(['errors' => ($slider->type==1)? "Atleast one Featured Collection is mandatory" : "Atleast one Best Selling is mandatory"], 400);
                    }
                    else{
                        $slider->status = ($slider->status == 1) ? 2 : 1;
            
                        $slider->updated_at =date('Y-m-d H:i:s');
                       $res=$slider->save();
                        if($res){
                           return response()->json(['code'=>200,'msg'=>'Slider status changed successfully'],200);
                       }
                    }
                  

            }

           


        }
    }


    public function showMenu(Request $request){
        if($request->has('id')){
            $id = $request->input('id');

            $menu = Menu::where('id',$id)->first();
            return response()->json($menu); 
        }
    }

    public function addBanner(Request $request){


        $rules = [
            'image' => 'required',
            'target' => 'required|string',
           
        ];

        $validator = Validator::make($request->all(), $rules);
        
           
            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 400);
            }


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
                  $bannerData['created_at']=date('Y-m-d H:i:s');

           }

            DB::table('banners')->insert($bannerData);
            return response()->json(['msg' => "Banner Added Successfully",'code'=>200], 200);

            }

    }

    public function updateBanner(Request $request){
        $rules = [
            // 'image' => 'required',
            'target' => 'required|string',
           
        ];

        $validator = Validator::make($request->all(), $rules);
        
           
            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 400);
            }

            $target = $request->input('target');
            $bid = $request->input('bid');  

            if ($request->hasFile('image')) {

                $image = $request->file('image');
              
                $image_name = time() . '.' . $image->getClientOriginalExtension();
                $uploadPath = public_path('banners');
       
                   
                    
                    $existing_banner = Banner::where('id',$bid)->first();
                    $existing_banner_img = $existing_banner->image;


                    if (!is_dir($uploadPath)) {
                        mkdir($uploadPath, 0755, true);
                    }

                    if ($existing_banner_img) {
                        // Check if the image already exists and delete it
                        $existingImagePath = $uploadPath . '/' . $existing_banner_img;
                        if (file_exists($existingImagePath)) {
                            unlink($existingImagePath);
                        }
                    }

                    
                  if($image->move($uploadPath, $image_name)){
                        $bannerData['image']=$image_name;
                    }
       
                 }

                    $bannerData['target']=$target;
                    $bannerData['updated_at']=date('Y-m-d H:i:s');
                    DB::table('banners')->where('id',$bid)->update($bannerData);
                    return response()->json(['msg' => "Banner updated successfully",'code'=>200], 200);

    }

    public function addSlider(Request $request){

         $rules = [
                'type' => 'required|string',
                'products' => 'required',
                
            ];
        
           
            $validator = Validator::make($request->all(), $rules);
        
           
            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 400);
            }

            $sliders=DB::table('sliders')->get();

            foreach($sliders as $slider){
                if($slider->status==1 && $slider->type==$request->input('type')){
                    DB::table('sliders')->where('id',$slider->id)->update(['status'=>2]);
                }
            }


        $data['type'] = $request->input('type');
        $productsarr = $request->input('products');

        $data['products'] = implode(',', $productsarr);
        $data['created_at']=date('Y-m-d H:i:s');
        $data['status']=1;

        // var_dump($data);
        // die;

        DB::table('sliders')->insert($data);
         return response()->json(['msg' => "Slider Added Successfully",'code'=>200], 200);


    }

    public function updateSlider(Request $request){
        $rules = [
            'type' => 'required|string',
            'products' => 'required',
            
        ];
    
       
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 400);
            }

        $data['type'] = $request->input('type');
        $productsarr = $request->input('products');

        $data['products'] = implode(',', $productsarr);
        $data['updated_at']=date('Y-m-d H:i:s');
        $sid = $request->input('sid');
        DB::table('sliders')->where('id',$sid)->update($data);
         return response()->json(['msg' => "Slider updated Successfully",'code'=>200], 200);

    
    }


   

    public function addCategory(Request $request){
        
        $rules = [
            'name' => 'required',
          
        ];

         $validator = Validator::make($request->all(), $rules);
        
           
            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 400);
            }

            $data['name']=$request->input('name');
            $data['created_at']=date('Y-m-d H:i:s');
            $res=MainCategory::insert($data);
            if($res){
                return response()->json(['code'=>200,'msg'=>'Category added successfully'],200);
            }


    }

    public function addSubcategory(Request $request){
        $rules = [
            'name' => 'required|string',
            'main_category' =>'required'
        ];

        $validator = Validator::make($request->all(), $rules);
        
           
            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 400);
            }

             $data['name']=$request->input('name');
             $data['main_category']=$request->input('main_category');
            $data['created_at']=date('Y-m-d H:i:s');
            $res=SubCategory::insert($data);
            if($res){
                return response()->json(['code'=>200,'msg'=>'Subcategory added successfully'],200);
            }


            
    }


    

    public function addMenu(Request $request){
     
    $PageData['title'] = $request->input('title');
    $PageData['content'] = $request->input('content');
    $PageData['main_category'] = $request->input('main_category');
    $PageData['sub_category'] = $request->input('sub_category');
    $PageData['status'] = $request->input('fetch_all');
    $PageData['product_price_range'] = $request->input('price_range');
    $PageData['created_at']=date('Y-m-d H:i:s');


    //add menu details

    $Menudata['name'] = $request->input('name');
    $Menudata['url'] = $request->input('url');
    $Menudata['icon'] = $request->input('icon');
    $Menudata['parent_id'] = $request->input('parent_id');
    $Menudata['created_at']=date('Y-m-d H:i:s');
    $Menudata['status']=1;

   
   

    $rules = [
        'name' => 'required|string',
        'url' => 'required|string|unique:menus,url',
        'title' => 'required|string',
    ];
    

   
    $validator = Validator::make($request->all(), $rules);

   
    if ($validator->fails()) {
        return response()->json(['errors' => $validator->errors()], 400);
    }

    $res1= Page::create($PageData);
    $insertedId = $res1->id;


    //add menu details 
    $Menudata['page_id'] = $insertedId;

    $res2= Menu::create($Menudata);
      
      
       if($res1 && $res2){
        return response()->json(['msg' => 'Menu added successfully','code'=>200],200);
       }
        

    }


    public function editMenu(Request $request){
        $PageData['title'] = $request->input('title');
        $PageData['content'] = $request->input('content');
        $PageData['main_category'] = $request->input('main_category');
        $PageData['sub_category'] = $request->input('sub_category');
        $PageData['status'] = $request->input('fetch_all');
        $PageData['product_price_range'] = $request->input('price_range');
        $PageData['updated_at']=date('Y-m-d H:i:s');
    
    
        //add menu details
        $menuId = $request->input('id');
        $row =  Menu::with('page')->where('id',$menuId)->first();
        $page = $row->page;
        $pageId=$page->id;



        $Menudata['name'] = $request->input('name');
        $Menudata['url'] = $request->input('url');
        $Menudata['icon'] = $request->input('icon');
        $Menudata['parent_id'] = $request->input('parent_id');
        $Menudata['updated_at']=date('Y-m-d H:i:s');
        //$Menudata['status']=1;
    
       
       
    
        $rules = [
            'name' => 'required|string',
           // 'url' => 'required|string|unique:menus,url',
            'title' => 'required|string',
        ];
        
    
       
        $validator = Validator::make($request->all(), $rules);
    
       
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }
    
        $res2= Menu::where('id',$menuId)->update($Menudata);

        $res1= Page::where('id',$pageId)->update($PageData);
       
           if($res1 && $res2){
            return response()->json(['msg' => 'Menu updated successfully','code'=>200],200);
           }
            
        
    }






    public function showPageByMenuUrl(Request $request,$url){
        $menu = Menu::where('url', $url)->with('page')->first();

        

        if ($menu) {
            $page = $menu->page;

            if ($page) {

                $main_category = $page->main_category;
                $sub_category = $page->sub_category;
                
                if($page->status==4){
                        //show home page

                        $title = 'Home|CrazzyGift';
                        $banners = Banner::where('status',1)->orderBy('id','desc')->get();
                        $featured_collection = DB::table('sliders')->where(['type'=>1,'status'=>1])->orderBy('id', 'desc')->first();
                        $best_selling = DB::table('sliders')->where(['type'=>2,'status'=>1])->orderBy('id', 'desc')->first();
                
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
                           $data1['slug']=$featured_products->slug;
                
                           $res1[]=$data1;
                        }
                
                        $res2=[];
                        foreach($best_products_ids as $id2){
                          $best_products = Product::where('id',$id2)->first();
                          $data2['id']=$best_products->id;
                          $data2['product_image']=$best_products->product_image;
                          $data2['title']=$best_products->title;
                          $data2['price']=$best_products->price;
                          $data2['slug']=$best_products->slug;
                           $res2[]=$data2;
                        }
                
                   
                        return view('DashboardView', compact('title','banners','res1','res2'));

                }
                else if($page->status==0){
                    //static Content
                    return view('Dynamicpage2', ['page' => $page]);
                }
                else if($page->status==1){
                    if($page->sub_category==null){
                        //main category page
                        $title = $page->title.'|CrazzyGift';
                        $heading = $page->title;
                        $recordsPerPage = 12;
                        $query = '';

                        
                        
                    $result = DB::table('products')->where(['main_category'=>$main_category]);
            
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

                    $url = $menu->url;

                    return view('Dynamicpage1', compact('title', 'products', 'heading', 'totalRecords', 'currentPage', 'recordsPerPage', 'query','url'));


                    }
                    else{
                        //who has main and sub category as well
                        $title = $page->title.'|CrazzyGift';
                        $heading = $page->title;
                        $recordsPerPage = 12;
                        $query = '';

                        
                        
                    $result = DB::table('products')->where(['main_category'=>$main_category,'sub_category'=>$sub_category]);
            
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

                    $url = $menu->url;

                    return view('Dynamicpage1', compact('title', 'products', 'heading', 'totalRecords', 'currentPage', 'recordsPerPage', 'query','url'));

                    }
                }
                else if($page->status==2){
                    //fetch all products

                    $title = $page->title.'|CrazzyGift';
                    $heading = $page->title;
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

                    $url = $menu->url;
            
            
            
            
                    return view('Dynamicpage1', compact('title', 'products', 'heading', 'totalRecords', 'currentPage', 'recordsPerPage', 'query','url'));

                }
                else if($page->status==3){
                    //fetch product with price range
                }

                //return view('page', ['page' => $page]);
            }
        }

        //return response()->view('errors.404', [], 404);
    }
   


}
