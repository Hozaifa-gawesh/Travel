<?php

namespace App\Http\Requests\Dashboard\Offers;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreOffer extends FormRequest
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
            'country_id' => 'required|integer',
            'date_from' => 'required|date|date_format:Y-m-d|after:yesterday',
            'date_to' => 'required|date|date_format:Y-m-d|after:date_from',
            'image' => 'required|image|mimes:jpeg,jpg,png',
            'adult_price' => 'required|numeric|regex:/^\d*(\.\d{1,2})?$/',
            'child_price' => 'required|numeric|regex:/^\d*(\.\d{1,2})?$/',
            'title' => [
                'required',
                'string',
                'max:191',
                Rule::unique('offers', 'title')->where('country_id', $this->country_id)
            ],
        ];
    }

    public function attributes()
    {
        return [
            'country_id' => 'country',
            'adult_price' => 'price for adult',
            'child_price' => 'price for child',
        ];
    }
}
