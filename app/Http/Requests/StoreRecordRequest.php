<?php

namespace App\Http\Requests;

use App\Models\Record;
use Illuminate\Validation\Rule;
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

    protected function prepareForValidation()
    {
        $this->merge([
            'name' => trim($this->name),
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
            'year' => 'required|integer|min:1920|max:2030',
            'name' => 'required|string|min:2|max:255',
            'description' => 'nullable|string|max:61440',
            'artist' => 'required|integer|exists:artists,id',
            'genre'  => 'required|array|exists:genres,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:4096|dimensions:min_width=400,min_height=400',
            'record' => 'required|file|mimes:mp3,ogg,flac,mpeg,ogg,mp4,webm,3gp,mov,flv,avi,wmv|max:131072',
            'publicity' => ['required', 'string', Rule::in(array_keys(Record::$publicity))],
            // mimetypes:video/avi,video/mpeg,video/quicktime
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'year.min' => 'Год должен быть в разумных пределах',
            'required' => 'Поле :attribute обязательно для заполнения',
            'record.required' => 'Выберите файл записи',
            'name.required' => 'Необходимо ввести название записи',
            'genre.required' => 'Необходимо выбрать хотя бы один Жанр',
        ];
    }
}
