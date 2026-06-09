<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'major_id', 
        'name', 
        'phone' 
    ];

    public function major () 
    {
        return $this->belongsTo(Major::class, 'major_id', 'id'); 
    }
}

// Object relation model 
// One to one : jarang sekali dipakai 
// One to many : satu ke banyak 
// Many to many 

