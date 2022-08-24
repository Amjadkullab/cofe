<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use PhpParser\Node\Stmt\TryCatch;
use Symfony\Component\HttpFoundation\Response;

class ApiAuthController extends Controller
{
//    public function login(Request $request){
//     $validator = Validator($request->all(),[
//         'email'=> 'required|email|exists:users,email',
//         'password'=> 'required|String'//  هاي ال  api ل guard ال api
//     ]);
//     if(!$validator->fails()){
//         $user=User::where('email',$request->get('email'))->first();
//         if(Hash::check($request->get('password'),$user->password)){
//             if(!$this->checkForActiveTokens($user->id)){

//                 $token = $user->createToken('User-Api');
//                 $user->setAttribute('token',$token->accessToken);

//                 return response()->json([
//                     'message'=> 'login in success',
//                     'data'=>$user,
//                 ],Response::HTTP_OK);
//             } else{
//                 return response()->json([
//                     'message'=> 'unable to login from two devices at same time '

//                 ],Response::HTTP_OK);

//             }


//             }

//         else{
//             return response()->json([
//                 'message' => 'login in failed'],Response::HTTP_BAD_REQUEST);
//         }

//     }else{
//         return response()->json([
//             'message'=>$validator->getMessageBag()->first()
//         ],Response::HTTP_BAD_REQUEST);
//     }

//    }


   public function login(Request $request){
    $validator = Validator($request->all(),[
        'email'=> 'required|email|exists:users,email',
        'password'=> 'required|string'//  هاي ال  api ل guard ال api
    ]);

    if(!$validator->fails()){
        try {
            $response = Http::asForm()->post('http://127.0.0.1:8001/oauth/token',[
                'grant_type'=>'password',
                'client_id'=>'3',
                'client_secret'=>'',
                'username'=>$request->get('email'),
                'password'=>$request->get('password'),
                'scope'=>'*',

            ]);
            $user= User::where('email',$request->get('email'))->first();
            $user->setAttribute('token',$response->json()['access_token']);
            $user->setAttribute('token_type',$response->json()['token_type']);
            $user->setAttribute('refresh_token',$response->json()['refresh_token']);
            return response()->json([
                'data'=>$user,
                'message'=>'logged in successfully'
            ],Response::HTTP_OK);

            }
            //code...
         catch (Exception $e) {
        if($response->json()['error']=='invalid_grant'){
            return response()->json([
                'message'=>'wrong crediential, please enter correct email and password'
            ],Response::HTTP_BAD_REQUEST);
        } else{
            return response()->json([
                'message'=>'login failed'
            ],Response::HTTP_BAD_REQUEST);

        }

        }
    }else{
        return response()->json([
            'message'=> $validator->getMessageBag()->first()
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
