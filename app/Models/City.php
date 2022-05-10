<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\{
    Province, User, Job
};

class City extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'province_id'];

    public function province()
    {
        $this->belongsTo(Province::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function jobs()
    {
        return $this->hasMany(Job::class);
    }

}
