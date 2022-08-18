<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Symfony\Component\HttpFoundation\Response;
use Spatie\Permission\Models\Permission as ModelsPermission;

class RolesPermissionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Role $role)
    {

        $permissions = Permission::all();
        $rolepermissions= $role->permissions;
        if(count($rolepermissions) > 0){
            foreach($permissions as $permission){
                $permission->setAttribute('assigned',false);
                foreach($rolepermissions as $rolepermission){
                $permission->assigned = $permission->id == $rolepermission->id;

                }
            }


        }
        return response()->view('admin.Spatie.roles.rolepermission',[
            'role'=> $role,
            'permissions' =>$permissions
           ]);



    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request , Role $role)
    {
        $validator = Validator($request->all(),[
            'permission_id' => 'required|integar|exists:permissions,id'
          ]);
          if(!$validator->fails()){
            $permission = Permission::findorfail($request->get('permission_id'));
            if($role->hasPermissionTo($permission)){
                $role->revokePermissionTo($permission);
            } else{
                $role->givePermissionTo($permission);
            }
            return response()->json([
                'message'=> 'updated permission successfully'
            ],Response::HTTP_OK);
          } else{
            return response()->json([
                'message' => $validator->getMessageBag()->first()
            ], Response::HTTP_BAD_REQUEST);
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
