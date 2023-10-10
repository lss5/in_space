<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

}
