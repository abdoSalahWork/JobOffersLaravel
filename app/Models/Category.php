<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['categoryName' , 'categoryDesc'];

    public function job()
    {
        return $this->hasMany(Job::class,'categoryId','id')->where('jobStatus','=', 1);
    }
    // public function allJob()
    // {
    //     return $this->hasMany(Job::class,'categoryId','id')->take(5);
    // }
}
