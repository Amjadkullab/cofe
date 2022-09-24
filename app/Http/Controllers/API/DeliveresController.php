<?php

namespace App\Http\Controllers\Api;

use App\Models\Delivery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class DeliveresController extends Controller
{
   public function update(Request $request , Delivery $delivery){

 $request->validate([
 'lng'=>['required','numeric'],
 'lat'=>['required','numeric'],
 ]);
 $delivery->update([
    'current_location'=>DB::raw("POINT({$request->lng},{$request->lat})")// عشان خزنت فيه ال db صف من نوع point اضطريت هان اضيف حقل خام
 ]);

return $delivery ;
   }


   public function show($id){

  $delivery = Delivery::query()->select([
    'id','product_id','status',
    DB::raw("ST_X(current_location)As lng"),
    DB::raw("ST_Y(current_location) As lat")

  ])->where('id',$id)->firstOrFail();

    return $delivery;
   }
}
