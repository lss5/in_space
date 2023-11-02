<?php

namespace App\Http\Requests;

use App\Models\Record;
use Illuminate\Foundation\Http\FormRequest;

class StoreRecordRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->artists->contains($this->artist);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'artist' => 'required|integer|exists:artists,id',
            'genre'  => 'required|array|exists:genres,id',
            'name' => 'required|string|min:2|max:255',
            'description' => 'nullable|string|max:61440',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:4096|dimensions:min_width=400,min_height=400',
            'audio' => 'required|file|mimes:mp3,ogg,flac|max:9216',
        ];
    }
}
