<?php

namespace App\Http\Controllers;

use App\Models\product;
use Illuminate\Http\Request;

class cofecontroller extends Controller
{


public function home(){

    return view('front.index');
}

public function about(){
    return view('front.about');
}
public function products(){
    $products = product::all();
    return view('front.products',compact('products'));
}
public function store(){
    return view('front.store');
}




}
