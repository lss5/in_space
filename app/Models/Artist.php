<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Artist extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'description',
    ];

    public function records()
    {
        return $this->hasMany(Record::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function scopeForUser(Builder $query, User $user)
    {
        return $query->where('user_id', $user->id);
    }

    public function images()
    {
        return $this->morphMany(Image::class, 'parent');
    }
    public function latestImage()
    {
        return $this->morphOne(Image::class, 'parent')->latestOfMany();
    }

    public function likes()
    {
        return $this->morphMany(Like::class, 'parent');
    }
    public function genres()
    {
        return $this->morphToMany(Genre::class, 'genreable');
    }



}

