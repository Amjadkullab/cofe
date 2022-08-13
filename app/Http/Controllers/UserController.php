<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $users = User::where('id','!=', auth('user')->id())->get();
        return view('admin.Users.index',compact('users'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.Users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator($request->all(),[
            'name'=> 'required|string|min:3|max:20',
            'email'=>'required|string',
            'active'=>'required|boolean'
        ]);
        if(!$validator->fails()){
            $user = new User();
            $user->name = $request->get('name');
            $user->email= $request->get('email');
            $user->password = Hash::make('password');
            $user->active = $request->get('active');
            $isSaved = $user->save();
            return response()->json([
                'message'=>$isSaved ? 'Saved Successfully': 'Saved Failed'
            ],$isSaved ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);

        } else {
            return response()->json([
                'message'=> $validator->getMessageBag()->first()
            ],Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findorfail('id')->get();
        return view('admin.Users.edit',compact('user'));
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

  $user = User::findorfail('id')->get();
        $validator = Validator($request->all(),[
            'name'=> 'required|string|min:3|max:20',
            'email'=>'required|string',
            'active'=>'required|boolean'
        ]);
        if(!$validator->fails()){
            $user->name = $request->get('name');
            $user->email= $request->get('email');
            $user->password = Hash::make('password');
            $user->active = $request->get('active');
            $isSaved = $user->save();
            return response()->json([
                'message'=>$isSaved ? 'Saved Successfully': 'Saved Failed'
            ],$isSaved ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);

        } else {
            return response()->json([
                'message'=> $validator->getMessageBag()->first()
            ],Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $user = User::findorfail('id')->get();
        $isDeleted = $user->delete();
        if($isDeleted){
         return response()->json([
             'icon'=> 'success',
             'title'=> 'Success!',
             'text'=> 'deleted successfully'
         ], Response::HTTP_OK);
        } else{
         return response()->json([
             'icon'=> 'error',
             'title'=> 'Failed!',
             'text'=> 'deleted Failed'
         ], Response::HTTP_BAD_REQUEST);

        }
    }

    }

