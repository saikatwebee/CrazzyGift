<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Exception;
use App\Models\Product;
use App\Models\MainCategory;
use App\Models\SubCategory;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Str;



class ProductInventoryController extends Controller
{

    public function all_products()
    {
        $title = 'Products|CrazzyGift';
        $heading = "All Products";
        $categories =  MainCategory::where('status', 1)->orderBy('id', 'desc')->get();
        $subcategories =  SubCategory::where('status', 1)->orderBy('id', 'desc')->get();
        return view('admin.ProductsView', compact('title', 'heading', 'categories', 'subcategories'));
    }

    public function inactive_products()
    {
        $title = 'Products|CrazzyGift';
        $heading = "Inactive Products";
        $categories =  MainCategory::where('status', 1)->orderBy('id', 'desc')->get();
        $subcategories =  SubCategory::where('status', 1)->orderBy('id', 'desc')->get();
        return view('admin.InactiveProductsView', compact('title', 'heading', 'categories', 'subcategories'));
    }

    public function getAllProducts()
    {
        $products = Product::with('mainCategory', 'subCategory')->orderBy('id', 'desc')->get();
        return response()->json($products);
    }

    public function getAllInactiveProducts()
    {
        $products = Product::with('mainCategory', 'subCategory')->where('status', 2)->orderBy('id', 'desc')->get();
        return response()->json($products);
    }

    public function Addproducts()
    {
        $title = 'Products|CrazzyGift';
        $heading = "Add New Product";
        $categories =  MainCategory::where('status', 1)->orderBy('id', 'desc')->get();
        $subcategories = SubCategory::where('status', 1)->orderBy('id', 'desc')->get();
        return view('admin.AddProductView', compact('title', 'heading', 'categories', 'subcategories'));
    }

    public function getDependent(Request $request)
    {
        $main_category = $request->input('id');
        $sub_cat = SubCategory::where('main_category', $main_category)->orderBy('id', 'desc')->get();
        return response()->json($sub_cat);
    }


    public function getCategory(Request $request)
    {

        $id = $request->input('id');
        $main_category = MainCategory::where('id', $id)->first();
        return response()->json($main_category);
    }

    public function getSubcategory(Request $request)
    {
        $id = $request->input('id');
        $sub_cat = SubCategory::where('id', $id)->first();
        return response()->json($sub_cat);
    }

    public function updateCategory(Request $request)
    {

        $id = $request->input('id');

        $rules = [
            'name' => 'required',

        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $data['name'] = $request->input('name');
        $data['updated_at'] = date('Y-m-d H:i:s');

        $res = MainCategory::where('id', $id)->update($data);

        if ($res) {
            return response()->json(['code' => 200, 'msg' => 'Category updated successfully.'], 200);
        }
    }

    public function updateSubcategory(Request $request)
    {
        $rules = [
            'name' => 'required|string',
            'main_category' => 'required'
        ];

        $validator = Validator::make($request->all(), $rules);


        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $id = $request->input('id');

        $data['name'] = $request->input('name');
        $data['main_category'] = $request->input('main_category');
        $data['updated_at'] = date('Y-m-d H:i:s');

        $res = SubCategory::where('id', $id)->update($data);

        if ($res) {
            return response()->json(['code' => 200, 'msg' => 'Subcategory updated successfully'], 200);
        }
    }




    public function categoryChange(Request $request)
    {
        if ($request->has('id')) {

            $id = $request->input('id');

            $category = MainCategory::find($id);
            $category->status = ($category->status == 1) ? 2 : 1;
            $category->updated_at = date('Y-m-d H:i:s');
            $res = $category->save();
            if ($res) {
                return response()->json(['code' => 200, 'msg' => 'Category status changed successfully'], 200);
            }
        }
    }

    public function categoryDelete(Request $request)
    {
        if ($request->has('id')) {

            $id = $request->input('id');

            $res = MainCategory::where('id', $id)->delete();

            if ($res) {
                return response()->json(['code' => 200, 'msg' => 'Category deleted successfully'], 200);
            }
        }
    }

    public function subcategoryChange(Request $request)
    {
        if ($request->has('id')) {

            $id = $request->input('id');

            $sub_cat = SubCategory::find($id);
            $sub_cat->status = ($sub_cat->status == 1) ? 2 : 1;
            $sub_cat->updated_at = date('Y-m-d H:i:s');
            $res = $sub_cat->save();
            if ($res) {
                return response()->json(['code' => 200, 'msg' => 'Subcategory status changed successfully'], 200);
            }
        }
    }

    public function subcategoryDelete(Request $request)
    {
        if ($request->has('id')) {

            $id = $request->input('id');

            $res = SubCategory::where('id', $id)->delete();

            if ($res) {
                return response()->json(['code' => 200, 'msg' => 'Subcategory deleted successfully'], 200);
            }
        }
    }

    public function productDelete(Request $request)
    {

        if ($request->has('id')) {

            $productId = $request->input('id');

            $res =  Product::where('id', $productId)->delete();
            if ($res) {
                return response()->json(['code' => 200, 'msg' => 'Product deleted successfully'], 200);
            }
        }
    }

    public function productChange(Request $request)
    {


        if ($request->has('id')) {

            $productId = $request->input('id');

            $product = Product::find($productId);
            $product->status = ($product->status == 1) ? 2 : 1;
            $product->updated_at = date('Y-m-d H:i:s');
            $res = $product->save();
            if ($res) {
                return response()->json(['code' => 200, 'msg' => 'Product status changed successfully'], 200);
            }
        }
    }




    public function subproducts(Request $request)
    {


        $rules = [
            'title' => 'required|unique:products',
            'code' => 'required',
            'sku' => 'required',
            'main_category' => 'required',
            // 'sub_category' => 'required',
            'weight' => 'required|numeric',
            'height' => 'required|numeric',
            'length' => 'required|numeric',
            'breadth' => 'required|numeric',
            'product_height' => 'required|numeric',
            'product_length' => 'required|numeric',
            'product_breadth' => 'required|numeric',
            'price' => 'required|numeric',
            'actual_price' => 'required|numeric',
            'gst' => 'required',
            'status' => 'required',
            'description' => 'required',
            'product_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:5242880',
            'product_alt_image.*' => 'image|mimes:jpeg,png,jpg,gif|max:5242880',



        ];



        $validator = Validator::make($request->all(), $rules);


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

                // Handle multiple alternative product images
                $altImageNames = [];
                if ($request->hasFile('product_alt_image')) {
                    $altUploadPath = public_path('product_alt');

                    if (!is_dir($altUploadPath)) {
                        mkdir($altUploadPath, 0755, true);
                    }

                    foreach ($request->file('product_alt_image') as $altImage) {
                        $altImageName = time() . '_' . $altImage->getClientOriginalName();
                        $altImage->move($altUploadPath, $altImageName);
                        $altImageNames[] = $altImageName;
                    }
                }

                $tag_arr = $request->input('tags');
                $tags = $string = implode(", ", $tag_arr);


                $data =   [
                    'title' => $request->input('title'),
                    'code' => $request->input('code'),
                    'sku' => $request->input('sku'),
                    'main_category' => $request->input('main_category'),
                    'sub_category' => $request->input('sub_category'),
                    'weight' => $request->input('weight'),
                    'height' => $request->input('height'),
                    'length' => $request->input('length'),
                    'breadth' => $request->input('breadth'),
                    'product_height' => $request->input('product_height'),
                    'product_length' => $request->input('product_length'),
                    'product_breadth' => $request->input('product_breadth'),
                    'price' => $request->input('price'),
                    'actual_price' => $request->input('actual_price'),
                    'gst' => $request->input('gst'),
                    'status' => $request->input('status'),
                    'description' => $request->input('description'),
                    'product_image' => $imageName,
                    'product_alt_images' => json_encode($altImageNames),
                    'slug' => Str::slug($request->input('title')),
                    'created_at' => date('Y-m-d H:i:s'),
                    'tags' => $tags
                ];


                DB::table('products')->insert($data);

                return redirect()->route('admin.product.all')->with('success', 'Product added successfully');
            } else {

                return redirect()->back()->with('error', 'Image upload failed!');
            }
        }
    }


    public function getProduct(Request $request)
    {

        if ($request->has('id')) {

            $productId = $request->input('id');
            $product = Product::where('id', $productId)->first();

            return response()->json($product);
        }
    }


    public function editProduct(Request $request)
    {

        try {

            $id = $request->input('id');
            $rules = [
                'title' => 'required|string|',
                'code' => 'required|string',
                'sku' => 'required|string',
                'main_category' => 'required',
                'sub_category' => 'required',
                // 'description' => 'required|string',
                'weight' => 'required|string',
                'height' => 'required|string',
                'length' => 'required|string',
                'breadth' => 'required|string',
                'product_height' => 'required|string',
                'product_length' => 'required|string',
                'product_breadth' => 'required|string',
                'price' => 'required|numeric',
                'gst' => 'required',
                // 'actual_price' => 'required|numeric',
                'status' => 'required',
                'slug' => 'required',



            ];



            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 400);
            }


            $data['title'] = $request->input('title');
            $data['code'] = $request->input('code');
            $data['sku'] = $request->input('sku');
            $data['main_category'] = $request->input('main_category');
            $data['sub_category'] = $request->input('sub_category');

            $data['description'] = $request->input('description');
            $data['weight'] = $request->input('weight');
            $data['height'] = $request->input('height');
            $data['length'] = $request->input('length');
            $data['breadth'] = $request->input('breadth');

            $data['product_length'] = $request->input('product_length');
            $data['product_height'] = $request->input('product_height');
            $data['product_breadth'] = $request->input('product_breadth');

            $data['price'] = $request->input('price');
            $data['actual_price'] = $request->input('actual_price');
            $data['gst'] = $request->input('gst');
            $data['status'] = $request->input('status');
            $data['slug'] = $request->input('slug');

            $tag_arr = $request->input('tags');
            // var_dump($tag_arr);
            // die;
            if ($tag_arr != null) {
                $tags = $string = implode(", ", $tag_arr);
                $data['tags'] = $tags;
            }


            $data['updated_at'] = date('Y-m-d H:i:s');

            $product = Product::where('id', $id)->first();

            if ($request->hasFile('product_image')) {

                $image = $request->file('product_image');
                $image_name = time() . '.' . $image->getClientOriginalExtension();
                $uploadPath = public_path('products');


                if (!is_dir($uploadPath)) {

                    mkdir($uploadPath, 0755, true);
                }


                if ($request->has('id')) {


                    if ($product->product_image != "") {

                        $existingImagePath = $uploadPath . '/' . $product->product_image;

                        if (file_exists($existingImagePath)) {
                            unlink($existingImagePath);
                        }
                    }


                    $image->move($uploadPath, $image_name);

                    $data['product_image'] = $image_name;
                }
            }


            // Handle multiple alternative product images
            if ($request->hasFile('product_alt_image')) {
                $altImageNames = [];
                $altUploadPath = public_path('product_alt');

                if (!is_dir($altUploadPath)) {
                    mkdir($altUploadPath, 0755, true);
                }

                // Delete existing product_alt_images
                $existingAltImages = json_decode($product->product_alt_images, true);

                if ($existingAltImages) {
                    foreach ($existingAltImages as $altImage) {
                        $existingAltImagePath = $altUploadPath . '/' . $altImage;
                        if (file_exists($existingAltImagePath)) {
                            unlink($existingAltImagePath);
                        }
                    }
                }


                foreach ($request->file('product_alt_image') as $altImage) {
                    $altImageName = time() . '_' . $altImage->getClientOriginalName();
                    $altImage->move($altUploadPath, $altImageName);
                    $altImageNames[] = $altImageName;
                }

                $data['product_alt_images'] = json_encode($altImageNames);
            }


            $res = DB::table('products')->where('id', $id)->update($data);

            if ($res)

                return response()->json(['code' => 200, 'msg' => 'Product details updated Successfully'], 200);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 502);
        }
    }
}
