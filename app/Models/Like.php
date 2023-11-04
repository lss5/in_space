<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use App\Models\User;

class Like extends Model
{
    use HasFactory;

    protected $fillable = ['user_id'];

    /**
     * Get the parent liked model (record or artist).
     */
    public function liked()
    {
        return $this->morphTo('parent');
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
