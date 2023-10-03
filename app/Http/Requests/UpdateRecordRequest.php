<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRecordRequest extends FormRequest
{

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
            'image' => 'nullable|file|image|max:5000|dimensions:min_width=400,min_height=400',
        ];
    }
}
