<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'year',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function artists()
    {
        return $this->belongsToMany(Artist::class);
    }

    public function records()
    {
        return $this->belongsToMany(Record::class);
    }

    public function images()
    {
        return $this->morphMany(Image::class, 'parent');
    }
    public function latestImage()
    {
        return $this->morphOne(Image::class, 'parent')->latestOfMany();
    }

    public function delete()
    {
        //Deleting relations Records
        foreach ($this->images as $image) {
            $image->delete();
        }

        $this->artists()->detach();
        $this->records()->detach();

        return parent::delete();
    }
}
