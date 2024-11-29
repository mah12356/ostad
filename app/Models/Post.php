<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public $timestamps = false;
    use HasFactory;
    protected $casts=[
        'name'=>'string',
        'email_verified_at'=>'array',
        'password'=>'string',
    ];
}
