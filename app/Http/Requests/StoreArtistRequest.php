<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class StoreArtistRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can('create', Artist::class);
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'name' => Str::ucfirst(trim($this->name)),
            'description' => trim($this->description),
            'status' => 'created',
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|min:4|max:255',
            'description' => 'nullable|string|max:4096',
//            'image' => 'required|file|image|max:5000|dimensions:min_width=500,min_height=400',
            'image' => 'nullable',
        ];
    }
}
