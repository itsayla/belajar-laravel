<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Major extends Model
{
    protected $fillable = [
        'name', 
        'is_active'
    ];

    
    public function major () 
    {
        return $this->hasMany(Student::class); 
    }
}

// Object relation model 
// One to one : jarang sekali dipakai 
// One to many : satu ke banyak 
// Many to many 

