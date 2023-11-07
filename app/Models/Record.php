<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Record extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $with = ['artist'];

    protected $fillable = [
        'name',
        'description',
        'publicity',
    ];

    public static $statuses = [
        'created' => 'Создан',
        'active' => 'Активный',
        'banned' => 'Заблокирован',
    ];

    public static $content_types = [
        'audio' => 'Аудиозапись',
        'video' => 'Видеозапись',
    ];

    public static $publicity = [
        'person' => 'Личный',
        'public' => 'Для всех',
    ];

    public function artist()
    {
        return $this->belongsTo(Artist::class);
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

    public function playlists()
    {
        return $this->belongsToMany(Playlist::class);
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

    public function plays()
    {
        return $this->hasMany(Play::class);
    }

    public function purchasers()
    {
        return $this->hasMany(Purchase::class);
    }

    public function scopeActive(Builder $query)
    {
        return $query->where('status', 'active');
    }
    
    public function scopeAudio(Builder $query)
    {
        return $query->where('content_type', 'audio');
    }

    public function scopeVideo(Builder $query)
    {
        return $query->where('content_type', 'video');
    }

    public function delete()
    {
        // Deleting relations Images
        foreach ($this->images as $image) {
            $image->delete();
        }

        // Deleting Like
        foreach ($this->likes as $like) {
            $like->delete();
        }

        // Deleting Dislike
        foreach ($this->dislikes as $dislike) {
            $dislike->delete();
        }

        // Deleting record file
        if (Storage::disk('public')->exists($this->link)) {
            Storage::disk('public')->delete($this->link);
        }

        // Deleting relations with Playlist
        $this->playlists()->detach();

        return parent::delete();
    }

}

