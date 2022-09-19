<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use Throwable;

class SocialiteController extends Controller
{
   public function redirect($provider){

   return Socialite::driver($provider)->redirect();




   }
   public function callback($provider){
try{
    $provider_user =  Socialite::driver($provider)->user();
    $user = User::where([
     'provider'=> $provider,
     'provider_id'=>$provider_user->id,
     ])->first();

     if(!$user){
         $user = User::create([
             'name'=> $provider_user->name,
             'email'=>$provider_user->email,
             'password'=> Hash::make(Str::random(8)),
             'provider'=>$provider,
             'provider_id'=> $provider_user->id,
             'provider_token'=>$provider_user->token
         ]);
     }

     Auth::login($user);
     return redirect()->route('admin/');
}catch(Throwable $e){
    $guard = auth('admin')->check() ? 'admin' : 'user';
    return redirect()->route('login',$guard)->withErrors([
        'email'=>$e->getMessage(),
    ]);

}




   }
}
