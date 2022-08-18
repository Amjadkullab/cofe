<?php

namespace App\Http\Controllers;

use Dotenv\Validator;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Symfony\Component\HttpFoundation\Response;

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::withcount('permissions')->get();
        return response()->view('admin.Spatie.roles.index',['roles'=> $roles]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return response()->view('admin.Spatie.roles.create');
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
        $role = new Role();
        $role->name = $request->get('name');
        $role->guard_name = $request->get('guard_name');
        $isSaved = $role->save();
        return response()->json([
            'message'=> $isSaved ? 'Created Role Successfully' : 'Created Role Failed'
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
      $role = Role::findorfail('id')->get();
      return view('admin.Spatie.roles.edit',['role'=>$role]);
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
        $role = Role::findorfail('id')->get();
        $validator = Validator($request->all(),[
            'name'=> 'required|string',
            'guard_name' => 'required|string|in:admin,user'
        ]);
        if(!$validator->fails()){
            $role->name = $request->get('name');
            $role->guard_name = $request->get('guard_name');
            $isSaved = $role->save();
            return response()->json([
                'message'=> $isSaved ? 'Created Role Successfully' : 'Created Role Failed'
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
        $role = Role::findorfail('id')->get();
        $isdeleted = $role->delete();
        if( $isdeleted){
            return response()->json([
             'icon'=> 'success',
             'title'=> '!Success',
             'text'=>'role deleted successfully'

            ]);

        } else{
            return response()->json([
            'icon'=> 'failed',
            'title'=> '!Failed',
            'text'=>'role deleted failed'

           ]);

        }
    }
}
