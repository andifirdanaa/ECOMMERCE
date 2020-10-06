<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileRequest;
use App\Http\Requests\PasswordRequest;
use Illuminate\Support\Facades\Hash;
use Kavist\RajaOngkir\Facades\RajaOngkir;
use App\Country;
use App\Province;
use App\User;
use Auth;

class ProfileController extends Controller
{
    /**
     * Show the form for editing the profile.
     *
     * @return \Illuminate\View\View
     */
    public function edit()
    {
        $user_id = Auth::user()->id;
        $userDetails = User::find($user_id);
        $countries = Country::get();
        $daftarProvinsi = Province::pluck('name','province_id');
        return view('profile.edit',compact('countries','userDetails','daftarProvinsi'));
    }

    /**
     * Update the profile
     *
     * @param  \App\Http\Requests\ProfileRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ProfileRequest $request)
    {
        // auth()->user()->update($request->all());
         $request->validate([
            'name'      => 'required',
            'email'     => 'required|email',
            'mobile'     => 'required',
        ]);
        $user = Auth::user();
        $user->email = $request->email;
        $user->name = $request->name;
        $user->role = 'customer';
        $user->address = $request->address;
        $user->province = $request->province;
        $user->city = $request->city;
        $user->state = $request->state;
        $user->country = $request->country;
        $user->pincode = $request->pincode;
        $user->mobile = $request->mobile;
        $user->save();

        return back()->withStatus(__('Profile successfully updated.'));
    }

    /**
     * Change the password
     *
     * @param  \App\Http\Requests\PasswordRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function password(PasswordRequest $request)
    {
        auth()->user()->update(['password' => Hash::make($request->get('password'))]);

        return back()->withPasswordStatus(__('Password successfully updated.'));
    }
    public function account(){
        return view('profile.profile');
    }
}
