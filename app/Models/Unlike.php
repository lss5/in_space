<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unlike extends Model
{
    use HasFactory;

    protected $fillable = ['user_id'];

    /**
     * Get the parent liked model (record or artist).
     */
    public function unliked()
    {
        return $this->morphTo('parent');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
