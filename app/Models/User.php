<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Filament\Models\Contracts\FilamentUser;
use Filament\Models\Contracts\HasName;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;


use App\Models\{
    Role, Province, City, Job, Proposal, Conversation
};

class User extends Authenticatable implements FilamentUser
{

    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use HasSlug;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'firstname',
        'lastname',
        'slug',
        'email',
        'password',
        'role_id',
        'level_id',
        'suspended',
        //'province_id',
        'city_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug')
            ->doNotGenerateSlugsOnUpdate();
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function level()
    {
        return $this->belongsTo(Level::class);
    }

    /*
    public function province()
    {
        return $this->belongsTo(Province::class);
    }
    */

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function jobs()
    {
        return $this->hasMany(Job::class);
    }

    public function proposals()
    {
        return $this->hasMany(Proposal::class);
    }

    public function likes()
    {
        return $this->belongsToMany(Job::class)->withTimestamps()->orderByDesc('job_user.created_at');
    }

    public function conversations()
    {
        return Conversation::where(function ($q) {
            $q->where('to', $this->id)
                ->orWhere('from', $this->id);
        });
    }

    public function getConversationsAttribute()
    {
        return $this->conversations()->get();
    }

    // Restriction pour domaine pour l'accès à l'espace admin
    public function canAccessFilament(): bool
    {
        return str_ends_with($this->email, '@gmail.com') && $this->level_id != 3 && $this->hasVerifiedEmail();
    }

}
