<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\{
    Category, Job
};

class Profession extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'category_id'];

    public function category()
    {
        $this->belongsTo(Category::class);
    }

    /*
    public function jobs()
    {
        return $this->hasMany(Job::class);
    }
    */

}
