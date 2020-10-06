<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Banner;
use App\Category;
use App\ProductAttrib;
use App\Product;
use App\Province;
use App\City;
use App\Cart;
use File;
use DB;
use Auth;
use Session;
use Image;

class IndexController extends Controller
{
     public function index(){
        $banner = Banner::where('id', 1)->get();
        $category = Category::all();
        $product = Product::all();
        $productAll = Product::inRandomOrder()->where('feature_item',1)->get();
        return view('shop.product',compact('banner','category','product','total_cart'));
    }
    public function indexdetail($id=null){
        // $productDetail = ProductAttrib::all();
        $productDetail = Product::with('attributes')->where('id',$id)->first();
        $productDetail = json_decode(json_encode($productDetail));
        // echo "<pre>";print_r($productDetail);
        $relatedProducts = Product::where('id','!=',$id)->where(['category_id'=>$productDetail->category_id])->get();
        // $relatedProducts = json_decode(json_encode($relatedProducts));
        // echo "<pre>";print_r($productDetail);

        // foreach ($relatedProducts->chunk(3) as $chunk) {
        //     foreach ($chunk as $item) {
        //         echo $item;echo "<br>";
        //     }echo "<br><br><br>";
        // }
        // die;
        $total_stock = ProductAttrib:: where('product_id',$id)->sum('stock');
        return view('shop.product-detail',compact('productDetail','total_stock','relatedProducts'));
    }
    public function categories($category_id){
        $banner = Banner::where('id', 1)->get();
        $category = Category::all();
        $product = Product::where(['category_id'=>$category_id])->get();
        $product_name = Product::where(['category_id'=>$category_id])->first();
        return view('shop.category',compact('category','product','product_name','banner'));
    }
}
