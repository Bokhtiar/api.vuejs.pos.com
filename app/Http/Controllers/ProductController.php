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
      $product->category_id = $request->category_id;
      $product->brand_id = $request->brand_id;
      $product->price = $request->price;

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

    
    public function delete($id){
      $delete = Product::find($id)->delete();
      return response()->json($delete, 200);
    }
}
