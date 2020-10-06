<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ImageCategory;
use File;
use Image;

class ImageController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	$no = 1;
        $image = ImageCategory::all();
        return view('image.index',compact('image','no'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view ('image.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
        $image = new ImageCategory;
        $image->name = $request->name;
       if($request->hasFile('image')){
            $file = $request->file('image');
            $fileName = time().'.'.$file->getClientOriginalExtension();
            $destinationPath = public_path('imagescat');
            $file->move($destinationPath , $fileName);
            // Image::make($file)->resize(1920,750)->save($file.$fileName);
            // echo "test"; die;
            $image->image = $fileName;
        }

        $image->save();
        return redirect()->route('image.index')->withStatus(__('Image Category successfully created.'));
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $image = ImageCategory::find($id);
        return view('image.edit', compact('image'));
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
       	$image = ImageCategory::find($id);
        $image->name = $request->name;
       if($request->hasFile('image')){
            File::delete('imagescat/'.$image->image);
            $file = $request->file('image');
            $fileName = time().'.'.$file->getClientOriginalExtension();
            $destinationPath = public_path('imagescat');
            $file->move($destinationPath , $fileName);
            // Image::make($file)->resize(1920,750)->save($file.$fileName);
            // echo "test"; die;
            $image->image = $fileName;
        }

        $image->save();
        return redirect()->route('image.index')->withStatus(__('Image Category successfully update.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       //
    }
}
