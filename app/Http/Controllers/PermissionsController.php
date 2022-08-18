<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Symfony\Component\HttpFoundation\Response;

class PermissionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $permissions = Permission::all();
       return response()->view('admin.Spatie.permissions.index',['permissions'=>$permissions]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return response()->view('admin.Spatie.permissions.create');
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
            'name'=> 'required|string',
            'guard_name' => 'required|string|in:admin,user'
        ]);

      if(!$validator->fails()){
        $permission = new Permission();
        $permission->name = $request->get('name');
        $permission->guard_name = $request->get('guard_name');
        $isSaved = $permission->save();
        return response()->json([
            'message'=> $isSaved ? 'Created permission Successfully' : 'Created permission Failed'
        ],Response::HTTP_OK);
      } else{
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
        $permission = Permission::findorfail('id')->get();
        return view('admin.Spatie.permissions.edit',['permission'=>$permission ]);

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
        $permission = Permission::findorfail('id')->get();
        $validator = Validator($request->all(),[
            'name'=> 'required|string',
            'guard_name' => 'required|string|in:admin,user'
        ]);
        if(!$validator->fails()){
            $permission->name = $request->get('name');
            $permission->guard_name = $request->get('guard_name');
            $isSaved = $permission->save();
            return response()->json([
                'message'=> $isSaved ? 'Created permission Successfully' : 'Created permission Failed'
            ],Response::HTTP_OK);
          } else{
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
        $permission = Permission::findorfail('id')->get();
        $isdeleted = $permission->delete();
        if( $isdeleted){
            return response()->json([
             'icon'=> 'success',
             'title'=> '!Success',
             'text'=>'permission deleted successfully'

            ]);

        } else{
            return response()->json([
            'icon'=> 'failed',
            'title'=> '!Failed',
            'text'=>'permission deleted failed'

           ]);

        }
    }
    }

