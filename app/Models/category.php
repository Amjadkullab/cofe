<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class category extends Model
{
    use HasFactory;

  public function products(){
    return $this->hasMany(product::class);
  }
  public function users(){
    return $this->hasMany(User::class);
  }





}
