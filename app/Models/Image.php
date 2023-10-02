<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image as ImageFacade;

class Image extends Model
{
    use HasFactory;

    protected $fillable = ['link'];

    public function imageble()
    {
        return $this->morphTo();
    }

    public function artists()
    {
        return $this->morphedByMany(Artist::class, 'parent');
    }
    public function records()
    {
        return $this->morphedByMany(Record::class, 'parent');
    }

    public function save(array $options = [])
    {
        $save = parent::save($options);

        // crop image
        $imageFacade = ImageFacade::make(public_path('storage/'.$this->link))->fit(720, 600, function ($constraint) {
            $constraint->upsize();
        });
        $imageFacade->save();

        return $save;
    }

    public function delete()
    {
        if (Storage::disk('public')->exists($this->link)) {
            Storage::disk('public')->delete($this->link);
        }
        return parent::delete();
    }
}
