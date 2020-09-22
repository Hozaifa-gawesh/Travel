<?php

namespace App\Http\Requests\Dashboard\Offers;

use Illuminate\Foundation\Http\FormRequest;

class CheckDate extends FormRequest
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
            'date_from' => 'required|date|date_format:Y-m-d|after:yesterday',
            'date_to' => 'required|date|date_format:Y-m-d|after:today',
        ];
    }
}
