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
            'artist' => ['required', 'integer', 'exists:artists,id'],
            'name' => 'required|string|min:4|max:255',
            'description' => 'nullable|string|max:4096',
            'image' => 'nullable|file|image|max:5000|dimensions:min_width=400,min_height=400',
        ];
    }
}
