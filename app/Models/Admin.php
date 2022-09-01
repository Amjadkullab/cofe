<?php

namespace App\Models;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use HasFactory,HasRoles,Notifiable;
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

public function getStatusAttribute(){
    return  $this->active ? 'Active' : 'Disabled' ;
}
public function products(){
    return $this->hasMany(product::class);
}


}
