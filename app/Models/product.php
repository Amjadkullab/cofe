<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'description', 'category_id', 'admin_id'
    ];



  public function category(){
    return $this->belongsTo(category::class);
  }
  public function admin(){
    return $this->belongsTo(Admin::class);
  }
  public function delivery(){
    return $this->hasone(Delivery::class);
  }


}
