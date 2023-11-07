<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Artist extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'description',
    ];

    public static $statuses = [
        'created' => 'Создан',
        'active' => 'Активный',
        'banned' => 'Заблокирован',
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

    public function dislikes()
    {
        return $this->morphMany(Dislike::class, 'parent');
    }

    public function genres()
    {
        return $this->morphToMany(Genre::class, 'genreable');
    }

    public function scopeActive(Builder $query)
    {
        return $query->where('status', 'active');
    }

    public function delete()
    {
        // TODO: delete relation Likes and Dislikes

        //Deleting relations Records
        foreach ($this->images as $image) {
            $image->delete();
        }

        // Deleting relation records
        foreach ($this->records as $record) {
            $record->delete();
        }


        return parent::delete();
    }

}

