<?php

namespace App\Http\Requests\Dashboard\Cities;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCity extends FormRequest
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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'image' => 'sometimes|image|mimes:jpeg,jpg,png',
            'title' => [
                'required',
                'string',
                'max:191',
                Rule::unique('cities', 'title')
                    ->ignore($this->route('item'))->where('country_id', $this->route('id'))
            ],
        ];
    }
}
