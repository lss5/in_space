<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\Record;

class UpdateRecordRequest extends FormRequest
{
    protected function prepareForValidation()
    {
        $this->merge([
            'name' => trim($this->name),
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
            'name' => 'required|string|min:2|max:255',
            'description' => 'nullable|string|max:61440',
            'genre'  => 'required|array|exists:genres,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:4096|dimensions:min_width=400,min_height=400',
            'publicity' => ['required', 'string', Rule::in(array_keys(Record::$publicity))],
        ];
    }
}
