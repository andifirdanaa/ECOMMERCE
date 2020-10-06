<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Banner;
use File;
use Image;

class BannerController extends Controller
{
      /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	$no = 1;
        $banner = Banner::all();
        return view('banner.index',compact('banner','no'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view ('banner.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
        $banner = new Banner;
        $banner->name = $request->name;
        $banner->text_style = $request->text_style;
        $banner->sort_order = $request->sort_order;
        $banner->content = $request->content;
        $banner->link = $request->link;
        $banner->status = 0;
       if($request->hasFile('image')){
            $file = $request->file('image');
            $fileName = time().'.'.$file->getClientOriginalExtension();
            $destinationPath = public_path('banneri');
            $file->move($destinationPath , $fileName);
            // Image::make($file)->resize(1920,750)->save($file.$fileName);
            // echo "test"; die;
            $banner->image = $fileName;
        }

        $banner->save();
        return redirect()->route('banner.index')->withStatus(__('Status successfully created.'));
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $banner = Banner::find($id);
        return view('banner.edit', compact('banner'));
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
       	$banner = Banner::find($id);
        $banner->name = $request->name;
        $banner->text_style = $request->text_style;
        $banner->sort_order = $request->sort_order;
        $banner->content = $request->content;
        $banner->link = $request->link;
        $banner->status = 0;
       if($request->hasFile('image')){
        File::delete('banneri/'.$banner->image);
            $file = $request->file('image');
            $fileName = time().'.'.$file->getClientOriginalExtension();
            $destinationPath = public_path('banneri');
            $file->move($destinationPath , $fileName);
            $banner->image = $fileName;
        }

        $banner->save();
        return redirect()->route('banner.index')->withStatus(__('Status successfully created.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $banner = Banner::find($id);
        $banner->delete();
        return redirect()->route('banner.index')->withStatus(__('Status successfully deleted.'));
    }

}
