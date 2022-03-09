<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;
    protected $visible = ['id', 'jobTitle', 'jobContent', 'jobImage'];
    protected $fillable = [
        'jobTitle',
        'jobContent',
        'jobImage',
        'categoryId',
        'userId',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'userId', 'id');
    }
    public function category()
    {
        return $this->belongsTo(Category::class, 'categoryId', 'id');
    }

    public function applyForJob()
    {
        return $this->hasMany(ApplyForJob::class, 'jobId', 'id')->with('user')->orderBy('updated_at', 'DESC');
    }
}
