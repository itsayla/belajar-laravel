<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    //insert into users ()
    //DB::insert 
    //Role::create
    protected $fillable = ['name', 'is_active'];
}
