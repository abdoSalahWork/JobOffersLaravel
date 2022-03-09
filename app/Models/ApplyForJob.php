<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApplyForJob extends Model
{
    use HasFactory;

    protected $visible = ['id','message' , 'updated_at' , 'user'];

    protected $fillable = [
        'message',
        'jobId',
        'userId',
    ];
    public function user()
    {
        return $this->belongsTo(User::class,'userId','id');
    }
}
