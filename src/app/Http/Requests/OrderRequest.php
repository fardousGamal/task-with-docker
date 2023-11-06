<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class OrderRequest extends FormRequest
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
             'products' => 'required|array',
            'products.*.quantity' => 'required|integer|min:1',
            'products.*.product_id' => ['required', 'integer', 'distinct', Rule::exists('products', 'id')],
      
        ];
    }
}
