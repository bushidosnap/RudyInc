<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateOrderRequest extends FormRequest
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

            'name\.*' => 'required | min:5',
            'description\.*' => 'required | min:5',
            'price\.*' => 'required | numeric',
            'qty\.*' => 'required | numeric',
            'category\.*' => 'required',

            'client_name' => 'required',
            'tailor_id' => 'required',
            'date_finish' => 'required | date',
            'status' => 'numeric',

        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Product name is required!',
            'description.required' => 'Product description is required!',
            'price.required' => 'Product price is required!',
            'qty.required' => 'Quantity is required!',
            'category.required' => 'Category is missing!',
            'client_name.required' => 'Client name is missing!',
            'date_finish.required' => 'Expected date to finish is missing!',

        ];
    }
}
