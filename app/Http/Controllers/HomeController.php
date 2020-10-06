<?php

namespace App\Http\Controllers;
use App\User;
use App\Banner;
use App\ImageCategory;
use App\Product;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {   
        $users = User::all();
        $banner = Banner::all();
        $productAll = Product::inRandomOrder()->where('feature_item',1)->get();
        $imagecat = ImageCategory::where('id',1)->get();
        $imagetwo = ImageCategory::where('id',2)->get();
        $imagethree = ImageCategory::where('id',3)->get();
        $imagefour = ImageCategory::where('id',4)->get();
        $imagefive = ImageCategory::where('id',5)->get();
        if(auth()->user()->role == 'admin'){
         return view('dashboard');
    } 
        return view('shop.index', compact('banner','productAll','imagecat','imagetwo','imagethree','imagefour','imagefive'));
    }
}
