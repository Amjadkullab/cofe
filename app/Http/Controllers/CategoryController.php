<?php

namespace App\Http\Controllers;

use Dotenv\Validator;
use App\Models\category;
use App\Notifications\NewProductNotification;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories= category::all();
        return view('admin.Categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('admin.Categories.create');
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
        'name' => 'required|string|min:3|max:30',
      ]);
      $user=Auth::guard('user')->user();
      if(!$validator->fails()){
        $category = new category();
        $category->name = $request->get('name');
        $category->users->notify(new NewProductNotification($user,$category));
        // $category->slug = $request->get(Str::slug($request->name));
        $isSaved = $category->save();
        return response()->json([
            'message'=>$isSaved ? 'saved successfully' : 'failed save'
        ],$isSaved ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);


      }else {
        return response()->json([
            'message' => $validator->getMessageBag()->first()
        ],Response::HTTP_BAD_REQUEST);
      }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(category $category)
    {
      return view('admin.Categories.edit',compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, category $category)
    {
        $validator = Validator($request->all(),[
            'name'=> 'required|string'
        ]);
        if(!$validator->fails()){
            $category->name=$request->get('name');
            // $category->slug=Str::slug($request->get('name'));
            $isUpdated = $category->save();
            return response()->json([
                'message'=>$isUpdated ? 'updated successfully' : 'updated failed'
            ],$isUpdated ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
        } else {
            return response()->json([
                'message' =>   $validator->getMessageBag()->first()
            ],Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(category $category)
    {
      $isDeleted = $category->delete();
      if($isDeleted ){
      return response()->json([
        'title'=> 'Success!',
        'icon' => 'success',
        'text'=> 'Category Deleted Successfully',
      ],Response::HTTP_OK);}
      else{
        return response()->json([
            'title'=> 'Failed!',
            'icon' => 'Failed',
            'text'=> 'Category Deleted Failed',
        ],Response::HTTP_BAD_REQUEST);
      }
    }
}
