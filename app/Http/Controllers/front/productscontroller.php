<?php

namespace App\Http\Controllers\front;

use App\Models\product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class productscontroller extends Controller
{
  public function show(product $product){
    $delivery = $product->delivery()->select([
        'id','product_id','status',
        DB::raw("ST_X(current_location)As lng"),
        DB::raw("ST_Y(current_location) As lat")


    ])->first();
    return view('admin.productss.show',[
        'product'=>$product,
        'delivery'=>$delivery
    ]);
  }
}
