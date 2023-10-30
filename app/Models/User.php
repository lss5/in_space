<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'last_name',
        'description',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function records()
    {
        return $this->hasMany(Record::class);
    }

    public function artists()
    {
        return $this->hasMany(Artist::class);
    }
    public function images()
    {
        return $this->morphMany(Image::class, 'parent');
    }
    public function latestImage()
    {
        return $this->morphOne(Image::class, 'parent')->latestOfMany();
    }
    public function playlists()
    {
        return $this->hasMany(Playlist::class)->orderBy('created_at', 'desc');
    }
    public function likes()
    {
        return $this->hasMany(Like::class)->orderBy('created_at', 'desc');
    }

    public function unlikes()
    {
        return $this->hasMany(Unlike::class)->orderBy('created_at', 'desc');
    }

    public function plays()
    {
        return $this->hasMany(Play::class);
    }

    public function hasAnyRoles($roles)
    {
        if ($this->roles()->whereIn('uniq_name', $roles)->first()) {
            return true;
        }

        return false;
    }

    public function hasRole($role)
    {
        if ($this->roles()->where('uniq_name', $role)->first()) {
            return true;
        }

        return false;
    }

}
