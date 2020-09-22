<?php

namespace App\Http\Requests\Dashboard\Hotels;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreHotel extends FormRequest
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
            'country' => 'required|integer',
            'city_id' => 'required|integer',
            'services' => 'required|array',
            'image' => 'required|image|mimes:jpeg,jpg,png',
            'title' => [
                'required',
                'string',
                'max:191',
                Rule::unique('hotels', 'title')->where('city_id', $this->city_id)
            ],
        ];
    }

    public function attributes()
    {
        return [
            'city_id' => 'city',
        ];
    }
}
