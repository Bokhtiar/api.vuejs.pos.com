<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Str;

class ProductController extends Controller
{

    public function index(){
      $products = Product::with('category')->get();
      return response()->json($products, 200);
    }

    public function store(Request $request)
    {
      $product = new Product;
      $product->title = $request->title;
      $product->product_code = $request->product_code;
      $product->product_quantity = $request->product_quantity;
      $product->category_id = $request->category_id;
      $product->brand_id = $request->brand_id;
      $product->company_id = $request->company_id;
      $product->product_unit = $request->product_unit;
      $product->product_sell_unit = $request->product_sell_unit;
      $product->product_purchase_unit = $request->product_purchase_unit;
      $product->product_cost_price = $request->product_cost_price;
      $product->price = $request->price;
      $product->pos_display = $request->pos_display;
      $product->description = $request->description;
      $product->product_promotion = $request->product_promotion;
      $product->promotional_price = $request->promotional_price;
      $product->promotion_start_date = $request->promotion_start_date;
      $product->promotion_end_date = $request->promotion_end_date;

        $image=$request->file('image');
             if ($image){
               $image_name=Str::random(20);
               $ext=strtolower($image->getClientOriginalExtension());
               $image_full_name=$image_name.'.'.$ext;
               $upload_path='image/';
               $image_url=$upload_path.$image_full_name;
               $success=$image->move($upload_path,$image_full_name);
                   if ($success) {
                   $product['image']=$image_url;
                }
            }

      $product->save();
      return response()->json($product, 200);

    }

    public function edit($id){
      $edit = Product::find($id);
      return response()->json($edit, 200);
    }

    public function update(Request $request, $id){
      $product = Product::find($id);
      $product->title = $request->title;
      $product->category_id = $request->category_id;
      $product->brand_id = $request->brand_id;
      $product->price = $request->price;
      if($request->image){
        $image=$request->file('image');
             if ($image){
               $image_name=Str::random(20);
               $ext=strtolower($image->getClientOriginalExtension());
               $image_full_name=$image_name.'.'.$ext;
               $upload_path='image/';
               $image_url=$upload_path.$image_full_name;
               $success=$image->move($upload_path,$image_full_name);
                   if ($success) {
                   $product['image']=$image_url;
                }
            }
      }else{
        $product->image = $product->image;
      }

      $product->save();
      return response()->json($product, 200);
    }


    public function search($text){
      $text = $text;
      $product = Product::select("title")
           ->where("title", "LIKE", "%{$text}%")
           ->get();

      return response()->json($product, 200);
    }

    public function category_ways_show($id){
      $product = Product::where('category_id', $id)->get();
      return response()->json($product, 200);
    }

    public function show($id){
      $product = Product::where('id', $id)->with('category', 'brand', 'company')->first();
      return response()->json($product, 200);
    }

    public function company_ways_show($id){
      $product = Product::with('category')->where('company_id', $id)->get();
      return response()->json($product, 200);
    }


    public function delete($id){
      $delete = Product::find($id)->delete();
      return response()->json($delete, 200);
    }
}
