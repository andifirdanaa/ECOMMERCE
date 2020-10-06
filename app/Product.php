<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;
use Session;
use DB;

class Product extends Model
{
    public function category(){
        return $this->belongsTo(Category::class, 'category_id');
                                        // yg mau diambil , yg mau make
      }
     public function attributes(){
        return $this->hasMany('App\ProductAttrib','product_id');
    }
      public function getImage()
        {
        	if(!$this->image){
        		return asset('img/default.png');
        	}
        	
        		return asset('images/'.$this->image);
        }
        public static function cartCount(){
            if(Auth::check()){
                $user_email = Auth::User()->email;
                $cartCount = DB::table('cart')->where('user_email',$user_email)->sum('quantity');
            }else{
                $session_id = Session::get('session_id');
                $cartCount = DB::table('cart')->where('session_id',$session_id)->sum('quantity');
            }
            return $cartCount;
        }
        public static function productCount($cat_id){
            $catCount = Product::where(['category_id'=>$cat_id])->count();
            return $catCount;
        }
        public static function getProductStock($product_id,$product_size){
            $getProductStock = ProductAttrib::select('stock')->where(['product_id'=>$product_id,'size'=>$product_size])->first();
            return $getProductStock->stock;
        }
        public static function getProductPrice($product_id,$product_size){
            $getProductPrice = ProductAttrib::select('price')->where(['product_id'=>$product_id,'size'=>$product_size])->first();
            return $getProductPrice->price;
        }
        public static function deleteCartProduct($product_id, $user_email){
                DB::table('cart')->where(['product_id'=>$product_id,'user_email'=>$user_email])->delete();
        }
        // public static function getProductStatus($product_id){
        //     $getProductStatus = Product::select('status')->where('id',$product_id)->first();
        //     return $getProductStatus->status;
        // }
        public static function getAttributeCount($product_id,$product_size){
            $getAttributeCount = ProductAttrib::where(['product_id'=>$product_id,'size'=>$product_size])->count();
            return $getAttributeCount;
        }
        public static function getShippingCharges($city){
            $shippingDetails = ShippingCharges::where('city',$city)->first();
            $shipping_charges = $shippingDetails->shipping_charges;
            return $shipping_charges;
        }
        public static function getGrandTotal(){
            $getGrandTotal = "";
            $username = Auth::User()->email;
            $userCart = DB::table('cart')->where('user_email',$username)->get();
            $userCart = json_decode(json_encode($userCart),true);
            // echo "<pre>";print_r($userCart);die;
            foreach ($userCart as $product){
                $productPrice = ProductAttrib::where(['product_id'=>$product['product_id'],'size'=>$product['size']])->first();
                $priceArray[] = $productPrice->price;
            }
            $grandTotal = array_sum($priceArray) - Session::get('CouponAmount') + Session::get('shippingCharges');
            // return $grandTotal;
            echo $grandTotal; die;
        }
}
