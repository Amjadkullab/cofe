<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Dotenv\Validator;

use App\Mail\ContactUsMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\HttpFoundation\Response;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $admins = Admin::where('id','!=',auth('admin')->id())->get();
        return view('admin.admins.index',compact('admins'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.admins.create');
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
            $admin = new Admin();
            $admin->name = $request->get('name');
            $admin->email= $request->get('email');
            $admin->password = Hash::make('password');
            $admin->active = $request->get('active');
            $isSaved = $admin->save();

            Mail::to('ahmed@email.com')->send(new ContactUsMail($admin));
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
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function show(Admin $admin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function edit(Admin $admin)
    {
        return view('admin.admins.edit',compact('admin'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Admin $admin)
    {
        $validator = Validator($request->all(),[
            'name'=> 'required|string|min:3|max:20',
            'email'=>'required|string',
            'active'=>'required|boolean'
        ]);
        if(!$validator->fails()){
            $admin->name = $request->get('name');
            $admin->email= $request->get('email');
            $admin->password = Hash::make('password');
            $admin->active = $request->get('active');
            $isSaved = $admin->save();
            return response()->json([
                'message'=>$isSaved ? 'Updated Successfully': 'Updated Failed'
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
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function destroy(Admin $admin)
    {
        $isDeleted = $admin->delete();
        if($isDeleted){
            return response()->json([
                'icon'=>'success',
                'title'=>'Successfully!',
                'text'=>'deleted successfully'
            ],Response::HTTP_OK);
        }else{
            return response()->json([
                'icon'=>'failed',
                'title'=>'Failed!',
                'text'=>'deleted failed'

            ],Response::HTTP_BAD_REQUEST);
        }

    }
}
