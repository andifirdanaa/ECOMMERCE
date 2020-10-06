<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;
use App\Http\Requests\PasswordRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    /**
     * Display a listing of the users
     *
     * @param  \App\User  $model
     * @return \Illuminate\View\View
     */
    public function index(User $model)
    {   
        $user = User::all();
        return view('users.index',compact('user'));
    }
     public function create()
    {
        return view('users.create');
    }
    /**
     * Store a newly created user in storage
     *
     * @param  \App\Http\Requests\UserRequest  $request
     * @param  \App\User  $model
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(UserRequest $request, User $model)
    {
        $model->create($request->merge(['password' => Hash::make($request->get('password'))])->all());

        return redirect()->route('user.index')->withStatus(__('User successfully created.'));
    }

    /**
     * Show the form for editing the specified user
     *
     * @param  \App\User  $user
     * @return \Illuminate\View\View
     */
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified user in storage
     *
     * @param  \App\Http\Requests\UserRequest  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, User  $user)
    {
        $request->validate([
            'name' => 'required', 'min:3',
            'email' => 'required', 'email',
        ]);
        $user->name     = $request->name;
        $user->email    = $request->email;
       

        if($request->password != ""){
            $user->password = bcrypt($request->password);
        }
        if(empty($request['status'])){
          $request['status'] = 0;
        }
        $user->status = $request->status;

        $user->save();
        return redirect()->route('user.index')->withStatus(__('User successfully updated.'));
    }

    /**
     * Remove the specified user from storage
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(User  $user)
    {
        $user->delete();

        return redirect()->route('user.index')->withStatus(__('User successfully deleted.'));
    }
    public function confirmAccount($email){
        $email = base64_decode($email);
        $userCount = User::where('email',$email)->count();
        if($userCount > 0){
            $userDetails = User::where('email',$email)->first();
            if($userDetails->status == 1){
                return redirect('login')->with('flash_message_success','Your Email account is already activated. You can login now.');
            }else{
                User::where('email',$email)->update(['status'=>1]);

                //send welcome actived
                // $email = $data['email'];
                $messageData = ['email'=>$email,'name'=>$userDetails->name];
                Mail::send('users.welcome',$messageData,function($message)use($email){
                    $message->to($email)->subject('Welcome in Market Place');
                });
              return redirect('login')->with('flash_message_success','Your Email account is already activated. You can login now.');
            }
        }else{
            abort(404);
        }
    }
}
