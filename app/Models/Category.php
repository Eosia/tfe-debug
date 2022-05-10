<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\{
    Profession,
    Job
};

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function professions()
    {
        return $this->hasMany(Profession::class);
    }

    /*
    public function jobs()
    {
        return $this->hasMany(Job::class);
    }
    */

}
