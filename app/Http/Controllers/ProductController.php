<?php

namespace App\Http\Controllers;

use App\Models\category;
use App\Models\product;
use App\Notifications\NewProductNotification;
use Dotenv\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Response as HttpFoundationResponse;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = product::all();
        return view('admin.Products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $admin = Auth::guard('admin')->user();
        $categories = category::select(['id','name'])->get();
        return view('admin.Products.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validator = Validator($request->all(), [

            'name' => 'required|string',
            'description' => 'required|string',
            'image' => 'required|image',
            'category_id' => 'required'
        ]);
     $admin = Auth::guard('admin')->user();
        if (!$validator->fails()) {

            $product = new product();
            $product->name = $request->get('name');
            $product->description = $request->get('description');

            $ex = $request->file('image')->getClientOriginalExtension();
            $new_img_name = 'vision_cofe' . '.' . time() . '.' . $ex;
            $request->file('image')->move(public_path('uploads'), $new_img_name);
            $product->image = $new_img_name ;
            $product->category_id = $request->get('category_id');
            $isSaved = $product->save();
            $product->admin->notify(new NewProductNotification($product ,$admin));
            return response()->json([
                'message' => $isSaved ? 'Saved Successfully' : 'Failed Successfully'
            ], Response::HTTP_OK);
        } else {
            return response()->json([
                'mesaage' => $validator->getMessageBag()->first()
            ], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(product $product)
    {
        $categories = category::select(['id','name'])->get();
        return view('admin.Products.edit',compact('product','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, product $product)
    {
       $validator = Validator($request->all(),[
        'name' => 'required|string',
        'description' => 'required|string',
        'image' =>  'required|image',
        'category_id' =>  'required'
       ]);
       if(!$validator->fails()){
       $product->name = $request->get('name');
       $product->description= $request->get('description');
       $new_img_name=$product->image;
       if($request->has('image')){
        $ex = $request->file('image')->getClientOriginalExtension();
        $new_img_name = 'vision_cofe' . '.' . time() . '.' . $ex;
        $request->file('image')->move(public_path('uploads'), $new_img_name);
        $product->image = $new_img_name;
       }

       $product->catgeory_id = $request->get('category_id');

       $isUpdated = $product->save();
       return response()->json([
        'message'=> $isUpdated ? 'Updated Successfully' : 'Updated Failed '
       ],Response::HTTP_OK);
       } else {
        return response()->json([
            'message'=> $validator->getMessageBag()->first()
        ],Response::HTTP_BAD_REQUEST);
       }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(product $product)
    {
        $isdeleted = $product->delete();
        if ($isdeleted) {
            return response()->json([
                'icon' => 'success',
                'text' => 'Product Deleted Successfully',
                'title' => 'Success!',

            ], Response::HTTP_OK);
        } else {
            return response()->json([
                'icon' => 'Failed',
                'text' => 'Product Deleted Failed',
                'title' => 'Failed!',
            ], Response::HTTP_BAD_REQUEST);
        }
    }
}
