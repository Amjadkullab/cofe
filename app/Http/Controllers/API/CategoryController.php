<?php

namespace App\Http\Controllers\API;

use App\Models\category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Dotenv\Validator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ResponseEvent;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    //  $data = auth('api')->user()->categories;
     $data=category::where('user_id',auth('api')->id())->get();
    return response()->json([
        'message'=>'success',
        'data'=>$data,
    ],Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator=Validator($request->all(),[
            'name'=>'required|string|min:3|max:30',
            'active'=>'required|boolean'
        ]);
        if(!$validator->fails()){
            $category= new category();
            $category->name=$request->get('name');
            $category->active=$request->get('active');
            $isSaved=auth('api')->user()->categories->save($category);
            if($isSaved){
                return response()->json([
                    'message'=>'create category successfully'
                ],Response::HTTP_OK);
            }else{
                return response()->json([
                    'message'=>'create category failed'
                ],Response::HTTP_BAD_REQUEST);

            }

        }else{
            return response()->json([
                'message'=>$validator->getMessageBag()->first()
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
        $category = category::findorfail('id');
        if(!is_null($category)){
            $this->authorize('delete',$category);
            $isDeleted= $category->delete();
            return response()->json([
                'message'=>$isDeleted ?'category deleted successfully':'category deleted fail'
            ],$isDeleted ? Response::HTTP_OK :Response::HTTP_BAD_REQUEST);
        }else{
            return response()->json([
                'message'=> 'item not found'
            ],Response::HTTP_NOT_FOUND);
        }


    }
}
