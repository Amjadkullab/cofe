<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\User;
use Dotenv\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    public function showlogin(Request $request, $guard)
    {

        return response()->view('admin.login',['guard'=> $guard]);
    }
    public function login(Request $request)
    {

        $validator = Validator($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:3|max:10',
            'remember' => 'required|boolean',
            'guard' => 'required|string|in:admin,user',
        ],[
            'guard.in' => 'please, Check login URL'
        ]);

        if (!$validator->fails()) {
            $credientials = [
                'email' => $request->get('email'),
                'password' => $request->get('password')
            ];
            if (Auth::guard($request->get('guard'))->attempt($credientials, $request->get('remember'))) {
                return response()->json([
                    'message' => 'login successfully',
                ], Response::HTTP_OK);
            } else {
                return response()->json([
                    'message' => 'login failed, wrong credentials'
                ], Response::HTTP_BAD_REQUEST);
            }
        } else {
            return response()->json([
                'message' => $validator->getMessageBag()->first(),
            ], Response::HTTP_BAD_REQUEST);
        }
    }


    public function editpassword(){

        return response()->view('admin.auth.changepassword');
    }
    public function updatepassword(Request $request){
       $guard = auth('admin')->check() ? 'admin':'user';
        $validator = Validator($request->all(),[
            'current_password'=>"required|string|password:$guard",
            'new_password'=>'required|string|confirmed',
        ]);
        if(!$validator->fails()){
            $user = auth($guard)->user();
            $user->password = Hash::make($request->get('new_password'));
             $isSaved= $user->save();
             return response()->json([
                'message'=> $isSaved ? 'Updated Password Successfully' : 'Updated Password Failed'
             ],Response::HTTP_OK);
        } else{
            return response()->json([
                'message'=> $validator->getMessageBag()->first()
            ],Response::HTTP_BAD_REQUEST);
        }

    }
    public function editprofile(){

       $view =  auth('admin')->check() ? 'admin.admins.edit' : 'admin.Users.edit' ;
        $guard = auth('admin')->check() ? 'admin': 'user';
        return response()->view($view,['guard'=>auth($guard)->user(),'redirect' => false]);
    }

    public function logout(Request $request)
    {
        $guard = auth('admin')->check() ? 'admin' : 'user';

        auth::guard($guard)->logout();
        $request->session()->invalidate();
        return redirect()->route('login',$guard);
    }

}
