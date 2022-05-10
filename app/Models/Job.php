<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

use App\Models\{
    User, Category, Profession, Proposal, CoverLetter, City, province
};

class Job extends Model
{
    use HasFactory, HasSlug;

    protected $fillable = ['title', 'user_id', 'slug', 'content','status', 'moderate', 'profession_id', 'city_id', 'time', 'proposal_name', 'conversation_id'];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug')
            ->doNotGenerateSlugsOnUpdate();
    }

    public function scopeOnline($query)
    {
        return $query->where('status', 1);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /*
    public function category()
    {
        $this->belongsTo(Category::class);
    }
    */

    public function profession()
    {
        return $this->belongsTo(Profession::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    /*
    public function province()
    {
        $this->belongsTo(Province::class);
    }
    */

    public function proposals()
    {
        return $this->hasMany(Proposal::class);
    }

    public function likes()
    {
        return $this->belongsToMany(User::class);
    }


    public function isLiked()
    {
        if (!auth()->check()) {
            return false;
        }
        return auth()->user()->likes->contains('id', $this->id);
    }

    protected $casts = [
        'moderate' => 'boolean',
    ];

}


