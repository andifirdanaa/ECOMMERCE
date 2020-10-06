<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Coupon;

class CouponsController extends Controller
{
      /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	$no = 1;
        $coupon = Coupon::paginate(5);
        return view('coupon.index',compact('coupon','no'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view ('coupon.create');
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
            'coupon_code'      => 'required',
            'amount'     => 'required',
            'amount_type'  => 'required',
            'expiry_date'   => 'required',
           
        ]);
        $coupon = new Coupon;
        $coupon->coupon_code = $request->coupon_code;
        $coupon->amount = $request->amount;
        $coupon->amount_type = $request->amount_type;
        $coupon->expiry_date = $request->expiry_date;
        $coupon->status = $request->status;
        //dd($coupon);
       	$coupon->save();
      

        return redirect()->route('coupons.index')->withStatus(__('Status successfully created.'));
    }

   

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $coupon = Coupon::find($id);
        return view('coupon.edit', compact('coupon'));
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
       $request->validate([
            'coupon_code'      => 'required',
            'amount'     => 'required',
            'amount_type'  => 'required',
            'expiry_date'   => 'required',
           
        ]);
        $data = $request->all();
        $coupon = Coupon::find($id);
        $coupon->coupon_code = $request->coupon_code;
        $coupon->amount = $request->amount;
        $coupon->amount_type = $request->amount_type;
        $coupon->expiry_date = $request->expiry_date;
        if(empty($data['status'])){
          $data['status'] = 0;
        }
        $coupon->status = $data['status'];
        //dd($coupon);
       	$coupon->save();
        return redirect()->route('coupons.index')->withStatus(__('Coupon successfully update.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $coupon = Coupon::find($id);
        $coupon->delete();
        return redirect()->route('coupons.index')->withStatus(__('Coupon successfully deleted.'));
    }
}
