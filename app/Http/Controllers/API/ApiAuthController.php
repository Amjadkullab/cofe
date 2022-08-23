<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class ApiAuthController extends Controller
{
   public function login(Request $request){
    $validator = Validator($request->all(),[
        'email'=> 'required|email|exists:users,email',
        'password'=> 'required|String'//  هاي ال  api ل guard ال api
    ]);
    if(!$validator->fails()){
        $user=User::where('email',$request->get('email'))->first();
        if(Hash::check($request->get('password'),$user->password)){
            $token = $user->createToken('User-Api');
            $user->SetAttribute('token',$token->accessToken);

            return response()->json([
                'message'=> 'login in success','data'=>$user,
            ],Response::HTTP_OK);
        }else{
            return response()->json([
                'message' => 'login in failed'],Response::HTTP_BAD_REQUEST);
        }

    }else{
        return response()->json([
            'message'=>$validator->getMessageBag()->first()
        ],Response::HTTP_BAD_REQUEST);
    }

   }
   public function logout(){
    $token = auth('api')->user()->token();
    $isRevoked=$token->revoke();
    return response()->json([
    'Status'=>$isRevoked,
    'message' => $isRevoked ? 'log out successfully' : 'failed to logout'
    ],$isRevoked ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);



   }
}
