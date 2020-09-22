<?php

namespace App\Http\Requests\Dashboard\CitiesOffer;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreCityOffer extends FormRequest
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
            'room_type' => 'required|in:single,double',
            'date_from' => 'required|date|date_format:Y-m-d|after:yesterday',
            'date_to' => 'required|date|date_format:Y-m-d|after:date_from',
            'city_id' => [
                'required',
                'integer',
                Rule::unique('offers_cities', 'city_id')->where('offer_id', $this->route('offer_id'))
            ],
            'hotel_id' => [
                'required',
                'integer',
                Rule::unique('offers_cities', 'hotel_id')->where('offer_id', $this->route('offer_id'))
            ],
        ];
    }

    public function attributes()
    {
        return [
            'city_id' => 'city',
            'hotel_id' => 'hotel',
        ];
    }
}
