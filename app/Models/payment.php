<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class payment extends Model
{
    use HasFactory;
    protected $casts =[
        'data' => 'json',
    ];   // هاي لازم نعماها عشان انا رجعت البيانات ك json
}
