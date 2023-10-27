<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'name' => trim($this->name),
            'last_name' => trim($this->last_name),
            'description' => trim($this->description),
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
            'name' => 'required|string|min:3|max:100',
            'last_name' => 'required|string|min:3|max:100',
            'description' => 'nullable|string|min:2|max:4096',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:4096|dimensions:min_width=400,min_height=400',
        ];
    }
}
