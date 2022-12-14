<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Passport\HasApiTokens;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;

use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory, Notifiable,HasRoles,HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'provider',
        'provider_id',
        'provider_token',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'provider_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function getActiveStatusAttribute(){
        return $this->active ? 'active' : 'disabled';
    }
    public function category(){
        return $this->belongsTo(category::class);
    }
    public function findForPassport($username)
    {
        return $this->where('email', $username)->first();
    }
    public function validateForPassportPasswordGrant($password)
    {
        return Hash::check($password, $this->password);
    }
    public function setproviderTokenAttribute($value){
        $this->attributes['provider_token'] = Crypt::encryptString($value);
    }
    public function getproviderTokenAttribute($value){
        return Crypt::decryptString($value);// هيك انا فكيت التشفير
    }
}
