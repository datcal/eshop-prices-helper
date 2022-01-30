<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddTrackRequest extends FormRequest
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
            'mail' => 'required',
            'url' => 'required',
            'price' => 'required|numeric'
        ];
    }

    public function messages()
    {
        return [
          'mail.required' => 'Email Address must be filled',
          'url.required' => 'Url must be filled',
          'price.required' => 'Price must be filled',
          'price.numeric' => 'Price must be number',
        ];
    }
}
