<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Record extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $with = ['artist'];

    protected $fillable = [
        'name',
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

}

