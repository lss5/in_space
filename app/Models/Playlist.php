<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Playlist extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'publicity',
    ];

    public static $publicity = [
        'person' => 'Личный',
        'public' => 'Публичный',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function records()
    {
        return $this->belongsToMany(Record::class)
            ->withTimestamps();
    }

    public function delete()
    {
        $this->records()->detach();

        return parent::delete();
    }
}
