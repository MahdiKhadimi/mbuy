<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use App\Mail\UserCreated;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\ApiController;
use App\Http\Requests\UpdateUserRequest;

class UserController extends ApiController
{
    /**
     * Display a listing of the user.
     *
     * @return \Illuminate\Http\jsonResponse
     */
    public function index()
    {
        $users = User::orderBy('id','desc')->get();

        return $this->show_all($users);
    }

    /**
     * Store a newly created user in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\jsonResponse
     */
    public function store(Request $request)
    {
        $data = $request->all();
        
        $data['password'] = Hash::make($request->password);
        
        $data['verified'] = User::UNVERIFIED_USER;

        $data['admin'] = User::REGULAR_USER;

        $data['verification_token'] = User::generate_verification_token();

        $user = User::create($data);

        return $this->show_one($user,201);


    }

    /**
     * Display the specified user.
     *
     * @param  int  $id
     * @return \Illuminate\Http\jsonResponse
     */
    public function show(User $user)
    {
        
        return $this->show_one($user);

    }

    /**
     * Update the specified user in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\jsonResponse
     */
    public function update(UpdateUserRequest $request, User $user)
    {
         if($request->has('name')){
             $user->name = $request->name;
         } 
         if($request->has('email') && $user->email!=$request->email){
           
            $user->verified = User::UNVERIFIED_USER;
           
            $user->verification_token = User::generate_verification_token();

            $user->email= $request->email;
        }  

        if($request->has('password')){
             $user->password = Hash::make($request->password);  
        }
          
        if($request->has('admin')){
            if(!$user->is_verified()){
                return $this->error_response('Only the verified users can modify the admin field ',409);
            }
            $user->admin = $request->admin;
        }

        $user->save();
        
        return $this->show_one($user);
    

    }

    /**
     * Remove the specified user from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(User $user)
    {
        $user->delete();
        
        return $this->show_one($user);
           
    }

    public function verify($token)
    {
         $user = User::where('verification_token',$token)->firstOrFail();

         $user->verification_token = null;
         $user->verified = User::VERIFIED_USER;
         $user->save();

      return $this->show_message('The user has been verified successfully');
    }

    public function resend(User $user)
    {
        if($user->is_verified()){
            return $this->error_response('The user already has verfied',409);
        }
        retry(5,function() use($user){
         Mail::to($user->email)->send(new UserCreated($user));
          
        },100);

        return $this->show_message('email has been sended successfully',200);

    }
}