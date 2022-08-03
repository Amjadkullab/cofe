<?php

namespace App\Http\Controllers;

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
    return view('front.products');
}
public function store(){
    return view('front.store');
}




}
