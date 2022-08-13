<?php

namespace App\Http\Controllers;

use Dotenv\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

    public function logout(Request $request)
    {
        $guard = auth('admin')->check() ? 'admin' : 'user';

        auth::guard($guard)->logout();
        $request->session()->invalidate();
        return redirect()->route('login',$guard);
    }

}
