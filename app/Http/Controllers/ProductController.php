<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Http;
use Kavist\RajaOngkir\Facades\RajaOngkir;
use Illuminate\Support\Facades\Mail;
use GuzzleHttp\Client;
use App\Product;
use App\Category;
use App\ProductAttrib;
use App\User;
use App\Cart;
use App\Coupon;
use App\Country;
use App\DeliveryAddress;
use App\City;
use App\Province;
use App\Courier;
use App\Order;
use App\OrdersProduct;
use App\Banner;
use Dompdf\Dompdf;
use File;
use DB;
use Auth;
use Session;
use Image;


class ProductController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product = Product::paginate(10);
        $no = 1;
        $category = Category::all();

        return view('product.index',compact('product','category','no'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = Category::all();
        return view ('product.create',compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_product'      => 'required',
            'category_id'=>'required',
            'name_product'     => 'required',
            'product_color'  => 'required',
            'product_description'   => 'required',
            'image' => 'required|image|mimes:jpg,png,jpeg,svg|max:3048',
            'product_prize' => 'required',
        ]);
        $data = $request->all();
        $product = new Product;
        $product->id_product = $request->id_product;
        $product->category_id = $request->category_id;
        $product->name_product = $request->name_product;
        $product->product_color = $request->product_color;
        $product->product_description = $request->product_description;
       if($request->hasFile('image')){
            $file = $request->file('image');
            $fileName = time().'.'.$file->getClientOriginalExtension();
            $destinationPath = public_path('images');
            $file->move($destinationPath , $fileName);
            $product->image = $fileName;
        }
        if(empty($data['feature_item'])){
          $data['feature_item'] = 0;
        }else{
            $data['feature_item']=1;
        }
        $product->feature_item = $data['feature_item'];
        $product->product_prize = $request->product_prize;

        $product->save();
        return redirect()->route('product.index')->withStatus(__('Status successfully created.'));
    }

    public function show($id){
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);
        $category = Category::all();
        return view('product.edit', compact('product','category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();
       	$product = Product::find($id);
        $product->id_product = $request->id_product;
        $product->category_id = $request->category_id;
        $product->name_product = $request->name_product;
        $product->product_color = $request->product_color;
        $product->product_description = $request->product_description;
       if($request->hasFile('image')){
            File::delete('images/'.$product->image);
            $file = $request->file('image');
            $fileName = time().'.'.$file->getClientOriginalExtension();
            $destinationPath = public_path('images');
            $file->move($destinationPath , $fileName);
            $product->image = $fileName;
        }
        if(empty($data['feature_item'])){
          $data['feature_item'] = 0;
        }
        $product->feature_item = $data['feature_item'];
        $product->product_prize = $request->product_prize;

        $product->save();
        return redirect()->route('product.index')->withStatus(__('Status successfully updated.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();
        return redirect()->route('product.index')->withStatus(__('Status successfully deleted.'));
    }
    // public function attrib($id){
    //     $product = Product::find($id);
        
    // return view('product.attribute', compact('product'));
    // }
    // public function attribCreate(Request $request,$id){
    //         $product = Product::find($id);
    //         $attrib = new ProductAttrib;
    //         $attrib->product_id = $request->product_id;
    //         $attrib->sku = $request->sku;
    //         $attrib->size = $request->size;
    //         $attrib->price = $request->price;
    //         $attrib->stock = $request->stock;
    //         $attrib->save();
    //         // dd($attrib);
    //  return redirect()->route('product.index')->withStatus(__('Status successfully.'));
      
    // }
    public function addAttributes(Request $request, $id=null){
        $no = 1;
        $productDetails = Product::with('attributes')->where(['id'=>$id])->first();
        //$productDetails = json_decode(json_encode($productDetails));
        //echo "<pre>"; print_r($productDetails);die;
        if($request->isMethod('post')){
            $no = 1;
            $data = $request->all();
            foreach($data['sku'] as $key => $val ){
                if(!empty($val)){
                    //Prevent duplicate SKU check
                    $attrCountSKU = ProductAttrib::where('sku',$val)->count();
                    if($attrCountSKU>0){
                    return redirect('/admin/add-attributes/'.$id)->with('flash_message_error','SKU is already exist please add another SKU!');   
                    }
                    //Prevent duplicate Size check
                    $attrCountSizes =ProductAttrib::where(['product_id'=>$id,'size'=>$data['size'][$key]])->count();
                    if($attrCountSizes>0){
                    return redirect('/admin/add-attributes/'.$id)->with('flash_message_error',''.$data['size'][$key].' Size is already exist for this product please add another Size!');   
                    } 

                    $attribute = new ProductAttrib;
                    $attribute->product_id = $id;
                    $attribute->sku = $val;
                    $attribute->size = $data['size'][$key];
                    $attribute->price =$data['price'][$key];
                    $attribute->stock =$data['stock'][$key];
                    $attribute->save();
                }
            }
            return redirect('/admin/add-attributes/'.$id)->with('flash_message_success','Products Attributes Added Successfully!');
        }
        return view('product.attribute')->with(compact('productDetails','no'));

    }
     public function editAttributes(Request $request, $id=null){
       if($request->isMethod('post')){
           $data = $request->all();
           //echo "<pre>";print_r($data);die;
           foreach($data['idAttr'] as $key=>$attr){
               ProductAttrib::where(['id'=>$data['idAttr'][$key]])->update(['price'=>$data['price'][$key],
               'stock'=>$data['stock'][$key]]);
           }
           return redirect()->back()->with('flash_message_success','Products Attributes Updated!!!');
       }
    }
     public function deleteAttribute($id=null){
        ProductAttrib::where(['id'=>$id])->delete();
        return redirect()->back()->with('flash_message_error','Attribute has been deleted successfully!');
    
    }
     public function getProductPrize(Request $request){
        $data = $request->all();
        //echo "<pre>";print_r($data);die;
        $proArr = explode("-",$data['idSize']);
        $proAttr = ProductAttrib::where(['product_id' => $proArr[0], 'size' => $proArr[1]])->first();
        echo $proAttr->price;
        echo "#";
        echo $proAttr->stock;

    }
    public function addtocart(Request $request){
        Session::forget('CouponAmount');
        Session::forget('CouponCode');
        $data = $request->all();
        // echo "<pre>";print_r($data);
        $product_size = explode("-", $data['size']);
        $getProductStock = ProductAttrib::where(['product_id'=>$data['product_id'],'size'=>$product_size[1]])->first();
        // echo $getProductStock->stock; die;

        if($getProductStock->stock<$data['quantity']){
            return redirect()->back()->with('flash_message_error','Required Quantity is not available!');
        }

        if(empty(Auth::user()->email)){
            $data['user_email'] = '';
        }else{
            $data['user_email'] = Auth::user()->email;
        }

        $session_id = Session::get('session_id');
        if(!isset($session_id)){
            $session_id = Str::random(40);
            Session::put('session_id',$session_id);
        }
        $sizeArr = explode("-",$data['size']);
        $product_size = $sizeArr[1];

        // if(empty($data['size'])){
        //     return redirect()->back()->with('flash_message_error','Please Provide Your Size ');
        // }
        if(empty(Auth::check())){
        $countProducts =DB::table('cart')->where(['product_id'=>$data['product_id'],
        'product_color'=>$data['product_color'],'size'=>$sizeArr[1],'session_id'=>$session_id])->count();
        if($countProducts>0){
          return redirect()->back()->with('flash_message_error','Product already exists in Cart!!');
            }
        }else{
        //     $getSKU = ProductAttrib::select('sku')->where(['product_id'=>$data['product_id'],
        //     'size'=>$sizeArr[1]])->first();
        // DB::table('cart')->insert(['product_id'=>$data['product_id'],'product_name'=>$data['product_name'],
        // 'product_code'=>$getSKU->sku,'product_color'=>$data['product_color'],'price'=>$data['price'],
        // 'size'=>$sizeArr[1],'quantity'=>$data['quantity'],'user_email'=>$data['user_email'],'session_id'=>$session_id]);
            $countProducts = DB::table('cart')->where(['product_id'=> $data['product_id'],'product_color'=>$data['product_color'],
            'size'=>$product_size,'user_email'=>$data['user_email']])->count();
            if($countProducts>0){
                return redirect()->back()->with('flash_message_error','Product already exists in Cart!!');
            }
        }
             $getSKU = ProductAttrib::select('sku')->where(['product_id'=>$data['product_id'],
            'size'=>$sizeArr[1]])->first();
        DB::table('cart')->insert(['product_id'=>$data['product_id'],'product_name'=>$data['product_name'],
        'product_code'=>$getSKU['sku'],'product_color'=>$data['product_color'],'price'=>$data['price'],
        'size'=>$product_size,'quantity'=>$data['quantity'],'user_email'=>$data['user_email'],'session_id'=>$session_id]);
      
        // dd($data);
        
        return redirect('/cart')->with('flash_message_success','Product has been Added to Cart!');
    }
    public function cart(Request $request){
        $banner = Banner::where('id', 3)->get();
        if(Auth::check()){
        $user_email = Auth::user()->email;
        $userCart = DB::table('cart')->where(['user_email'=>$user_email])->get();
        }else{
        $session_id = Session::get('session_id');
        $userCart = DB::table('cart')->where(['session_id'=>$session_id])->get();
        }
         foreach($userCart as $key =>$product){
        //echo $product->product_id;
        $productDetails = Product::where('id',$product->product_id)->first();
        $userCart[$key]->image = $productDetails->image;
        }
         // echo"<pre>"; print_r($userCart);die;
        return view('shop.cart')->with(compact('userCart','banner'));
    }
    public function deleteCartProduct($id = NULL){
        Session::forget('CouponAmount');
        Session::forget('CouponCode');
        DB::table('cart')->where('id',$id)->delete();
        return redirect('cart')->with('flash_message_error','Product has been deleted from Cart');
    }
     public function updateCartQuantity($id=null,$quantity=null){
        Session::forget('CouponAmount');
        Session::forget('CouponCode');
        $getCartSetails = DB::table('cart')->where('id',$id)->first();
        $getAttributeStock = ProductAttrib::where('sku',$getCartSetails->product_code)->first();
        $updated_quantity = $getCartSetails->quantity+$quantity;
        if($getAttributeStock->stock >= $updated_quantity){
        DB::table('cart')->where('id',$id)->increment('quantity',$quantity);
        return redirect('/cart')->with('flash_message_success','Product Quantity has been Updated Successfully!!');
        }else{
        return redirect('cart')->with('flash_message_error','Required Product Quantity is not Available');  
        }
    }
    public function ApplyCoupon(Request $request){
       Session::forget('CouponAmount');
        Session::forget('CouponCode');
        $data = $request->all();
        $couponCount = Coupon::where('coupon_code',$data['coupon_code'])->count();
        if($couponCount == 0){
           return redirect()->back()->with('flash_message_error','Coupon does not Exists!');
       }else{
           //perform other actions like active,inactive or expiry date

            //Get Coupon Details
           $couponDetails = Coupon::where('coupon_code',$data['coupon_code'])->first();
            //if coupon is valid
           if($couponDetails->status== 0){
             return redirect()->back()->with('flash_message_error','This Coupon is not active!');
           }
            //if coupon is expired
           $expiry_date = $couponDetails->expiry_date;
           $current_date = date('Y-m-d');
        if($expiry_date < $current_date){
            return redirect()->back()->with('flash_message_error','This Coupon is Expired!');
        }
        //Coupon is valid for Discount
           //Get Cart total amount
         $session_id =Session::get('session_id');
         $userCart = DB::table('cart')->where(['session_id'=>$session_id])->get();
          if(Auth::check()){
            $user_email = Auth::user()->email;
            $userCart = DB::table('cart')->where(['user_email'=>$user_email])->get();
            }else{
            $session_id = Session::get('session_id');
            $userCart = DB::table('cart')->where(['session_id'=>$session_id])->get();
            }
         $total_amount = 0;
         foreach($userCart as $item){
            $total_amount = $total_amount + ($item->price * $item->quantity);
        }
         //Check if amount type is fixed or percentage
           if($couponDetails->amount_type=="Fixed"){
               $couponAmount = $couponDetails->amount;
           }else{
               $couponAmount = $total_amount * ($couponDetails->amount/100);
           }
           //Add coupon Code & Amount in session
            Session::put('CouponAmount',$couponAmount);
            Session::put('CouponCode',$data['coupon_code']);
            return redirect()->back()->with('flash_message_success','Coupon Code is successfully
            applied.You are availing discount!');
       }
    }
     public function checkout(Request $request){
        $user_id = Auth::user()->id;
        $user_email = Auth::user()->email;
        $userDetails = User::find($user_id);
        $countries = Country::get();
        $cities = City::get();
        $daftarProvinsi = Province::pluck('name', 'province_id');
        $courier = Courier::pluck('name');
        
     
        //Check if shipping address exists
        $shippingCount = DeliveryAddress::where('user_id',$user_id)->count();
        $shippingDetails = array();
        if($shippingCount>0){
            $shippingDetails = DeliveryAddress::where('user_id',$user_id)->first();
        }

        //Update Cart Table with user id or email
        $session_id = Session::get('session_id');
        DB::table('cart')->where(['session_id'=>$session_id])->update(['user_email'=>$user_email]);

        if($request->isMethod('post')){
        $data = $request->all();
        // echo "<pre>";print_r($data);die;
        if(empty($data['billing_name']) ||empty($data['billing_address'])||empty($data['billing_province'])
        ||empty($data['billing_city']) ||empty($data['billing_state'])
        ||empty($data['billing_country']) ||empty($data['billing_pincode'])
        ||empty($data['billing_mobile']) ||empty($data['shipping_name'])
        ||empty($data['shipping_address'])||empty($data['shipping_province']) ||empty($data['shipping_city'])
        ||empty($data['shipping_state']) ||empty($data['shipping_country'])
        ||empty($data['shipping_pincode']) ||empty($data['shipping_mobile'])){
        return redirect()->back()->with('flash_message_error','Please Fill all 
        Fields to Continue!!');
        }
        //Update User Details
        User::where('id',$user_id)->update(['name'=>$data['billing_name'],'address'=>$data['billing_address'],
        'province'=>$data['billing_province'],'city'=>$data['billing_city'],'state'=>$data['billing_state'],'pincode'=>$data['billing_pincode'],
        'country'=>$data['billing_country'],'mobile'=>$data['billing_mobile']]);

         if($shippingCount>0){
          //Update Shipping Address
          DeliveryAddress::where('user_id',$user_id)->update(['name'=>$data['shipping_name'],'address'=>$data['shipping_address'],
          'province'=>$data['shipping_province'],'city'=>$data['shipping_city'],'state'=>$data['shipping_state'],'pincode'=>$data['shipping_pincode'],
          'country'=>$data['shipping_country'],'mobile'=>$data['shipping_mobile'],'courier'=>$data['shipping_courier']]);
        }else{
          //New Shipping Address
          $shipping = new DeliveryAddress;
          $shipping->user_id = $user_id;
          $shipping->user_email = $user_email;
          $shipping->name = $data['shipping_name'];
          $shipping->address = $data['shipping_address'];
          $shipping->province = $data['shipping_province'];
          $shipping->city = $data['shipping_city'];
          $shipping->state = $data['shipping_state'];
          $shipping->pincode = $data['shipping_pincode'];
          $shipping->country = $data['shipping_country'];
          $shipping->mobile = $data['shipping_mobile'];
          $shipping->courier = $data['shipping_courier'];
          $shipping->save();
        }
          return redirect()->action('ProductController@orderReview');
        }
        return view('product.checkout')->with(compact('userDetails','countries','shippingDetails','daftarProvinsi','cities','courier','cities'));
     }
      public function orderReview(Request $request){
        $user_id = Auth::user()->id;
        $user_email = Auth::user()->email;
        $userDetails = User::where('id',$user_id)->first();
        $shippingDetails = DeliveryAddress::where('user_id',$user_id)->first();
        $shippingDetails =json_decode(json_encode($shippingDetails));

        $userCart = DB::table('cart')->where(['user_email'=>$user_email])->get();
        foreach($userCart as $key =>$product){
        //echo $product->product_id;
        $productDetails = Product::where('id',$product->product_id)->first();
        $userCart[$key]->image = $productDetails->image;
        }
        //order shipping 
        $shippingCharges = Product::getShippingCharges($shippingDetails->city);
        Session::put('shippingCharges',$shippingCharges);
        //echo "<pre>";print_r($userCart);die;
        return view('product.order_review')->with(compact('userDetails','shippingDetails','userCart','shippingCharges'));
    }
    public function placeOrder(Request $request){
         if($request->isMethod('post')){
            $data = $request->all();
            $user_id = Auth::user()->id;
            $user_email = Auth::user()->email;

            // prevent out of stock product
            $userCart = DB::table('cart')->where('user_email',$user_email)->get();
            foreach ($userCart as $cart) {
                $getAttributeCount = Product::getAttributeCount($cart->product_id,$cart->size);
                if ($getAttributeCount == 0) {
                    Product::deleteCartProduct($cart->product_id,$user_email);
                     return redirect('cart')->with('flash_message_error','One product is not available, please choose another size.');
                }

                $product_stock = Product::getProductStock($cart->product_id,$cart->size);
                if ($product_stock == 0) {
                    Product::deleteCartProduct($cart->product_id,$user_email);
                    return redirect('cart')->with('flash_message_error','Product is Sold Out removed from your cart and please choose another size.');
                }

                if ($cart->quantity>$product_stock) {
                    return redirect('cart')->with('flash_message_error','Reduce Product Stock and try again.');
                    
                }
            }

             //Get Shipping Detail for User
            $shippingDetails = DeliveryAddress::where(['user_email'=>$user_email])->first();
            if(!empty(Session::get('CouponCode'))){
              $coupon_code = Session::get('CouponCode');
            }else{
                  $coupon_code = null;
            }
            if(empty(Session::get('CouponAmount'))){
               $coupon_amount = Session::get('CouponAmount');
            }else{
                 $coupon_amount = null;
            }
            //Shipping charge
             // $shippingCharges = Product::getShippingCharges($shippingDetails->city);

                   
            echo "<pre>";print_r($data);die;
            $order = new Order;
            $order->user_id = $user_id;
            $order->user_email = $user_email;
            $order->name = $shippingDetails->name;
            $order->address = $shippingDetails->address;
            $order->province = $shippingDetails->province;
            $order->city = $shippingDetails->city;
            $order->state = $shippingDetails->state;
            $order->pincode = $shippingDetails->pincode;
            $order->country = $shippingDetails->country;
            $order->mobile = $shippingDetails->mobile;
            $order->coupon_code = $coupon_code;
            $order->coupon_amount = $coupon_amount;
            $order->order_status = "New";
            $order->payment_method = $data['payment_method'];
            $order->shipping_charges =  Session::get('shippingCharges');
            $order->grand_total = $data['grand_total'];
            $order->save();

            // echo "<pre>";print_r($order);die;
             $order_id = DB::getPdo()->lastInsertId();

            $cartProducts = DB::table('cart')->where(['user_email'=>$user_email])->get();
            foreach($cartProducts as $pro){
                $cartPro = new OrdersProduct;
                $cartPro->order_id = $order_id;
                $cartPro->user_id = $user_id;
                $cartPro->product_id = $pro->product_id;
                $cartPro->product_code = $pro->product_code;
                $cartPro->product_name = $pro->product_name;
                $cartPro->product_color = $pro->product_color;
                $cartPro->product_size = $pro->size;
                $product_price = Product::getProductPrice($pro->product_id,$pro->size);
                $cartPro->product_price = $product_price;
                $cartPro->product_qty = $pro->quantity;
                $cartPro->save();

                //Reduce stock
                $getProductStock = ProductAttrib::where('sku',$pro->product_code)->first();
                // echo "original stock =" .$getProductStock->stock;
                // echo "stock reduce :".$pro->quantity; die;
                $newStock = $getProductStock->stock - $pro->quantity;
                if ($newStock<0) {
                    $newStock = 0;
                }
                ProductAttrib::where('sku',$pro->product_code)->update(['stock'=>$newStock]);
            }
                            
            Session::put('order_id',$order_id);
            Session::put('grand_total',$data['grand_total']);
            if($data['payment_method']=="COD"){
                $productDetails = Order::with('orders')->where('id',$order_id)->first();
                $productDetails = json_decode(json_encode($productDetails),true);
                // echo "<pre"; print_r($productDetails);die;

                $userDetails = User::where('id',$user_id)->first();
                $userDetails = json_decode(json_encode($userDetails),true);
                // echo "<pre"; print_r($userDetails);die;

            //Code for order email start
                $email = $user_email;
                $messageData = [
                    'email'=>$email,
                    'name'=> $shippingDetails->name,
                    'order_id'=>$shippingDetails->order_id,
                    'productDetails'=>$productDetails,
                    'userDetails'=>$userDetails
                ];
                Mail::send('emails.order',$messageData,function($message)use($email){
                    $message->to($email)->subject('Order Placed - Market Place Website');
                });
            //COD - Redirect user to thanks page after saving order
            return redirect('/thanks');
            }else{
            return redirect('/bankthanks');  
            }

        }
    }
     public function thanks(Request $request){
        $user_email = Auth::user()->email;
        DB::table('cart')->where('user_email',$user_email)->delete();
        return view('order.thanks');
    }
    public function bankthanks(Request $request){
        $user_email = Auth::user()->email;
        DB::table('cart')->where('user_email',$user_email)->delete();
        return view('order.bank');
    }
     public function userOrders(){
        $user_id = Auth::user()->id;
        $orders = Order::with('orders')->where('user_id',$user_id)->orderBy('id','DESC')->get();
        $orders = json_decode(json_encode($orders));
        // echo "<pre>";print_r($orders);

        return view('order.user_orders')->with(compact('orders'));
    }
     public function userOrderDetails($order_id){
        $user_id = Auth::user()->id;
        $orderDetails = Order::with('orders')->where('id',$order_id)->first();
        $orderDetails = json_decode(json_encode($orderDetails));
        //echo "<pre>";print_r($orderDetails);die;
        return view('order.user_orders_details')->with(compact('orderDetails','userCart'));
    }
     public function viewOrders(){
        $orde = Order::with('orders')->orderBy('id','DESC')->paginate(5);
        $orders = Order::with('orders')->orderBy('id','DESC')->get();
        $orders = json_decode(json_encode($orders));
        // echo "<pre>";print_r($orders);die;
        return view('order.view-order',compact('orders','orde'));
    }
    public function viewOrderDetails($order_id){
        $orderDetails = Order::with('orders')->where('id',$order_id)->first();
        $orderDetails = json_decode(json_encode($orderDetails));
        // echo "<pre>"; print_r($orderDetails);die;
        $user_id = $orderDetails->user_id;
        $userDetails = User::where('id',$user_id)->first();
        $userDetails = json_decode(json_encode($userDetails));
        //echo "<pre>"; print_r($userDetails);die;
        return view('order.order_details')->with(compact('orderDetails','userDetails'));
    }
      public function viewOrderInvoice($order_id){
        $orderDetails = Order::with('orders')->where('id',$order_id)->first();
        $orderDetails = json_decode(json_encode($orderDetails));
        // echo "<pre>"; print_r($orderDetails);die;
        $user_id = $orderDetails->user_id;
        $userDetails = User::where('id',$user_id)->first();
        $userDetails = json_decode(json_encode($userDetails));
        //echo "<pre>"; print_r($userDetails);die;
        return view('order.order_invoice')->with(compact('orderDetails','userDetails'));
    }
     public function viewPDFInvoice($order_id){
        $orderDetails = Order::with('orders')->where('id',$order_id)->first();
        $orderDetails = json_decode(json_encode($orderDetails));
        // echo "<pre>"; print_r($orderDetails);die;
        $user_id = $orderDetails->user_id;
        $userDetails = User::where('id',$user_id)->first();
        $userDetails = json_decode(json_encode($userDetails));
        //echo "<pre>"; print_r($userDetails);die;
        $output = '<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Example 1</title>
    <style>
        .clearfix:after {
  content: "";
  display: table;
  clear: both;
}

a {
  color: #5D6975;
  text-decoration: underline;
}

body {
  position: relative;
  width: 21cm;  
  height: 29.7cm; 
  margin: 0 auto; 
  color: #001028;
  background: #FFFFFF; 
  font-family: Arial, sans-serif; 
  font-size: 12px; 
  font-family: Arial;
}

header {
  padding: 10px 0;
  margin-bottom: 30px;
}

#logo {
  text-align: center;
  margin-bottom: 10px;
}

#logo img {
  width: 90px;
}

h1 {
  border-top: 1px solid  #5D6975;
  border-bottom: 1px solid  #5D6975;
  color: #5D6975;
  font-size: 2.4em;
  line-height: 1.4em;
  font-weight: normal;
  text-align: center;
  margin: 0 0 20px 0;
  background: url(dimension.png);
}

#project {
  float: left;
}

#project span {
  color: #5D6975;
  text-align: right;
  width: 52px;
  margin-right: 10px;
  display: inline-block;
  font-size: 0.8em;
}

#company {
  float: right;
  text-align: right;
}

#project div,
#company div {
  white-space: nowrap;        
}

table {
  width: 100%;
  border-collapse: collapse;
  border-spacing: 0;
  margin-bottom: 20px;
}

table tr:nth-child(2n-1) td {
  background: #F5F5F5;
}

table th,
table td {
  text-align: center;
}

table th {
  padding: 5px 20px;
  color: #5D6975;
  border-bottom: 1px solid #C1CED9;
  white-space: nowrap;        
  font-weight: normal;
}

table .service,
table .desc {
  text-align: left;
}

table td {
  padding: 20px;
  text-align: right;
}

table td.service,
table td.desc {
  vertical-align: top;
}

table td.unit,
table td.qty,
table td.total {
  font-size: 1.2em;
}

table td.grand {
  border-top: 1px solid #5D6975;;
}

#notices .notice {
  color: #5D6975;
  font-size: 1.2em;
}

footer {
  color: #5D6975;
  width: 100%;
  height: 30px;
  position: absolute;
  bottom: 0;
  border-top: 1px solid #C1CED9;
  padding: 8px 0;
  text-align: center;
}
    </style>

  </head>
  <body>
    <header class="clearfix">
      <div id="logo">
        <img src="argon/img/Mark.png">
      </div>
      <h1>INVOICE '.$orderDetails->id.'</h1>
      <div id="project" class="clearfix">
        <div><span>Order ID</span> '.$orderDetails->id.'</div>
        <div><span>Order Date</span> '.date('j F Y', strtotime($orderDetails->created_at)).'</div>
        <div><span>Order Amount</span> '.$orderDetails->grand_total.'</div>
        <div><span>Order Status</span> '.$orderDetails->order_status.'</div>
        <div><span>Payment Method</span> '.$orderDetails->payment_method.'</div>
      </div>
      <div id="project" style="float:right;">
      <div><strong>Shipping Address</strong></div>
        <div><span>Order Name</span> '.$orderDetails->name.'</div>
        <div><span>Address</span> '.$userDetails->address.'</div>
        <div><span>City</span> '.$orderDetails->city.'</div>
        <div><span>State</span> '.$orderDetails->state.'</div>
        <div><span>Pincode</span> '.$orderDetails->pincode.'</div>
        <div><span>Mobile</span> '.$orderDetails->mobile.'</div>
      </div>
    </header>
    <main>
      <table>
        <thead>
          <tr>
            <th class="service">PRODUCT CODE</th>
            <th class="desc">COLOR</th>
            <th>PRICE</th>
            <th>QTY</th>
            <th>TOTAL</th>
          </tr>
        </thead>
        <tbody>';
        $Subtotal = 0;
        foreach($orderDetails->orders as $pro){
         $output.= ' <tr>
            <td class="service">'.$pro->product_code.'</td>
            <td class="desc">'.$pro->product_color.'</td>
            <td class="unit">'.$pro->product_price.'</td>
            <td class="qty">'.$pro->product_qty.'</td>
            <td class="total">'.$pro->product_price*$pro->product_qty.'</td>
          </tr>';
        $Subtotal = $Subtotal + ($pro->product_price * $pro->product_qty); }
        $output .= '<tr>
            <td colspan="4" class="grand total">SUB TOTAL</td>
            <td class="grand total">Rp.'.$Subtotal.'</td>
          </tr>
          <tr>
            <td colspan="4" class="grand total">SHIPPING (+)</td>
            <td class="grand total">Rp.'.$orderDetails->shipping_charges.'</td>
          </tr>
          <tr>
            <td colspan="4" class="grand total">COUPON DISCOUNT (-)</td>
            <td class="grand total">';
            if(!empty(Session::get('CouponAmount'))){
               }$output.=' Rp. '.Session::get('CouponAmount').'
            
                0
        
            </td>
          </tr>
          <tr>
            <td colspan="4" class="grand total">GRAND TOTAL</td>
            <td class="grand total">Rp.'.$orderDetails->grand_total.'</td>
          </tr>
        </tbody>
      </table>
      <div id="notices">
        <div>NOTICE:</div>
        <div class="notice">A finance charge of 1.5% will be made on unpaid balances after 30 days.</div>
      </div>
    </main>
    <footer>
      Invoice was created on a computer and is valid without the signature and seal.
    </footer>
  </body>
</html>';
$pdf = new Dompdf;
$pdf->loadHTML($output);
$pdf->setPaper('A4','landscape');
$pdf->render();
return $pdf->stream();

    }
     public function updateOrderStatus(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
        }
        Order::where('id',$data['order_id'])->update(['order_status'=>$data['order_status']]);
        return redirect()->back()->with('flash_message_success','Order Status has been Updated Successfully!');
    }
    // public function searchProducts(Request $request){
    //     if($request->isMethod('post')){
    //         $data = $request->all();
    //         $product = Product::all();
    //         $categories = Category::all();
    //         $productsAll = Product::where('name_product','like','%'.$product. '%')->orwhere('product_code', $product)->get();

    //     return view('shop.product',compact('categories','product','productAll'));

    //     }
    // }
   
}
